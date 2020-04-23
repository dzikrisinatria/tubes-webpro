<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_auth');
        $this->load->model('m_user');
        $role_id = $this->session->userdata('role_id');
        $menu = $this->uri->segment(1);
        
        if (!$this->session->userdata('username')){
            redirect('auth');
        } else{
            if (($this->session->userdata('role_id') == 2) || ($this->session->userdata('role_id') == 3) ){
                redirect('auth/blocked');
            }
        }
    }

    public function index()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Dashboard';

        $data['jml_apoteker'] = $this->m_user->getUserCountByRole(2);
        $data['jml_customer'] = $this->m_user->getUserCountByRole(3);

        $data['jml_obat'] = $this->m_auth->getObatCount();
        $data['jml_pemesanan'] = $this->m_auth->getPemesananCount();

        $sess_username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getUser($sess_username);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function user()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'User';
        $sess_username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getUser($sess_username);

        $data['getuser'] = $this->m_user->getAllUser();
        
        //cek keyword di dalam kolom pencarian
        if ( $this->input->post('keyword') ){
            //jika ada keyword masuk ke dalam data keyword
            $data['keyword'] = $this->input->post('keyword');
            //masukan data keyword ke dalam session agar dapat diakses di setiap page di pagination
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        $data['getrole'] = $this->m_user->getAllRole();
        $data['alluser'] = $this->m_user->getAllUserAndRole();

        // PAGINATION
        $config['base_url']     = 'http://localhost/tubes-webpro/admin/user';
        $config['total_rows']   = $this->m_user->totalRowsPagination($data['keyword']);
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
        
        $data['userpagination'] = $this->m_user->getUserPagination($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambahuser()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'User';
        $sess_username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getUser($sess_username);

        $data['getuser'] = $this->m_user->getAllUser();
        $data['getrole'] = $this->m_user->getAllRole();
        $data['alluser'] = $this->m_user->getAllUserAndRole();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email ini telah terdaftar!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'Username ini telah terdaftar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'matches' => "Password tidak sama",
            'min_length' => "Password minimal 4 karakter."
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('telepon', 'Nomor Telepon', 'required|trim|min_length[10]|numeric');
            
        if ( $this->form_validation->run() == FALSE ){
            // echo "gamasuk"; die;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('user/tambah', $data);
            $this->load->view('templates/footer', $data);

        } else {
            
            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['foto']['name'];

            if ($upload_image){
                
                $config['upload_path']          = './assets/img/profile/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')){ //jika berhasil upload
                    //upload gambar yg baru
                    $new_image = $this->upload->data('file_name');
                    $this->m_user->adddata($new_image);

                } else{
                    //menampilkan pesan error khusus upload
                    $this->session->set_flashdata('message', '<small class="text-danger">' . 
                    $this->upload->display_errors() . '</small>');
                    redirect('admin/tambahuser');
                }
            } else{
                $new_image = 'default.jpg';
                $this->m_user->adddata($new_image);
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akun user baru berhasil dibuat!</div>');
            redirect('admin/user');
        }
    }

    public function edituser($id)
    {   
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'User';
        $sess_username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getUser($sess_username);

        $data['getuser'] = $this->m_user->getUserById($id);
        $data['getrole'] = $this->m_user->getAllRole();
        $data['alluser'] = $this->m_user->getAllUserAndRole();

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('telepon', 'Nomor Telepon', 'required|trim|min_length[10]|numeric');
        
        if ( $this->form_validation->run() == FALSE ){
            // echo "gamasuk"; die;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer', $data);

        } else {
            
            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['foto']['name'];

            if ($upload_image){
                
                $config['upload_path']          = './assets/img/profile/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')){ //jika berhasil upload
                    
                    //mengecek gambar profil yg lama
                    $old_image = $data['getuser']['foto'];
                    // var_dump($old_image); die;
                    //cek apakah gambar default, apabila gambar default tidak akan dihapus
                    if ($old_image != 'default.jpg'){ 
                        //apabila gambar bukan default akan dihapus dengan unlink
                        unlink(FCPATH . 'assets/img/profile' . $old_image); 
                    }

                    //upload gambar yg baru
                    $new_image = $this->upload->data('file_name');
                    $data = $this->m_user->editdata($new_image);
                    $this->m_user->updateUser($data, $id);

                } else{
                    //menampilkan pesan error khusus upload
                    $this->session->set_flashdata('msgUpload', '<small class="text-danger">' . 
                    $this->upload->display_errors() . '</small>');
                    redirect('admin/user');
                }
            } else{
                $new_image = 'default.jpg';
                $data = $this->m_user->editdata($new_image);
                $this->m_user->updateUser($data, $id);
            }
            
            $this->session->set_flashdata('message', 
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data User berhasil diupdate!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('admin/user');
        }
    }

    public function hapususer($id)
    {
        $data['getuser'] = $this->m_user->getUserById($id);
        $this->m_user->hapusUser($id);
        //mengecek gambar profil yg lama
        $old_image = $data['getuser']['foto'];
        //cek apakah gambar default, apabila gambar default tidak akan dihapus
        if ($old_image != 'default.jpg'){ 
            //apabila gambar bukan default akan dihapus dengan unlink
            unlink(FCPATH . 'assets/img/profile' . $old_image); 
        }
        $this->session->set_flashdata('message', 
        '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data User berhasil dihapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('admin/user');
    }
}