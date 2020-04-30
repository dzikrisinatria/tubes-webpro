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
            if($this->input->post('metode')){
                if ( $this->m_pemesanan->proses($data['user']['id_user']) ){
                    $this->cart->destroy();
                    $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Pesanan Anda sedang diproses, silahkan kembali lagi nanti.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('customer/obat');
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
            else {
                // $this->session->set_flashdata('message', 
                // '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                //    Silakan Isi Nominal Uang yang akan dibayarkan
                //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                //         <span aria-hidden="true">&times;</span>
                //     </button>
                // </div>');
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
        $data['title'] = 'Pemesanan Obat';

        $data['jml_obat'] = $this->m_auth->getObatCount();
        $data['jml_pemesanan'] = $this->m_auth->getPemesananCount();

        $sess_username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getUser($sess_username);

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
        $config['base_url']     = 'http://localhost:8080/tubes-webpro/pemesanan/index';
        $config['total_rows']   = $this->m_pemesanan->totalRowsPagination($data['keyword']);
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
        
        $data['pemesananPagination'] = $this->m_pemesanan->getPemesananPagination($config['per_page'], $data['start'], $data['keyword'], ($this->session->userdata('role_id')));
       

        $this->load->view('templates/header', $data);
        if (($this->session->userdata('role_id') == 1)){
            $this->load->view('templates/sidebar_admin', $data);
        } elseif (($this->session->userdata('role_id') == 2)) {
            $this->load->view('templates/sidebar_apoteker', $data);
        }
        $this->load->view('pemesanan/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function hapusPemesanan($id){
        $this->m_pemesanan->hapusDetailPemesanan($id);
        $this->m_pemesanan->hapusPemesanan($id);
        $this->session->set_flashdata('message', 
        '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Pemesanan berhasil dihapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('pemesanan/index');
    }

    public function konfirmasiPemesanan($id)
    {
        // var_dump($id);die;
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Pemesanan Obat';
        $sess_username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getUser($sess_username);

        $data['Pemesanan'] = $this->m_pemesanan->getPemesananById($id);
        $data['Pemesanan']['itemPemesanan'] = $this->m_pemesanan->getDetailPemesanan($id);

        if ($this->input->post('nominal')){
            foreach ($data['Pemesanan']['itemPemesanan'] as $o){
                if($o['stok'] < $o['jumlah']){
                    $this->session->set_flashdata('message', 
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Stok tidak cukup.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('pemesanan/konfirmasiPemesanan/'.$data['Pemesanan']['id_pemesanan']);
                }
            }
            foreach ($data['Pemesanan']['itemPemesanan'] as $o){
                $newStok = $o['stok'] - $o['jumlah'];
                $this->m_obat->updateStokObat($o['id_obat'], $newStok);
            }

            $nominal = $this->input->post('nominal');
            if ($this->input->post('nominal') >= $data['Pemesanan']['total']){
                $this->m_pemesanan->updateKonfirmasiPemesanan($id, $nominal);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Pemesanan berhasil dikonfirmasi!</div>');
                redirect('pemesanan/index');
            } else {
                $this->session->set_flashdata('message', 
                '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Harap mengisi jumlah nominal yang dibayarkan dengan benar.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('pemesanan/konfirmasiPemesanan/'.$data['Pemesanan']['id_pemesanan']);
            }    
        }
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_apoteker', $data);
        $this->load->view('pemesanan/konfirmasiPemesanan', $data);
        $this->load->view('templates/footer', $data);
    }
}