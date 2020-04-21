<div class="col pt-5 mb-4">
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
                        <i class="fas fa-fw fa-plus mr-2"></i>Kelola Jenis Obat
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
							<td><?= $o['username'] ?></td>
							<td><?= $o['email']?></td>
							<td><?= $o['nama']?></td>
							<td><?= $o['role']?></td>

							<td width="1">
								<button type="button" class="btn btn-primary" data-toggle="modal"
									data-target="#detail<?= $o['id_user']?>">
									<i class="fas fa-fw fa-info"></i>
								</button>
                            </td>
                            <td width="1">
								<a type="button" class="btn btn-warning ml-1"
									href="<?= base_url(); ?>obat/editobat/<?= $o['id_user']?>">
									<i class="fas fa-fw fa-edit"></i>
									</<button>
                            </td>
                            <td width="1">
                                <a type="button" class="btn btn-danger ml-2"
                                    href="<?= base_url(); ?>obat/hapusobat/<?= $o['id_user']?>"
                                    onClick="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">
                                    <i class="fas fa-fw fa-trash-alt"></i>
                                    </<button>
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

<!-- MODAL FORM DETAIL USER -->
<?php $no=1; foreach ($allobat as $o ) :?>
<div class="modal fade" id="detail<?= $o['id_user']; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- <div class="modal-header">
				<h4>Detail User</h4>
			</div> -->
			<div class="modal-body my-auto">
                <center>
                <img class="mx-2 mb-3 mt-2 bg-light" height="150px" width="150px"
                    src="<?= base_url('assets/img/profile/') . $o['foto']; ?>">
				<h5><?//= $o['nama'];?></h5>
				<p><?//= $o['role'];?></p>
                </center>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Kode Obat</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['email'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Nama Obat</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['username'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Jenis Obat</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['jenis_kelamin'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Harga</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['tgl_lahir'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Stok</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['alamat'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Bentuk</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['telepon'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Fungsi</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['telepon'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Aturan</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $o['telepon'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Terdaftar Sejak</h6>
                    </div>
                    <div class="col-8">
                        <p><?= date('d F Y', $o['date_created']);?></p>
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
