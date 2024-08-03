<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();

        //cek session login
        if ($this->session->userdata("id_user") != "") {
            redirect('/dashboard');
        }
    }

    public function index()
    {
        //load view form login
        $this->load->view('pages/home');
    }
}
