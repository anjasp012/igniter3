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

    public function set($id_user = null, $data = [])
    {
        $this->load->helper('url');
        if ($id_user === null) {
            return $this->db->insert('system_user', $data);
        } else {
            $this->db->where('id_user', $id_user);
            return $this->db->update('system_user', $data);
        }
    }

    public function delete($id_user)
    {
        return $this->db->delete('system_user', array('id_user' => $id_user));
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
    function check_auth_google($google_id_user)
    {
        $this->db->select("*");
        $this->db->from("system_user");
        $this->db->where("google_id_user", $google_id_user);
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
