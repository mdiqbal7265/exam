<?php
session_start();
require_once 'classes/MysqliDb.php';
require_once 'classes/Helper.php';

$db = new MysqliDb('localhost', 'root', '', 'db_examine');
$help = new Helper();


// Handle admin Login
if (isset($_POST['action']) && $_POST['action'] == 'admin_login') {
    $email = $help->sanitize_data($_POST['email']);
    $password = $help->sanitize_data($_POST['password']);

    $db->where('email', $email);
    $loggedIn = $db->getOne('admin');
    if ($loggedIn != null) {
        if (password_verify($password, $loggedIn['password'])) {
            if (!empty($_POST['rem'])) {
                setcookie("email", $email, time() + (30 * 24 * 60 * 60), '/');
                setcookie("password", $password, time() + (30 * 24 * 60 * 60), '/');
            } else {
                setcookie("email", "", 1, '/');
                setcookie("password", "", 1, '/');
            }

            echo "login";
            $_SESSION['email'] = $email;
        } else {
            echo 'password_not_matched';
            //echo $help->message('danger','Password didn\'t matched with your email');
        }
    } else {
        echo 'data_not_found';
        //echo $help->message('danger','We didn\'t find your email in our database');
    }
}



// Handle Admin Logout
if (isset($_POST['action']) && $_POST['action'] == 'admin_logout') {
    unset($_SESSION['email']);
    echo 'logout';
}

// Handle Student Fetch Data
if (isset($_POST['action']) && $_POST['action'] == 'fetchStudent') {
    $output = '';
    $data = $db->get('member');
    if ($data) {
        foreach ($data as $key => $value) {
            $output .= "<tr>
                <td>" . ++$key . "</td>
                <td>
                    <img src='../assets/img/" . $value['photo'] . "' width='32px' alt=''>
                </td>
                <td>{$value['name']}</td>
                <td>{$value['clg_name']} </td>
                <td>{$value['phone']}</td>
                <td>{$value['username']}</td>
                <td>{$value['user_id']}</td>
                <td>
                    <a href='#' id='{$value['id']}' class='btn btn-danger btn-sm dltStudent'><i class='fa fa-trash'></i></a>
                </td>
            </tr>";
        }

        echo $output;
    } else {
        echo '<h2 class="text-danger">No student available here!</h2>';
    }
}


// Handle Fetch Category Data
if (isset($_POST['action']) && $_POST['action'] == 'fetchCategory') {
    $output = '';
    $data = $db->get('category');
    if ($data) {
        foreach ($data as $key => $value) {
            $output .= "<tr>
                <td>" . ++$key . "</td>
                <td>
                    <img src='../assets/img/" . $value['photo'] . "' width='32px' alt=''>
                </td>
                <td>{$value['cat_name']}</td>
                <td>" . ($value['cat_status'] == 1 ? '<span class="badge badge-success">Enable</span>' : '<span class="badge badge-danger">Disable</span>') . " </td>
                <td>" . ($value['exam_fees'] == 0 ? '<span class="badge badge-danger p-2">Free Exam</span>' : '<span class="badge badge-success p-2">' . $value['exam_fees'] . ' TK</span>') . " </td>
                <td><a href='../assets/img/" . $value['syllabus'] . "' target='_blank'>{$value['syllabus']}</a></td>
                <td>{$help->timeAgo($value['created_at'])}</td>
                <td>
                    <a href='#' id='{$value['id']}' class='btn btn-primary btn-sm addDetail' title='Add Details' data-toggle='modal' data-target='#add-description-modal'><i class='fa fa-plus-circle'></i></a>
                    <a href='#' id='{$value['id']}' class='btn btn-dark btn-sm uploadSyllabus' title='Upload Syllabus' data-toggle='modal' data-target='#add-syllabus-modal'><i class='fas fa-upload'></i></a>
                    <a href='#' id='{$value['id']}' class='btn btn-info btn-sm editCat' title='Edit Category' data-toggle='modal' data-target='#edit-category-modal'><i class='fa fa-edit'></i></a>
                    <a href='#' id='{$value['id']}' class='btn btn-danger btn-sm dltCat' title='Delete Category'><i class='fa fa-trash'></i></a>
                </td>
            </tr>";
        }

        echo $output;
    } else {
        echo '<h2 class="text-danger">No Category available here!</h2>';
    }
}


// Handle Add Category
if (isset($_FILES['cat_photo'])) {
    $name = $help->sanitize_data($_POST['cat_name']);
    $status = $_POST['cat_status'];
    $fees = $help->sanitize_data($_POST['exam_fees']);
    $folder = '../assets/img/';

    if (isset($_FILES['cat_photo']['name']) && $_FILES['cat_photo']['name'] != null) {
        if ($help->image_validation($_FILES['cat_photo']) == 1) {
            $upload_path = $folder . $_FILES['cat_photo']['name'];
            $image = $_FILES['cat_photo']['name'];
            move_uploaded_file($_FILES['cat_photo']['tmp_name'], $upload_path);

            $data = [
                'cat_name' => $name,
                'cat_status' => $status,
                'photo' => $image,
                'exam_fees' => $fees
            ];

            if ($db->insert('category', $data)) {
                echo 'insert';
            } else {
                echo $db->getLastError();
            }
        } else {
            echo $help->image_validation($_FILES['cat_photo']);
        }
    }
}

// Handle Edit Category

if (isset($_POST['action']) && $_POST['action'] == 'editCat') {
    $id = $_POST['id'];
    $db->where('id', $id);
    $cat = $db->getOne('category');
    echo json_encode($cat);
}

// Handle Update Category
if (isset($_FILES['edit_cat_photo'])) {
    $id = $_POST['id'];
    $name = $help->sanitize_data($_POST['cat_name']);
    $fees = $help->sanitize_data($_POST['exam_fees']);
    $status = $_POST['cat_status'];
    $folder = '../assets/img/';
    $old_image = $_POST['old_image'];

    if (isset($_FILES['edit_cat_photo']['name']) && $_FILES['edit_cat_photo']['name'] != null) {
        if ($help->image_validation($_FILES['edit_cat_photo']) == 1) {
            $upload_path = $folder . $_FILES['edit_cat_photo']['name'];
            $image = $_FILES['edit_cat_photo']['name'];
            move_uploaded_file($_FILES['edit_cat_photo']['tmp_name'], $upload_path);
            if ($old_image != null) {
                unlink($folder . $old_image);
            }
        } else {
            echo $help->image_validation($_FILES['edit_cat_photo']);
        }
    } else {
        $image = $old_image;
    }

    $data = [
        'cat_name' => $name,
        'cat_status' => $status,
        'photo' => $image,
        'exam_fees' => $fees
    ];

    $db->where('id', $id);
    if ($db->update('category', $data)) {
        echo 'updated';
    } else {
        echo $db->getLastError();
    }
}


// Delete Category
if (isset($_POST['action']) && $_POST['action'] == 'dltCat') {
    $id = $_POST['id'];
    $db->where('id', $id);
    $db->delete('category');
}

// Fetch Details
if (isset($_POST['action']) && $_POST['action'] == 'fetch_detail') {
    $id = $_POST['id'];
    $db->where('id', $id);
    $data = $db->getOne('category', 'description,id');
    echo json_encode($data);
}
// Add Details
if (isset($_POST['action']) && $_POST['action'] == 'add_detail') {
    $id = $_POST['id'];
    $description = $help->sanitize_data($_POST['description']);
    $data = [
        'description' => $description
    ];

    $db->where('id', $id);
    if ($db->update('category', $data)) {
        echo 'added';
    } else {
        echo $db->getLastError();
    }
}

// Handle Add Syllabus
if (isset($_FILES['syllabus'])) {
    $id = $_POST['id'];
    $folder = '../assets/img/';

    if (isset($_FILES['syllabus']['name']) && $_FILES['syllabus']['name'] != null) {
        if ($help->file_validation($_FILES['syllabus']) == 1) {
            $upload_path = $folder . $_FILES['syllabus']['name'];
            $syllabus = $_FILES['syllabus']['name'];
            move_uploaded_file($_FILES['syllabus']['tmp_name'], $upload_path);

            $data = [
                'syllabus' =>  $syllabus
            ];
            $db->where('id', $id);
            if ($db->update('category', $data)) {
                echo 'insert';
            } else {
                echo $db->getLastError();
            }
        } else {
            echo $help->file_validation($_FILES['syllabus']);
        }
    }
}


// Handle Enroll Student Data
if (isset($_POST['action']) && $_POST['action'] == 'fetchEnrollStudent') {
    $output = '';
    $db->join('member', 'enroll.user_id = member.user_id', 'INNER');
    $db->join('category', 'enroll.cat_id = category.id', 'INNER');
    $data = $db->get('enroll', null, 'enroll.*,member.name,category.cat_name');
    if ($data) {
        foreach ($data as $key => $value) {
            $output .= "<tr>
                <td>" . ++$key . "</td>
                <td>{$value['user_id']}</td>
                <td>{$value['name']}</td>
                <td>{$value['cat_name']} </td>
                <td>{$value['number']}</td>
                <td>{$value['tr_id']}</td>
                <td><span class='badge badge-info p-2'>{$value['status']}</span></td>
                <td>";
            if ($value['status'] == 'Accepted') {
                $output .= "<a href='#' id='{$value['id']}' class='btn btn-danger btn-sm declineBtn' title='Decline Enroll'><i class='fas fa-times-circle'></i></a>";
            } else if ($value['status'] == 'Declined') {
                $output .= "<a href='#' id='{$value['id']}' class='btn btn-primary btn-sm acceptBtn' title='Accept Enroll'><i class='fas fa-check-circle'></i></a>";
            } else {
                $output .= "<a href='#' id='{$value['id']}' class='btn btn-danger btn-sm mr-2 declineBtn' title='Decline Enroll'><i class='fas fa-times-circle'></i></a>";
                $output .= "<a href='#' id='{$value['id']}' class='btn btn-primary btn-sm acceptBtn' title='Accept Enroll'><i class='fas fa-check-circle'></i></a>";
            }


            $output .= "</td>
            </tr>";
        }

        echo $output;
    } else {
        echo '<h2 class="text-danger">No Enroll student available here!</h2>';
    }
}

// Accept Payment
if (isset($_POST['action']) && $_POST['action'] == 'acceptEnroll') {
    $id = $_POST['id'];
    $data = [
        'status' => 'Accepted'
    ];

    $db->where('id', $id);
    $db->update('enroll', $data);
}

// Decline Payment
if (isset($_POST['action']) && $_POST['action'] == 'declineEnroll') {
    $id = $_POST['id'];
    $data = [
        'status' => 'Declined'
    ];

    $db->where('id', $id);
    $db->update('enroll', $data);
}


// Handle Fetch Exam Data
if (isset($_POST['action']) && $_POST['action'] == 'fetchExam') {
    $output = '';
    $db->join('category', 'exam.cat_id = category.id', 'INNER');
    $data = $db->get('exam', null, 'exam.*,category.cat_name');
    if ($data) {
        foreach ($data as $key => $value) {
            $id = $value['id'];
            $db->where('exam_id', $id);
            $input_question = $db->getValue('question', 'count(*)');
            $output .= "<tr>
                <td>" . ++$key . "</td>
                <td>{$value['title']}</td>
                <td>{$value['cat_name']}</td>
                <td>{$value['type']}</td>
                <td>{$value['duration']}</td>
                <td>{$value['total_mark']}</td>
                <td><span class='badge badge-info p-2 mr-2'>{$input_question}</span><a href='question.php?exam_id={$value['id']}' class='text-danger' title='View Question'><i class='fa fa-eye'></i></a></td>
                <td>" . ($value['status'] == 1 ? '<span class="badge badge-success">Enable</span>' : '<span class="badge badge-danger">Disable</span>') . " </td>
                <td>{$help->timeAgo($value['created_at'])}</td>
                <td>
                    <a href='#' id='{$value['id']}' class='text-primary addQuestion' title='Add Question' data-toggle='modal' data-target='#add-question-modal'><i class='fa fa-plus-circle'></i></a>
                    <a href='result.php?exam_id={$value['id']}' class='text-success' title='View Result'><i class='fas fa-poll-h'></i></a>
                    <a href='#' id='{$value['id']}' class='text-info editExam' title='Edit exam' data-toggle='modal' data-target='#edit-exam-modal'><i class='fa fa-edit'></i></a>
                    <a href='#' id='{$value['id']}' class='text-danger dltExam' title='Delete Exam'><i class='fa fa-trash'></i></a>
                </td>
            </tr>";
        }

        echo $output;
    } else {
        echo '<h2 class="text-danger">No Exam available here!</h2>';
    }
}


// Add Exam
if (isset($_POST['action']) && $_POST['action'] == 'add_exam') {
    $title = $help->sanitize_data($_POST['title']);
    $exam_cat = $help->sanitize_data($_POST['exam_cat']);
    $exam_type = $help->sanitize_data($_POST['exam_type']);
    $exam_status = $help->sanitize_data($_POST['exam_status']);
    $exam_duration = $help->sanitize_data($_POST['exam_duration']);
    $total_marks = $help->sanitize_data($_POST['total_marks']);
    $total_question = $help->sanitize_data($_POST['total_question']);
    $negative_marks = $help->sanitize_data($_POST['negative_marks']);
    $pass_marks = $help->sanitize_data($_POST['pass_marks']);
    $exam_started = $help->sanitize_data($_POST['exam_started']);
    $exam_end = $help->sanitize_data($_POST['exam_end']);
    $description = $_POST['description'];

    $data = [
        'title' => $title,
        'cat_id' => $exam_cat,
        'type' => $exam_type,
        'description' => $description,
        'duration' => $exam_duration,
        'total_mark' => $total_marks,
        'total_question' => $total_question,
        'negetive_marks' => $negative_marks,
        'pass_parcentage' => $pass_marks,
        'status' => $exam_status,
        'exam_started' => $exam_started,
        'exam_end' => $exam_end,
    ];

    if ($db->insert('exam', $data)) {
        echo 'added';
    } else {
        echo $db->getLastError();
    }
}


// Handle Edit Exam
if (isset($_POST['action']) && $_POST['action'] == 'editExam') {
    $id = $_POST['id'];
    $db->where('id', $id);
    $exam = $db->getOne('exam');
    echo json_encode($exam);
}

// Handle Update Exam
if (isset($_POST['action']) && $_POST['action'] == 'edit_exam') {
    $id = $_POST['id'];
    $title = $help->sanitize_data($_POST['title']);
    $exam_cat = $help->sanitize_data($_POST['exam_cat']);
    $exam_type = $help->sanitize_data($_POST['exam_type']);
    $exam_status = $help->sanitize_data($_POST['exam_status']);
    $exam_duration = $help->sanitize_data($_POST['exam_duration']);
    $total_marks = $help->sanitize_data($_POST['total_marks']);
    $total_question = $help->sanitize_data($_POST['total_question']);
    $negative_marks = $help->sanitize_data($_POST['negative_marks']);
    $pass_marks = $help->sanitize_data($_POST['pass_marks']);
    $exam_started = $help->sanitize_data($_POST['exam_started']);
    $exam_end = $help->sanitize_data($_POST['exam_end']);
    $description = $_POST['description'];

    $data = [
        'title' => $title,
        'cat_id' => $exam_cat,
        'type' => $exam_type,
        'description' => $description,
        'duration' => $exam_duration,
        'total_mark' => $total_marks,
        'total_question' => $total_question,
        'negetive_marks' => $negative_marks,
        'pass_parcentage' => $pass_marks,
        'status' => $exam_status,
        'exam_started' => $exam_started,
        'exam_end' => $exam_end,
    ];

    $db->where('id', $id);
    if ($db->update('exam', $data)) {
        echo 'update';
    } else {
        echo $db->getLastError();
    }
}

// Delete Exam
if (isset($_POST['action']) && $_POST['action'] == 'dltExam') {
    $id = $_POST['id'];
    $db->where('id', $id);
    $db->delete('exam');
}


// Add Question
if (isset($_POST['action']) && $_POST['action'] == 'add_question') {
    $id = $_POST['id'];
    $db->where('id', $id);
    $total_question = $db->getValue('exam', 'total_question');

    $db->where('exam_id', $id);
    $input_question = $db->getValue('question', 'count(*)');

    if ($total_question >= $input_question) {
        $data = [
            'exam_id' => $_POST['id'],
            'question' => $_POST['question'],
            'option1' => $_POST['option1'],
            'option2' => $_POST['option2'],
            'option3' => $_POST['option3'],
            'option4' => $_POST['option4'],
            'hints' => $_POST['hints'],
            'answer' => $_POST['answer'],
            'correct_option' => $_POST['correct_option'],
        ];

        if ($db->insert('question', $data)) {
            echo 'added';
        } else {
            echo $db->getLastError();
        }
    } else {
        echo 'most_question';
    }
}


// Delete Question
if (isset($_POST['action']) && $_POST['action'] == 'dltQuestion') {
    $id = $_POST['id'];
    $db->where('id', $id);
    $db->delete('question');
}

// Handle Fetch Free Exam Student 
if (isset($_POST['action']) && $_POST['action'] == 'fetchFreeExamStudent') {
    $output = '';
    $data = $db->get('free_exam');
    if ($data) {
        foreach ($data as $key => $value) {
            $output .= "<tr>
                <td>" . ++$key . "</td>
                <td>{$value['name']}</td>
                <td>{$value['clg_name']} </td>
                <td>{$value['phone']}</td>
                <td>{$value['answer']}</td>
                <td>
                    <a href='#' id='{$value['id']}' class='btn btn-danger btn-sm dltFreeRegisterStudent'><i class='fa fa-trash'></i></a>
                </td>
            </tr>";
        }

        echo $output;
    } else {
        echo '<h2 class="text-danger">No Free Exam student available here!</h2>';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'dltFreeRegisterStudent') {
    $id = $_POST['id'];
    $db->where('id', $id);
    $db->delete('free_exam');
}

// Handle Add Student
if (isset($_POST['action']) && $_POST['action'] == 'add_student') {
    $name = $help->sanitize_data($_POST['name']);
    $clg_name = $help->sanitize_data($_POST['clg_name']);
    $phone = $help->sanitize_data($_POST['phone']);
    $email = $help->sanitize_data($_POST['email']);

    $data = [
        'name' => $name,
        'clg_name' => $clg_name,
        'phone' => $phone,
        'email' => $email,
        'user_id' => $help->userId(),
    ];

    if ($db->insert('member', $data)) {
        echo 'added';
    } else {
        echo $db->getLastError();
    }
    
}

// Handle Add Enroll Student
if (isset($_POST['action']) && $_POST['action'] == 'add_enroll') {
    $user_id = $help->sanitize_data($_POST['user_id']);
    $cat_id = $help->sanitize_data($_POST['cat_id']);

    $data = [
        'user_id' => $user_id,
        'cat_id' => $cat_id,
        'status' => 'Accepted',
    ];

    if ($db->insert('enroll', $data)) {
        echo 'added';
    } else {
        echo $db->getLastError();
    }
    
}