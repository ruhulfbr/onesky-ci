<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Important_links extends CI_Controller {

    public $_module;
    public $_moduleName;
    public $_moduleImagePath;
    public $_viewPath;
    public $_getImageSize;

    function __construct() {
        parent::__construct();

        if (!loginCheck()) {
            $this->session->set_userdata('return_url', current_url()); // set the last visit page
            $this->session->set_flashdata('success_msg', 'Please Login First !!');
            redirect(admin_url('auth/login'));
        }
        // load the specific model
        $this->load->model('admin/important_links_model', 'important_links');

        // set global variable
        $this->_module = 'important_links';
        $this->_moduleName = 'Important Links';
        $this->_viewPath = 'admin/important_links/';

        // load file processing library
        $this->load->library('file_processing');
    }

    public function index($id = false) {
        // set the page name
        $data['pageGroup'] = $this->_moduleName;
        $data['pageTitle'] = "Manage " . $this->_moduleName;

        $data['important_links_id']    = $id;
        $data['tabActive'] = $data['subTabActive'] = "important_links";

        if ($id && ($important_links = $this->important_links->getSingleInfo($id))) {
            $data['important_links'] = $important_links;
        }

        //add important_links image
        if ($this->input->post('submit')) {
            if ($id) {
                $data = $this->edit($id);
            } else {
                $data = $this->add();
            }
        }

        // get the all information

        $data['allData'] = $this->important_links->getAll();
        // load the views
        $data['required_contents'] = $this->load->view($this->_viewPath . 'manage', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    // create new information
    public function add() {
        $data = array();
        if ($this->input->post('submit')) {
            // write the validation rule
            $this->form_validation
                    ->set_rules('title', 'Title', 'trim|required')
                    ->set_rules('link', 'Link', 'trim|required')
                    ->set_rules('status', 'Status', 'trim');

            $this->form_validation->set_error_delimiters('<br>', '');
            // check the validation
            if ($this->form_validation->run()) {
                $addData['title']       = $this->input->post('title');
                $addData['link']        = $this->input->post('link');
                $addData['status']      = $this->input->post('status') ? $this->input->post('status') : 1;
                $addData['created_at']  = date('Y-m-d H:i:s');
                if ($this->important_links->create($addData)) {
                    $this->session->set_flashdata('success_msg', 'New important_links Added Successfully !!');
                    redirect(admin_url($this->_module));
                } else {
                    $data['error'] = mysql_error();
                }
            } else {
                $data['error'] = validation_errors();
            }
        }

        return $data;
    }

    public function edit($id) {

        $data = array();
        $data['important_links'] = $important_links = $this->important_links->getSingleInfo($id);

        if ($this->input->post('submit')) {
            // write the validation rule
            $this->form_validation
                    ->set_rules('title', 'Title', 'trim|required')
                    ->set_rules('link', 'Link', 'trim|required')
            ;
            $this->form_validation->set_error_delimiters('<br>', '');

            // check the validation
            if ($this->form_validation->run()) {

                $addData['title']       = $this->input->post('title') ? $this->input->post('title') : $important_links->title;
                $addData['link']        = $this->input->post('link') ? $this->input->post('link') : $important_links->link;
                $addData['status']      = $this->input->post('status') ? $this->input->post('status') : $important_links->status;
                $addData['modified_at'] = date('Y-m-d H:i:s');

                if ($this->important_links->update($addData, $id)) {
                    $this->session->set_flashdata('success_msg', 'important_links Updated Successfully!!');
                    redirect(admin_url($this->_module));
                } else {
                    $data['error'] = mysql_error();
                }
            } else {
                $data['error'] = validation_errors();
            }
        }
        return $data;
    }

    // delete the specific record based on ID
    public function delete($id) {
        // delete the record from database
        if ($info = $this->important_links->getSingleInfo($id)) {
            if ($this->important_links->delete($id)) {
                $this->session->set_flashdata('success_msg', 'Item Deleted Successfully !!');
            }
        }

        redirect(admin_url($this->_module));
    }
}

/* End of file important_links.php */
/* Location: ./application/controllers/extremeadmin/important_links.php */