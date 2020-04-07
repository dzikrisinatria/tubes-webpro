<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>

	<!-- Bootstrap CSS-->
	<link href="<?= base_url('assets/');?>css/bootstrap.min.css" rel="stylesheet">

	<!-- Bootstrap core JavaScript-->
	<script src="<?= base_url('assets/');?>js/jquery.js"></script>
	<script src="<?= base_url('assets/');?>js/bootstrap.bundle.min.js"></script>

</head>

<body class="h-100 bg-light">
	<div class="container h-100">
		<div class="row h-100 justify-content-center align-items-center">
			<div class="col-10 col-md-8 col-lg-4">
				<div class="card o-hidden border-0 shadow-lg">
					<div class="card-body">
						<div class="text-center">
							<h1 class="h4 text-gray-900 mb-4">Login</h1>
						</div>
						
						<?= $this->session->flashdata('message'); ?>

						<form action="<?= base_url('auth');?>" method="post">
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>">
								<?= form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password">
								<?= form_error('password', '<small class="form-text text-danger">', '</small>'); ?>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success form-control mt-2">Login</button>
							</div>
							<hr>
							<div class="text-center">
								<a class="small" href="<?= base_url('auth/registration'); ?>">Belum memiliki akun? Silahkan <b>Register!</b></a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
