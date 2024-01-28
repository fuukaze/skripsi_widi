<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }
    
    public function index()
    {
        $data['title'] = 'laporan';
        $data['laporan'] = $this->M_laporan->get_laporan();
        $data['no_tiket'] = $this->M_laporan->laporan_no_tiket();
        $this->template->load('back/template_view', 'back/laporan/laporan_view', $data);
    }


    public function view_pdf($pdf_id)
    {
        // Ambil informasi file PDF dari database berdasarkan $pdf_id
        $pdf_info = $this->db->get_where('tiket', array('no_tiket' => $pdf_id))->row();

        // Periksa apakah data PDF ditemukan
        if ($pdf_info && property_exists($pdf_info, 'file_tiket')) {
            // Mendapatkan nama file PDF dari data dalam database
            $file_name = $pdf_info->file_tiket;

            // Buat tautan URL ke file PDF di dalam folder assets/pdf_files
            $pdf_url = base_url('assets/doc/tiket/' . $file_name); // Sesuaikan dengan struktur folder dan nama file yang benar

            // Tampilkan embed tag untuk menampilkan file PDF dalam browser
            echo '<embed src="' . $pdf_url . '" type="application/pdf" width="100%" height="600px" />';
        } else {
            // Jika data PDF tidak ditemukan atau properti tidak ada, tampilkan pesan atau lakukan penanganan lainnya
            echo "File PDF tidak ditemukan.";
        }
    }

    function print_laporan()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $data['get_laporan'] = $this->M_laporan->get_periode_laporan($tgl_awal, $tgl_akhir)->result();

        $this->load->view('back/laporan/print_laporan', $data);
    }

    function edit_laporan($id)
    {
        $data['laporan'] = $this->M_laporan->get_no_tiket($id);
        if ($data['laporan']) {
            $this->template->load('back/template_view', 'back/laporan/edit_laporan', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Data Tidak Ada</div>');
            redirect('laporan', 'refresh');
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
            redirect('laporan', 'refresh');
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
                'tanggapan' => $this->input->post('tanggapan'),
            );
            $this->M_tiket->update($this->input->post('id_tiket'), $data);
            $this->session->set_flashdata('message', '<div class = "alert alert-info">Status Berhasil CLOSED</div>');
            redirect('laporan', 'refresh');
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

    function save_tanggapan()
    {
        $this->form_validation->set_rules('status_tiket', 'Status Tiket', 'trim|required');

        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data =  array(
                'status_tiket' => $this->input->post('status_tiket'),
                'tanggapan' => $this->input->post('tanggapan'),
            );
            $this->M_tiket->update($this->input->post('id_tiket'), $data);
            $this->session->set_flashdata('message', '<div class = "alert alert-info">Status Berhasil CLOSED</div>');
            redirect('laporan', 'refresh');
        }
    }
}
