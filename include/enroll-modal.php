<!-- Enroll Modal -->
<div id="EnrollModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-danger font-weight-bold">Course Enroll</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-center">
                <!-- Notice Section -->
                <div id="notice">
                    <h3 class="text-danger">আপনি রেজিষ্ট্রেশন করেন নি। রেজিষ্ট্রেশন করেতে 'Yes' Button এ ক্লিক করুন।
                        <hr class="donar_card_hr"> রেজিষ্ট্রেশন করা ছাড়া আপনি Exam Course এ Enroll করতে পারবেন না।
                    </h3>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-success" id="enroll_yes_btn">Yes</a>
                <a href="#" class="btn btn-danger" id="enroll_no_btn">No</a>
            </div>
        </div>
    </div>
</div>
<!-- Enroll Modal -->

<!-- Enroll Model if registered -->
<div id="EnrollModal1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-danger font-weight-bold">Course Enroll</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-center">
                <!-- Instruction Section -->
                <div id="instruction">
                    <p class="text-danger">Exam ব্যাচে Enroll করতে হলে ব্যাচ ফি প্রদান করতে হবে। নিম্নে দেওয়া নির্দেশনা অনুযায়ী টাকা প্রদান করে 'Yes' Button এ ক্লিক করুন। কোর্স এ Enroll না করতে চাইলে 'No' Button এ ক্লিক করুন।</p>
                    <hr class="donar_card_hr">
                    <h5 class="text-info text-left">Instruction for Pay Exam Fees</h5>
                    <ul class="text-left text-success">
                        <ol>01. Go to your bKash Mobile Menu by dialing *247#</ol>
                        <ol>02. Choose “Send Money”</ol>
                        <ol>03. Enter the bKash Account Number (01679487265)</ol>
                        <ol>04. Enter the amount you want to send</ol>
                        <ol>05. Enter a reference about the transaction. (use your user id. Ex:-223087)</ol>
                        <ol>06. Now enter your bKash Mobile Menu PIN to confirm the transaction</ol>
                    </ul>
                </div>

                <!-- User Id Section -->
                <div id="form-section" style="display: none;">
                    <form action="#" id="enroll-submit-form">
                        <input type="hidden" name="cat_id" id="cat_id">
                        <div class="form-group">
                            <label for="phone">কোন নাম্বারে টাকা পাঠিয়েছেন? </label>
                            <input type="number" class="form-control" name="phone" id="mobile" placeholder="Enter Number">
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="tr_id">Transaction ID </label>
                                    <input type="text" class="form-control" name="tr_id" id="tr_id" placeholder="Enter Tr. Id">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="user_id">User Id Number</label>
                                    <input type="text" class="form-control" name="user_id" id="user_id" placeholder="Enter user id num">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" id="submit-enroll-btn" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-success" id="re_enroll_yes_btn">Yes</a>
                <a href="#" class="btn btn-danger" id="re_enroll_no_btn">No</a>
            </div>
        </div>
    </div>
</div>
<!-- Enroll Model if registered  -->