<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Packages extends CI_Controller {

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
        $this->load->model('admin/packages_model', 'packages');

        // set global variable
        $this->_module = 'packages';
        $this->_moduleName = 'Packages';
        $this->_viewPath = 'admin/packages/';

    }

    public function index($id = false) {
        // set the page name
        $data['pageGroup'] = $this->_moduleName;
        $data['pageTitle'] = "Manage " . $this->_moduleName;

        $data['package_id'] = $id;
        $data['tabActive'] = $data['subTabActive'] = "packages";

        if ($id && ($packages = $this->packages->getSingleInfo($id))) {
            $data['package'] = $packages;
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
        $data['allData'] = $this->packages->getAll();
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
                    ->set_rules('price', 'Price', 'trim|required')
                    ->set_rules('speed', 'Speed', 'trim|required')
                    ->set_rules('type', 'Type', 'trim|required')
                    ->set_rules('otc', 'OTC', 'trim|required')
                    ->set_rules('video', 'Video', 'trim|required')
                    ->set_rules('support', 'Support', 'trim|required')
                    ->set_rules('up_time', 'Up Time', 'trim|required')
                    ->set_rules('status', 'Status', 'trim|required');

            $this->form_validation->set_error_delimiters('<br>', '');
            

            // check the validation
            if ($this->form_validation->run()) {

                $total_item = $this->global_model->count_row('packages');

                $addData['category'] = $this->input->post('category');
                $addData['name'] = $this->input->post('name');
                $addData['price'] = $this->input->post('price');
                $addData['speed'] = $this->input->post('speed');
                $addData['type'] = $this->input->post('type');
                $addData['otc'] = $this->input->post('otc');
                $addData['video'] = $this->input->post('video');
                $addData['support'] = $this->input->post('support');
                $addData['up_time'] = $this->input->post('up_time');
                $addData['status'] = $this->input->post('status');
                $addData['view_order'] = $total_item + 1;
                $addData['created_at'] = date('Y-m-d H:i:s');
                $addData['updated_at'] = date('Y-m-d H:i:s');

                if ($this->packages->create($addData)) {
                    $this->session->set_flashdata('success_msg', 'New Packages Added Successfully !!');
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
            // write the validation rule
            $this->form_validation
                    ->set_rules('category', 'Category', 'trim|required')
                    ->set_rules('name', 'Name', 'trim|required')
                    ->set_rules('price', 'Price', 'trim|required')
                    ->set_rules('speed', 'Speed', 'trim|required')
                    ->set_rules('type', 'Type', 'trim|required')
                    ->set_rules('otc', 'OTC', 'trim|required')
                    ->set_rules('video', 'Video', 'trim|required')
                    ->set_rules('support', 'Support', 'trim|required')
                    ->set_rules('up_time', 'Up Time', 'trim|required')
                    ->set_rules('status', 'Status', 'trim|required');

            $this->form_validation->set_error_delimiters('<br>', '');

            // check the validation
            if ($this->form_validation->run()) {

                $addData['category'] = $this->input->post('category');
                $addData['name'] = $this->input->post('name');
                $addData['price'] = $this->input->post('price');
                $addData['speed'] = $this->input->post('speed');
                $addData['type'] = $this->input->post('type');
                $addData['otc'] = $this->input->post('otc');
                $addData['video'] = $this->input->post('video');
                $addData['support'] = $this->input->post('support');
                $addData['up_time'] = $this->input->post('up_time');
                $addData['status'] = $this->input->post('status');
                $addData['view_order'] = $this->input->post('view_order');
                $addData['updated_at'] = date('Y-m-d H:i:s');

                if ($this->packages->update($addData, $id)) {
                    $this->session->set_flashdata('success_msg', 'Package Updated Successfully!!');
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

        if ($this->packages->delete($id)) {
            $this->session->set_flashdata('success_msg', 'Item Deleted Successfully !!');
        }
        
        redirect(admin_url($this->_module));
    }

}