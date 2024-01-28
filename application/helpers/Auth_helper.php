<?php
defined('BASEPATH') or exit('No direct script access allowed');

function cek_login()
{
    $CI = &get_instance();
    $email = $CI->session->email;

    if ($email == NULL) {
        $CI->session->set_flashdata('message', '<div class="alert alert-danger">Anda Harus Login</div>');

        redirect('auth/login');
    }
}

function admin()
{
    $CI = &get_instance();

    $tipeuser = $CI->session->level_user;

    if ($tipeuser == '2') {
        return $tipeuser;
    }
    return null;
}
