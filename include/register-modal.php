<!-- Register Modal -->
<div id="RegisterModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-danger font-weight-bold">Member Registration</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-center">
                <img src="assets/img/footer-logo.png" alt="" width="260px" class="mb-4">
                <form action="" method="post" id="registration_form">
                    <div class="form-row text-left">
                        <div class="form-group col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Your Name" aria-label="Name" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-building"></i></span>
                            </div>
                            <input type="text" name="clg_name" class="form-control" id="clg_name" placeholder="Enter College Name" aria-label="email" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-mobile-phone"></i></span>
                            </div>
                            <input type="number" name="phone" class="form-control" id="phone" placeholder="Phone" aria-label="email" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="form-row text-left">
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="username" class="form-control" id="rusername" placeholder="Username" aria-label="Name" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control" id="rpassword" placeholder="password" aria-label="Name" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Register" class="btn btn-danger btn-block" id="register_btn">
                    </div>
                </form>
            </div>
            <div class="modal-footer text-center">
                <a href="#" class="text-muter" id="register">Already Register?</a>
            </div>
        </div>
    </div>
</div>
<!-- Register Modal -->