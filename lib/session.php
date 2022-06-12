<?php

session_start();

require_once 'classes/MysqliDb.php';
require_once 'classes/Helper.php';

$db = new MysqliDb('localhost', 'root', '', 'db_examine');
$help = new Helper();

if(isset($_SESSION['member'])){
    $username = $_SESSION['member'];
}else{
    $username = '';
}

$db->where('username', $username);
$db->orWhere('user_id', $username);
$member_data = $db->getOne('member');

// Category
$db->where('cat_status',1);
$category = $db->get('category');

if(isset($_SESSION['member'])){
    $user_id = $member_data['user_id'];
    $db->join("category", "enroll.cat_id=category.id", "INNER");
    $db->where("enroll.user_id", $user_id,);
    $db->where('enroll.status','Accepted');
    $enroll_data = $db->getOne("enroll","category.cat_name, enroll.*");
}


// Fetch Exam
$db->where('exam_fees',0);
$cat = $db->getValue('category','id');

$db->where('cat_id', $cat);
$exam = $db->getOne('exam');

$exam_id = $exam['id'];
$exam_duration = $exam['duration'];
$exam_start_time = strtotime($exam['exam_started']);
$exam_end_time = strtotime($exam['exam_end']);

$db->where('exam_id',$exam_id);
$question = $db->get('question');