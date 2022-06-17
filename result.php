<?php include 'include/header.php'; ?>

<div class="container">
    <?php 
     if($exam_end_time <= strtotime(date("Y-m-d H:i:s"))):
    ?>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="">
                <div class="input-group">
                    <input type="search" class="form-control form-control-lg" id="number" name="number" placeholder="Type your Mobile Number here">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-dark" id="result_search_btn">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="result_body" style="margin-bottom: 100px;">

    </div>
    <?php else: ?>
        <h2 class="text-center text-danger" style="margin-bottom: 100px;">No result has been published yet.</h2>
    <?php endif; ?>
</div>

<?php include 'include/footer.php'; ?>
