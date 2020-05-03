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
        <script>
        $(document).ready(function(){
            $("#table<?= $p['id_pemesanan']; ?>").hide();
          $("#toggle<?= $p['id_pemesanan']; ?>").click(function(){
            $("#table<?= $p['id_pemesanan']; ?>").toggle();
            $(this).text($(this).text() == 'Lihat Detail Pesanan' ? 'Sembunyikan Detail Pesanan' : 'Lihat Detail Pesanan'); 
          });
        });
        </script>
        <div class="row justify-content-start col-11 mx-auto">
            <div class="card ml-3 mb-4" style="width: 45rem;">
                <h6 class="card-header"><?= $p['tgl_pemesanan']; ?></h6>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <small>Status</small>
                                <p> <?php if ($p['status'] == 1) echo "Selesai";
                                                else echo "Belum Selesai";?> </p>
                            </div>
                            <div class="col">
                                <small>Metode Pembayaran</small>
                                <p> <?= $p['metode_pembayaran'];?> </p>
                            </div>
                            <div class="col">
                                <small>Total</small>
                                <p>Rp<?= number_format($p['total'], 0,',','.'); ?>,-</p>
                            </div>

                        </div>
                         <a href="#" class="btn btn-primary" id="toggle<?= $p['id_pemesanan']; ?>">Lihat Detail Pesanan</a>
                        <div clas="row">
                            <table class="table table col-7 mx-auto" id="table<?= $p['id_pemesanan']; ?>" >
                            <br>
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
                    </div>
                </div>
            </div>
           
        </div>


     <?php endforeach; ?>
    <?= $this->pagination->create_links(); ?>

    <!-- AKHIR KONTEN -->
</div>
