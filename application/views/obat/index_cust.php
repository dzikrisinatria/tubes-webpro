<div class="col pt-5 mb-4">
	<div class="container mt-5">
		<h2>Daftar Obat</h2>
		<!-- MULAI KONTEN DISINI -->
        <div class="card-deck">
            <?php $no=1; foreach ($obatpagination as $o ) :?>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?= base_url('assets/img/obat/') . $o['gambar']; ?>" alt="Card image cap" height=150px>
                    <div class="card-body">
                        <h5 class="card-title"><?= $o['nama_obat']?></h5>
                        <p class="card-text">Rp<?= $o['harga']?>,-</p>
                        <a href="#" class="btn btn-primary">Pesan</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
	</div>
</div>