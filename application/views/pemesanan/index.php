<div class="col pt-5 mb-4">
	<div class="container mt-5">
		<h2>Pemesanan</h2>
		<!-- MULAI KONTEN DISINI -->

		<?= $this->session->flashdata('message'); ?>

		<div class="mt-4 row">
            <form action="<?= base_url('pemesanan'); ?>" method="post" class="col-4 justify-content-end">
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
                        <th scope="col">id Customer</th>
						<th scope="col">Tanggal Pemesanan</th>
						<th scope="col">Total</th>
						<th scope="col">Metode Pembayaran</th>
                        <th scope="col">Nominal Pembayaran</th>
                        <th scope="col">Status</th>
                        <th scope="col" colspan="2">Action</th>

					</tr>
				</thead>
				<tbody>
                    <?php if ( empty($pemesananPagination) ) :?>
                        <tr>
                            <td colspan="6">
                                <div class="alert alert-danger" role="alert">
                                    Data tidak ditemukan.
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($pemesananPagination as $p ) :?>
                    <tr>
                        <form action="">
                            <td><?= ++$start ?></td>
                            <td><?= $p['id_user'] ?></td>
                            <td><?= $p['tgl_pemesanan']?></td>
                            <td><?= $p['total']?></td>
                            <td><?= $p['metode_pembayaran']?></td>
                            <td><?= $p['bayar']?></td>
                            <td><?php if ($p['status'] == 1) echo "Lunas";
                                else echo "Belum Lunas";
                                ?></td>

                            <td width="1">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#detail<?= $p['id_pemesanan']?>">
                                    <i class="fas fa-fw fa-info"></i>
                                </button>
                            </td>
                            <!-- <td width="1">
                                <a type="button" class="btn btn-danger ml-2"
                                    href="<?= base_url(); ?>pemesanan/hapusPemesanan/<?= $p['id_pemesanan']?>"
                                    onClick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                    <i class="fas fa-fw fa-user-times"></i>
                                    </<button>
                            </td> -->
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
<?php $no=1; foreach ($allPemesanan as $p ) :?>
<div class="modal fade" id="detail<?= $p['id_pemesanan']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h4>Detail User</h4>
            </div> -->
            <div class="modal-body my-auto">
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Id Customer</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $p['id_user'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Tanggal Pemesanan</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $p['tgl_pemesanan'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Metode Pembayaran</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $p['metode_pembayaran'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Nominal Pembayaran</h6>
                    </div>
                    <div class="col-8">
                        <p>Rp<?= $p['bayar'];?>,-</p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Status</h6>
                    </div>
                    <div class="col-8">
                        <p><?php if ($p['status'] == 1) echo "Lunas";
                                else echo "Belum Lunas";
                                ?></p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table col-7 mx-auto">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($p['itemPemesanan']) ): ?>
                                <tr><td colspan="5">
                                <div class="alert alert-danger text-center" role="alert">
                                    Item Kosong.
                                </div></td></tr>
                            <?php else: ?>
                                <?php $no=1; foreach ($p['itemPemesanan'] as $items) : ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $items['nama_obat']; ?></td>
                                    <td><?= $items['jumlah']; ?></td>
                                    <td align="right">Rp<?= number_format($items['harga'], 0,',','.'); ?>,-</td>
                                    <td align="right">Rp<?= number_format($items['subtotal'], 0,',','.'); ?>,-</td>
                                </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td align="right" colspan="4"><b>Total</b></td>
                                    <td align="right"><b>Rp<?= number_format($p['total'], 0,',','.'); ?>,-</b></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
