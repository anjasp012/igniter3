<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Access extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('M_system_user_access');
        $this->load->helper('url_helper');
        $this->load->helper('url');
    }

    public function index()
    {
        die(var_dump('wdwdw'));
        $data['system_user_id'] = $id;
        $this->load->view('pages/user_access/index', $data);
    }
    public function data_table($system_user_id)
    {
        if ($this->input->is_ajax_request() == true) {

            $datatable = $this->M_system_user_access->get_datatables($system_user_id);

            $data = array();
            $no   = @$_POST['start'];

            foreach ($datatable as $n) {

                $no++;
                $row    = array();

                $row[]  = $no;
                $row[]  = $n->actor_code;
                $row[]  = '
                        <a href="' . base_url('access/detail/') . $system_user_id . '/' . $n->id . '" class="btn btn-sm btn-info btn-detail">Detail</a>
                    ';
                $data[] = $row;
            }

            $output = array(
                "draw"              => $_POST['draw'],
                "recordsTotal"      => $this->M_system_user_access->count_all($system_user_id),
                "recordsFiltered"   => $this->M_system_user_access->count_filtered($system_user_id),
                "data"              => $data,
            );

            $this->output->set_content_type('application/json')->set_output(json_encode($output, 200));
        } else {
            exit('Ajax say:: Maaf data tidak bisa ditampilkan, lihat Web Developer!');
        }
    }
    public function detail($system_user_id, $id)
    {
        //load view form login
        $data['user_access'] = $this->M_system_user_access->get($id);
        $this->load->view('pages/user_access/detail', $data);
    }
    public function create($system_user_id)
    {
        $data['system_user_id'] = $system_user_id;
        $this->load->view('pages/user_access/create', $data);
    }
    public function store($system_user_id)
    {
        $data = [
            'id' => getId(),
            'system_user_id' => $system_user_id,
            'actor_code' => $this->input->post('actor_code') != null ? $this->input->post('actor_code') : null,
        ];
        $created = $this->M_system_user_access->set(null, $data);

        if ($created) {
            $response['success'] = true;
            $response['message'] = "Berhasil menambahkan user access";
            echo json_encode($response);
            return;
        } else {
            $response['success'] = false;
            $response['message'] = "Gagal menambahkan user access";
            echo json_encode($response);
            return;
        }
    }
    public function edit($system_user_id,$id)
    {
        //load view form login
        $data['user_access'] = $this->M_system_user_access->get($id);
        $this->load->view('pages/user_access/edit', $data);
    }
    public function update($system_user_access,$id)
    {
        $data = [
            'actor_code' => $this->input->post('actor_code') != null ? $this->input->post('actor_code') : null,
        ];
        $updated = $this->M_system_user_access->set($id, $data);
        if ($updated) {
            $response['success'] = true;
            $response['message'] = "Berhasil mengupdate user access";
            echo json_encode($response);
            return;
        } else {
            $response['success'] = false;
            $response['message'] = "Gagal mengupdate user access";
            echo json_encode($response);
            return;
        }
    }

    public function delete($system_user_access,$id)
    {
        $deleted = $this->M_system_user_access->delete($id);
        if ($deleted) {
            $response['success'] = true;
            $response['message'] = "Berhasil menghapus user access";
            echo json_encode($response);
            return;
        } else {
            $response['success'] = false;
            $response['message'] = "Gagal menghapus user access";
            echo json_encode($response);
            return;
        }
    }
}
