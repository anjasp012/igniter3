<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_system_user extends CI_model
{
    protected $table = 'system_user';
    protected $column_order = array(null,'full_name', 'email', 'gender', 'full_address');
    protected $column_search = array('full_name', 'email', 'gender', 'full_address');
    protected $order = array('full_name' => 'desc');

    private function _get_datatables_query()
    {
        /* query */
        $this->db->from($this->table);

        /* search */
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        /* order */
        if (@isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (@isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if (@$_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result(); // return JSON Response
    }
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function get($id = FALSE)
    {
        if ($id === FALSE) {
            $query = $this->db->get($this->table);
            return $query->result_array();
        }
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->row_array();
    }

    public function set($id = null, $data = [])
    {
        $this->load->helper('url');
        if ($id === null) {
            $data['create_at'] = date('Y-m-d H:i:s');
            return $this->db->insert($this->table, $data);
        } else {
            $data['modify_at'] = date('Y-m-d H:i:s');
            $this->db->where('id', $id);
            return $this->db->update($this->table, $data);
        }
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id' => $id));
    }

    // fungsi cek login
    function check_auth($username, $password)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("email", $username);
        $this->db->or_where("login_name", $username);
        $query = $this->db->get();
        $user = $query->row();

        /**
         * Check password
         */
        if (!empty($user)) {
            if (password_verify($password, $user->passwd)) {
                return $query->result();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    // fungsi cek login google
    function check_auth_google($google_id)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("google_id", $google_id);
        $query = $this->db->get();
        $user = $query->row();

        /**
         * Check password
         */
        if (!empty($user)) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
}
