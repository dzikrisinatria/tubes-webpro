<div class="col pt-3 mb-4">
	<div class="container mt-5">
        <h2>Konfirmasi Pemesanan</h2>
		<!-- MULAI KONTEN DISINI -->
        <?= $this->session->flashdata('message'); ?>
        
		<div class="row mt-4">
			<div class="col-3">
				<h6>Tanggal Pemesanan</h6>
			</div>
			<div class="col-8">
				<p><?= date("d F Y", strtotime($Pemesanan['tgl_pemesanan']));?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-3">
				<h6>Customer</h6>
			</div>
			<div class="col-8">
				<p><?= $Pemesanan['nama'];?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-3">
				<h6>Metode Pembayaran</h6>
			</div>
			<div class="col-8">
				<p><?= $Pemesanan['metode_pembayaran'];?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-3">
				<h6>Nominal Pembayaran</h6>
			</div>
			<div class="col-8">
				<p>Rp<?= $Pemesanan['bayar'];?>,-</p>
			</div>
		</div>
		<div class="row">
			<div class="col-3">
				<h6>Status</h6>
			</div>
			<div class="col-8">
				<p><?php if ($Pemesanan['status'] == 1) echo "Lunas";
                    else echo "Belum Lunas";
                    ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-3">
				<h6>Alamat Pengiriman</h6>
			</div>
			<div class="col-8">
				<p><?= $Pemesanan['alamat'];?></p>
			</div>
		</div>

		<div class="table-responsive mt-3">
			<table class="table table col-7">
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
					<?php if (empty($Pemesanan['itemPemesanan']) ): ?>
						<tr>
							<td colspan="5">
								<div class="alert alert-danger text-center" role="alert">
									Item Kosong.
								</div>
							</td>
						</tr>
					<?php else: ?>
						<?php $no=1; foreach ($Pemesanan['itemPemesanan'] as $items) : ?>
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
							<td align="right"><b>Rp<?= number_format($Pemesanan['total'], 0,',','.'); ?>,-</b></td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
        </div>
        <?php if ($confirm != false) : ?>
			<?= form_open_multipart('pemesanan/konfirmasiPemesanan/'.$Pemesanan['id_pemesanan']);?>
				<div class="form-group row justify-content-start">
					<div class="col-2 col-form-label">
						<h6>Jumlah Bayar</h6>
					</div>
					<div class="row col-3">
						<div class="col-1 col-form-label">Rp</div>
						<div class="col">
							<input type="text" class="form-control" id="nominal" name="nominal" placeholder=""
								value="<?= set_value('nominal'); ?>">
							<?= form_error('nominal', '<small class="form-text text-danger">', '</small>'); ?>
						</div>
					</div>
					<div class="col justify-content-end">
						<button type="submit" class="btn btn-success form-control col-3">Konfirmasi</button>
					</div>
				</div>
			</form>
		<?php else : ?>
			<a type="button" href="<?= base_url('pemesanan/index'); ?>" class="btn btn-secondary form-control mt-2 col-sm-2 mx-1">Kembali</a>
		<?php endif; ?>
	</div>
</div>
