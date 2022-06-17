<?php
	error_reporting(0);
?>
<?php include 'lib/session.php'; ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Amuse Exam</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
	    <!-- Ckeditor -->
    <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
	    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="assets/js/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">	
</head>

<body>
	<nav class="navbar sticky-top navbar-expand-lg navbar-light shadow p-3 mb-5 bg-white rounded">
		<a class="navbar-brand ml-5 logo text-danger" href="index.php">
			<img src="assets/img/logo.png" height="28" class="mr-2" alt="CoolBrand">Amuse Exam</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">

			</ul>
			<div class="mr-5">
				<img src="assets/img/man.png" height="36" class="mr-2" alt="CoolBrand">
				<!-- <a href="#myModal" class="btn btn-danger" data-toggle="modal">Login</a> -->
				<?php if (!isset($_SESSION['member'])) : ?>
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#LoginModal">Login</button>
					<!-- <a href="#" class="btn btn-danger ml-2">Register</a> -->
					<button type="button" class="btn btn-danger ml-1" data-toggle="modal" data-target="#RegisterModal">Register</button>
				<?php else : ?>
					<a href="dashboard.php" class="btn btn-danger ml-2">Dashboard</a>
				<?php endif; ?>
			</div>
		</div>
	</nav>