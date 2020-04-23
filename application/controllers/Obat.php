<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_auth');
        $this->load->model('m_obat');
        $role_id = $this->session->userdata('role_id');
        $menu = $this->uri->segment(1);
        
        if (!$this->session->userdata('username')){
            redirect('auth');
        } else{
            if (($this->session->userdata('role_id') == 3)){
                redirect('auth/blocked');
            }
        }
    }

    public function index()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Kelola Obat';

        $data['jml_obat'] = $this->m_auth->getObatCount();
        $data['jml_pemesanan'] = $this->m_auth->getObatCount();

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
        $config['base_url']     = 'http://localhost/tubes-webpro/obat/index';
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
        $this->load->view('obat/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambahobat()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Kelola Obat';
        $sess_username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getUser($sess_username);

        $data['getobat'] = $this->m_obat->getAllObat();
        $data['getjenis'] = $this->m_obat->getAllJenis();
        $data['allobat'] = $this->m_obat->getAllObatAndJenis();

        $this->form_validation->set_rules('kode_obat', 'Kode Obat', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required|trim|is_unique[obat.nama_obat]', [
            'is_unique' => 'Obat ini telah terdaftar!'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|trim|numeric');
        $this->form_validation->set_rules('fungsi', 'Fungsi', 'trim|min_length[5]');
        $this->form_validation->set_rules('aturan', 'Aturan', 'trim|min_length[5]');
            
        if ( $this->form_validation->run() == FALSE ){
            // echo "gamasuk"; die;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('obat/tambah', $data);
            $this->load->view('templates/footer', $data);

        } else {
            
            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['gambar']['name'];

            if ($upload_image){
                
                $config['upload_path']          = './assets/img/obat/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')){ //jika berhasil upload
                    //upload gambar yg baru
                    $new_image = $this->upload->data('file_name');
                    $this->m_obat->adddataobat($new_image);

                } else{
                    //menampilkan pesan error khusus upload
                    $this->session->set_flashdata('message', '<small class="text-danger">' . 
                    $this->upload->display_errors() . '</small>');
                    redirect('obat/tambahobat');
                }
            } else{
                $new_image = 'default.png';
                $this->m_obat->adddataobat($new_image);
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Obat baru berhasil ditambah!</div>');
            redirect('obat/index');
        }
    }

    public function editobat($id)
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Kelola Obat';
        $sess_username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getUser($sess_username);

        $data['getobat'] = $this->m_obat->getObatById($id);
        // var_dump($data['getobat']); die;
        $data['getjenis'] = $this->m_obat->getAllJenis();
        $data['allobat'] = $this->m_obat->getAllObatAndJenis();

        $this->form_validation->set_rules('kode_obat', 'Kode Obat', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|trim|numeric');
        $this->form_validation->set_rules('fungsi', 'Fungsi', 'trim|min_length[5]');
        $this->form_validation->set_rules('aturan', 'Aturan', 'trim|min_length[5]');
            
        if ( $this->form_validation->run() == FALSE ){
            // echo "gamasuk"; die;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('obat/edit', $data);
            $this->load->view('templates/footer', $data);

        } else {
            
            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['gambar']['name'];

            if ($upload_image){
                
                $config['upload_path']          = './assets/img/obat/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')){ //jika berhasil upload
                    //mengecek gambar obat yg lama
                    $old_image = $data['getobat']['gambar'];
                    // var_dump($old_image); die;
                    //cek apakah gambar default, apabila gambar default tidak akan dihapus
                    if ($old_image != 'default.png'){ 
                        //apabila gambar bukan default akan dihapus dengan unlink
                        unlink(FCPATH . 'assets/img/obat' . $old_image); 
                    }

                    //upload gambar yg baru
                    $new_image = $this->upload->data('file_name');
                    $data = $this->m_obat->editdataobat($new_image);
                    $this->m_obat->updateObat($data, $id);

                } else{
                    //menampilkan pesan error khusus upload
                    $this->session->set_flashdata('message', '<small class="text-danger">' . 
                    $this->upload->display_errors() . '</small>');
                    redirect('obat/editobat');
                }
            } else{
                $new_image = 'default.png';
                $data = $this->m_obat->editdataobat($new_image);
                $this->m_obat->updateObat($data, $id);
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data obat berhasil diubah!</div>');
            redirect('obat/index');
        }
    }

    public function hapusobat($id)
    {
        $data['getobat'] = $this->m_obat->getObatById($id);
        $this->m_obat->hapusObat($id);
        //mengecek gambar profil yg lama
        $old_image = $data['getobat']['gambar'];
        //cek apakah gambar default, apabila gambar default tidak akan dihapus
        if ($old_image != 'default.png'){ 
            //apabila gambar bukan default akan dihapus dengan unlink
            unlink(FCPATH . 'assets/img/obat' . $old_image); 
        }
        $this->session->set_flashdata('message', 
        '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Obat berhasil dihapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('obat/index');
    }

    public function jenisobat()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Kelola Obat';

        $data['jml_obat'] = $this->m_auth->getObatCount();

        $sess_username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getUser($sess_username);
        
        //cek keyword di dalam kolom pencarian
        if ( $this->input->post('keyword') ){
            //jika ada keyword masuk ke dalam data keyword
            $data['keyword'] = $this->input->post('keyword');
            //masukan data keyword ke dalam session agar dapat diakses di setiap page di pagination
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        $data['alljenis'] = $this->m_obat->getAllJenis();
        $data['allobat'] = $this->m_obat->getAllObatAndJenis();

        // PAGINATION
        $config['base_url']     = 'http://localhost/tubes-webpro/obat/jenisobat';
        $config['total_rows']   = $this->m_obat->totalRowsJenisPagination($data['keyword']);
        $config['per_page']     = 5;
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
        
        $data['jenisobatpagination'] = $this->m_obat->getJenisObatPagination($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/header', $data);
        if (($this->session->userdata('role_id') == 1)){
            $this->load->view('templates/sidebar_admin', $data);
        } elseif (($this->session->userdata('role_id') == 2)) {
            $this->load->view('templates/sidebar_apoteker', $data);
        }
        $this->load->view('obat/index_jenis', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambahjenisobat()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Kelola Obat';
        $sess_username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getUser($sess_username);

        $data['getobat'] = $this->m_obat->getAllObat();
        $data['getjenis'] = $this->m_obat->getAllJenis();
        $data['allobat'] = $this->m_obat->getAllObatAndJenis();

        $this->form_validation->set_rules('id_jenis_obat', 'ID Jenis Obat', 'required|trim');
        $this->form_validation->set_rules('nama_jenis', 'Nama Jenis Obat', 'required|trim');
            
        if ( $this->form_validation->run() == FALSE ){
            // echo "gamasuk"; die;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('obat/tambah_jenis', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $this->m_obat->adddatajenisobat();

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Jenis obat baru berhasil ditambah!</div>');
            redirect('obat/jenisobat');
        }
    }

    public function editjenisobat($id)
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Kelola Obat';
        $sess_username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getUser($sess_username);

        $data['getjenis'] = $this->m_obat->getJenisById($id);
        // var_dump($data['getobat']); die;
        $data['alljenis'] = $this->m_obat->getAllJenis();
        $data['allobat'] = $this->m_obat->getAllObatAndJenis();

        $this->form_validation->set_rules('id_jenis_obat', 'ID Jenis Obat', 'required|trim');
        $this->form_validation->set_rules('nama_jenis', 'Nama Jenis Obat', 'required|trim');
            
        if ( $this->form_validation->run() == FALSE ){
            // echo "gamasuk"; die;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('obat/edit_jenis', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $data = $this->m_obat->editdatajenisobat();
            $this->m_obat->updateJenisObat($data, $id);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data jenis obat berhasil diubah!</div>');
            redirect('obat/jenisobat');
        }
    }

    public function hapusjenisobat($id)
    {
        $data['getjenis'] = $this->m_obat->getJenisById($id);
        $this->m_obat->hapusJenisObat($id);
        $this->session->set_flashdata('message', 
        '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Jenis Obat berhasil dihapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('obat/jenisobat');
    }
}