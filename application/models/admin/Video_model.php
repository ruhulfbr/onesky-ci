<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Video_model extends CI_Model {

    public $_module;
    public $_primaryKey;

    function __construct() {
        parent::__construct();
        $this->_module = 'video';
        $this->_primaryKey = 'id';
    }

    // insert new record 
    public function create($data) {
        $this->db->insert($this->_module, $data);
        return $this->db->affected_rows();
    }

    // get the specific information
    public function getSingleInfo($id) {

        $select = $this->db->select('*');
        $select->from($this->_module);
        $select->where($this->_primaryKey, $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getAll() {

        $this->db->select('*');
        $this->db->from($this->_module);
        $query = $this->db->get();

        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function _getAll($id) {

        $select = $this->db->select('*');
        $select->from($this->_module);
        $select->where($this->_primaryKey, $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getSingleData($id) {

        $this->db
                ->select('*')
                ->from($this->_module)
                ->where($this->_primaryKey, $id);
        $query = $this->db->get();

        if ($query->num_rows() != 0) {
            return $query->row();
        }

        return false;
    }

    // delete single information
    public function delete($id = 0) {
        $this->db->delete($this->_module, array($this->_primaryKey => $id));
        return $this->db->affected_rows();
    }

    // update the information
    public function update($data, $id) {
        if ($this->db->update($this->_module, $data, $this->_primaryKey . "= " . $id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

/* End of file Project_video_model.php */
/* Location: ./application/model/perfectadmin/Project_video_model.php */