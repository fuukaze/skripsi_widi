<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dasboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }


    public function index()
    {
        $data['tiket_wait'] = $this->M_tiket->tiket_wait();
        $data['tiket_proses'] = $this->M_tiket->tiket_proses();
        $data['tiket_close'] = $this->M_tiket->tiket_close();
        $data['user'] = $this->M_karyawan->jumlah_user();
        $this->template->load('back/template_view', 'back/dasboard_view', $data);
    }
}
