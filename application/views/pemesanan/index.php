<div class="col pt-3 mb-4">
	<div class="container mt-5">
		<h2>Pemesanan</h2>
		<!-- MULAI KONTEN DISINI -->

		<?= $this->session->flashdata('message'); ?>

		<!-- <div class="mt-4 row">
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
		</div> -->

		<div class="mt-4 table-responsive-lg">

			<table id="datatables" class="table table-hover">
				<thead>
					<tr>
						<th scope="col">No</th>
                        <th scope="col">Tanggal Pemesanan</th>
                        <th scope="col">Customer</th>
						<th scope="col">Total</th>
						<th scope="col">Metode Pembayaran</th>
                        <th scope="col">Nominal Bayar</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>

					</tr>
				</thead>
				<tbody>
                    <?php if ( empty($allPemesanan) ) :?>
                        <tr>
                            <td colspan="6">
                                <div class="alert alert-danger" role="alert">
                                    Data tidak ditemukan.
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php $no=1; foreach ($allPemesanan as $p ) :?>
                    <tr>
                        <form action="">
                            <td><?= $no++; ?></td>
                            <td><?= $p['tgl_pemesanan']?></td>
                            <td><?= $p['nama'] ?></td>
                            <td>Rp<?= number_format($p['total'], 0,',','.'); ?>,-</td>
                            <td><?= $p['metode_pembayaran']?></td>
                            <td>Rp<?= number_format($p['bayar'], 0,',','.'); ?>,-</td>
                          
                            <td>
                                <?php if ($p['status'] == 1) {
                                    echo '<h5><span class="badge text-white" style="background: #00b894;">Selesai</span></h5>';
                                }else{
                                    echo '<h5><span class="badge badge-danger">Belum Selesai</span></h5>';
                                }?>
                            </td>
                          
                            <?php if (($this->session->userdata('role_id')) == 1): ?>
                                <td width="100">
                                    <div class="row mx-auto justify-content-between">
                                        <span data-toggle="tooltip" data-placement="left" title="Detail">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#detail<?= $p['id_pemesanan']?>">
                                                <i class="fas fa-fw fa-info"></i>
                                            </button>
                                        </span>
                                        <span data-toggle="tooltip" data-placement="left" title="Hapus">
                                            <a href="<?= base_url(); ?>pemesanan/hapusPemesanan/<?= $p['id_pemesanan']?>"
                                                onClick="return confirm('Apakah Anda yakin ingin menghapus Pemesanan ini?')">
                                            <button type="button" class="btn btn-danger ml-1">
                                                <i class="fas fa-fw fa-user-times"></i>
                                            </<button>
                                        </span>
                                    </div>
                                </td>
                            <?php else: ?>
                                <td>
                                    <?php if ($p['status'] == 0) : ?>
                                        <span data-toggle="tooltip" data-placement="left" title="Konfirmasi">
                                            <a type="button" class="btn text-white" style="background: #00b894;"
                                            href="<?= base_url(); ?>pemesanan/konfirmasiPemesanan/<?= $p['id_pemesanan']?>">
                                            <i class="fas fa-fw fa-tasks fa-lg"></i>
                                        </<button>
                                    <?php else : ?>
                                        <span data-toggle="tooltip" data-placement="left" title="Detail">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#detail<?= $p['id_pemesanan']?>">
                                                <i class="fas fa-fw fa-info"></i>
                                            </button>
                                        </span>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </form>
                    </tr>
                    <?php endforeach; ?>
				</tbody>
			</table>

		</div>

	</div>

</div>


<!-- MODAL FORM DETAIL PEMESANAN -->
<?php $no=1; foreach ($allPemesanan as $p ) :?>
<div class="modal fade" id="detail<?= $p['id_pemesanan']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h4>Detail User</h4>
            </div> -->
            <div class="modal-body mt-3">
                <div class="row mx-auto my-2">
                    <div class="col">
                        <h6>Tanggal Pemesanan</h6>
                    </div>
                    <div class="col-7">
                        <?= $p['tgl_pemesanan'];?>
                    </div>
                </div>
                <div class="row mx-auto my-2">
                    <div class="col">
                        <h6>Customer</h6>
                    </div>
                    <div class="col-7">
                        <?= $p['nama'];?>
                    </div>
                </div>
                <div class="row mx-auto my-2">
                    <div class="col">
                        <h6>Alamat Pengiriman</h6>
                    </div>
                    <div class="col-7">
                        <?= $p['alamat'];?>
                    </div>
                </div>
                <div class="row mx-auto my-2">
                    <div class="col">
                        <h6>Metode Pembayaran</h6>
                    </div>
                    <div class="col-7">
                        <?= $p['metode_pembayaran'];?>
                    </div>
                </div>
                <div class="row mx-auto my-2">
                    <div class="col">
                        <h6>Nominal Pembayaran</h6>
                    </div>
                    <div class="col-7">
                        Rp<?= $p['bayar'];?>,-
                    </div>
                </div>
                <div class="row mx-auto my-2">
                    <div class="col">
                        <h6>Status</h6>
                    </div>
                    <div class="col-7">
                        <?php if ($p['status'] == 1) {
                            echo "Lunas";
                        }else{
                            echo "Belum Lunas";
                        }?>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table col mx-auto mt-4">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Jumlah</th>
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
                                    <td align="right">Rp<?= number_format($items['subtotal'], 0,',','.'); ?>,-</td>
                                </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td align="right" colspan="3"><b>Total</b></td>
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
