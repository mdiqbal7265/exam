<?php
require_once 'lib/classes/MysqliDb.php';
$db = new MysqliDb('localhost', 'root', '', 'db_examine');

$exam_id = 3;
$user_id = 8;

$db->where('id',$exam_id);
$exam = $db->getOne('exam');

$total_mark = $exam['total_marks'];
$negetive_marks = $exam['negetive_marks'];
$pass_marks = $exam['pass_parcentage'];
$total_question = $exam['total_question'];

$question_per_marks = $total_mark / $total_question;

$db->where('id', $user_id);
$free_exam_data = $db->getOne('free_exam');
$total_correct_ans = 0;
$total_incorrect_ans = 0;


$result = json_decode($free_exam_data['answer'], true);
echo $free_exam_data['name']."\n";
foreach($result as $key => $val){
    $db->where('id', $key);
    $question = $db->getOne('question');
    if($question['correct_option'] == $val){
        $total_correct_ans++;            
    }else{
        $total_incorrect_ans++;            
    }
}
$gained_marks = $total_correct_ans * $question_per_marks;
$neg_marks = $total_incorrect_ans * ($negetive_marks/100);
$total_marks = $gained_marks-$neg_marks;


if($total_marks >= ($total_marks*0.60)){
    $status = "Passed";
}else{
    $status = "Failed";
}

$data = [
    'exam_id' => $exam_id,
    'user_id' => $user_id,
    'correct_ans' => $total_correct_ans,
    'incorrect_ans' => $total_incorrect_ans,
    'total_marks' => $gained_marks,
    'neg_marks' => $neg_marks,
    'final_marks' => $total_marks,
    'status' => $status,
];

$db->insert('result', $data);



?>