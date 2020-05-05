<div class="container-fluid pt-3 mt-4 mb-5">
    <!-- MULAI KONTEN DISINI -->

    <div class="row col-11 mb-4 mx-auto justify-content-start">
        <?= $this->session->flashdata('message'); ?>
        <div class="col-8">
            <h3>Daftar Obat</h3>
        </div>
        <div class="col justify-content-end">
            <form action="<?= base_url('customer/obat'); ?>" method="post" class="mr-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Obat.." name="keyword" autocomplete="off" autofocus
                    value="<?= set_value('keyword'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">
                            <i class="fas fa-fw fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-start col-11 mx-auto">
        <?php foreach ($obatpagination as $obat) : ?>
        <div class="card ml-3 mb-4" style="width: 18rem;">
            <a href="" data-toggle="modal" data-target="#detail<?= $obat['id_obat']?>"><img src="<?= base_url('assets/img/obat/') . $obat['gambar']; ?>" style="padding:30px; object-fit: cover; height: 258px;" class="card-img-top"></a>
            <small class="text-center text-muted">Klik gambar untuk detail obat.</small>
            <div class="card-body text-center text-capitalize">
                <h5 class="card-title"><b><?= $obat['nama_obat']; ?></b></h5>
                <h6 class="mt-n2 mb-3"><small class="text-secondary"><?= $obat['nama_jenis']; ?></small></h6>
                <h5><span class="text-info">Rp<?= number_format($obat['harga'], 0,',','.'); ?>,-</span></h5>
            </div>
            <div class="card-footer bg-white">
                <a href="<?= base_url('customer/addtocart/').$obat['id_obat']; ?>" class="btn btn-info mr-1 w-100"><i class="fas fa-lg fa-cart-plus ml-n1 mr-1"></i> Tambah ke Keranjang</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?= $this->pagination->create_links(); ?>

    <!-- AKHIR KONTEN -->
</div>

<!-- MODAL FORM DETAIL OBAT -->
<?php $no=1; foreach ($allobat as $o ) :?>
<div class="modal fade" id="detail<?= $o['id_obat']; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <h4>Detail User</h4> -->
                <img class="mx-auto mb-3 mt-2 bg-white" style="object-fit: cover; max-height: 200px;"
                    src="<?= base_url('assets/img/obat/') . $o['gambar']; ?>">
				<h5><?//= $o['nama_obat'];?></h5>
				<p><?//= $o['jenis_obat'];?></p>
			</div>
			<div class="modal-body my-auto">
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Kode Obat</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['kode_obat'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Nama Obat</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['nama_obat'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Jenis Obat</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['nama_jenis'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Harga</h6>
                    </div>
                    <div class="col-8">
                        <p>Rp<?= $o['harga'];?>,-</p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Stok</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['stok'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Bentuk</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['bentuk'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Fungsi</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['fungsi'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Aturan</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['aturan'];?></p>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
                <a href="<?= base_url('customer/addtocart/').$obat['id_obat']; ?>" class="btn btn-outline-info mr-1"><i class="fas fa-lg fa-cart-plus ml-n1 mr-1"></i> Tambah ke Keranjang</a>
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>