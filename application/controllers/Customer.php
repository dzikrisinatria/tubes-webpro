<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $role_id = $this->session->userdata('role_id');
        $menu = $this->uri->segment(1);

        // if (!$this->session->userdata('username')){
        //     redirect('auth');
        // } else{
            if (($this->session->userdata('role_id') == 1) || ($this->session->userdata('role_id') == 2) ){
                redirect('auth/blocked');
            }
        // }
    }

    public function index()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Home';
        $data['user'] = $this->db->get_where('user',
        ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar_customer', $data);
        $this->load->view('customer/index', $data);
        $this->load->view('templates/footer', $data);
    }
}