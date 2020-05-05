<div class="container-fluid pt-5 mt-5">
    <!-- MULAI KONTEN DISINI -->

		<center><h2>Profile Saya</h2></center>

		<div class="row mt-4 justify-content-center">
			
            <div class="card" style="width: 45em;">
                <div class="row">
                    <div class="col-3">    
                        <img class="rounded-circle mx-2 bg-light my-5 mx-4" style="object-fit: cover;" height="150em" width="150em"
                            src="<?= base_url('assets/img/profile/') . $user['foto']; ?>">
                    </div>
                    <div class="col">
                        <div class="card-body m-3">
                            <h5 class="card-title"><?= $user['nama']; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $user['role']; ?></h6>
                            <div class="row mb-1 mt-3">
                                <div class="col-4"><p class="card-text">Tanggal Lahir</p></div>
                                <div class="col"><p class="card-text"><?= date("d F Y", strtotime($user['tgl_lahir'])); ?></p></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-4"><p class="card-text">Alamat</p></div>
                                <div class="col"><p class="card-text"><?= $user['alamat']; ?></p></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-4"><p class="card-text">Telepon</p></div>
                                <div class="col"><p class="card-text"><?= $user['telepon']; ?></p></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-4"><p class="card-text">Email</p></div>
                                <div class="col"><p class="card-text"><?= $user['email']; ?></p></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <small class="card-subtitle text-muted">Terdaftar sejak <?= date('d F Y', $user['date_created']);?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>

    <!-- AKHIR KONTEN -->
</div>