<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light shadow-sm">

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".collapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="#"><i class="fas fa-clinic-medical mr-3"></i><?= $appname; ?></a>

	<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
		<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
			<li class="nav-item dropdown active">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
					<?= $user['nama']; ?></span>
					<img class="rounded-circle mx-2 bg-light" height="35px" width="35px"
						src="<?= base_url('assets/img/profile/') . $user['foto']; ?>">
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="#">My Profile</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
				</div>
			</li>
		</ul>
	</div>

</nav>

<div class="container-fluid px-0 pt-0 h-100">
	<div class="row min-vh-100 collapse show no-gutters d-flex h-100 position-relative">
		<div class="col-3 p-0 h-100 text-dark w-sidebar navbar-collapse collapse d-none d-md-flex sidebar">
			<!-- fixed sidebar -->
			<div class="navbar-light bg-light position-fixed h-100 w-sidebar shadow">

				<h6 class="px-3 pt-4"><b>Customer</b></h6>
				<ul class="navbar-nav ml-4 nav flex-column flex-nowrap text-truncate">
					
					<?php if ($title == 'Home') :?>
						<li class="nav-item active">
					<?php else : ?>
						<li class="nav-item">
					<?php endif; ?>
						<a class="nav-link" href="<?= base_url('admin'); ?>">
						<i class="fas fa-fw fa-clinic-medical mr-3"></i>Home</a>
					</li>
					
					<?php if ($title == 'User') :?>
						<li class="nav-item active">
					<?php else : ?>
						<li class="nav-item">
					<?php endif; ?>
						<a class="nav-link" href="<?= base_url('admin/user'); ?>">
						<i class="fas fa-fw fa-user mr-3"></i>My Profile</a>
					</li>

				</ul>
				
				<hr class="bg-secondary mx-3">

				<h6 class="px-3 pt-2"><b>Obat</b></h6>
				<ul class="navbar-nav ml-4 nav flex-column flex-nowrap text-truncate">
					
					<?php if ($title == 'Daftar Obat') :?>
						<li class="nav-item active">
					<?php else : ?>
						<li class="nav-item">
					<?php endif; ?>
						<a class="nav-link" href="<?= base_url('admin'); ?>">
						<i class="fas fa-fw fa-pills mr-3"></i>Daftar Obat</a>
					</li>
					
					<?php if ($title == 'Pemesanan Obat') :?>
						<li class="nav-item active">
					<?php else : ?>
						<li class="nav-item">
					<?php endif; ?>
						<a class="nav-link" href="<?= base_url('admin'); ?>">
						<i class="fas fa-fw fa-file-invoice mr-3"></i>Pesan Obat</a>
					</li>

				</ul>

				<hr class="bg-secondary mx-3">

				<ul class="navbar-nav ml-4 nav flex-column flex-nowrap text-truncate">
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('auth/logout');?>">
						<i class="fas fa-fw fa-sign-out-alt mr-3"></i>Logout</a>
					</li>
				</ul>

			</div>
		</div>
		
