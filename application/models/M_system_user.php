<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_system_user extends CI_model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get($id = FALSE)
    {
        if ($id === FALSE) {
            $query = $this->db->get('system_user');
            return $query->result_array();
        }
        $query = $this->db->get_where('system_user', array('id' => $id));
        return $query->row_array();
    }

    public function set($id = null, $data = [])
    {
        $this->load->helper('url');
        if ($id === null) {
            return $this->db->insert('system_user', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('system_user', $data);
        }
    }

    public function delete($id)
    {
        return $this->db->delete('system_user', array('id' => $id));
    }

    // fungsi cek login
    function check_auth($email, $password)
    {
        $this->db->select("*");
        $this->db->from("system_user");
        $this->db->where("email", $email);
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
        $this->db->from("system_user");
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
