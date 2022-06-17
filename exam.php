<?php include 'include/admin_header.php'; ?>

<?php if($exam_start_time <= strtotime(date("Y-m-d H:i:s")) && $exam_end_time >= strtotime(date("Y-m-d H:i:s"))): ?>


<div class="container">
    <div class="card border border-info" style="margin-bottom: 100px;" id="description">
        <div class="card-header">
            <h3 class="text-center text-info">Exam Description</h3>
        </div>
        <div class="card-body">
            <?=$exam['description']; ?>
        </div>
        <div class="card-footer">
            <h4 class="text-center text-success"> The Exam will begin in <span id="countdowntimer">10 </span> Seconds</h4>
            <script type="text/javascript">
                var timeleft = 10;
                var downloadTimer = setInterval(function(){
                timeleft--;
                document.getElementById("countdowntimer").textContent = timeleft;
                if(timeleft <= 0){
                    clearInterval(downloadTimer);
                    document.getElementById("description").style.display = "none";
                    document.getElementById("exam").style.display = "";
                }
                    
                },1000);
            </script>
        </div>
    </div>

    <div class="card border border-info" style="margin-bottom: 100px; display: none;" id="exam">
        <div class="card-header border-bottom border-info">
            <h3> <?= $exam['title']; ?><strong id="timer" class="float-right"></strong></h3>            
        </div>
        <form action="" id="question_form">
            <input type="hidden" name="user_id" value="<?= $member_data['user_id']; ?>">
            <input type="hidden" name="exam_id" value="<?= $exam['id']; ?>">
            <div class="card-body">            
                <?php if($question): 
                $i = 1;
                    foreach($question as $val): ?>
                        <div class="question d-flex"><?php echo $i++ .".{$val['question']}"; ?></div> 
                        <label for="">
                            <input type="radio" value="1" name="<?= $val['id']; ?>">
                            <span>ক</span><?= $val['option1'] ?>
                        </label><br>
                        <label for="">
                            <input type="radio" value="2" name="<?= $val['id']; ?>">
                            <span>খ</span><?= $val['option2'] ?>
                        </label><br>
                        <label for="">
                            <input type="radio" value="3" name="<?= $val['id']; ?>">
                            <span>গ</span><?= $val['option3'] ?>
                        </label><br>
                        <label for="">
                            <input type="radio" value="4" name="<?= $val['id']; ?>">
                            <span>ঘ</span><?= $val['option3'] ?>
                        </label>                     
                         
                <?php 
                endforeach;
                else:
                ?>
                <h1 class="text-danger text-center">You have no question.</h1>
                <?php endif; ?>            
            </div>
            <div class="card-footer border-top border-info">
                <a href="index.php" class="btn btn-danger">Cancel</a>
                <input type="submit" value="Finish Exam" class="btn btn-info float-right" id="question_submit_btn">
                <!-- <a href="exam.php" class="btn btn-info float-right">Finish Exam</a> -->
            </div>
        </form>
    </div>
</div>
<?php else: ?>
    <h2 class="text-center text-danger" style="margin-bottom: 100px;">Exam Started Soon Or Exam Time has been End</h2>
<?php endif; ?>

<?php include 'include/footer.php'; ?>
