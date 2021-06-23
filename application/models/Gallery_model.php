<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function getGalleryAlbum($limit = 0, $offset = 0) {

        $this->db->select('*');
        $this->db->from('gallery');
        $this->db->order_by('created', 'DESC');

        $tempdb = clone $this->db;
        $finalResult['totalRow'] = $tempdb->count_all_results();
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            $finalResult['result'] = $query->result();
            return $finalResult;
        }

        return FALSE;
    }

    public function countAlbumPhoto($albumId) {

        return $this->db
                        ->where('type_id', $albumId)
                        ->where('type', 'gallery')
                        ->count_all_results('media');
    }

    public function getAlbumInfo($albumId) {

        $this->db->select('*');
        $this->db->from('gallery');

        $this->db->where('gallery_id', $albumId);
        $query = $this->db->get();
        
        if ($query->num_rows() != 0):
            return $query->row();
        endif;

        return FALSE;
    }

}
