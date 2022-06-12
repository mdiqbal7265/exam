<?php include 'include/header.php'; ?>

<div class="container">
    <?php 
     if($exam_start_time <= strtotime(date("Y-m-d H:i:s")) && $exam_end_time >= strtotime(date("Y-m-d H:i:s"))):
    ?>
    <div class="card border border-info" style="margin-bottom: 100px;">
        <div class="card-header border-bottom border-info">
            <h3>Free Exam</h3>
        </div>
        <form id="add_free_exam_form" action="" method="post">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 shadow p-3 bg-white rounded border border-info">
                    
                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="write you name Here..." />                        
                        </div>
                        <!-- College Name input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="clg_name">College Name</label>
                            <input type="text" id="clg_name" name="clg_name" placeholder="Write Your College Name.." class="form-control" />                        
                        </div>
                        <!-- Phone number input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="phone">Phone Number</label>
                            <input type="text" id="phone" name="phone" placeholder="Write Your Mobile Number.." class="form-control" />                        
                        </div>
                    
                </div>
                <div class="col-md-6 shadow p-3 bg-white rounded border border-primary">
                    <h4><strong>Exam Description:-</strong></h4>
                    <p class="text-info text-center"><?= $exam['description']; ?>
                    </p>
                </div>
            </div>
            <input type="hidden" name="exam_id" value="<?= $exam['id']; ?>">
        </div>
        <div class="card-footer border-top border-info">
            <input type="submit" value="Start Exam" class="btn btn-info float-right" id="start_exam">
            <!-- <a href="exam.php" class="btn btn-success float-right">Start Exam</a> -->
        </div>
        </form>
    </div>
    <?php else: ?>
        <h2 class="text-center text-danger" style="margin-bottom: 100px;">Exam Started Soon Or Exam Time has been End</h2>
    <?php endif; ?>
</div>

<?php include 'include/footer.php'; ?>
