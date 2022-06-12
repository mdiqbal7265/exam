<?php include 'include/admin_header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card profile-card shadow p-3 mb-5 bg-white rounded">
                <div class="card-content">
                    <div class="card-body p-auto">
                        <div class="profile"> <img src="assets/img/<?= $member_data['photo']; ?>" class="img-thumbnail img-fluid" style="width: 180px !important; height: 180px !important;"> </div>
                        <div class="card-title"> <?= $member_data['name']; ?>
                        </div>
                        <div class="card-subtitle">
                            <p>
                                <strong class="badge badge-success p-2 mr-2">ID: </strong><span class="badge badge-info p-2"><?= strtoupper($member_data['user_id']) ?></span><br>
                                <strong>Phone Number: </strong><span><?= $member_data['phone']; ?></span><br>
                                <strong>Email: </strong><span><?= $member_data['email']; ?></span><br>
                                <strong>created_at: </strong><span><?= $help->timeAgo($member_data['created_at']); ?></span><br>
                                <?php if ($enroll_data) : ?>
                                    <strong>Enrolled Batch:- </strong><span class="badge badge-info p-2"><?= $enroll_data['cat_name']; ?></span>
                                <?php endif; ?>
                            </p>
                            <a href="#" class="btn btn-danger btn-block" data-target="#edit" data-toggle="pill">Update Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8"><br><br>
            <?php if ($enroll_data) : ?>
                <h1 class="text-center text-success">ধন্যবাদ কোর্সে Enroll করার জন্য। আমাদের সাথে থাকুন, খুব শীঘ্রই আমাদের ফেজবুক পেজ, গ্রুপ এবং ওয়েবসাইটে পরিক্ষার রুটিন প্রকাশ করা হবে।</h1>
            <?php else : ?>
                <div class="row" style="justify-content: center">
                    <?php include 'include/cat_section.php'; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'include/footer.php'; ?>

<!-- Enroll Modal -->
<?php include 'include/enroll-modal.php'; ?>
<!-- Enroll Modal -->