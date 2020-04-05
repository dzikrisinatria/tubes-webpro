CREATE TABLE `obat` (
	`id_obat` int NOT NULL AUTO_INCREMENT,
	`kode_obat` varchar(5) NOT NULL,
	`nama_obat` varchar(128) NOT NULL,
	`id_jenis_obat` int NOT NULL,
	`harga` int(6) NOT NULL,
	`stok` int(6) NOT NULL,
	`bentuk` varchar(10) NOT NULL,
	`fungsi` varchar(128) NOT NULL,
	`aturan` TEXT NOT NULL,
	`gambar` varchar(128) NOT NULL,
	PRIMARY KEY (`id_obat`)
);

CREATE TABLE `jenis_obat` (
	`id_jenis_obat` int NOT NULL AUTO_INCREMENT,
	`nama_jenis` varchar(50) NOT NULL,
	PRIMARY KEY (`id_jenis_obat`)
);

CREATE TABLE `user` (
	`id_user` int NOT NULL AUTO_INCREMENT,
	`nama` varchar(128) NOT NULL,
	`email` varchar(128) NOT NULL,
	`username` varchar(20) NOT NULL,
	`password` varchar(256) NOT NULL,
	`jenis_kelamin` varchar(10) NOT NULL,
	`tgl_lahir` DATE NOT NULL,
	`alamat` TEXT NOT NULL,
	`telepon` varchar(13) NOT NULL,
	`foto` varchar(128) NOT NULL,
	`role_id` int(1) NOT NULL,
	`date_created` int(11) NOT NULL,
	PRIMARY KEY (`id_user`)
);

CREATE TABLE `user_role` (
	`role_id` int NOT NULL AUTO_INCREMENT,
	`role` varchar(30) NOT NULL,
	PRIMARY KEY (`role_id`)
);

CREATE TABLE `pemesanan` (
	`id_pemesanan` int NOT NULL AUTO_INCREMENT,
	`id_user` int NOT NULL,
	`tgl_pemesanan` DATE NOT NULL,
	`total` int NOT NULL,
	`bayar` int NOT NULL,
	`status` int(1) NOT NULL,
	PRIMARY KEY (`id_pemesanan`)
);

CREATE TABLE `detail_pemesanan` (
	`id_pemesanan` int NOT NULL,
	`id_obat` int NOT NULL,
	`jumlah` int NOT NULL,
	`subtotal` int NOT NULL
);

ALTER TABLE `obat` ADD CONSTRAINT `obat_fk0` FOREIGN KEY (`id_jenis_obat`) REFERENCES `jenis_obat`(`id_jenis_obat`);

ALTER TABLE `user` ADD CONSTRAINT `user_fk0` FOREIGN KEY (`role_id`) REFERENCES `user_role`(`role_id`);

ALTER TABLE `pemesanan` ADD CONSTRAINT `pemesanan_fk0` FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`);

ALTER TABLE `detail_pemesanan` ADD CONSTRAINT `detail_pemesanan_fk0` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan`(`id_pemesanan`);

ALTER TABLE `detail_pemesanan` ADD CONSTRAINT `detail_pemesanan_fk1` FOREIGN KEY (`id_obat`) REFERENCES `obat`(`id_obat`);

