ALTER TABLE `obat` DROP FOREIGN KEY `obat_fk0`;

ALTER TABLE `user` DROP FOREIGN KEY `user_fk0`;

ALTER TABLE `pemesanan` DROP FOREIGN KEY `pemesanan_fk0`;

ALTER TABLE `detail_pemesanan` DROP FOREIGN KEY `detail_pemesanan_fk0`;

ALTER TABLE `detail_pemesanan` DROP FOREIGN KEY `detail_pemesanan_fk1`;

DROP TABLE IF EXISTS `obat`;

DROP TABLE IF EXISTS `jenis_obat`;

DROP TABLE IF EXISTS `user`;

DROP TABLE IF EXISTS `user_role`;

DROP TABLE IF EXISTS `pemesanan`;

DROP TABLE IF EXISTS `detail_pemesanan`;

