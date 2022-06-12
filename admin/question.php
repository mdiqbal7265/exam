<?php include 'include/header.php'; ?>

<?php include 'include/aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Question List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Question List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Question List <span class="badge badge-danger p-2 ml-2"><?= $exam_title; ?></span></h3>
                            <a href="#" class="btn btn-success float-right addQuestion" id="<?= $question_data[0]['exam_id']; ?>" data-toggle="modal" data-target="#add-question-modal"><i class="fas fa-plus-circle"></i></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="question_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Question</th>
                                        <th>Option 1</th>
                                        <th>Option 2</th>
                                        <th>Option 3</th>
                                        <th>Option 4</th>
                                        <th>Correct Ans</th>
                                        <th>Answer</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $key = 1;
                                    foreach ($question_data as $val) : ?>
                                        <tr>
                                            <td><?= $key++; ?></td>
                                            <td><?= $val['question'] ?></td>
                                            <td><?= $val['option1'] ?></td>
                                            <td><?= $val['option2'] ?></td>
                                            <td><?= $val['option3'] ?></td>
                                            <td><?= $val['option4'] ?></td>
                                            <td><?= $val['correct_option'] ?></td>
                                            <td><?= $val['answer'] ?></td>
                                            <td><?= $help->timeAgo($val['created_at']) ?></td>
                                            <td>
                                                <a href='#' id='<?= $val['id'] ?>' class='text-info editExam' title='Edit exam' data-toggle='modal' data-target='#edit-exam-modal'><i class='fa fa-edit'></i></a>
                                                <a href='#' id='<?= $val['id'] ?>' class='text-danger dltQuestion' title='Delete Exam'><i class='fa fa-trash'></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SI</th>
                                        <th>Question</th>
                                        <th>Option 1</th>
                                        <th>Option 2</th>
                                        <th>Option 3</th>
                                        <th>Option 4</th>
                                        <th>Correct Ans</th>
                                        <th>Answer</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Exam Add Question -->
<?php include 'include/add_question.php'; ?>
<!-- Exam Add Question -->


<?php include 'include/footer.php'; ?>