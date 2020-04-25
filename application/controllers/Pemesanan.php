<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_auth');
        $this->load->model('m_obat');
        $this->load->model('m_pemesanan');
        $role_id = $this->session->userdata('role_id');
        $menu = $this->uri->segment(1);
        
        // if (!$this->session->userdata('username')){
        //     redirect('auth');
        // }
    }

    public function keranjang()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Keranjang';
        $data['user'] = $this->db->get_where('user',
        ['username' => $this->session->userdata('username')])->row_array();

        $data['allobat'] = $this->m_obat->getAllObatAndJenis();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar_customer', $data);
        $this->load->view('pemesanan/keranjang', $data);
        $this->load->view('templates/footer', $data);
    }

    public function hapuskeranjang()
    {
        $this->cart->destroy();
        redirect('customer/obat');
    }

    public function pembayaran()
    {
        if (!$this->session->userdata('username')){
            $this->session->set_flashdata('message', 
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Anda harus login terlebih dahulu.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('auth');
        }

        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Pembayaran';
        $data['user'] = $this->db->get_where('user',
        ['username' => $this->session->userdata('username')])->row_array();

        $data['allobat'] = $this->m_obat->getAllObatAndJenis();

        if ($this->cart->contents()){
            if ( $this->m_pemesanan->proses($data['user']['id_user']) ){
                $this->cart->destroy();
                $this->session->set_flashdata('message', 
                '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Pesanan akan diproses, silahkan pilih metode pembayaran.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('pemesanan/pembayaran');
            } else{
                $this->session->set_flashdata('message', 
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal memproses pemesanan, silahkan ulangi kembali.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('pemesanan/keranjang');
            }
        } 

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar_customer', $data);
        $this->load->view('pemesanan/pembayaran', $data);
        $this->load->view('templates/footer', $data);
    }

    public function index()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Pemesanan';

        $data['jml_obat'] = $this->m_auth->getObatCount();
        $data['jml_pemesanan'] = $this->m_auth->getPemesananCount();

        $sess_username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getUser($sess_username);

        $data['getobat'] = $this->m_obat->getAllObat();
        
        //cek keyword di dalam kolom pencarian
        if ( $this->input->post('keyword') ){
            //jika ada keyword masuk ke dalam data keyword
            $data['keyword'] = $this->input->post('keyword');
            //masukan data keyword ke dalam session agar dapat diakses di setiap page di pagination
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        $data['getjenis'] = $this->m_obat->getAllJenis();
        $data['allobat'] = $this->m_obat->getAllObatAndJenis();

        // PAGINATION
        $config['base_url']     = 'http://localhost:8080/tubes-webpro/obat/index';
        $config['total_rows']   = $this->m_obat->totalRowsPagination($data['keyword']);
        $config['per_page']     = 6;
        $data['start']          = $this->uri->segment(3);

        //STYLING PAGINATION
        $config['full_tag_open']    = '<nav><ul class="pagination pagination-sm justify-content-center">';
        $config['full_tag_close']   = '</ul></nav>';
        
        $config['first_link']       = 'First';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close']  = '</li>';
        
        $config['last_link']        = 'Last';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']   = '</li>';
        
        $config['next_link']        = '&raquo';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        
        $config['prev_link']        = '&laquo';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        
        $config['cur_tag_open']     = '<li class="page-item"><a class="page-link bg-secondary text-light" href="#">';
        $config['cur_tag_close']    = '</a></li>';
        
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';

        $config['attributes']       = array('class' => 'page-link text-dark');
        
        $this->pagination->initialize($config);
        
        $data['obatpagination'] = $this->m_obat->getObatPagination($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/header', $data);
        if (($this->session->userdata('role_id') == 1)){
            $this->load->view('templates/sidebar_admin', $data);
        } elseif (($this->session->userdata('role_id') == 2)) {
            $this->load->view('templates/sidebar_apoteker', $data);
        }
        $this->load->view('pemesanan/index', $data);
        $this->load->view('templates/footer', $data);
    }

}