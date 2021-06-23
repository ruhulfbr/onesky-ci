<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Media_model extends CI_Model {

    public $_table;
    public $_primary_key;

    public function __construct() {
        parent::__construct();

        // set the common variable
        $this->_table = 'media';
        $this->_primary_key = 'photo_id';
    }

    //Add News Category 
    public function save_new($data = array()) {
        $this->db->insert($this->_table, $data);
        return $this->db->affected_rows();
    }

    // Delete Category
    public function delete($id) {
        $this->db->delete($this->_table, array($this->_primary_key => $id));
        return $this->db->affected_rows();
    }

}

/* End of file Media_model.php */
/* Location: ./application/models/admin/Media_model.php */