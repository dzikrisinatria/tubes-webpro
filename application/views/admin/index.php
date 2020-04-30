<div class="col pt-3 mb-4">
	<div class="container mt-5">
		<h2>Dashboard</h2>
		<!-- MULAI KONTEN DISINI -->

		<div class="row mt-4 ml-1 justify-content-between">
			<div class="card text-white mb-3" style="background: #ff9f43; width: 15rem;" >
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
            <div class="card text-white mb-3" style="background: #0abde3; width: 15rem;" >
				<div class="card-header h5">Jumlah Apoteker</div>
				<div class="card-body row">
					<div class="col">
						<h1 class="card-title"><?= $jml_apoteker; ?></h1>
					</div>
					<div class="col">
						<i class="fas fa-fw fa-user-md fa-4x"></i>
					</div>
					<!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p> -->
				</div>
            </div>
            <div class="card text-white mb-3" style="background: #2e86de; width: 15rem;" >
				<div class="card-header h5">Jumlah Customer</div>
				<div class="card-body row">
					<div class="col">
						<h1 class="card-title"><?= $jml_customer; ?></h1>
					</div>
					<div class="col">
						<i class="fas fa-fw fa-user fa-4x"></i>
					</div>
					<!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p> -->
				</div>
            </div>
            <div class="card text-white mb-3" style="background: #00b894;width: 15rem;" >
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

</div>
