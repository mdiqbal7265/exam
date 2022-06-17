<?php

session_start();

require_once 'classes/MysqliDb.php';
require_once 'classes/Helper.php';
$db = new MysqliDb('localhost', 'root', '', 'db_examine');
$help = new Helper();

if (!isset($_SESSION['email'])) {
    header('location: index.php');
    die();
}

// Category
// $db->where('cat_status', 1);
$category = $db->get('category');

$email = $_SESSION['email'];
$db->where('email', $email);
$admin_data = $db->getOne('admin');


if (isset($_GET['exam_id']) && $_GET['exam_id'] != null) {
    $id = $help->sanitize_data($_GET['exam_id']);

    // Fetch Exam
    $db->join('exam', 'question.exam_id = exam.id', 'INNER');
    $db->where('question.exam_id', $id);
    $question_data = $db->get('question', null, 'question.*,exam.title');

    if($question_data){
        $exam_title = $question_data[0]['title'];
    }else{
        $exam_title = "";
    }

    // Fetch Result

    $db->join('free_exam','result.user_id=free_exam.id','INNER');
    $db->join('exam','result.exam_id=exam.id','INNER');
    $db->where('result.exam_id', $id);
    $result = $db->get('result',null,'result.*,free_exam.name,free_exam.clg_name,exam.total_mark'); 


}


// total Student
$total_student = $db->getValue('member', 'count(*)');
$total_enroll = $db->getValue('enroll', 'count(*)');
$total_exam = $db->getValue('exam', 'count(*)');
$total_payment = $db->getValue('enroll', 'count(*)');
$total_payment = $total_payment * 20;

$student = $db->get('member');