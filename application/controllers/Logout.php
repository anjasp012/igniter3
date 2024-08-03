<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();

        //cek session login
        if ($this->session->userdata("id") == "") {
            redirect('/login');
        }
    }
    public function index()
    {
        //hapus session
        $this->session->sess_destroy();

        redirect('/login');
    }
}
