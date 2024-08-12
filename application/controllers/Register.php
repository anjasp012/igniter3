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
        $this->load->model('M_system_user_access');

        // Cek apakah email sudah ada di database
        if ($this->is_email_exists($this->input->post('email'))) {
            $response['success'] = false;
            $response['message'] = 'Email sudah terdaftar, gunakan email lain.';
            echo json_encode($response);
            return;
        }

        $data = [
            'id' => $system_user_id = getId(),
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'passwd' => password_hash($this->input->post('passwd'), PASSWORD_DEFAULT),
        ];

        $register = $this->M_system_user->set(null, $data);

        if ($register) {
            $user_access = [
                'id' => getId(),
                'system_user_id' => $system_user_id,
                'actor_code' => 'AKSES',
                'expired_time' => null,
                'allow_access' => null,
            ];
            $this->M_system_user_access->set(null, $user_access);
            $response['success'] = true;
            $response['message'] = 'Anda akan di arahkan ke halaman login dalam 3 Detik.';
            echo json_encode($response);
            return;
        } else {
            $response['success'] = false;
            $response['message'] = 'registrasi gagal, silahkan coba lagi.';
            echo json_encode($response);
            return;
        }
    }

    private function is_email_exists($email)
    {
        $this->db->select('id');
        $this->db->from('system_user');
        $this->db->where('email', $email);
        $query = $this->db->get();

        // Jika ada hasil, email sudah ada
        return $query->num_rows() > 0;
    }
}
