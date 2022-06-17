<?php include 'include/header.php'; ?>
	<div class="container">
		<div class="row">
			<div class="col-md-6 mt-lg-5 quotes_text text-center">
				<br>
				<br>
				<h3 class="text-center text-danger"> "তোমাদের সাফল্য, আমাদের অঙ্গিকার" </h3>
				<h4 class="text-center">SSC, HSC & Admission Online Exam ব্যাচ এ রেজিষ্ট্রেশন চলছে।</h4>
				<a href="#" class="btn btn-danger btn-lg mt-5" data-toggle="modal" data-target="#RegisterModal">Register</a>
				<a href="#" class="btn btn-danger btn-lg mt-5" data-toggle="modal" data-target="#LoginModal">Login</a>
			</div>
			<div class="col-md-6">
				<img src="assets/img/exam.jpg" width="500px" class="img-thumbnail img-fluid">
			</div>
		</div>
		<br><br>
		<hr class="donar_card_hr">
		<br><br>
		<?php 
			if($exam):
			if($exam_end_time >= strtotime(date("Y-m-d H:i:s"))):
		?>
			<div style="border: 1px solid red;" class="shadow p-3 mb-5 bg-white rounded">
				<h1 class="text-danger text-center">ফ্রি এক্সাম দেওয়ার জন্য এখানে ক্লিক করুন। <a href="freeexam.php" class="btn btn-danger ml-3">Free Exam</a></h1>
			</div>
		<?php else: ?>
			<div style="border: 1px solid red;" class="shadow p-3 mb-5 bg-white rounded">
				<h1 class="text-danger text-center">ফ্রি এক্সাম এর রেজাল্ট প্রকাশিত হয়েছে। রেজাল্ট দেখতে এখানে ক্লিক করুন <a href="result.php" class="btn btn-danger ml-3">Result</a></h1>
			</div>
		<?php endif; endif; ?>

		<!-- Doner Card -->
		<p class="text-center text-danger doner-title">অনলাইনে amuse exam এর সাথে প্রস্তুতির জন্য নিচের কোর্সগুলো <br> থেকে পছন্দের কোর্সে Enroll করে শুরু করো তোমার জার্নি...</p>
		<hr class="donar_card_hr">

		<div class="row my-5" style="justify-content: center">
			<?php include 'include/cat_section.php'; ?>
		</div>

		<!-- Doner Card -->
		<hr class="donar_card_hr">
		<div class="row my-5">
			<div class="col-md-6">
				<img src="assets/img/footer.jpg" alt="" width="400px" class="img-thumbnail img-fluid">
			</div>
			<div class="col-md-6 mt-4">
				<form action="mail.php" method="post" class="shadow mb-5 bg-white rounded">
					<div class="card border-danger rounded-0">
						<div class="card-header p-0">
							<div class="bg-danger text-white text-center py-2">
								<h3><i class="fa fa-envelope"></i> Contact With Us</h3>
								<p class="m-0">If you have any query? Please sContact with us</p>
							</div>
						</div>
						<div class="card-body p-3">

							<!--Body-->
							<div class="form-group">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fa fa-user text-danger"></i></div>
									</div>
									<input type="text" class="form-control" id="name" name="name" placeholder="Name.." required>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fa fa-envelope text-danger"></i></div>
									</div>
									<input type="email" class="form-control" id="email" name="email" placeholder="email@gmail.com" required>
								</div>
							</div>

							<div class="form-group">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fa fa-comment text-danger"></i></div>
									</div>
									<textarea class="form-control" placeholder="Write your message Here" required></textarea>
								</div>
							</div>

							<div class="text-center">
								<input type="submit" value="Send Message" class="btn btn-danger btn-block rounded-0 py-2">
							</div>
						</div>

					</div>
				</form>
			</div>
		</div>

	</div>

	<?php include 'include/footer.php' ?>