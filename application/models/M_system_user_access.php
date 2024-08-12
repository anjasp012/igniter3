<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_system_user_access extends CI_model
{
    protected $table = 'system_user_access';
    protected $column_order = array(null, 'actor_code', 'allow_access', 'create_at');
    protected $column_search = array('actor_code', 'allow_access');
    protected $order = array('actor_code' => 'desc');

    private function _get_datatables_query($system_user_id)
    {
        /* query */
        $this->db->from($this->table)->where('delete_at', null)->where('system_user_id', $system_user_id);

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

    function get_datatables($system_user_id)
    {
        $this->_get_datatables_query($system_user_id);
        if (@$_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result(); // return JSON Response
    }
    public function count_all($system_user_id)
    {
        $this->db->from($this->table)->where('delete_at', null)->where('system_user_id', $system_user_id);
        return $this->db->count_all_results();
    }
    function count_filtered($system_user_id)
    {
        $this->_get_datatables_query($system_user_id);
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
        $this->db->where('id', $id);
        return $this->db->update($this->table, array('delete_at' => date('Y-m-d H:i:s'), 'delete_by' => $this->session->userdata("id")));
    }
}
