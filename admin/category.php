<?php include 'include/header.php'; ?>

<?php include 'include/aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Category List</li>
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
                            <h3 class="card-title">Category List</h3>
                            <a href="#" class="btn btn-success float-right" data-toggle="modal" data-target="#add-category-modal"><i class="fas fa-plus-circle"></i></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="category_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Exam Fees</th>
                                        <th>Syllabus</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SI</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Exam Fees</th>
                                        <th>Syllabus</th>
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

<!-- Category Add Modal -->
<div class="modal fade" id="add-category-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" enctype="multipart/form-data" id="add-category-form">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="cat_name" class="col-sm-2 col-form-label">Category Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="Enter Category Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cat_status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="cat_status" name="cat_status">
                                    <option>Select Status</option>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exam_fees" class="col-sm-2 col-form-label">Exam Fees</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="exam_fees" name="exam_fees" placeholder="Enter exam fees">
                                <span class="text-info"><strong class="text-danger">(*)</strong>If this exam is free. Please type 0.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="col-sm-2 col-form-label">Upload Category Image</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="cat_photo" id="cat_photo" />
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="preview"></div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Insert" class="btn btn-info" id="add-category-btn">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Category Add Modal -->

<!-- Category Edit Modal -->
<div class="modal fade" id="edit-category-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" enctype="multipart/form-data" id="edit-category-form">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="cat_name" class="col-sm-2 col-form-label">Category Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_cat_name" name="cat_name" placeholder="Enter Category Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cat_status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="edit_cat_status" name="cat_status">
                                    <option>Select Status</option>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_exam_fees" class="col-sm-2 col-form-label">Exam Fees</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_exam_fees" name="exam_fees" placeholder="Enter exam fees">
                                <span class="text-info"><strong class="text-danger">(*)</strong>If this exam is free. Please type 0.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="old_image" id="old_image">
                            <label for="photo" class="col-sm-2 col-form-label">Upload Category Image</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="edit_cat_photo" id="edit_cat_photo" />
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="preview"></div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Update" class="btn btn-info" id="edit-category-btn">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Category Edit Modal -->

<!-- Add Description -->
<div class="modal fade" id="add-description-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Description</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="add-description-form">
                <input type="hidden" name="id" id="details_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cat_name">Description</label>
                        <textarea id="summernote" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Add" class="btn btn-info" id="add-description-btn">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add Description -->

<!-- Add Syllebus -->
<div class="modal fade" id="add-syllabus-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Syllabus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="add-syllabus-form" enctype="multipart/form-data">
                <input type="hidden" name="id" id="syllabus_id">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="syllabus" class="col-sm-2 col-form-label">Upload Syllabus</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="syllabus" id="syllabus" />
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Add" class="btn btn-info" id="add-syllabus-btn">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add Syllebus -->

<?php include 'include/footer.php'; ?>