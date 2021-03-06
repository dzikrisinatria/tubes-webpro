<div class="col pt-3 mb-4">
	<div class="container mt-5">
		<h2>Dashboard</h2>
		<!-- MULAI KONTEN DISINI -->

		<div class="row mt-4 ml-1 justify-content-start">
			<div class="card text-white mb-3" style="background: #ff9f43; width: 15rem; border: none;" >
				<div class="card-header h5">Total Pemesanan</div>
				<div class="card-body row">
					<div class="col">
						<h1 class="card-title"><?= $jml_pemesanan; ?></h1>
					</div>
					<div class="col">
						<i class="fas fa-fw fa-file-invoice-dollar fa-4x"></i>
					</div>
					<!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p> -->
				</div>
			</div>
			<div class="card text-white bg-danger mb-3 ml-4" style="width: 15rem; border: none;" >
				<div class="card-header h5">Belum Dikonfirmasi</div>
				<div class="card-body row">
					<div class="col">
						<h1 class="card-title"><?= $jml_pemesanan_notconfirmed; ?></h1>
					</div>
					<div class="col">
						<i class="fas fa-fw fa-file-invoice-dollar fa-4x"></i>
					</div>
					<!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p> -->
				</div>
            </div>
            <div class="card text-white mb-3 ml-4" style="background: #00b894;width: 15rem; border: none;" >
				<div class="card-header h5">Jumlah Obat</div>
				<div class="card-body row">
					<div class="col">
						<h1 class="card-title"><?= $jml_obat; ?></h1>
					</div>
					<div class="col">
						<i class="fas fa-fw fa-pills fa-4x"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container mt-3">
		<h2>Notifikasi</h2>
		<!-- MULAI KONTEN DISINI -->

		<div class="mt-4 ml-1 justify-content-start">
			<?php foreach ($get_pemesanan_notconfirmed as $pnc) : ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Pesanan 
					<a href="<?= base_url(); ?>pemesanan/konfirmasiPemesanan/<?= $pnc['id_pemesanan']?>" class="alert-link">
						<?= $pnc['nama'].', '.date("d F Y", strtotime($pnc['tgl_pemesanan'])); ?>
					</a> 
					belum dikonfirmasi, harap segera konfirmasi.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

</div>
