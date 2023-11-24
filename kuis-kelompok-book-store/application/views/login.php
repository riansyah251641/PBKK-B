<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>IZZI BOOK STORE | LOGIN</title>

	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
	<style>
		body {
			margin: 0;
			font-size: .9rem;
			font-weight: 400;
			line-height: 1.6;
			color: #212529;
			text-align: left;
			background-color: #f5f8fa;
		}

		.navbar-laravel {
			box-shadow: 0 2px 4px rgba(0, 0, 0, .04);
		}

		.navbar-brand,
		.nav-link,
		.my-form,
		.login-form {
			font-family: Raleway, sans-serif;
		}

		.my-form {
			padding-top: 1.5rem;
			padding-bottom: 1.5rem;
		}

		.my-form .row {
			margin-left: 0;
			margin-right: 0;
		}

		.login-form {
			padding-top: 1.5rem;
			padding-bottom: 1.5rem;
		}

		.login-form .row {
			margin-left: 0;
			margin-right: 0;
		}
	</style>
</head>

<body>


	<br><br>
	<form method="post" action="<?= base_url('login/login'); ?>">

		<main class="login-form">
			<div class="cotainer">
				<div class="row justify-content-center">
					<div class="col-lg-5">
						<div class="card">
							<div class="card-header">
								<center><b>
										<H3>IZZI BOOK STORE</H3>
									</b></center>
							</div>
							<div class="card-body">
								<form action="" method="">
									<div class="form-group row">
										<label for="email_address" class="col-md-4 col-form-label text-md-right">Username</label>
										<div class="col-md-6">
											<input type="text" name="user" placeholder="Username" class="form-control" required>
										</div>
									</div>

									<div class="form-group row">
										<label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
										<div class="col-md-6">
											<input type="password" name="pass" placeholder="Password" class="form-control" required>
										</div>
									</div>

									<div class="col-md-6 offset-md-4">
										<button type="submit" name="login" class="btn btn-primary">
											Masuk
										</button>
										<a href="#" class="btn btn-link">
											Daftar disini
										</a>
									</div>
							</div>
	</form>
	</div>
	</div>
	</div>
	</div>
	</div>

	</main>


	</form>


	<!-- Bootstrap core JavaScript-->
	<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/jsjs/config.js"></script>
	<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="<?php echo base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>

	<!-- Page level custom scripts -->
	<script src="<?php echo base_url() ?>assets/js/demo/chart-area-demo.js"></script>
	<script src="<?php echo base_url() ?>assets/js/demo/chart-pie-demo.js"></script>
	<script src="<?php echo base_url() ?>assets/js/datatables/datatables.min.js"></script>
	<script>
		$(document).ready(function() {
			var tb = $('#dt').DataTable({});
			$('#fil').on('change', function() {
				tb.search(this.value).draw()
			});


		});
		$(document).ready(function() {
			var tb = $('#dtt').DataTable({
				"searching": false,
				"bPaginate": false,
				"bLengthChange": false,
				"bFilter": true,
				"bInfo": false,
				"bAutoWidth": false
			});
			$('#fil').on('change', function() {
				tb.search(this.value).draw()
			});


		});
	</script>
</body>

</html>