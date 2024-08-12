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
        $this->load->view('pages/users/index');
    }
    public function data_table()
    {
        if ($this->input->is_ajax_request() == true) {

            $datatable = $this->M_system_user->get_datatables();

            $data = array();
            $no   = @$_POST['start'];

            foreach ($datatable as $n) {

                $no++;
                $row    = array();

                $row[]  = $no;
                $row[]  = $n->full_name;
                $row[]  = $n->email;
                $row[]  = $n->gender;
                $row[]  = $n->full_address;
                $row[]  = '
                        <a data-full_name="'.$n->full_name.'" data-id="'.$n->id.'" class="btn btn-sm btn-info btn-detail">Detail</a>
                    ';
                $row[]  = '
                <a data-full_name="'.$n->full_name.'" data-id="'.$n->id.'" class="btn btn-sm btn-dark px-3 btn-akses">List</a>
                ';
                $data[] = $row;
            }

            $output = array(
                "draw"              => $_POST['draw'],
                "recordsTotal"      => $this->M_system_user->count_all(),
                "recordsFiltered"   => $this->M_system_user->count_filtered(),
                "data"              => $data,
            );

            $this->output->set_content_type('application/json')->set_output(json_encode($output, 200));
        } else {
            exit('Ajax say:: Maaf data tidak bisa ditampilkan, lihat Web Developer!');
        }
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
            'login_name' => $this->input->post('login_name') != null ? $this->input->post('login_name') : null,
            'full_name' => $this->input->post('full_name') != null ? $this->input->post('full_name') : null,
            'email' => $this->input->post('email') != null ? $this->input->post('email') : null,
            'gender' => $this->input->post('gender') != null ? $this->input->post('gender') : null,
            'place_of_birth' => $this->input->post('place_of_birth') != null ? $this->input->post('place_of_birth') : null,
            'date_of_birth' => $this->input->post('date_of_birth') != null ? $this->input->post('date_of_birth') : null,
            'full_address' => $this->input->post('full_address') != null ? $this->input->post('full_address') : null,
            'ip_address' => $this->input->post('ip_address') != null ? $this->input->post('ip_address') : null,
            'allow_access' => $this->input->post('allow_access') != null ? $this->input->post('allow_access') : null,
            'passwd' => $this->input->post('password') != null ? password_hash($this->input->post('password'), PASSWORD_DEFAULT) : $user['passwd'],
        ];
        $updated = $this->M_system_user->set($id, $data);
        if ($updated) {
            $response['success'] = true;
            $response['message'] = "Berhasil mengupdate user";
            echo json_encode($response);
            return;
        } else {
            $response['success'] = false;
            $response['message'] = "Gagal mengupdate user";
            echo json_encode($response);
            return;
        }
    }

    public function delete($id)
    {
        $deleted =$this->M_system_user->delete($id);
        if ($deleted) {
            $response['success'] = true;
            $response['message'] = "Berhasil menghapus user";
            echo json_encode($response);
            return;
        } else {
            $response['success'] = false;
            $response['message'] = "Gagal menghapus user";
            echo json_encode($response);
            return;
        }
    }
}
