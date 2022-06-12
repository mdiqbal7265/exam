<!-- Login Modal -->
<div id="LoginModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-danger font-weight-bold">Member Login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <img src="assets/img/footer-logo.png" alt="" width="260px" class="mb-4">
                <form action="" method="post" id="login_form">
                    <div class="form-group">
                        <i class="fa fa-user text-danger"></i>
                        <input type="text" name="username" class="form-control" placeholder="Username/userId" id="username" required="required">
                    </div>
                    <div class="form-group">
                        <i class="fa fa-lock text-danger"></i>
                        <input type="password" name="password" class="form-control" placeholder="Password" id="password" required="required">
                    </div>
                    <div class="form-group">
                        <input type="submit" id="login_btn" class="btn btn-danger btn-block btn-lg" value="Login">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal end -->