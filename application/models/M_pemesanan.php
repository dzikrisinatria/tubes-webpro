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
            'metode_pembayaran' => $this->input->post('metode'),
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
    public function getAllPemesanan()
    {
        return $this->db->get('pemesanan')->result_array();
    }
    public function getDetailPemesanan($id_pemesanan){
        $this->db->where('id_pemesanan', $id_pemesanan);
        $this->db->from('detail_pemesanan');
        $this->db->join('obat','obat.id_obat=detail_pemesanan.id_obat','LEFT OUTER');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function totalRowsPagination($keyword)
    {
        $this->cariPemesanan($keyword);
        $this->db->from('pemesanan');
        return $this->db->count_all_results();
    }
    public function getPemesananPagination($limit, $start, $keyword = null){
        if ($keyword){
            $this->caripemesanan($keyword);
        }
        $query = $this->db->get('pemesanan', $limit, $start);
        return $query->result_array();
    }
    public function cariPemesanan($keyword)
    {
        $this->db->or_like('tgl_pemesanan', $keyword);
        $this->db->or_like('total', $keyword);
        $this->db->or_like('metode_pembayaran', $keyword);
        $this->db->or_like('bayar', $keyword);
        $this->db->or_like('status', $keyword);
    }
}