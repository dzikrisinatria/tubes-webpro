<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pemesanan extends CI_Model
{
    public function proses($id_user)
    {
        // INSERT DATA KE TABEL PEMESANAN
        $dataPemesanan = array(
            'id_user'       => $id_user,
            'tgl_pemesanan' => date('Y-m-d'),
            'total'         => $this->cart->total(),
            'bayar'         => 0,
            'status'        => 0
        );

        $this->db->insert('pemesanan', $dataPemesanan);
        
        //INSERT ID UNTUK DIPAKAI DI DETAIL_PEMESANAN
        $id_pemesanan = $this->db->insert_id();

        // INSERT DATA KE TABEL DETAIL_PEMESANAN
        foreach ($this->cart->contents() as $items)
        {
            $dataDetailPemesanan = array(
                'id_pemesanan'  => $id_pemesanan,
                'id_obat'       => $items['id'],
                'jumlah'        => $items['qty'],
                'subtotal'      => $items['subtotal']
            );

            $this->db->insert('detail_pemesanan', $dataDetailPemesanan);
        }

        return true;
    }
}