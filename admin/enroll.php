<?php include 'include/header.php'; ?>

<?php include 'include/aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Enroll Student List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Enroll Student List</li>
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
                            <h3 class="card-title">Enroll Student List</h3>
                            <a href="#" class="btn btn-success float-right" data-toggle="modal" data-target="#add-enroll-modal" title="Add Enroll"><i class="fas fa-plus-circle"></i></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="enroll_student_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Number</th>
                                        <th>Tr.Id</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SI</th>
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Number</th>
                                        <th>Tr.Id</th>
                                        <th>Status</th>
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

<!-- Add Student Enroll Modal -->

<div class="modal fade" id="add-enroll-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Student</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="add-enroll-form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Student Name <span class="text-danger">(*required)</span></label>
                                <select class="form-control select2" style="width: 100%;" name="user_id">
                                    <?php foreach($student as $value): ?>
                                        <option value="<?= $value['user_id'] ?>" selected="selected"><?= $value['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Category Name <span class="text-danger">(*required)</span></label>
                                <select class="form-control select2" style="width: 100%;" name="cat_id">
                                    <?php foreach($category as $value): ?>
                                        <option value="<?= $value['id'] ?>" selected="selected"><?= $value['cat_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>               
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Add Student" class="btn btn-info" id="add-enroll-btn">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Add Student Enroll Modal -->


<?php include 'include/footer.php'; ?>