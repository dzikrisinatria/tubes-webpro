<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light shadow-sm">

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".collapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="#"><i class="fas fa-clinic-medical mr-3"></i><?= $appname; ?></a>

	<div class="collapse navbar-collapse">
		<ul class="navbar-nav mr-auto">
			<?php if ($title == 'Home') :?>
				<li class="nav-item active">
			<?php else : ?>
				<li class="nav-item">
			<?php endif; ?>
				<a class="nav-link" href="<?= base_url(''); ?>">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Profil</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
					Obat
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="<?= base_url(''); ?>">Daftar Obat</a>
					<a class="dropdown-item" href="<?= base_url(''); ?>">Pesan Obat</a>
				</div>
			</li>
		</ul>
		<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
			<?php if ( $this->session->userdata('username') ) : ?>
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
			<?php else : ?>
				<a href="<?= base_url('auth'); ?>"><button class="btn btn-outline-dark my-2 mr-2">Login</button></a>
				<a href="<?= base_url('auth/register'); ?>"><button class="btn btn-outline-dark my-2">Daftar</button></a>
			<?php endif; ?>
		</ul>
	</div>

</nav>

<!-- <div class="container-fluid px-0 pt-0 h-100"> -->
	<!-- <div class="row min-vh-100 collapse show no-gutters d-flex h-100 position-relative"> -->
		
