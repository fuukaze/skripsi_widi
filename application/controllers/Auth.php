<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{


    public function index()
    {
    }

    function login()
    {
        $this->load->view('back/login');
    }

    function register()
    {
        $this->load->view('back/register');
    }

    function proses_register()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|is_unique[user.email]|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|matches[password]|required');


        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_message('valid_email', '{field} anda harus valid');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'status_user' => 1,
                'level_user' => 1,
            );
            // var_dump($data);

            $this->M_auth->insert($data);

            $this->session->set_flashdata('message', '<div class="alert alert-info">Data Berhasil di simpan</div>');

            redirect('auth/login', 'refresh');
        } else {
            $this->load->view('back/register');
        }
    }

    function proses_login()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $user = $this->M_auth->get_email_user($this->input->post('email'));
            if (!$user) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Email Tidak Ditemukan</div>');
                redirect('auth/login', 'refresh');
            } elseif ($user->status_user == '0') {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">User Tidak Aktif Silahkan Hubungi Admin</div>');
                redirect('auth/login', 'refresh');
            } elseif (!password_verify($this->input->post('password'), $user->password)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Password Salah Silahkan Ketik Ulang</div>');
                redirect('auth/login', 'refresh');
            } else {
                $session = array(
                    'id_user'       => $user->id_user,
                    'username'      => $user->username,
                    'email'         => $user->email,
                    'level_user'    => $user->level_user,
                );
                $this->session->set_userdata($session);
                redirect('dasboard');
            }
        } else {
            $data['title'] = 'Login Pages';
            $this->load->view('back/register', $data);
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-info">Berhasil logout</div>');

        redirect('auth/login');
    }
}
