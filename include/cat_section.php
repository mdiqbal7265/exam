<?php foreach ($category as $item) : ?>
    <div class="card col-md-3 profile-card shadow p-3 mb-5 bg-white rounded">
        <div class="card-content">
            <div class="card-body p-0">
                <div class="profile"> <img src="assets/img/<?= $item['photo']; ?>" class="img-thumbnail img-fluid"> </div>
                <div class="card-title text-center"> <?= $item['cat_name'] ?>
                </div>
                <div class="card-subtitle">
                    <h4 class="text-center text-info">Exam Fees: <?= ($item['exam_fees'] == 0 ? 'Free' : $item['exam_fees']).' TK'; ?></h4>
                    <p class="text-center">
                        <a href="#" data-toggle="modal" data-target="#detailsModal" id="<?= $item['id'] ?>" class="btn btn-success viewDetails">See Details</a>
                        <a href="#" class="btn btn-info viewSyllabus" data-toggle="modal" data-target="#syllabusModal" id="<?= $item['id'] ?>">Syllabus</a>
                    </p>
                    <?php if (!isset($_SESSION['member'])) : ?>
                        <a href="#" data-toggle="modal" data-target="#EnrollModal" id="<?= $item['id'] ?>" class="btn btn-danger btn-block">Enroll Now</a>
                    <?php else : ?>
                        <a href="#" data-toggle="modal" data-target="#EnrollModal1" id="<?= $item['id'] ?>" class="btn btn-danger btn-block enroll_btn">Enroll Now</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>