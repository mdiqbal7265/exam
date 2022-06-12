<?php include 'include/header.php'; ?>

<div class="container">
    <div class="card border border-info" style="margin-bottom: 100px;">
        <div class="card-header border-bottom border-info">
            <h3>Free Exam<strong id="timer" class="float-right"></strong></h3>
            
        </div>
        <form action="" id="question_form">
            <div class="card-body">            
                <?php if($question): 
                $i = 1;
                    foreach($question as $val): ?>
                        <p><?php echo $i++ .".{$val['question']}"; ?></p>                        
                        <input type="radio" value="1" name="<?= $val['id']; ?>"> <label for=""><?= $val['option1'] ?></label><br>
                        <input type="radio" value="2" name="<?= $val['id']; ?>"> <label for=""><?= $val['option2'] ?></label><br>
                        <input type="radio" value="3" name="<?= $val['id']; ?>"> <label for=""><?= $val['option3'] ?></label><br>
                        <input type="radio" value="4" name="<?= $val['id']; ?>"> <label for=""><?= $val['option4'] ?></label><br>
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

<?php include 'include/footer.php'; ?>
