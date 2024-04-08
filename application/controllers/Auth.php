<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{   
        if ($this->session->userdata('username') == null) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
    
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('auth/login');
            } else {
                //validasi sukses
    
                $this->_login();
            }
        } else {
            redirect('lokasi');
        }
       
	}

    private function _login()
	{
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users',array('username' => $username))->row();
        // var_dump($user->password);
        // die;
        if ($user) {
            //user ada
            if (password_verify($password, $user->password)) {
                # code...
                $data = [
                    'username' => $user->username,
                    'role_id' => $user->role_id,
                    'id_user' => $user->id,
                    'name'  => $user->name
                ];
                $this->session->set_userdata($data);
                
                redirect('lokasi');
                

            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Password Salah</div>');
                redirect('auth');
            }
            

        }else {
            //tidak ada user
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Username Salah</div>');
            redirect('auth');
            
            
        }
        
	}

    public function logout() {
        
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Logout Success</div>');
                redirect('auth');
        
        
    }
}