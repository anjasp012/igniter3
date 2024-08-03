<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboard extends CI_Controller
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
        //load view form login
        $this->load->view('pages/dashboard');
    }
}
