<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_auth');
    }
    
	public function index()
	{
        if ($this->session->userdata('username')){
            if ($this->session->userdata('role_id') == 1){
                redirect('admin');
            } else if ($this->session->userdata('role_id') == 2){
                redirect('apoteker');
            } else{
                redirect('customer');
            }
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ( $this->form_validation->run() == FALSE ){
            $data['appname'] = 'Obat Online App';
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('templates/navbar_customer', $data);
            $this->load->view('auth/login', $data);
        } else {
            $this->_login();
        }
    }
    
    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->m_auth->getUser($username);
        
        // jika usernya ada
        if ( $user ){
            if ( $user['role_id'] == 0 ){
                $this->session->set_flashdata('message', '<div class="alert alert-danger " role="alert">
                Akun Anda sudah tidak aktif!</div>');
                redirect('auth');
            }
            // cek password
            if ( password_verify($password, $user['password']) ){
                $data = [
                    'username' => $user['username'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                
                //cek role id
                if ( $user['role_id'] == 1 ){
                    redirect('admin');
                } else if ( $user['role_id'] == 2 ){
                    redirect('apoteker');
                } else if ( $user['role_id'] == 3 ){
                    redirect('customer');
                }

            } else{

                $this->session->set_flashdata('message', '<div class="alert alert-danger " role="alert">
                Password Salah!</div>');
                redirect('auth');

            }
        } else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger " role="alert">
            Username belum terdaftar.</div>');
            redirect('auth');
        }
    }

    public function register()
    {
        if ($this->session->userdata('username')){
            if ($this->session->userdata('role_id') == 1){
                redirect('admin');
            } else if ($this->session->userdata('role_id') == 2){
                redirect('apoteker');
            } else{
                redirect('customer');
            }
        }
        
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
            $data['appname'] = 'Obat Online App';
            $data['title'] = 'Daftar';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('templates/navbar_customer', $data);
            $this->load->view('auth/register');

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
                    $this->m_auth->regdata($new_image);

                } else{
                    //menampilkan pesan error khusus upload
                    $this->session->set_flashdata('message', '<small class="text-danger">' . 
                    $this->upload->display_errors() . '</small>');
                    redirect('auth/register');
                }
            } else{
                $this->m_auth->regdata2();
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akun Anda berhasil dibuat! Silahkan Login.</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('keyword');
        // $this->session->sess_destroy();
        // $this->session->set_flashdata('message', '<div class="alert alert-success " role="alert">
        // Anda telah berhasil logout!</div>');
        redirect('customer');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function profile()
    {
        $data['appname'] = 'Obat Online App';
        $data['title'] = 'Profil Saya';

        $username = $this->session->userdata('username');
        $data['user'] = $this->m_auth->getProfile($username);

        $this->load->view('templates/header', $data);
        if ($data['user']['role_id'] == 1){
            $this->load->view('templates/sidebar_admin', $data);
        } else if ($data['user']['role_id'] == 2){
            $this->load->view('templates/sidebar_apoteker', $data);
        }
        $this->load->view('auth/profile', $data);
        $this->load->view('templates/footer', $data);
    }
}
