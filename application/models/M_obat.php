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
            $this->cariuser($keyword);
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
        $this->cariuser($keyword);
        $this->db->join('jenis_obat','jenis_obat.id_jenis_obat=obat.id_jenis_obat','LEFT OUTER');
        $this->db->from('user');
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
            // 'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'stok' => $this->input->post('stok'),
            'bentuk'     => $this->input->post('bentuk'),
            'fungsi'        => $this->input->post('fungsi'),
            'aturan'       => $this->input->post('aturan'),
            'gambar'          => $new_image,
            'id_jenis_obat'       => $this->input->post('jenis_obat'),
            // 'date_created'  => time()
        ];
    }

    public function adddataobat($new_image)
    {
        return $data = [
            'kode_obat'          => $this->input->post('kode_obat'),
            'nama_obat'         => $this->input->post('nama_obat'),
            'harga'      => $this->input->post('harga'),
            // 'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'stok' => $this->input->post('stok'),
            'bentuk'     => $this->input->post('bentuk'),
            'fungsi'        => $this->input->post('fungsi'),
            'aturan'       => $this->input->post('aturan'),
            'gambar'          => $new_image,
            'id_jenis_obat'       => $this->input->post('jenis_obat'),
            // 'date_created'  => time()
        ];
    }

    public function updateUser($data,$id_obat)
    {
        $this->db->set($data);
        $this->db->where('id_obat', $id_obat);
        $this->db->update('obat');
    }

}
