<div class="col pt-5 mb-4">
	<div class="container mt-5">
		<h2>Dashboard</h2>
		<!-- MULAI KONTEN DISINI -->

		<div class="row mt-4 ml-1 justify-content-between">
			<div class="card text-white bg-secondary mb-3" style="width: 15rem;" >
				<div class="card-header h4">Total Pemesanan</div>
				<div class="card-body">
					<h4 class="card-title"><?= $jml_pemesanan; ?></h4>
					<!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p> -->
				</div>
            </div>
            <div class="card text-white bg-info mb-3" style="width: 15rem;" >
				<div class="card-header h4">Jumlah Apoteker</div>
				<div class="card-body">
					<h4 class="card-title"><?= $jml_apoteker; ?></h4>
					<!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p> -->
				</div>
            </div>
            <div class="card text-white bg-primary mb-3" style="width: 15rem;" >
				<div class="card-header h4">Jumlah Customer</div>
				<div class="card-body">
					<h4 class="card-title"><?= $jml_customer; ?></h4>
					<!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p> -->
				</div>
            </div>
            <div class="card text-white bg-success mb-3" style="width: 15rem;" >
				<div class="card-header h4">Jumlah Obat</div>
				<div class="card-body">
					<h4 class="card-title"><?= $jml_obat; ?></h4>
					<!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p> -->
				</div>
			</div>
		</div>
	</div>

</div>
