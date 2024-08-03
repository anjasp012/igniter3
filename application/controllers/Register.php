<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();

        //cek session login
        if ($this->session->userdata("id") != "") {
            redirect('/dashboard');
        }
    }

    public function index()
    {
        $this->load->view('auth/register');
    }

    public function store()
    {
        $this->load->model('M_system_user');

        $data = [
            'id' => getId(),
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'passwd' => password_hash($this->input->post('passwd'), PASSWORD_DEFAULT),
        ];

        $register = $this->db->insert('system_user', $data);

        if ($register) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
}
