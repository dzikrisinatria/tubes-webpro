<div class="col pt-5 mb-4">
	<div class="container mt-5">
		<h2>User</h2>
		<!-- MULAI KONTEN DISINI -->
        
        <?= $this->session->flashdata('message'); ?>

        <div class="mt-4">
            <a href="<?= base_url(); ?>admin/tambahuser">
                <button class="btn btn-success">
                    <i class="fas fa-fw fa-user-plus mr-2"></i>Tambah User
                </button>
            </a>
        </div>

		<div class="mt-4 table-responsive-md">

			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col"></th>
						<th scope="col">Username</th>
						<th scope="col">Email</th>
						<th scope="col">Nama</th>
						<th scope="col">Role</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($userpagination as $u ) :?>
					<tr>
						<form action="">
							<td><?= ++$start ?></td>
							<td><?= $u['username'] ?></td>
							<td><?= $u['email']?></td>
							<td><?= $u['nama']?></td>
							<td><?= $u['role']?></td>

							<td>
								<button type="button" class="btn btn-primary" data-toggle="modal"
									data-target="#detail<?= $u['id_user']?>">
									<i class="fas fa-fw fa-info"></i>
								</button>
								<a type="button" class="btn btn-warning ml-1"
									href="<?= base_url(); ?>admin/edituser/<?= $u['id_user']?>">
									<i class="fas fa-fw fa-user-edit"></i>
								</<button>
								<a type="button" class="btn btn-danger ml-2"
									href="<?= base_url(); ?>admin/hapususer/<?= $u['id_user']?>"
									onClick="return confirm('Apakah Anda Yakin?')">
									<i class="fas fa-fw fa-user-times"></i>
								</<button>
							</td>
						</form>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

            <?= $this->pagination->create_links(); ?>

		</div>

	</div>

</div>

<!-- MODAL FORM DETAIL USER -->
<?php $no=1; foreach ($alluser as $u ) :?>
<div class="modal fade" id="detail<?= $u['id_user']; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Detail User</h4>
			</div>
			<div class="modal-body">
                <h5><?= $u['nama'];?></h5>
                <p><?= $u['role'];?></p>
                <p><?= $u['email'];?></p>
                <p><?= $u['username'];?></p>
                <p><?= $u['jenis_kelamin'];?></p>
                <p><?= $u['tgl_lahir'];?></p>
                <p><?= $u['alamat'];?></p>
                <p><?= $u['telepon'];?></p>
                <p><?= $u['foto'];?></p>
                <p>Terdaftar Sejak <?= date('d F Y', $u['date_created']);?></p>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
		</div>
	</div>
</div>
<?php endforeach; ?>
