<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function getAllUser()
    {
        return $this->db->get('user')->result_array();
    }
    
    public function getUserPagination($limit, $start, $keyword = null)
    {
        if ($keyword){
            $this->cariuser($keyword);
        }
		$this->db->join('user_role','user_role.role_id=user.role_id','LEFT OUTER');
		$query = $this->db->get('user', $limit, $start);
        return $query->result_array();
    }

    public function totalRowsPagination($keyword)
    {
        $this->cariuser($keyword);
        $this->db->join('user_role','user_role.role_id=user.role_id','LEFT OUTER');
        $this->db->from('user');
        return $this->db->count_all_results();
    }

    public function getUserById($id_user)
    {
        $this->db->join('user_role','user_role.role_id=user.role_id','LEFT OUTER');
        $this->db->where('id_user', $id_user);
        return $this->db->get('user')->row_array();
    }
    
    public function getUserCountByRole($role_id)
    {
        $this->db->where('role_id', $role_id);
        $this->db->from('user');
        return $this->db->count_all_results();
    }

    public function getAllUserAndRole()
    {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_role','user_role.role_id=user.role_id','LEFT OUTER');
		$query = $this->db->get();
		return $query->result_array();
    }
    
    public function getAllRole()
    {
		$this->db->select('*');
		$this->db->from('user_role');
		$query = $this->db->get();
		return $query->result_array();
    }

    public function countAllUser()
    {
        return $this->db->get('user')->num_rows();
    }
    
    public function hapusUser($id_user)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->delete('user');
    }

    public function cariuser($keyword)
    {
        $this->db->like('nama', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('username', $keyword);
        $this->db->or_like('jenis_kelamin', $keyword);
        $this->db->or_like('tgl_lahir', $keyword);
        $this->db->or_like('alamat', $keyword);
        $this->db->or_like('telepon', $keyword);
        $this->db->or_like('role', $keyword);
    }

    public function editdata($new_image)
    {
        return $data = [
            'nama'          => htmlspecialchars($this->input->post('nama', true)),
            'email'         => htmlspecialchars($this->input->post('email', true)),
            'username'      => htmlspecialchars($this->input->post('username', true)),
            // 'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'tgl_lahir'     => $this->input->post('tgl_lahir'),
            'alamat'        => $this->input->post('alamat'),
            'telepon'       => $this->input->post('telepon'),
            'foto'          => $new_image,
            'role_id'       => $this->input->post('role'),
            'date_created'  => time()
        ];
    }

    public function adddata($new_image)
    {
        $data = [
            'nama'          => htmlspecialchars($this->input->post('nama', true)),
            'email'         => htmlspecialchars($this->input->post('email', true)),
            'username'      => htmlspecialchars($this->input->post('username', true)),
            'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'tgl_lahir'     => $this->input->post('tgl_lahir'),
            'alamat'        => $this->input->post('alamat'),
            'telepon'       => $this->input->post('telepon'),
            'foto'          => $new_image,
            'role_id'       => $this->input->post('role'),
            'date_created'  => time()
        ];
        $this->db->insert('user', $data);
    }

    public function updateUser($data,$id_user)
    {
        $this->db->set($data);
        $this->db->where('id_user', $id_user);
        $this->db->update('user');
    }

}