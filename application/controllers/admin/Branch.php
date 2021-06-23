<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {

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
        $this->load->model('admin/branch_model', 'branch');

        // set global variable
        $this->_module = 'branch';
        $this->_moduleName = 'Branch';
        $this->_viewPath = 'admin/branch/';

    }

    public function index($id = false) {

        // set the page name
        $data['pageGroup'] = $this->_moduleName;
        $data['pageTitle'] = "Manage " . $this->_moduleName;

        $data['branch_id'] = $id;
        $data['tabActive'] = $data['subTabActive'] = "branch";

        if ($id && ($branch = $this->branch->getSingleInfo($id))) {
            $data['branch'] = $branch;
        }

        //add banner image
        if ($this->input->post('submit')) {
            if ($id) {
                $data = $this->edit($id);
            } else {
                $data = $this->add();
            }
        }

        // get the all information

        $data['allData'] = $this->branch->getAll();
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
                    ->set_rules('category', 'Category', 'trim|required')
                    ->set_rules('name', 'Name', 'trim|required')
                    ->set_rules('address', 'Address', 'trim|required')
                    ->set_rules('phone', 'Phone', 'trim|required')
                    ->set_rules('map', 'Map', 'trim|required')
                    ->set_rules('status', 'Status', 'trim|required');

            $this->form_validation->set_error_delimiters('<br>', '');
            

            // check the validation
            if ($this->form_validation->run()) {

                $total_item = $this->global_model->count_row('branch');

                $addData['category'] = $this->input->post('category');
                $addData['name'] = $this->input->post('name');
                $addData['address'] = $this->input->post('address');
                $addData['phone'] = $this->input->post('phone');
                $addData['map'] = $this->input->post('map');
                $addData['status'] = $this->input->post('status');
                $addData['view_order'] = $total_item + 1;
                $addData['created_at'] = date('Y-m-d H:i:s');
                $addData['updated_at'] = date('Y-m-d H:i:s');

                if ($this->branch->create($addData)) {
                    $this->session->set_flashdata('success_msg', 'New Branch Added Successfully !!');
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

        if ($this->input->post('submit')) {
            // write the validation rule
            $this->form_validation
                    ->set_rules('category', 'Category', 'trim|required')
                    ->set_rules('name', 'Name', 'trim|required')
                    ->set_rules('address', 'Address', 'trim|required')
                    ->set_rules('phone', 'Phone', 'trim|required')
                    ->set_rules('map', 'Map', 'trim|required')
                    ->set_rules('status', 'Status', 'trim|required');

            $this->form_validation->set_error_delimiters('<br>', '');

            // check the validation
            if ($this->form_validation->run()) {

                $addData['category'] = $this->input->post('category');
                $addData['name'] = $this->input->post('name');
                $addData['address'] = $this->input->post('address');
                $addData['phone'] = $this->input->post('phone');
                $addData['map'] = $this->input->post('map');
                $addData['status'] = $this->input->post('status');
                $addData['view_order'] = $total_item + 1;                
                $addData['view_order'] = $this->input->post('view_order');
                $addData['updated_at'] = date('Y-m-d H:i:s');

                if ($this->branch->update($addData, $id)) {
                    $this->session->set_flashdata('success_msg', 'Branch Updated Successfully!!');
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

        if ($this->branch->delete($id)) {
            $this->session->set_flashdata('success_msg', 'Item Deleted Successfully !!');
        }
        
        redirect(admin_url($this->_module));
    }

    public function contact() {

        // set the page name
        $data['tabActive'] = 'contact';
        $data['pageGroup'] = 'contact';
        $data['pageTitle'] = "Manage Contact";

        // get the all information

        $data['allData'] = $this->global_model->get('contact', false, false, array('filed'=>'id', 'order'=>'DESC'));


        // load the views
        $data['required_contents'] = $this->load->view($this->_viewPath . 'contacts', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

}