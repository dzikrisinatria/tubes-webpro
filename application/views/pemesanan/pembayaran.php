<div class="container-fluid pt-5 mt-5">
	<!-- MULAI KONTEN DISINI -->

        <?= $this->session->flashdata('message'); ?>
    <h2>Pembayaran</h2>
    <div>
    	<h4>Alamat Pengiriman</h4>
    	<p><?= $user['nama'] ?></p>
    	<p><?= $user['telepon'] ?></p>
    	<p><?= $user['alamat'] ?> </p>
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
                <?php if (!$this->cart->contents()):?>
                    <tr><td colspan="5">
                    <div class="alert alert-danger text-center" role="alert">
                        Keranjang belum terisi.
                    </div></td></tr>
                <?php else: ?>
                    <?php $no=1; foreach ($this->cart->contents() as $items) : ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></th>
                        <td><?= $items['name']; ?></td>
                        <td><?= $items['qty']; ?></td>
                        <td align="right">Rp<?= number_format($items['price'], 0,',','.'); ?>,-</td>
                        <td align="right">Rp<?= number_format($items['subtotal'], 0,',','.'); ?>,-</td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td align="right" colspan="4"><b>Total</b></td>
                        <td align="right"><b>Rp<?= number_format($this->cart->total(), 0,',','.'); ?>,-</b></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="container-fluid col-3">
        <div class="row justify-content-between">
			<?= form_open_multipart('pemesanan/pembayaran');?>
			<div class="form-group row">
				<label for="metode" class="col-sm-7 col-form-label">Metode Pembayaran </label>
				<div class="col-sm-5">
					<select class="custom-select" name="metode">
                            <option value="Bayar di Tempat">Bayar di Tempat</option>
                            <option value="Cash On Delivery">Cash On Delivery</option>
					</select>
				</div>
			</div>
			<div class="form-group row justify-content-end">
				<!-- <a type="button" href="<?= base_url('obat/index'); ?>" class="btn btn-secondary form-control mt-2 col-sm-2 mx-1">Batal</a> -->
				<button type="submit" class="btn btn-success form-control mt-2 col-sm-5 mx-1">Selesaikan</button>
			</div>
        </div>
    </div>
    <!-- AKHIR KONTEN -->
</div>