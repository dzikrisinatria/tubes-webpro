<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_obat extends CI_Model
{
    public function getAllObat()
    {
        return $this->db->get('obat')->result_array();
    }
    
    public function getObatPagination($limit, $start, $keyword = null)
    {
        if ($keyword){
            $this->cariobat($keyword);
        }
		$this->db->join('jenis_obat','jenis_obat.id_jenis_obat=obat.id_jenis_obat','LEFT OUTER');
		$query = $this->db->get('obat', $limit, $start);
        return $query->result_array();
    }
    
    public function getJenisObatPagination($limit, $start, $keyword = null)
    {
        if ($keyword){
            $this->carijenis($keyword);
        }
		$query = $this->db->get('jenis_obat', $limit, $start);
        return $query->result_array();
    }

    public function totalRowsPagination($keyword)
    {
        $this->cariobat($keyword);
        $this->db->join('jenis_obat','jenis_obat.id_jenis_obat=obat.id_jenis_obat','LEFT OUTER');
        $this->db->from('obat');
        return $this->db->count_all_results();
    }
    
    public function totalRowsJenisPagination($keyword)
    {
        $this->carijenis($keyword);
        $this->db->from('jenis_obat');
        return $this->db->count_all_results();
    }

    public function getObatById($id_obat)
    {
        $this->db->join('jenis_obat','jenis_obat.id_jenis_obat=obat.id_jenis_obat','LEFT OUTER');
        $this->db->where('id_obat', $id_obat);
        return $this->db->get('obat')->row_array();
    }
    
    public function getJenisById($id_jenis_obat)
    {
        $this->db->where('id_jenis_obat', $id_jenis_obat);
        return $this->db->get('jenis_obat')->row_array();
    }

    public function getObatCountByJenis($id_jenis_obat)
    {
        $this->db->where('id_jenis_obat', $id_jenis_obat);
        $this->db->from('obat');
        return $this->db->count_all_results();
    }

    public function getAllObatAndJenis()
    {
		$this->db->select('*');
		$this->db->from('obat');
		$this->db->join('jenis_obat','jenis_obat.id_jenis_obat=obat.id_jenis_obat','LEFT OUTER');
		$query = $this->db->get();
		return $query->result_array();
    }
    
    public function getAllJenis()
    {
		$this->db->select('*');
		$this->db->from('jenis_obat');
		$query = $this->db->get();
		return $query->result_array();
    }

    public function countAllObat()
    {
        return $this->db->get('obat')->num_rows();
    }
    
    public function hapusObat($id_obat)
    {
        $this->db->where('id_obat', $id_obat);
        return $this->db->delete('obat');
    }

     public function hapusJenisObat($id_jenis_obat)
    {
        $this->db->where('id_jenis_obat', $id_jenis_obat);
        return $this->db->delete('jenis_obat');
    }

    public function cariobat($keyword)
    {
        $this->db->like('kode_obat', $keyword);
        $this->db->or_like('nama_obat', $keyword);
        $this->db->or_like('harga', $keyword);
        $this->db->or_like('stok', $keyword);
        $this->db->or_like('bentuk', $keyword);
        $this->db->or_like('fungsi', $keyword);
        $this->db->or_like('aturan', $keyword);
        $this->db->or_like('nama_jenis', $keyword);
    }
    
    public function carijenis($keyword)
    {
        $this->db->like('id_jenis_obat', $keyword);
        $this->db->or_like('nama_jenis', $keyword);
    }

    public function editdataobat($new_image)
    {
        return $data = [
            'kode_obat'          => $this->input->post('kode_obat'),
            'nama_obat'         => $this->input->post('nama_obat'),
            'harga'      => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'bentuk'     => $this->input->post('bentuk'),
            'fungsi'        => $this->input->post('fungsi'),
            'aturan'       => $this->input->post('aturan'),
            'gambar'          => $new_image,
            'id_jenis_obat'       => $this->input->post('id_jenis_obat')
        ];
    }

    public function adddataobat($new_image)
    {
        $data = [
            'kode_obat'          => $this->input->post('kode_obat'),
            'nama_obat'         => $this->input->post('nama_obat'),
            'harga'      => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'bentuk'     => $this->input->post('bentuk'),
            'fungsi'        => $this->input->post('fungsi'),
            'aturan'       => $this->input->post('aturan'),
            'gambar'          => $new_image,
            'id_jenis_obat'       => $this->input->post('id_jenis_obat')
        ];
        $this->db->insert('obat', $data);
    }

    public function adddatajenisobat()
    {
        $data = [
            'id_jenis_obat' => $this->input->post('id_jenis_obat'),
            'nama_jenis' => $this->input->post('nama_jenis')
        ];
        $this->db->insert('jenis_obat', $data);
    }

    public function editdatajenisobat()
    {
        return $data = [
            'id_jenis_obat' => $this->input->post('id_jenis_obat'),
            'nama_jenis' => $this->input->post('nama_jenis')
        ];
    }

    public function updateObat($data,$id_obat)
    {
        $this->db->set($data);
        $this->db->where('id_obat', $id_obat);
        $this->db->update('obat');
    }

    public function updateJenisObat($data,$id_jenis_obat)
    {
        $this->db->set($data);
        $this->db->where('id_jenis_obat', $id_jenis_obat);
        $this->db->update('jenis_obat');
    }
    public function updateStokObat($id, $stok)
    {
        $this->db->query("UPDATE `obat` SET `stok` = ".$stok." WHERE `obat`.`id_obat` = ".$id.";");
    }
}
