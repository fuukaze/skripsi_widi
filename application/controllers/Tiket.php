<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tiket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }


    public function index()
    {
        $data['tiket'] = $this->M_tiket->get_tiket();
        $data['no_tiket'] = $this->M_tiket->no_tiket();
        $this->template->load('back/template_view', 'back/tiket/tiket_view', $data);
    }


    function save_tiket()
    {
        $this->form_validation->set_rules('judul_tiket', 'Judul Proposal', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Penjelasan Singkat', 'trim|required');

        $this->form_validation->set_message('required', '{field} Harus Di Isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run('save_tiket') == FALSE) {
            $this->index();
        } else {
            if ($_FILES['file_tiket']['error'] <> 4) {

                $config['upload_path'] = './assets/doc/tiket/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '2048';
                $nama_file = $this->input->post('no_tiket') . date('YmdHis');
                $config['file_name'] = $nama_file;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file_tiket')) {
                    $error = array('error' => $this->upload->display_erors());
                    $this->session->set_flashdata('message', '<div class = "alert alert-danger">' . $error['error'] . '</div>');
                    $this->index();
                } else {
                    $file_tiket = $this->upload->data();

                    $data = array(
                        'no_tiket' => $this->input->post('no_tiket'),
                        'judul_tiket' => $this->input->post('judul_tiket'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'status_tiket' => 0,
                        'user_id' => $this->session->userdata('id_user'),
                        'file_tiket' => $this->upload->data('file_name'),
                        'tgl_daftar' => date('y-m-d'),
                    );
                    $this->M_tiket->insert($data);
                    $this->session->set_flashdata('message', '<div class = "alert alert-info">Data Berhasil di SIMPAN</div>');
                    redirect('tiket', 'refresh');
                }
            } else {
                $data = array(
                    'no_tiket' => $this->input->post('no_tiket'),
                    'judul_tiket' => $this->input->post('judul_tiket'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'status_tiket' => 0,
                    'user_id' => $this->session->userdata('id_user'),
                    // 'file_tiket' => $this->upload->data('file_name'),
                    'tgl_daftar' => date('y-m-d'),
                );
                $this->M_tiket->insert($data);
                $this->session->set_flashdata('message', '<div class = "alert alert-info">Data Berhasil di SIMPAN</div>');
                redirect('tiket', 'refresh');
            }
        }
    }

    function save_tiket_waiting()
    {
        $this->form_validation->set_rules('status_tiket', 'Status Tiket', 'trim|required');

        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data =  array(
                'status_tiket' => $this->input->post('status_tiket'),
            );
            $this->M_tiket->update($this->input->post('id_tiket'), $data);
            $this->session->set_flashdata('message', '<div class = "alert alert-info">Status Berhasil di UPDATE</div>');
            redirect('tiket', 'refresh');
        }
    }

    function save_close_tiket()
    {
        $this->form_validation->set_rules('status_tiket', 'Status Tiket', 'trim|required');

        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data =  array(
                'status_tiket' => $this->input->post('status_tiket'),
            );
            $this->M_tiket->update($this->input->post('id_tiket'), $data);
            $this->session->set_flashdata('message', '<div class = "alert alert-info">Status Berhasil CLOSED</div>');
            redirect('tiket', 'refresh');
        }
    }

    function detail_tiket($no_tiket)
    {
        $data['tiket'] = $this->M_tiket->get_no_tiket($no_tiket);
        if ($data['tiket']) {
            $data['title'] = 'Detail Tiket' . $data['tiket']->no_tiket;
            $this->template->load('back/template_view', 'back/tiket/detail_tiket', $data);
        }
    }

    function pdf($path)
    {
        $data['tiket'] = $this->M_tiket->get_no_tiket($no_tiket);
        if ($data['tiket']) {
            $data['title'] = 'Detail Tiket' . $data['tiket']->no_tiket;
            $this->template->load('back/template_view', 'back/tiket/detail_tiket', $data);
        }
    }

    function delete_tiket($id)
    {
        $delete = $this->M_tiket->get_id_tiket($id);
        if ($delete) {
            $this->M_tiket->delete($id);
            $this->session->set_flashdata('message', '<div class = "alert alert-info">Data berhasil dihapus</div>');
            redirect('tiket', 'refresh');
        } else {
            $this->session->set_flashdata('message', '<div class = "alert alert-danger">Data tidak ada</div>');
            redirect('tiket', 'refresh');
        }
    }

    function save_tanggapan()
    {
        $this->form_validation->set_rules('tanggapan', 'Tanggapan', 'trim|required');

        $this->form_validation->set_message('required', '{field} Harus Di Isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            if ($_FILES['file_tanggapan']['error'] <> 4) {

                $config['upload_path'] = './assets/doc/tanggapan/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '2048';
                $nama_file = $this->input->post('tiket_id') . date('YmdHis');
                $config['file_name'] = $nama_file;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file_tanggapan')) {
                    $error = array('error' => $this->upload->display_erors());
                    $this->session->set_flashdata('message', '<div class = "alert alert-danger">' . $error['error'] . '</div>');
                    $this->index();
                } else {
                    if ($this->input->post('id_tiket')) {
                        $data = array(
                            'status_tiket' => 2,
                        );
                        $this->M_tiket->update($this->input->post('id_tiket'), $data);
                    }
                    $tiket_file = $this->upload->data();

                    $data = array(
                        'tiket_id' => $this->input->post('tiket_id'),
                        'tanggapan' => $this->input->post('tanggapan'),
                        'file_tanggapan' => $this->upload->data('file_name'),
                        'waktu' => date('y-m-d'),
                    );
                    $this->M_tiket->insert_tanggapan($data);
                    $this->session->set_flashdata('message', '<div class = "alert alert-info">Data Berhasil di SIMPAN</div>');
                    redirect('tiket', 'refresh');
                }
            } else {
                if ($this->input->post('id_tiket')) {
                    $data = array(
                        'status_tiket' => 2,
                    );
                    $this->M_tiket->update($this->input->post('id_tiket'), $data);
                }

                $data = array(
                    'tiket_id' => $this->input->post('tiket_id'),
                    'tanggapan' => $this->input->post('tanggapan'),
                    'waktu' => date('y-m-d'),
                );
                $this->M_tiket->insert_tanggapan($data);
                $this->session->set_flashdata('message', '<div class = "alert alert-info">Data Berhasil di SIMPAN</div>');
                redirect('tiket', 'refresh');
            }
        }
    }
}
