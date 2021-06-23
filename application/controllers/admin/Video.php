<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

    public $_moduleName;
    public $_module;
    public $_moduleVideoPath;
    public $_viewPath;
    public $_videoLimit;

    function __construct() {
        parent::__construct();

        if (!loginCheck()) {
            $this->session->set_userdata('return_url', current_url()); // set the last visit page
            $this->session->set_flashdata('success_msg', 'Please Login First !!');
            redirect(admin_url('auth/login'));
        }

        $models = array(
            'admin/video_model' => 'video',
        );
        $this->load->model($models);

        $this->load->library('file_processing');
        $this->_moduleName = 'Video';
        $this->_module = 'video';
        $this->_viewPath = 'admin/video/';
        $this->_moduleVideoPath = 'assets/media/video/';
        $this->_videoLimit = 10240;
    }

    public function index($id = false) {

        $data = array();
        $data['pageTitle'] = "Manage " . $this->_moduleName;
        $data['tabActive'] = $this->_module;
        $data['subTabActive'] = $this->_module . "_manage";

        // get the all information
        $data['allData'] = $this->video->getAll();

        // load the views
        $data['required_contents'] = $this->load->view($this->_viewPath . '/manage', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function add() {

        $data = array();
        $data['tabActive'] = $this->_module;
        $data['subTabActive'] = $this->_module . "_add";

        if ($this->input->post('submit')) {
            $this->form_validation
                    ->set_rules('description', 'Description', 'trim') 
                    ->set_rules('title', 'Title', 'trim')
                    ->set_rules('youtube_url', 'YouTube Url', 'trim|required')     
            ;

            if ($this->form_validation->run()) {
                $addData['youtube_url'] = $this->input->post('youtube_url');
                $addData['title'] = $this->input->post('title');
                $addData['created'] = date('Y-m-d H:i:s');
                if ($this->video->create($addData)) {
                    $this->session->set_flashdata('success_msg', 'New ' . $this->_moduleName . ' Added Successfully !');
                    redirect(admin_url($this->_module));
                } else {
                    $data['error'] = mysql_error();
                }
            } else {
                $data['error'] = validation_errors();
            }
        }
        $data['required_contents'] = $this->load->view($this->_viewPath . 'create', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function update($id = false) {

        $data['tabActive'] = $this->_module;
        $data['subTabActive'] = $this->_module . "_manage";

        $data['allData'] = $allData = $this->video->getSingleInfo($id);
 
        if ($this->input->post('submit')) {

            // write the validation rule
            $this->form_validation
                    ->set_rules('description', 'Description', 'trim')
                    ->set_rules('title', 'Title', 'trim')
                    ->set_rules('youtube_url', 'YouTube Url', 'trim|required')

            ;

            // check the validation
            if ($this->form_validation->run()) {

                // $addData['description'] = $this->input->post('description');
                $addData['youtube_url'] = $this->input->post('youtube_url');
                $addData['title'] = $this->input->post('title');
                $addData['modified'] = date('Y-m-d H:i:s');
                if ($this->video->update($addData, $id)) {
                    $this->session->set_flashdata('success_msg', 'Updated Successfully !');
                    redirect(admin_url($this->_module));
                }
            }
        }

        $data['required_contents'] = $this->load->view($this->_viewPath . 'update', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function view($id) {

        $data = array();
        $data['get_info'] = $this->video->getSingleData($id);
        $data['pageTitle'] = "View of " . $this->_module;
        $data['tabActive'] = $this->_module;
        $data['subTabActive'] = $this->_module . "_manage";

        //Check data
        if (empty($data['get_info'])) {
            $this->session->set_flashdata('error_msg', 'No data found!!');
            redirect($this->module);
        }

        // load the views
        $data['required_contents'] = $this->load->view($this->_viewPath . 'view', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function delete($id) {

        // delete the album
        if ($this->global_model->delete('video', array('id' => $id))) {
            $this->session->set_flashdata('success_msg', 'Item Deleted Successfully !!');
            redirect(admin_url($this->_module));
        }
    }
}

/* End of file Project_video.php */
/* Location: ./application/controllers/perfectadmin/Project_video.php */