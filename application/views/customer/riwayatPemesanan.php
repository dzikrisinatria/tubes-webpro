<div class="container-fluid pt-5 mt-5">
	<!-- MULAI KONTEN DISINI -->

    <?= $this->session->flashdata('message'); ?>
    
    <div class="row col-11 mb-4 mx-auto justify-content-start">
        <div class="col-8">
            <h3>Riwayat Pemesanan</h3>
        </div>
        <div class="col justify-content-end">
            <form action="<?= base_url('customer/riwayatPemesanan'); ?>" method="post" class="mr-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Pemesanan.." name="keyword" autocomplete="off" autofocus
                    value="<?= set_value('keyword'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">
                            <i class="fas fa-fw fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php foreach ($pemesananPagination as $p) : ?>
        <div class="row justify-content-start col-11 mx-auto">
            <div class="card ml-3 mb-4" style="width: 50rem;">
                <h6 class="card-header"><?= date("D, d F Y", strtotime($p['tgl_pemesanan'])); ?></h6>
                <div class="card-body">
                    <!-- <div class="container"> -->
                        <div class="row justify-content-between">
                            <div class="col-2">
                                <small>Status</small>
                                <?php if ($p['status'] == 1) {
                                    echo '<h5><span class="badge text-white" style="background: #00b894;">Selesai</span></h5>';
                                }else{
                                    echo '<h5><span class="badge badge-danger">Belum Selesai</span></h5>';
                                }?>
                            </div>
                            <div class="col-4">
                                <small>Metode Pembayaran</small>
                                <p> <?= $p['metode_pembayaran'];?> </p>
                            </div>
                            <div class="col-3">
                                <small>Total</small>
                                <p>Rp<?= number_format($p['total'], 0,',','.'); ?>,-</p>
                            </div>
                            <div class="col">
                                <a href="#" class="btn btn-info mt-2" id="toggle<?= $p['id_pemesanan']; ?>">Lihat Detail</a>
                            </div>
                        </div>
                        <div clas="row">
                            <table class="table table mt-2 mx-auto" id="table<?= $p['id_pemesanan']; ?>" >
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
                            <?php $no=1; foreach ($p['itemPemesanan'] as $items) : ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $items['nama_obat']; ?></td>
                                    <td><?= $items['jumlah']; ?></td>
                                    <td align="right">Rp<?= number_format($items['harga'], 0,',','.'); ?>,-</td>
                                    <td align="right">Rp<?= number_format($items['subtotal'], 0,',','.'); ?>,-</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            </table>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
           
        </div>


    <?php endforeach; ?>

    <?= $this->pagination->create_links(); ?>

    <!-- AKHIR KONTEN -->
</div>

<script>
    <?php foreach ($pemesananPagination as $p) : ?>
        $("#table<?= $p['id_pemesanan']; ?>").hide();
        $("#toggle<?= $p['id_pemesanan']; ?>").click(function(){
            $("#table<?= $p['id_pemesanan']; ?>").toggle();
            $(this).text($(this).text() == 'Lihat Detail' ? 'Sembunyikan' : 'Lihat Detail'); 
        });
    <?php endforeach; ?>
</script>
