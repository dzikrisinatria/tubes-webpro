<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model
{
    public function getUser($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row_array();
    }

    public function getObatCount()
    {
        return $this->db->count_all('obat');
    }
    
    public function getPemesananCount()
    {
        return $this->db->count_all('pemesanan');
    }

    public function regdata($new_image)
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
            'role_id'       => 3,
            'date_created'  => time()
        ];

        $this->db->insert('user', $data);
    }

    public function regdata2()
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
            'foto'          => 'default.jpg',
            'role_id'       => 3,
            'date_created'  => time()
        ];

        $this->db->insert('user', $data);
    }

    public function getProfile($username)
    {
        $this->db->join('user_role','user_role.role_id=user.role_id','LEFT OUTER');
        $this->db->where('username', $username);
        return $this->db->get('user')->row_array();
    }
}