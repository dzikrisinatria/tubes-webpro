<div class="col pt-5 mb-4">
	<div class="container mt-5">
		<h2>Tambah Jenis</h2>
		<!-- MULAI KONTEN DISINI -->

		<?= form_open_multipart('obat/tambahjenisobat');?>

        <div class="col-md-7 mt-3">
			<div class="form-group row">
				<label for="id_jenis_obat" class="col-sm-3 col-form-label">ID Jenis Obat</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="id_jenis_obat" name="id_jenis_obat" placeholder="ID Jenis Obat"
                    value="<?= set_value('id_jenis_obat'); ?>">
					<?= form_error('id_jenis_obat', '<small class="form-text text-danger">', '</small>'); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="nama_jenis" class="col-sm-3 col-form-label">Nama Jenis</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="nama_jenis" name="nama_jenis" placeholder="Nama Jenis"
                    value="<?= set_value('nama_jenis'); ?>">
					<?= form_error('nama_jenis', '<small class="form-text text-danger">', '</small>'); ?>
				</div>
			</div>
            <hr>
			<div class="form-group row justify-content-end">
				<a type="button" href="<?= base_url('obat/jenisobat'); ?>" class="btn btn-secondary form-control mt-2 col-sm-2 mx-1">Batal</a>
				<button type="submit" class="btn btn-success form-control mt-2 col-sm-2 mx-1">Tambah Jenis Obat</button>
			</div>
		</div>

		</form>
	</div>
</div>
<script>
    $('.custom-file-input').on('change', function() { 
        let fileName = $(this).val().split('\\').pop(); 
        $(this).next('.custom-file-label').addClass("selected").html(fileName); 
    });
</script>
