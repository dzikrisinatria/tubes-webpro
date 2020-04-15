<div class="container h-100">
	<div class="row h-100 justify-content-center align-items-center">
		<div class="col-10 col-md-8 col-lg-6">
			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body">
					<div class="text-center">
						<h1 class="h4 text-gray-900 mb-4">Register</h1>
					</div>

					<?= form_open_multipart('auth/register');?>

						<div class="form-group">
							<!-- <label for="email">Email</label> -->
							<input type="text" class="form-control" id="email" name="email"
								value="<?= set_value('email'); ?>" placeholder="Email">
							<?= form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
						</div>

						<div class="form-group">
							<!-- <label for="username">Username</label> -->
							<input type="text" class="form-control" id="username" name="username"
								value="<?= set_value('username'); ?>" placeholder="Username">
							<?= form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
						</div>

						<div class="form-group row">
							<div class="col-sm-6">
								<!-- <label for="password">Password</label> -->
								<input type="password" class="form-control" id="password" name="password" placeholder="Password">
								<?= form_error('password', '<small class="form-text text-danger">', '</small>'); ?>
							</div>
							<div class="col-sm-6">
								<!-- <label for="password2">Ulangi Password</label> -->
								<input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Password">
							</div>
						</div>
                        <hr>
						<div class="form-group">
							<label for="nama">Nama Lengkap</label>
							<input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>">
							<?= form_error('nama', '<small class="form-text text-danger">', '</small>'); ?>
						</div>

						<div class="form-group row">
							<div class="col-sm-6">
								<label for="jenis_kelamin">Jenis Kelamin</label><br>
								<div class="form-check form-check-inline col-3">
									<input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Pria" 
                                        <?= set_value('jenis_kelamin') == 'Pria' ? "checked" : ""; ?> />
									<label class="form-check-label" for="jenis_kelamin">Pria</label>
								</div>
								<div class="form-check form-check-inline col-3">
									<input class="form-check-input" type="radio" name="jenis_kelamin"
										id="jenis_kelamin2" value="Wanita" 
                                        <?= set_value('jenis_kelamin') == 'Wanita' ? "checked" : ""; ?> />
									<label class="form-check-label" for="jenis_kelamin2">Wanita</label>
								</div>
                                <?= form_error('jenis_kelamin', '<small class="form-text text-danger">', '</small>'); ?>
							</div>
                            <div class="col-sm-6">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                    value="<?= set_value('tgl_lahir'); ?>">
                                <?= form_error('tgl_lahir', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
						</div>

                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2"><?= set_value('alamat'); ?></textarea>
                            <?= form_error('alamat', '<small class="form-text text-danger">', '</small>'); ?>
						</div>

                        <div class="form-group row">
							<div class="col">
								<label for="telepon">Nomor Telepon</label>
								<input type="telepon" class="form-control" id="telepon" name="telepon" value="<?= set_value('telepon'); ?>">
								<?= form_error('telepon', '<small class="form-text text-danger">', '</small>'); ?>
							</div>
                            <div class="col">
                                <label for="foto">Foto Diri</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto">
                                    <label class="custom-file-label" for="foto">Pilih Foto</label>
                                    <?= $this->session->flashdata('message'); //pesan error khusus upload ?>
                                </div>
                            </div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-success form-control mt-2">Register</button>
						</div>
						<hr>
						<div class="text-center">
							<a class="small" href="<?= base_url('auth'); ?>">Sudah memiliki akun? Silahkan <b>Login!</b></a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>

<script>
    $('.custom-file-input').on('change', function() { 
        let fileName = $(this).val().split('\\').pop(); 
        $(this).next('.custom-file-label').addClass("selected").html(fileName); 
    });
</script>

</html>
