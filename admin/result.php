<?php include 'include/header.php'; ?>

<?php include 'include/aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Exam Result</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Exam Result</li>
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
                            <h3 class="card-title">Exam Result <span class="badge badge-danger p-2 ml-2"><?= $exam_title; ?></span></h3>                            
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="result_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Name</th>
                                        <th>College Name</th>
                                        <th>Correct Ans</th>
                                        <th>Wrong Ans</th>
                                        <th>Total Marks</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $key = 1;
                                    foreach ($result as $val) : ?>
                                        <tr>
                                            <td><?= $key++; ?></td>
                                            <td><?= $val['name'] ?></td>
                                            <td><?= $val['clg_name'] ?></td>
                                            <td><?= $val['correct_ans'] ?></td>
                                            <td><?= $val['incorrect_ans'] ?></td>
                                            <td><?= $val['final_marks'] ?> &nbsp; &nbsp; (<?= $val['total_mark']; ?>)</td>
                                            <td><?= $val['status'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SI</th>
                                        <th>Name</th>
                                        <th>College Name</th>
                                        <th>Correct Ans</th>
                                        <th>Wrong Ans</th>
                                        <th>Total Marks</th>
                                        <th>Status</th>
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



<?php include 'include/footer.php'; ?>