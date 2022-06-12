<?php
require_once 'MysqliDb.php';
$newdb = new MysqliDb('localhost', 'root', '', 'db_examine');

class Helper
{
    public $db;

    public function __construct()
    {
        global $newdb;
        $this->db = $newdb;
    }

    public function sanitize_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    // Mail Send
    // public function send_mail($email,$subject,$body){
    //     try {
    //         $this->mail->isSMTP();
    //         $this->mail->Host = 'smtp.mailtrap.io';
    //         $this->mail->SMTPAuth = true;
    //         $this->mail->Port = 2525;
    //         $this->mail->Username = 'ef4113ce44efb0';
    //         $this->mail->Password = 'a0aff7124fdd5f';
    //         $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //         $this->mail->setFrom('admin@gmail.com', 'MD Iqbal Hossen');
    //         $this->mail->addAddress($email);
    //         $this->mail->isHTML(true);
    //         $this->mail->Subject = $subject;
    //         $this->mail->Body = $body;
    //         $this->mail->send();
    //     } catch (PDOException $e) {
    //         echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
    //     }
    // }
    // Error Or Success Message Alert
    public function message($type, $message)
    {
        $output = '<div class="alert alert-' . $type . ' alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert">&times;</button>
                 <strong class="text-center">' . $message . '</strong>
                 </div>';

        return $output;
    }

    // Display Time InAgo Formate
    public function timeAgo($timestamp)
    {
        date_default_timezone_set('Asia/Dhaka');

        $timestamp = strtotime($timestamp) ? strtotime($timestamp) : $timestamp;

        $time = time() - $timestamp;

        switch ($time) {
                //second
            case $time <= 60:
                return 'Just Now!';
                // minute
            case $time >= 60 && $time < 3600:
                return (round($time / 60) == 1) ? 'a minute ago' : round($time / 60) . ' minutes ago';
                // hours
            case $time >= 3600 && $time < 86400:
                return (round($time / 3600) == 1) ? 'an hours ago' : round($time / 3600) . ' hours ago';
                // Days
            case $time >= 86400 && $time < 604800:
                return (round($time / 86400) == 1) ? 'a days ago' : round($time / 86400) . ' days ago';
                // Weeks
            case $time >= 604800 && $time < 2600640:
                return (round($time / 604800) == 1) ? 'a week ago' : round($time / 604800) . ' weeks ago';
                // Months
            case $time >= 2600640 && $time < 31207680:
                return (round($time / 2600640) == 1) ? 'a month ago' : round($time / 2600640) . ' months ago';
                // years
            case $time >= 31207680:
                return (round($time / 31207680) == 1) ? 'a year ago' : round($time / 31207680) . ' years ago';
            default:
                // code...
                break;
        }
    }

    public function userId()
    {
        $prefix = date('y');
        $number = rand(1000, 9999);
        $uniqe_id = $prefix . $number;
        return $uniqe_id;
    }

    public function image_validation($image)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $image['tmp_name']);
        if ($file_type != "image/jpeg" && $file_type != "image/jpg" && $file_type != "image/png") {
            return "not_image";
        }

        $size = $image['size'];
        $mb_5 = 5000000;

        if ($size > $mb_5) {
            return "file_size";
        }

        return 1;
    }


    public function file_validation($file)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $file['tmp_name']);
        if ($file_type != "application/pdf") {
            return "not_file";
        }

        $size = $file['size'];
        $mb_5 = 5000000;

        if ($size > $mb_5) {
            return "file_size";
        }

        return 1;
    }


    public function result($exam_id, $user_id){
        $this->db->where('id',$exam_id);
        $exam = $this->db->getOne('exam');

        $total_mark = $exam['total_mark'];
        $negetive_marks = $exam['negetive_marks'];
        $pass_marks = $exam['pass_parcentage'];
        $total_question = $exam['total_question'];

        $question_per_marks = $total_mark / $total_question;

        $this->db->where('id', $user_id);
        $free_exam_data = $this->db->getOne('free_exam');
        $total_correct_ans = 0;
        $total_incorrect_ans = 0;


        $result = json_decode($free_exam_data['answer'], true);
        echo $free_exam_data['name']."\n";
        foreach($result as $key => $val){
            $this->db->where('id', $key);
            $question = $this->db->getOne('question');
            if($question['correct_option'] == $val){
                $total_correct_ans++;            
            }else{
                $total_incorrect_ans++;            
            }
        }
        $gained_marks = $total_correct_ans * $question_per_marks;
        $neg_marks = $total_incorrect_ans * ($negetive_marks/100);
        $total_marks = $gained_marks-$neg_marks;


        if($total_marks >= ($total_mark*($pass_marks/100))){
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

        $this->db->insert('result', $data);

    }


    public function menu_active($file_name)
    {
        if (basename($_SERVER['PHP_SELF']) == $file_name) {
            echo "active";
        } else {
            echo "";
        }
    }

}
