<?php
// error_reporting(0);
date_default_timezone_set('Asia/Dhaka');
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
        'clg_name' => $help->sanitize_data($_POST['clg_name']),
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
    $db->where('username',$username);
    $db->orWhere('user_id',$username);
    $loggedIn = $db->getOne('member');
    if ($loggedIn != null) {
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
    $data = $_POST;
    array_pop($data);
    $user_id = $_POST['user_id'];
    $exam_id = $_POST['exam_id'];
    $answer = [
        'user_id' => $user_id,
        'exam_id' => $exam_id,
        'answer' => json_encode(array_slice($data,2)),
    ];    
    if($db->insert('answer',$answer)){
        $help->result($exam_id,$user_id);
    }else{
        echo $db->getLastError();
    }
}

// Search result
if(isset($_POST['action']) && $_POST['action'] == 'result_search'){
    $output = "";
    $number = $help->sanitize_data($_POST['number']);
    $db->where('phone',$number);
    $data = $db->getOne('free_exam');

    $output .= '<div class="card border border-info mt-2">';

    if($data){
        $db->where('user_id', $data['id']);
        $result = $db->getOne('result');
        $total_ans = $result['correct_ans']+$result['incorrect_ans'];

        $db->where('exam_id', $result['exam_id']);
        $question = $db->get('question');

        if($result){
            $output .= '<div class="card-header border-bottom border-info">
                            <h4 class="d-inline">'.$data['name'].'</h4>
                            <h4 class="d-inline mr-3 badge badge-info p-2 float-right">Total Answered: '.$total_ans.'</h4>
                            <h4 class="d-inline mr-3 badge badge-success p-2 float-right">Correct Answered: '.$result['correct_ans'].'</h4>
                            <h4 class="d-inline mr-3 badge badge-primary p-2 float-right">Total Marks: '.$result['total_marks'].'</h4>              
                        </div>';
            $output .= '<div class="card-body">';

            // Answer
            $answer = json_decode($data['answer'], true);


            foreach($question as $key => $value){
                $output .= '<p>'.($key+1).'.'.$value['question'].'</p>';
                $output .= '<input type="radio"><label for="">'.$value['option1'].'</label> ';
                if($value['correct_option'] == 1){
                    $output .= '<i class="fa fa-check-circle text-success"></i>';
                }else if($answer[$value['id']] == 1){
                    $output .= '<i class="fa fa-times-circle text-danger"></i>';
                }
                $output .= '<br><input type="radio"><label for="">'.$value['option2'].'</label> ';
                if($value['correct_option'] == 2){
                    $output .= '<i class="fa fa-check-circle text-success"></i>';
                }else if($answer[$value['id']] == 2){
                    $output .= '<i class="fa fa-times-circle text-danger"></i>';
                }
                $output .= '<br><input type="radio"><label for="">'.$value['option3'].'</label>';
                if($value['correct_option'] == 3){
                    $output .= '<i class="fa fa-check-circle text-success"></i>';
                }else if($answer[$value['id']] == 3){
                    $output .= '<i class="fa fa-times-circle text-danger"></i>';
                }
                $output .= '<br><input type="radio"><label for="">'.$value['option4'].'</label>';
                if($value['correct_option'] == 4){
                    $output .= '<i class="fa fa-check-circle text-success"></i>';
                }else if($answer[$value['id']] == 4){
                    $output .= '<i class="fa fa-times-circle text-danger"></i>';
                }

                if($value['answer'] != ""){
                    $output .= '<div class="solution mt-2 shadow p-3 mb-3 bg-white rounded border-left border-success">
                                    '.$value['answer'].'
                            </div>';
                }
            }
            $output .= '</div>';
            $output .= '<div class="card-footer border-top border-info">
                            <a href="index.php" class="btn btn-success float-right">Back</a>
                        </div>';
        }else{
            $output .= '<h2 class="text-center text-danger">You didn\'t attend in this exam</h2>';
        }        
    }else{
        $output .= '<h2 class="text-center text-danger">Your Phone Number Didn\'t found. Please Write Correct Number</h2>';
    }

    $output .= '</div>';
    echo $output;
    // $question = array_merge($question, $answer);
    // print_r($question);
}