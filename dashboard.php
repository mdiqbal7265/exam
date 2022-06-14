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
                <div class="row">
                    <?php 
                        if($exam_by_specific_id): 
                        foreach ($exam_by_specific_id as $key => $value) :
                    ?>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?= $value['title']; ?></h3>
                            </div>
                            <div class="card-body">
                                <strong>Exam Type:- <?= $value['type']; ?></strong> <br>
                                <strong>Exam Duration:- <?= $value['duration']; ?></strong> <br>
                                <strong>Total Question:- <?= $value['total_question']; ?></strong> <br>
                                <strong>Total Mark:- <?= $value['total_mark']; ?></strong> <br>
                                <strong>Negative Mark:- <?= $value['negetive_marks']; ?></strong> <br>
                                <strong>Passed Mark:- <?= $value['pass_parcentage']; ?></strong> <br>
                                <strong>Start Exam:- <?= date("d M Y H:i:s", strtotime($value['exam_started'])) ?></strong> <br>
                                <strong>End Exam:- <?= date("d M Y H:i:s",strtotime($value['exam_end'])) ?></strong> <br>                                
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-primary btn-block">Start Exam</a>
                            </div>
                        </div>
                    </div>
                    <?php 
                    endforeach;
                    else: ?>
                        <h2 class="text-center text-danger">No exam Here</h2>
                    <?php endif; ?>
                    
                </div>
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