<div class="col pt-3 mb-4">
	<div class="container mt-5">
		<h2>Obat</h2>
		<!-- MULAI KONTEN DISINI -->

		<?= $this->session->flashdata('message'); ?>

		<div class="mt-4 row">
            <div class="col justify-content-start">
                <a href="<?= base_url(); ?>obat/tambahobat">
                    <button class="btn btn-success">
                        <i class="fas fa-fw fa-plus mr-2"></i>Tambah Obat
                    </button>
                </a>
                <a href="<?= base_url(); ?>obat/jenisobat">
                    <button class="btn btn-success">
                        <i class="fas fa-fw fa-pills mr-2"></i>Kelola Jenis Obat
                    </button>
                </a>
            </div>
            <form action="<?= base_url('obat'); ?>" method="post" class="col-4 justify-content-end">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari.." name="keyword" autocomplete="off" autofocus
                    value="<?= set_value('keyword'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">
                            <i class="fas fa-fw fa-search"></i></button>
                    </div>
                </div>
            </form>
		</div>

		<div class="mt-4 table-responsive-lg">

			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col"></th>
						<th scope="col">Kode Obat</th>
						<th scope="col">Nama Obat</th>
						<th scope="col">Jenis</th>
						<th scope="col">Harga</th>
						<th scope="col" colspan="3">Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php if ( empty($obatpagination) ) :?>
                        <tr>
                            <td colspan="6">
                                <div class="alert alert-danger" role="alert">
                                    Data tidak ditemukan.
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
					<?php foreach ($obatpagination as $o ) :?>
					<tr>
						<form action="">
							<td><?= ++$start ?></td>
							<td><?= $o['kode_obat'] ?></td>
							<td><?= $o['nama_obat']?></td>
							<td><?= $o['nama_jenis']?></td>
							<td>Rp<?= $o['harga']?>,-</td>

							<td width="1">
                                <span data-toggle="tooltip" data-placement="left" title="Detail">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#detail<?= $o['id_obat']?>">
                                        <i class="fas fa-fw fa-info"></i>
                                    </button>
                                </span>
                            </td>
                            <td width="1">
                                <span data-toggle="tooltip" data-placement="left" title="Edit">
                                    <a href="<?= base_url(); ?>obat/editobat/<?= $o['id_obat']?>">
                                    <button type="button" class="btn btn-warning ml-1">    
                                        <i class="fas fa-fw fa-edit"></i>
                                    </button>
                                </span>
                            </td>
                            <?php if ($o['status'] == 1) : ?>
                                <td width="1">
                                    <span data-toggle="tooltip" data-placement="left" title="Hapus Boongan">
                                        <a href="<?= base_url(); ?>obat/hapusobatboongan/<?= $o['id_obat']?>"
                                            onClick="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">
                                        <button type="button" class="btn btn-danger ml-1">
                                            <i class="fas fa-fw fa-trash-alt"></i>
                                        </<button>
                                    </span>
                                </td>
                            <?php endif; ?>
                            <td width="1">
                                <span data-toggle="tooltip" data-placement="left" title="Hapus">
                                    <a href="<?= base_url(); ?>obat/hapusobat/<?= $o['id_obat']?>"
                                        onClick="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">
                                    <button type="button" class="btn btn-danger ml-1">
                                        <i class="fas fa-fw fa-trash-alt"></i>
                                    </<button>
                                </span>
							</td>
						</form>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<?= $this->pagination->create_links(); ?>

		</div>

	</div>

</div>

<!-- MODAL FORM DETAIL OBAT -->
<?php $no=1; foreach ($allobat as $o ) :?>
<div class="modal fade" id="detail<?= $o['id_obat']; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- <div class="modal-header">
				<h4>Detail User</h4>
			</div> -->
			<div class="modal-body my-auto">
                <center>
                <img class="mx-2 mb-3 mt-2 bg-white" height="150px"
                    src="<?= base_url('assets/img/obat/') . $o['gambar']; ?>">
				<h5><?//= $o['nama_obat'];?></h5>
				<p><?//= $o['jenis_obat'];?></p>
                </center>
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
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Status</h6>
                    </div>
                    <div class="col-8">
                        <?php if ($o['status'] == 1) :?>
                            <p>Tersedia</p>
                        <?php else : ?>
                            <p>Tidak Tersedia</p>
                        <?php endif; ?>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>
