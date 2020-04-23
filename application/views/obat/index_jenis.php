<div class="col pt-5 mb-4">
	<div class="container mt-5">
		<h2>Jenis Obat</h2>
		<!-- MULAI KONTEN DISINI -->

		<?= $this->session->flashdata('message'); ?>

		<div class="mt-4 row">
            <div class="col justify-content-start">
                <a href="<?= base_url(); ?>obat/tambahjenisobat">
                    <button class="btn btn-success">
                        <i class="fas fa-fw fa-plus mr-2"></i>Tambah Jenis Obat
                    </button>
                </a>
                <a href="<?= base_url(); ?>obat">
                    <button class="btn btn-success">
                        <i class="fas fa-fw fa-pills mr-2"></i>Kelola Obat
                    </button>
                </a>
            </div>
            <form action="<?= base_url('obat/jenisobat'); ?>" method="post" class="col-4 justify-content-end">
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
						<th scope="col">Jenis Obat</th>
						<th scope="col" colspan="3">Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php if ( empty($jenisobatpagination) ) :?>
                        <tr>
                            <td colspan="6">
                                <div class="alert alert-danger" role="alert">
                                    Data tidak ditemukan.
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
					<?php foreach ($jenisobatpagination as $jo ) :?>
					<tr>
						<form action="">
							<td><?= ++$start ?></td>
							<td><?= $jo['nama_jenis'] ?></td>

							<td width="1">
								<button type="button" class="btn btn-primary" data-toggle="modal"
									data-target="#detail<?= $jo['id_jenis_obat']?>">
									<i class="fas fa-fw fa-info"></i>
								</button>
                            </td>
                            <td width="1">
								<a type="button" class="btn btn-warning ml-1"
									href="<?= base_url(); ?>obat/editjenisobat/<?= $jo['id_jenis_obat']?>">
									<i class="fas fa-fw fa-edit"></i>
									</<button>
                            </td>
                            <td width="1">
                                <a type="button" class="btn btn-danger ml-2"
                                    href="<?= base_url(); ?>obat/hapusjenisobat/<?= $jo['id_jenis_obat']?>"
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

<!-- MODAL FORM DETAIL JENIS OBAT -->
<?php $no=1; foreach ($alljenis as $j ) :?>
<div class="modal fade" id="detail<?= $j['id_jenis_obat']; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- <div class="modal-header">
				<h4>Detail User</h4>
			</div> -->
			<div class="modal-body my-auto">
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Id Jenis Obat</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $j['id_jenis_obat'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Jenis Obat</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $j['nama_jenis'];?></p>
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
