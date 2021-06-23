<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

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

        $this->_getImageSize = array(
            'original' => array('width' => 1400, 'height' => 730, 'crop' => FALSE),
            'thumbs' => array('width' => 400, 'height' => 400, 'crop' => FALSE),
        );

        $this->_getImageSize2 = array(
            'original' => array('width' => 400, 'height' => 600, 'crop' => FALSE),
            'thumbs' => array('width' => 300, 'height' => 300, 'crop' => FALSE),
        );

        // load the specific model
        $this->load->model('admin/banner_model', 'banner');

        // set global variable
        $this->_module = 'banner';
        $this->_moduleName = 'Banner';
        $this->_moduleImagePath = 'assets/media/banners/';
        $this->_viewPath = 'admin/banners/';

        // load file processing library
        $this->load->library('file_processing');
    }

    public function index($id = false) {

        // set the page name
        $data['pageGroup'] = $this->_moduleName;
        $data['pageTitle'] = "Manage " . $this->_moduleName;

        $data['banner_id'] = $id;
        $data['tabActive'] = $data['subTabActive'] = "banner";

        if ($id && ($banner = $this->banner->getSingleInfo($id))) {
            $data['banner'] = $banner;
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

        $data['allData'] = $this->banner->getAll();
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
                    ->set_rules('title_one', 'Title One', 'trim|required')
                    ->set_rules('title_two', 'Title Two', 'trim')
                    ->set_rules('title_three', 'Title Three', 'trim')
                    ->set_rules('description', 'Description', 'trim')
                    ->set_rules('button_name', 'Button Name', 'trim')
                    ->set_rules('hyperlink', 'Hyperlink', 'trim')
                    ->set_rules('banner_image', 'Banner Image', 'callback_file_validate[yes.banner_image.jpg,gif,png,jpeg]')
                    ->set_rules('status', 'Status', 'trim');

            if($this->input->post('button_name')){
                $this->form_validation->set_rules('hyperlink', 'hyperlink', 'trim|required');
            }

            if($this->input->post('hyperlink')){
                 $this->form_validation->set_rules('button_name', 'Button Name', 'trim|required');
            }

            $this->form_validation->set_error_delimiters('<br>', '');
            

            // check the validation
            if ($this->form_validation->run()) {

                $addData['title_one'] = $this->input->post('title_one');
                $addData['title_two'] = $this->input->post('title_two');
                $addData['title_three'] = $this->input->post('title_three');
                $addData['description'] = $this->input->post('description');
                $addData['button_name'] = $this->input->post('button_name');
                $addData['hyperlink'] = $this->input->post('hyperlink');
                $addData['status'] = $this->input->post('status') ? $this->input->post('status') : 1;

                // upload photo
                $imageName = time();
                $photo = $this->file_processing->image_upload('banner_image', './' . $this->_moduleImagePath . 'original/', 'size[1600,9999]', 'jpg|jpeg|png|gif', $imageName);

                $initPath = './' . $this->_moduleImagePath . 'original/' . $photo; // original
                $mainPath = './' . $this->_moduleImagePath . $photo; // main image path
                $thumbsPath = './' . $this->_moduleImagePath . 'thumbs/' . $photo; // thumbs path
                // resizing the image

                img_resize($initPath, $mainPath, $this->_getImageSize['original']); // main path image
                img_resize($initPath, $thumbsPath, $this->_getImageSize['thumbs']); // resize with thumbs

                $addData['image_name'] = $photo ? $photo : '';

                if( !empty($_FILES['image_2']['name']) && $_FILES['image_2']['name'] != "") {
                    $imageName = time();
                    $photo = $this->file_processing->image_upload('image_2', './' . $this->_moduleImagePath . 'original/', 'size[1600,9999]', 'jpg|jpeg|png|gif', $imageName);

                    $initPath = './' . $this->_moduleImagePath . 'original/' . $photo; // original
                    $mainPath = './' . $this->_moduleImagePath . $photo; // main image path
                    $thumbsPath = './' . $this->_moduleImagePath . 'thumbs/' . $photo; // thumbs path
                    // resizing the image

                    img_resize($initPath, $mainPath, $this->_getImageSize2['original']); // main path image
                    img_resize($initPath, $thumbsPath, $this->_getImageSize2['thumbs']); // resize with thumbs

                    $addData['image_2'] = $photo ? $photo : '';
                }

                $addData['created'] = date('Y-m-d H:i:s');

                if ($this->banner->create($addData)) {
                    $this->session->set_flashdata('success_msg', 'New Banner Image Added Successfully !!');
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
        $data['banner'] = $banner = $this->banner->getSingleInfo($id);

        if ($this->input->post('submit')) {
            // write the validation rule
            $this->form_validation
                    ->set_rules('title_one', 'Title One', 'trim|required')
                    ->set_rules('title_two', 'Title Two', 'trim|required')
                    ->set_rules('title_three', 'Title Three', 'trim')
                    ->set_rules('description', 'Description', 'trim')
                    ->set_rules('hyperlink', 'Hyperlink', 'trim');

            if (isset($_FILES["banner_image"]["name"]) && !empty($_FILES["banner_image"]["name"])) {
                $this->form_validation->set_rules('banner_image', 'Image', 'callback_file_validate[yes.banner_image.jpg,gif,png,jpeg]');
            }

            if (isset($_FILES["image_2"]["name"]) && !empty($_FILES["image_2"]["name"])) {
                $this->form_validation->set_rules('image_2', 'Image', 'callback_file_validate[yes.image_2.jpg,gif,png,jpeg]');
            }

            if($this->input->post('button_name')){
                $this->form_validation->set_rules('hyperlink', 'hyperlink', 'trim|required');
            }

            if($this->input->post('hyperlink')){
                 $this->form_validation->set_rules('button_name', 'Button Name', 'trim|required');
            }

            $this->form_validation->set_rules('status', 'Status', 'trim');
            $this->form_validation->set_error_delimiters('<br>', '');

            // check the validation
            if ($this->form_validation->run()) {

                $addData['title_one'] = $this->input->post('title_one');
                $addData['title_two'] = $this->input->post('title_two');
                $addData['title_three'] = $this->input->post('title_three');
                $addData['description'] = $this->input->post('description');
                $addData['button_name'] = $this->input->post('button_name');
                $addData['hyperlink'] = $this->input->post('hyperlink');
                $addData['status'] = $this->input->post('status');

                if (isset($_FILES["banner_image"]["name"]) && $_FILES["banner_image"]["name"]) {

                    // delete all image 
                    if (!empty($banner->image_name)) {
                        if (file_exists($this->_moduleImagePath . $banner->image_name)) {
                            unlink($this->_moduleImagePath . $banner->image_name);
                            unlink($this->_moduleImagePath . 'original/' . $banner->image_name);
                            unlink($this->_moduleImagePath . 'thumbs/' . $banner->image_name);
                        }
                    }

                    // upload photo
                    $imageName = time();
                    $addData['image_name'] = $photo = $this->file_processing->image_upload('banner_image', './' . $this->_moduleImagePath . 'original/', 'size[1600, 9999]', 'jpg|jpeg|png|gif', $imageName);

                    $initPath = './' . $this->_moduleImagePath . 'original/' . $photo; // original
                    $mainPath = './' . $this->_moduleImagePath . $photo; // main image path
                    $thumbsPath = './' . $this->_moduleImagePath . 'thumbs/' . $photo; // thumbs path
                    // resizing the image
                    img_resize($initPath, $mainPath, $this->_getImageSize['original']); // main path image
                    img_resize($initPath, $thumbsPath, $this->_getImageSize['thumbs']); // resize with thumbs
                }

                if (isset($_FILES["image_2"]["name"]) && $_FILES["image_2"]["name"]) {

                    // delete all image 
                    if (!empty($banner->image_2)) {
                        if (file_exists($this->_moduleImagePath . $banner->image_2)) {
                            unlink($this->_moduleImagePath . $banner->image_2);
                            unlink($this->_moduleImagePath . 'original/' . $banner->image_2);
                            unlink($this->_moduleImagePath . 'thumbs/' . $banner->image_2);
                        }
                    }

                    // upload photo
                    $imageName = time();
                    $addData['image_2'] = $photo = $this->file_processing->image_upload('image_2', './' . $this->_moduleImagePath . 'original/', 'size[1600, 9999]', 'jpg|jpeg|png|gif', $imageName);

                    $initPath = './' . $this->_moduleImagePath . 'original/' . $photo; // original
                    $mainPath = './' . $this->_moduleImagePath . $photo; // main image path
                    $thumbsPath = './' . $this->_moduleImagePath . 'thumbs/' . $photo; // thumbs path
                    // resizing the image
                    img_resize($initPath, $mainPath, $this->_getImageSize2['original']); // main path image
                    img_resize($initPath, $thumbsPath, $this->_getImageSize2['thumbs']); // resize with thumbs
                }

                if ($this->banner->update($addData, $id)) {
                    $this->session->set_flashdata('success_msg', 'Banner Updated Successfully!!');
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
        if ($info = $this->banner->getSingleInfo($id)) {
            if ($this->banner->delete($id)) {
                if ($info->image_name) {
                    if (file_exists($this->_moduleImagePath . $info->image_name)) {
                        unlink($this->_moduleImagePath . $info->image_name);
                        unlink($this->_moduleImagePath . 'original/' . $info->image_name);
                        unlink($this->_moduleImagePath . 'thumbs/' . $info->image_name);
                    }
                }
                $this->session->set_flashdata('success_msg', 'Item Deleted Successfully !!');
            }
        }

        redirect(admin_url($this->_module));
    }

    // file validation
    public function file_validate($fieldValue, $params) {

        // get the parameter as variable
        list($require, $fieldName, $type) = explode('.', $params);

        // get the file field name
        $filename = $_FILES[$fieldName]['name'];

        if ($filename == '' && $require == 'yes') {
            $this->form_validation->set_message('file_validate', 'The %s field is required');
            return FALSE;
        } else if ($type != '' && $filename != '') {
            // get the extention
            $ext = strtolower(substr(strrchr($filename, '.'), 1));
            // get the type as array
            $types = explode(',', $type);
            if (!in_array($ext, $types)) {
                $this->form_validation->set_message('file_validate', 'The %s field must be ' . implode(' OR ', $types) . ' !!');
                return FALSE;
            }
        } else {
            return TRUE;
        }
    }

}

/* End of file Banner.php */
/* Location: ./application/controllers/perfectadmin/Banner.php */