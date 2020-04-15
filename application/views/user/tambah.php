<div class="col pt-5 mb-4">
	<div class="container mt-5">
		<h2>Tambah User</h2>
		<!-- MULAI KONTEN DISINI -->

		<?= form_open_multipart('admin/tambahuser');?>
		
        <div class="col-md-7 mt-3">
			<div class="form-group row">
				<label for="email" class="col-sm-3 col-form-label">Email</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="email" name="email" placeholder="Email"
                    value="<?= set_value('email'); ?>">
					<?= form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="username" class="col-sm-3 col-form-label">Username</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="username" name="username" placeholder="Username"
                    value="<?= set_value('username'); ?>">
					<?= form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="role" class="col-sm-3 col-form-label">Role</label>
				<div class="col-sm-9">
					<select class="custom-select" name="role">
						<?php foreach ($getrole as $r ) :?>
                            <?php if( set_value('role') == $r['role_id'] ) : ?>
                                <option value="<?= $r['role_id']; ?>" selected><?= $r['role']; ?></option>
                            <?php else : ?>
                                <option value="<?= $r['role_id']; ?>"><?= $r['role']; ?></option>
                            <?php endif; ?>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                    <div class="form-inline">
                        <input type="password" class="form-control col mr-1" id="password" name="password"
                            placeholder="Ketik Password">
                    
                        <input type="password" class="form-control col ml-1" id="password2" name="password2"
                            placeholder="Ulangi Password">
                    </div>
                    <?= form_error('password', '<small class="form-text text-danger">', '</small>'); ?>
                </div>
            </div>
            <hr>
			<div class="form-group row">
				<label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>">
					<?= form_error('nama', '<small class="form-text text-danger">', '</small>'); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline col-1 mt-1">
						<input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Pria"
							<?= set_value('jenis_kelamin') == 'Pria' ? "checked" : ""; ?> />
						<label class="form-check-label" for="jenis_kelamin">Pria</label>
					</div>
					<div class="form-check form-check-inline col-1 ml-3">
						<input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="Wanita"
                            <?= set_value('jenis_kelamin') == 'Wanita' ? "checked" : ""; ?> />
						<label class="form-check-label" for="jenis_kelamin2">Wanita</label>
					</div>
					<?= form_error('jenis_kelamin', '<small class="form-text text-danger">', '</small>'); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
				<div class="col-sm-9">
					<input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                    value="<?= set_value('tgl_lahir'); ?>">
					<?= form_error('tgl_lahir', '<small class="form-text text-danger">', '</small>'); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="alamat" class="col-sm-3 col-form-label">Alamat Lengkap</label>
				<div class="col-sm-9">
					<textarea class="form-control" id="alamat" name="alamat" rows="2"><?= set_value('alamat'); ?></textarea>
					<?= form_error('alamat', '<small class="form-text text-danger">', '</small>'); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="telepon" class="col-sm-3 col-form-label">Nomor Telepon</label>
				<div class="col-sm-9">
					<input type="telepon" class="form-control" id="telepon" name="telepon"
                    value="<?= set_value('telepon'); ?>">
					<?= form_error('telepon', '<small class="form-text text-danger">', '</small>'); ?>
				</div>
			</div>

			<div class="form-group row">
				<label for="foto" class="col-sm-3 col-form-label">Foto Diri</label>
				<div class="col-sm-9">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="foto" name="foto">
						<label class="custom-file-label" for="foto">Pilih Foto</label>
						<?= $this->session->flashdata('message'); //pesan error khusus upload ?>
					</div>
				</div>
			</div>
            
			<div class="form-group row justify-content-end">
				<a type="button" href="<?= base_url('admin/user'); ?>" class="btn btn-secondary form-control mt-2 col-sm-2 mx-1">Batal</a>
				<button type="submit" class="btn btn-success form-control mt-2 col-sm-2 mx-1">Register</button>
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
