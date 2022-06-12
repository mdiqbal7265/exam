<?php
session_start();

require_once 'classes/MysqliDb.php';
require_once 'classes/Helper.php';

$db = new MysqliDb('localhost', 'root', '', 'db_examine');
$help = new Helper();




// Handle User Register From
if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $name = $help->sanitize_data($_POST['name']);
    $password = $help->sanitize_data($_POST['password']);
    $password = password_hash($password, PASSWORD_BCRYPT);

    $member = [
        'name' => $name,
        'email' => $help->sanitize_data($_POST['email']),
        'phone' => $help->sanitize_data($_POST['phone']),
        'username' => $help->sanitize_data($_POST['username']),
        'user_id' => $help->userId(),
        'password' => $password,
    ];

    $db->where('username',$member['username']);
    $member_exists = $db->getOne('member');

    if ($member_exists) {
        echo 'user_exists';
    } else {
        if ($db->insert('member',$member)) {
            echo 'register';
            $_SESSION['member'] = $member['username'];
        } else {
            echo 'failed';
        }
    }
}

// Hnadle Member Login
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $username = $help->sanitize_data($_POST['username']);
    $password = $help->sanitize_data($_POST['password']);
    $db->where('username',$username);
    $db->orWhere('user_id',$username);
    $loggedIn = $db->getOne('member');
    if ($loggedIn != null) {
        if (password_verify($password, $loggedIn['password'])) {
            if (!empty($_POST['rem'])) {
                setcookie("username", $username, time() + (30 * 24 * 60 * 60), '/');
                setcookie("password", $password, time() + (30 * 24 * 60 * 60), '/');
            } else {
                setcookie("username", "", 1, '/');
                setcookie("password", "", 1, '/');
            }

            echo "login";
            $_SESSION['member'] = $username;
        } else {
            echo 'password_not_matched';
            //echo $help->message('danger','Password didn\'t matched with your email');
        }
    } else {
        echo 'data_not_found';
        //echo $help->message('danger','We didn\'t find your email in our database');
    }
}

// Handle Member Logout
if (isset($_POST['action']) && $_POST['action'] == 'logout') {
    unset($_SESSION['member']);
    echo 'logout';
}

// Handle Store Enroll Course Data
if (isset($_POST['action']) && $_POST['action'] == 'enroll_submit'){
    $data = [
        'user_id' => $help->sanitize_data($_POST['user_id']),
        'cat_id' => $help->sanitize_data($_POST['cat_id']),
        'number' => $help->sanitize_data($_POST['phone']),
        'tr_id' => $help->sanitize_data($_POST['tr_id']),
    ];

    $db->where('user_id',$data['user_id']);
    $user = $db->getOne('member');
    if($user){
        $db->insert('enroll',$data);
    }else{
        echo 'not_found';
    }
}

// Handle View Details
if (isset($_POST['action']) && $_POST['action'] == 'viewDetails'){
    $id = $_POST['id'];
    $db->where('id',$id);
    $cat = $db->getOne('category');
    echo json_encode($cat);
}

// Handle Add Free Exam
if(isset($_POST['action']) && $_POST['action'] == 'add_free_exam'){
    $data = [
        'name' => $help->sanitize_data($_POST['name']),
        'clg_name' => $help->sanitize_data($_POST['clg_name']),
        'phone' => $help->sanitize_data($_POST['phone']),
        'exam_id' => $help->sanitize_data($_POST['exam_id']),
    ];

    $id = $db->insert('free_exam',$data);
    if($id){
        echo "added";
        $_SESSION['free_exam_id'] = $id;
    }else{
        $db->getLastError();
    }
}

// Handle Submit Exam
if(isset($_POST['action']) && $_POST['action'] == 'submit_question'){
    $id = $_SESSION['free_exam_id']."\n";
    $data = $_POST;
    array_pop($data);
    $answer = [
        'answer' => json_encode($data)
    ];

    $db->where('id', $id);
    $exam_id = $db->getValue('free_exam','exam_id');

    $db->where('id', $id);
    if($db->update('free_exam', $answer)){
        $help->result($exam_id,$id);
        unset($_SESSION['free_exam_id']);
    }else{
        echo $db->getLastError();
    }
}