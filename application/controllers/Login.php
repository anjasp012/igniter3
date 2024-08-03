<?php

use Google\Client;

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
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
        //load view form login
        $data['google_auth'] = googleAuth()->createAuthUrl();
        $this->load->view('auth/login', $data);
    }

    public function check_auth()
    {
        //load model M_system_user
        $this->load->model('M_system_user');

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        //cek login via model
        $cek = $this->M_system_user->check_auth($email, $password);

        if (!empty($cek)) {

            foreach ($cek as $user) {

                //looping data user
                $session_data = array(
                    'id'   => $user->id,
                    'email'  => $user->email,
                    'full_name' => $user->full_name,
                );
                //buat session berdasarkan user yang login
                $this->session->set_userdata($session_data);
            }
            echo "success";
        } else {
            echo "error";
        }
    }

    public function google()
    {
        $this->load->model('M_system_user');

        $client = googleAuth();
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        // get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $google_id_user = $google_account_info->id;
        $nama = $google_account_info->name;
        $email = $google_account_info->email;

        $cek = $this->M_system_user->check_auth_google($google_id_user);
        if (!empty($cek)) {
            foreach ($cek as $user) {

                //looping data user
                $session_data = array(
                    'id_user'   => $user->id_user,
                    'email'  => $user->email,
                    'nama' => $user->nama,
                );
                //buat session berdasarkan user yang login
                $this->session->set_userdata($session_data);
            }
            redirect('/dashboard');
        } else {
            $data = [
                'google_id_user' => $google_id_user,
                'nama' => $nama,
                'email' => $email,
            ];

            $register = $this->M_system_user->register($data);

            if ($register) {
                $cek = $this->M_system_user->check_auth_google($google_id_user);
                foreach ($cek as $user) {

                    //looping data user
                    $session_data = array(
                        'id_user'   => $user->id_user,
                        'email'  => $user->email,
                        'nama' => $user->nama,
                    );
                    //buat session berdasarkan user yang login
                    $this->session->set_userdata($session_data);
                }
                redirect('/dashboard');
            } else {
                echo 'error';
            }
        }
    }
}
