<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // get the login information
    public function login($user_name) {
        $this->db->select('*')->from('users')->where('user_name', $user_name);
        $query = $this->db->get();
        return $query->row();
    }

    //get the information using email
    public function check_email($email) {
        $this->db->select('*')->from('users')->where('email', $email);
        $query = $this->db->get();
        return $query->row();
    }

    // get the specific user information
    public function getSingleUserInfo($user_id) {
        $this->db->select('*')->from('users')->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->row();
    }

    // update specific users information
    public function updateUser($data, $user_id = 0) {
        if ($this->db->update('users', $data, "user_id = " . $user_id . ""))
            return TRUE;
        else
            return FALSE;
    }

    // get the information based on filtaring
    public function getAll($count = false, $num = null, $offset = null) {
        $select = $this->db->select('*')->from('users');
        $select->order_by('user_id', 'DESC');
        if ($num) {
            $select->limit($num, $offset);
        }
        if ($count) {
            return $select->count_all_results();
        } else {
            $query = $this->db->get();
            return $query->result();
        }
    }

    // insert new record into user table
    public function create($data) {
        $this->db->insert('users', $data);
        return $this->db->affected_rows();
    }

    // delete single information
    public function delete($user_id = 0) {
        $this->db->delete('users', array('user_id' => $user_id));
        return $this->db->affected_rows();
    }

    // update the information
    public function update($data, $user_id) {
        if ($this->db->update('users', $data, array('user_id' => $user_id)))
            return TRUE;
        else
            return FALSE;
    }

}

/* End of file User_model.php */
/* Location: ./application/model/admin/User_model.php */