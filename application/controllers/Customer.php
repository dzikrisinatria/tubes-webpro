
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_obat');
        $this->load->model('m_user');
        $this->load->model('m_pemesanan');
        $this->load->model('m_auth');
        $role_id = $this->session->userdata('role_id');
        $menu = $this->uri->segment(1);

        // if (!$this->session->userdata('username')){
        //     redirect('auth');
        // } else{
            // if (($this->session->userdata('role_id') == 1) || ($this->session->userdata('role_id') == 2) ){
            //     redirect('auth/blocked');
            // }
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
        $this->load->view('templates/slider', $data);
        $this->load->view('customer/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function profile()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Profil Saya';

        $username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getProfile($username);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar_customer', $data);
        $this->load->view('customer/profile', $data);
        $this->load->view('templates/footer', $data);
    }

    public function kontak()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Kontak';

        $username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getProfile($username);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar_customer', $data);
        $this->load->view('templates/slider', $data);
        $this->load->view('customer/kontak', $data);
        $this->load->view('templates/footer', $data);
    }

    public function obat()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Obat';
        $data['user'] = $this->db->get_where('user',
        ['username' => $this->session->userdata('username')])->row_array();

        //cek keyword di dalam kolom pencarian
        if ( $this->input->post('keyword') ){
            //jika ada keyword masuk ke dalam data keyword
            $data['keyword'] = $this->input->post('keyword');
            //masukan data keyword ke dalam session agar dapat diakses di setiap page di pagination
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        $data['allobat'] = $this->m_obat->getAllObatAndJenis();

        // PAGINATION
        $config['base_url']     = 'http://localhost:8080/tubes-webpro/customer/obat';
        $config['total_rows']   = $this->m_obat->totalRowsPagination($data['keyword']);
        $config['per_page']     = 4;
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
        $this->load->view('templates/navbar_customer', $data);
        $this->load->view('templates/slider', $data);
        $this->load->view('customer/obat', $data);
        $this->load->view('templates/footer', $data);
    }

    public function addtocart($id_obat)
    {
        $obat = $this->m_obat->getObatById($id_obat);

        $data = array(
            'id'      => $obat['id_obat'],
            'qty'     => 1,
            'price'   => $obat['harga'],
            'name'    => $obat['nama_obat']
        );
        
        $this->cart->insert($data);
        redirect('customer/obat');
    }
    public function riwayatPemesanan()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Riwayat Pemesanan';

        $data['jml_obat'] = $this->m_auth->getObatCount();
        $data['jml_pemesanan'] = $this->m_auth->getPemesananCount();

        $sess_username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getUser($sess_username);
        $id_user = $data['user']['id_user'];
        
        $data['getobat'] = $this->m_obat->getAllObat();
        
        $data['allPemesanan'] = $this->m_pemesanan->getAllPemesanan();

        $rows = count($data['allPemesanan']);
        for ($x = 0; $x < $rows; $x++)
        {
            $id_pemesanan = $data['allPemesanan'][$x]['id_pemesanan'];
            $data['allPemesanan'][$x]['itemPemesanan'] = $this->m_pemesanan->getDetailPemesanan($id_pemesanan);
            
        }
        //cek keyword di dalam kolom pencarian
        if ( $this->input->post('keyword') ){
            //jika ada keyword masuk ke dalam data keyword
            $data['keyword'] = $this->input->post('keyword');
            //masukan data keyword ke dalam session agar dapat diakses di setiap page di pagination
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }
        // PAGINATION
        $config['base_url']     = 'http://localhost:8080/tubes-webpro/customer/riwayatPemesanan';
        $config['total_rows']   = $this->m_pemesanan->totalRowsPaginationByUser($data['keyword'],$id_user);
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
        
        $data['pemesananPagination'] = $this->m_pemesanan->getPemesananPaginationByUser($config['per_page'], $data['start'], $data['keyword'], $id_user);
       
        $rows = count($data['pemesananPagination']);
        for ($x = 0; $x < $rows; $x++)
        {
            $id_pemesanan = $data['pemesananPagination'][$x]['id_pemesanan'];
            $data['pemesananPagination'][$x]['itemPemesanan'] = $this->m_pemesanan->getDetailPemesanan($id_pemesanan);
            
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar_customer', $data);
        $this->load->view('customer/riwayatPemesanan', $data);
        $this->load->view('templates/footer', $data);
    }
}