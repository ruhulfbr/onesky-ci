<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_model extends CI_Model {

    public $_module;
    public $_primaryKey;

    function __construct() {
        parent::__construct();
        $this->_module = 'banners';
        $this->_primaryKey = 'id';
    }

    public function create($data) {
        $this->db->insert($this->_module, $data);
        return $this->db->affected_rows();
    }

    public function getSingleInfo($id) {
        $select = $this->db->select('*');
        $select->from($this->_module);
        $select->where($this->_primaryKey, $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getAll() {

        $this->db
                ->select('*')
                ->from($this->_module)
                ->order_by('id','desc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function getAllBannerData($limit = 0, $offset = 0) {

        $this->db
                ->select('*')
                ->from($this->_module)
                ->order_by('created', 'DESC');

        $tempdb = clone $this->db;
        $finalResult['totalRow'] = $tempdb->count_all_results();
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $finalResult['result'] = $query->result();
            return $finalResult;
        } else {
            return FALSE;
        }
    }

    // delete single information
    public function delete($id = 0) {
        $this->db->delete($this->_module, array($this->_primaryKey => $id));
        return $this->db->affected_rows();
    }

    // update the information
    public function update($data, $id) {
        if ($this->db->update($this->_module, $data, $this->_primaryKey . " = " . $id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
