<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

    public $_viewPath;
    public $_module;

    function __construct() {
        parent::__construct();

        $this->_viewPath = 'frontend/';
        $this->_module = 'gallery';
        $this->load->model('gallery_model');
    }

    public function index() {

        $data = array();
        $data['pageTitle'] = "Photo Gallery";
        $data['tabActive'] = "gallery";

        // pagination
        $uriSegment = 3;
        $data['offset'] = $offset = 0;
        if ($this->uri->segment($uriSegment) === FALSE) {
            $data['offset'] = $offset = 0;
        } else {
            $data['offset'] = $offset = $this->uri->segment($uriSegment) ? $this->uri->segment($uriSegment) : 0;
        }

        $perPage = 6; // product per page
        $result = $this->gallery_model->getGalleryAlbum($perPage, $offset);

        $data['allAlbums'] = $result['result'];
        $totalRow = $result['totalRow'];

        generatePagging('gallery/index', $totalRow, $perPage, $uriSegment, 4);

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'gallery/index', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function viewAlbum($albumId = 0) {

        if ($albumId == 0) {
            show_404();
        } else {
            $data = array();
            $data['albumId'] = $albumId;
            $data['tabActive'] = "gallery";

            // get album info
            $data['albumInfo'] = $albumInfo = $this->gallery_model->getAlbumInfo($albumId);
            $data['pageTitle'] = !empty($albumInfo->title) ? $albumInfo->title : "Photo Gallery";

            $this->load->view($this->_viewPath . 'header', $data);
            $this->load->view($this->_viewPath . 'gallery/album', $data);
            $this->load->view($this->_viewPath . 'footer', $data);
        }
    }

}
