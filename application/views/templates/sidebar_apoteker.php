<div class="wrapper">
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background: #2f3542;">

		<a class="navbar-brand" href="#"><i class="fas fa-fw fa-clinic-medical mr-3 ml-2"></i><?= $appname; ?></a>
		<button type="button" id="sidebarCollapse" class="btn text-white">
			<i class="fas fa-bars fa-lg"></i>
		</button>

		<div class="collapse navbar-collapse">
			<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				<li class="nav-item dropdown active">
					<a class="nav-link dropdown-toggle" href="" id="" role="button" data-toggle="dropdown"
						style="background: #2f3542;">
						<?= $user['nama']; ?></span>
						<img class="rounded-circle mx-2 bg-light" style="object-fit: cover;" height="35px" width="35px"
							src="<?= base_url('assets/img/profile/') . $user['foto']; ?>">
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
						<a class="dropdown-item" href="<?= base_url('auth/profile'); ?>">Profil Saya</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
					</div>
				</li>
			</ul>
		</div>

	</nav>

	<!-- Sidebar  -->
	<nav id="sidebar">
		<!-- <div class="sidebar-header">
			<h3>Bootstrap Sidebar</h3>
		</div> -->

		<ul class="list-unstyled components mt-5">
			<div class="mt-4 my-3 ml-3">
				<h6>Apoteker</h6>
			</div>

			<?php if ($title == 'Dashboard') :?>
			<li class="active">
				<?php else : ?>
			<li>
				<?php endif; ?>
				<a class="nav-link" href="<?= base_url('apoteker'); ?>">
					<i class="fas fa-fw fa-tachometer-alt mx-3"></i>Dashboard</a>
			</li>

			<div class="mt-4 my-3 ml-3">
				<h6>Obat</h6>
			</div>

			<?php if ($title == 'Kelola Obat') :?>
			<li class="active">
				<?php else : ?>
			<li>
				<?php endif; ?>
				<a class="nav-link" href="<?= base_url('obat'); ?>">
					<i class="fas fa-fw fa-pills mx-3"></i>Kelola Obat</a>
			</li>

			<?php if ($title == 'Pemesanan Obat') :?>
			<li class="active">
				<?php else : ?>
			<li>
				<?php endif; ?>
				<a class="nav-link" href="<?= base_url('pemesanan'); ?>">
					<i class="fas fa-fw fa-file-invoice mx-3"></i>Pemesanan</a>
			</li>
		</ul>
	</nav>

	<!-- Page Content  -->
	<div id="content">
