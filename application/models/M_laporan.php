<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{

    function get_periode_laporan($tgl_awal, $tgl_akhir)
    {
        $this->db->select('*');
        $this->db->select('detail_tiket');
        $this->db->select('tiket', 'detail_tiket.tiket_id = tiket.id_tiket', 'left');
        $this->db->select('waktu_tanggapan >=', $tgl_awal);
        $this->db->select('waktu_tanggapan >=', $tgl_akhir);

        return $this->db->get();
    }

    function get_laporan()
    {
        return $this->db->get('tiket')->result();
    }

    function get_no_tiket($no_tiket)
    {
        $this->db->join('user', 'tiket.user_id = user.id_user', 'left');
        $this->db->join('divisi', 'user.divisi_id = divisi.id_divisi', 'left');
        $this->db->join('jabatan', 'user.jabatan_id = jabatan.id_jabatan', 'left');
        $this->db->where('no_tiket', $no_tiket);

        return $this->db->get('tiket')->row();
    }

    function laporan_no_tiket()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(no_tiket,4)) AS no_tiket FROM tiket WHERE DATE(tgl_daftar)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->no_tiket) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "1234";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('dmy') . $kd;
    }
}
