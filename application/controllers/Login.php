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

    private function is_ip_allowed($client_ip, $allowed_ranges)
    {
        $ranges = preg_split('/[,;]\s*/', $allowed_ranges);

        foreach ($ranges as $allowed_range) {
            // Jika pola adalah wildcard global
            if ($allowed_range === '*') {
                return true;
            }

            // Menghapus wildcard * dari pola dan IP untuk perbandingan
            $allowed_parts = explode('.', $allowed_range);
            $client_parts = explode('.', $client_ip);

            // Filter out the parts with '*' from allowed_range
            $filtered_allowed_parts = array_filter($allowed_parts, function ($part) {
                return $part !== '*';
            });

            // Filter the client IP to match the length of filtered_allowed_parts
            $filtered_client_parts = array_slice($client_parts, 0, count($filtered_allowed_parts));

            // Memeriksa jika panjang filtered_client_parts cocok dengan filtered_allowed_parts
            if (count($filtered_client_parts) === count($filtered_allowed_parts)) {
                $match = true;
                foreach ($filtered_allowed_parts as $index => $allowed_part) {
                    if ($filtered_client_parts[$index] !== $allowed_part) {
                        $match = false;
                        break;
                    }
                }
                if ($match) {
                    return true;
                }
            }
        }
        return false;
    }

    public function check_auth()
    {
        $this->load->model('M_system_user');

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        //cek login via model
        $cek = $this->M_system_user->check_auth($username, $password);

        if (!empty($cek)) {

            foreach ($cek as $user) {
                if (isset($user->ip_address) && $user->ip_address !== '*') {
                    if (!$this->is_ip_allowed(getClientIP(), $user->ip_address)) {
                        $response['success'] = false;
                        $response['message'] = 'Akses tidak diizinkan dari IP saat ini.';
                        $response['clientIp'] = getClientIP();
                        echo json_encode($response);
                        return;
                    }
                }

                //looping data user
                $session_data = array(
                    'id'   => $user->id,
                    'email'  => $user->email,
                    'full_name' => $user->full_name,
                );
                //buat session berdasarkan user yang login
                $this->session->set_userdata($session_data);
            }
            $response['success'] = true;
            echo json_encode($response);
            return;
        } else {
            $response['success'] = false;
            $response['message'] = 'Kredensial login tidak ditemukan. Periksa username dan password Anda.';
            echo json_encode($response);
            return;
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
        $google_id = $google_account_info->id;
        $full_name = $google_account_info->name;
        $email = $google_account_info->email;

        $cek = $this->M_system_user->check_auth_google($google_id);

        if (!empty($cek)) {
            foreach ($cek as $user) {
                if (isset($user->ip_address) && $user->ip_address !== '*') {
                    if (!$this->is_ip_allowed(getClientIP(), $user->ip_address)) {
                        $this->session->set_flashdata('message', [
                            'type' => 'error',
                            'text' => 'Akses tidak diperbolehkan dari IP ini.'
                        ]);
                        redirect('/login');
                    }
                }

                //looping data user
                $session_data = array(
                    'id'   => $user->id,
                    'email'  => $user->email,
                    'full_name' => $user->full_name,
                );
                //buat session berdasarkan user yang login
                $this->session->set_userdata($session_data);
            }
            redirect('/dashboard');
        } else {
            $data = [
                'id' => getId(),
                'google_id' => $google_id,
                'full_name' => $full_name,
                'email' => $email,
            ];

            $register = $this->M_system_user->set(null, $data);

            if ($register) {
                $cek = $this->M_system_user->check_auth_google($google_id);
                foreach ($cek as $user) {
                    if (isset($user->ip_address) && $user->ip_address !== '*') {
                        if (!$this->is_ip_allowed(getClientIP(), $user->ip_address)) {
                            $this->session->set_flashdata('message', [
                                'type' => 'error',
                                'text' => 'Akses tidak diperbolehkan dari IP ini.'
                            ]);
                            redirect('/login');
                        }
                    }

                    //looping data user
                    $session_data = array(
                        'id'   => $user->id,
                        'email'  => $user->email,
                        'full_name' => $user->full_name,
                    );
                    //buat session berdasarkan user yang login
                    $this->session->set_userdata($session_data);
                }
                redirect('/dashboard');
            } else {
                $response['success'] = false;
                echo json_encode($response);
                return;
            }
        }
    }
}
