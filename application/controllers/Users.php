<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('M_system_user');
        $this->load->helper('url_helper');
        $this->load->helper('url');


        //cek session login
        if ($this->session->userdata("id") == "") {
            redirect('/login');
        }
    }

    public function index()
    {
        //load view form login
        $data['users'] = $this->M_system_user->get();
        $this->load->view('pages/users/index', $data);
    }
    public function detail($id)
    {
        //load view form login
        $data['user'] = $this->M_system_user->get($id);
        $this->load->view('pages/users/detail', $data);
    }
    public function edit($id)
    {
        //load view form login
        $data['user'] = $this->M_system_user->get($id);
        $this->load->view('pages/users/edit', $data);
    }
    public function update($id)
    {
        //load view form login
        $user = $this->M_system_user->get($id);
        $data = [
            'login_name' => $this->input->post('login_name'),
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'gender' => $this->input->post('gender'),
            'place_of_birth' => $this->input->post('place_of_birth'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'full_address' => $this->input->post('full_address'),
            'passwd' => $this->input->post('password') != null ? password_hash($this->input->post('password'), PASSWORD_DEFAULT) : $user['passwd'],
        ];
        $updated = $this->M_system_user->set($id, $data);

        if ($updated) {
            // Set a flash message for success
            $this->session->set_flashdata('message', [
                'type' => 'success',
                'text' => 'User updated successfully!'
            ]);
        } else {
            // Set a flash message for error
            $this->session->set_flashdata('message', [
                'type' => 'error',
                'text' => 'Failed to update user.'
            ]);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete($id)
    {
        $deleted = $this->M_system_user->delete($id);

        if ($deleted) {
            // Set a flash message for success
            $this->session->set_flashdata('message', [
                'type' => 'success',
                'text' => 'User deleted successfully!'
            ]);
        } else {
            // Set a flash message for error
            $this->session->set_flashdata('message', [
                'type' => 'error',
                'text' => 'Failed to delete user.'
            ]);
        }
        redirect('/users');
    }
}
