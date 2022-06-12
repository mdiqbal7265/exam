<?php include 'include/header.php'; ?>

<?php include 'include/aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Exam List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Exam List</li>
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
                            <h3 class="card-title">Exam List</h3>
                            <a href="#" class="btn btn-success float-right" data-toggle="modal" data-target="#add-exam-modal"><i class="fas fa-plus-circle"></i></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="exam_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">SI</th>
                                        <th width="15%">Title</th>
                                        <th width="15%">Category</th>
                                        <th width="10%">Type</th>
                                        <th width="5%">Duration</th>
                                        <th width="5%">Total Marks</th>
                                        <th width="10%">Question</th>
                                        <th width="10%">Status</th>
                                        <th width="5%">Created At</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="5%">SI</th>
                                        <th width="15%">Title</th>
                                        <th width="15%">Category</th>
                                        <th width="10%">Type</th>
                                        <th width="5%">Duration</th>
                                        <th width="5%">Total Marks</th>
                                        <th width="10%">Question</th>
                                        <th width="10%">Status</th>
                                        <th width="5%">Created At</th>
                                        <th width="20%">Action</th>
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

<!-- Exam Add Modal -->
<div class="modal fade" id="add-exam-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Exam</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="add-exam-form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Exam Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter exam title">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Exam Category</label>
                                <select class="form-control" id="exam_cat" name="exam_cat">
                                    <option>Select exam category</option>
                                    <?php foreach ($category as $item) : ?>
                                        <option value="<?= $item['id']; ?>"><?= $item['cat_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Exam Type</label>
                                <select class="form-control" id="exam_type" name="exam_type">
                                    <option>Select exam type</option>
                                    <option value="Combined Exam">Combined Exam</option>
                                    <option value="Chapter Wise Exam">Chapter Wise Exam</option>
                                    <option value="Subject Wise Exam">Subject Wise Exam</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exam_status">Exam Status</label>
                                <select class="form-control" id="exam_status" name="exam_status">
                                    <option>Select exam status</option>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exam_duration">Exam Duration (In minute)</label>
                                <input type="text" class="form-control" id="exam_duration" name="exam_duration" placeholder="Enter exam duration">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="total_marks">Total Marks</label>
                                <input type="text" class="form-control" id="total_marks" name="total_marks" placeholder="Enter Total Marks">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="total_question">Total Question</label>
                                <input type="text" class="form-control" id="total_question" name="total_question" placeholder="Enter Total Question">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="negative_marks">Negative Marks(In percentage)</label>
                                <input type="text" class="form-control" id="negative_marks" name="negative_marks" placeholder="Enter Negative marks">
                                <span class="text-danger">If no negative marks. Leave blank this field.</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass_marks">Passed Marks(In percentage)</label>
                                <input type="text" class="form-control" id="pass_marks" name="pass_marks" placeholder="Enter Pass marks">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exam_started">Start Date & Time</label>
                                <input type="datetime-local" class="form-control" id="exam_started" name="exam_started">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exam_end">End Date & Time</label>
                                <input type="datetime-local" class="form-control" id="exam_end" name="exam_end">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Write Description</label>
                                <textarea id="summernote" name="description" id="description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Add Exam" class="btn btn-info" id="add-exam-btn">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Exam Add Modal -->

<!-- Exam Edit Modal -->
<div class="modal fade" id="edit-exam-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Exam</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="edit-exam-form">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Exam Title</label>
                                <input type="text" class="form-control" id="edit_title" name="title" placeholder="Enter exam title">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Exam Category</label>
                                <select class="form-control" id="edit_exam_cat" name="exam_cat">
                                    <option>Select exam category</option>
                                    <?php foreach ($category as $item) : ?>
                                        <option value="<?= $item['id']; ?>"><?= $item['cat_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Exam Type</label>
                                <select class="form-control" id="edit_exam_type" name="exam_type">
                                    <option>Select exam type</option>
                                    <option value="Combined Exam">Combined Exam</option>
                                    <option value="Chapter Wise Exam">Chapter Wise Exam</option>
                                    <option value="Subject Wise Exam">Subject Wise Exam</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exam_status">Exam Status</label>
                                <select class="form-control" id="edit_exam_status" name="exam_status">
                                    <option>Select exam status</option>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exam_duration">Exam Duration (In minute)</label>
                                <input type="text" class="form-control" id="edit_exam_duration" name="exam_duration" placeholder="Enter exam duration">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="total_marks">Total Marks</label>
                                <input type="text" class="form-control" id="edit_total_marks" name="total_marks" placeholder="Enter Total Marks">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="total_question">Total Question</label>
                                <input type="text" class="form-control" id="edit_total_question" name="total_question" placeholder="Enter Total Question">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="negative_marks">Negative Marks(In percentage)</label>
                                <input type="text" class="form-control" id="edit_negative_marks" name="negative_marks" placeholder="Enter Negative marks">
                                <span class="text-danger">If no negative marks. Leave blank this field.</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass_marks">Passed Marks(In percentage)</label>
                                <input type="text" class="form-control" id="edit_pass_marks" name="pass_marks" placeholder="Enter Pass marks">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exam_started">Start Date & Time</label>
                                <input type="datetime" class="form-control" id="edit_exam_started" name="exam_started">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exam_end">End Date & Time</label>
                                <input type="datetime" class="form-control" id="edit_exam_end" name="exam_end">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Write Description</label>
                                <textarea name="description" class="summernote" id="edit_description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Update Exam" class="btn btn-info" id="edit-exam-btn">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Exam Edit Modal -->

<!-- Exam Add Question -->
<?php include 'include/add_question.php'; ?>
<!-- Exam Add Question -->



<?php include 'include/footer.php'; ?>