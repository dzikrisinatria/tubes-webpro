<div class="col pt-5 mb-4">
    <div class="container mt-5">
        <h2>Konfirmasi Pemesanan</h2>
        <!-- MULAI KONTEN DISINI -->
        <br>
        <div >
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Tanggal Pemesanan</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $Pemesanan['tgl_pemesanan'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Customer</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $Pemesanan['nama'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Metode Pembayaran</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $Pemesanan['metode_pembayaran'];?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Nominal Pembayaran</h6>
                    </div>
                    <div class="col-8">
                        <p>Rp<?= $Pemesanan['bayar'];?>,-</p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Status</h6>
                    </div>
                    <div class="col-8">
                        <p><?php if ($Pemesanan['status'] == 1) echo "Lunas";
                                else echo "Belum Lunas";
                                ?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Alamat Pengiriman</h6>
                    </div>
                    <div class="col-8">
                        <p><?= $Pemesanan['alamat'];?></p>
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
                            <?php if (empty($Pemesanan['itemPemesanan']) ): ?>
                                <tr><td colspan="5">
                                <div class="alert alert-danger text-center" role="alert">
                                    Item Kosong.
                                </div></td></tr>
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
                <?= form_open_multipart('pemesanan/konfirmasiPemesanan/'.$Pemesanan['id_pemesanan']);?>
                <div class="row mx-auto">
                    <div class="col-4">
                        <h6>Nominal</h6>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" id="nominal" name="nominal" placeholder=""
                    value="<?= set_value('nominal'); ?>">
                    <?= form_error('nominal', '<small class="form-text text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <button type="submit" class="btn btn-success form-control mt-2 col-sm-5 mx-1">Konfirmasi</button>
                </div>
            </div>
    </div>
</div>