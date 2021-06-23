<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

    public $_module;
    public $_viewPath;
    public $_moduleName;
    public $_getImageSize;
    public $_moduleImagePath;
    public $_setImageLimit;
    public $_fileName;

    function __construct() {
        parent::__construct();

        if (!loginCheck()) {
            $this->session->set_userdata('return_url', current_url()); // set the last visit page
            $this->session->set_flashdata('success_msg', 'Please Login First !!');
            redirect(admin_url('auth/login'));
        }

        $this->_getImageSize = array(
            'original' => array('width' => 945, 'height' => 468, 'crop' => FALSE),
            'thumbs'   => array('width' => 338, 'height' => 220, 'crop' => TRUE),
        );

        $this->_module          = 'news';
        $this->_moduleName      = 'News';
        $this->_viewPath        = 'admin/news/';
        $this->_moduleImagePath = 'assets/media/news/';
        $this->_setImageLimit   = 10240;
        $this->_fileName        = time();

        $this->load->library('file_processing');
        $models = array(
            'admin/News_model' => 'news_model',
        );
        $this->load->model($models);
    }

    public function index($id = false) {

        // set the page name
        $data = array();
        $data['pageTitle']          = "Manage " . $this->_moduleName;
        $data['moduleImagePath']    = $this->_moduleImagePath;
        $data['tabActive']          = $this->_module;
        $data['subTabActive']       = $this->_module . "_manage";
        // get the all information
        $data['allData']            = $this->news_model->getAllnewsData();
        // load the views
        $data['required_contents']  = $this->load->view($this->_viewPath . 'manage', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function add() {

        $data = array();
        $data['tabActive']      = $this->_module;
        $data['subTabActive']   = $this->_module . "_add";
        $data['pageTitle']      = "Create " . $this->_moduleName;
        if ($this->input->post('submit')) {

            $this->form_validation
                ->set_rules('title', 'news title', 'trim|required')
                ->set_rules('description', 'News Details', 'trim')
                ->set_rules('news_author', 'News Author', 'trim')
                ->set_rules('news_date', 'News Date', 'trim|required|date')
                ->set_rules('image_name', 'News Images', 'callback_file_validate[yes.image_name.jpg,jpeg,gif,png]')
            ;

            if ($this->form_validation->run()) {
                $addData = array();
                $addData['title']        = $this->input->post('title');
                $addData['description']  = $this->input->post('description');
                $addData['news_author']  = $this->input->post('news_author');
                $addData['news_date']    = $this->input->post('news_date');
                $addData['status']       = $this->input->post('status');

                // upload photo
                $imageName = time();
                $photo = $this->file_processing->image_upload('image_name', './' . $this->_moduleImagePath . 'original/', 'size[1000,9999]', 'jpg|jpeg|png|gif', $imageName);
                $initPath   = './'    .$this->_moduleImagePath  . 'original/' . $photo; // original
                $mainPath   = './'    .$this->_moduleImagePath  . $photo; // main image path
                $thumbsPath = './'    .$this->_moduleImagePath  . 'thumbs/' . $photo; // thumbs path
                // resizing the image
                img_resize($initPath, $mainPath,   $this->_getImageSize['original']); // main path image
                img_resize($initPath, $thumbsPath, $this->_getImageSize['thumbs']); // resize with thumbs

                $addData['image_name'] = $photo ? $photo : '';
                $addData['created_at'] = date('Y-m-d H:i:s');
                if ($this->global_model->insert('news', $addData)){
                    $this->session->set_flashdata('success_msg', 'New news Added Successfully !!');
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

        $data = array();
        $data['tabActive']      = $this->_module;
        $data['subTabActive']   = $this->_module . "_manage";
        $data['allData']        = $allData = $this->news_model->getSingleInfo($id);

        if ($this->input->post('submit')) {

            $this->form_validation
                ->set_rules('title', 'news title', 'trim|required')
                ->set_rules('news_author', 'news author', 'required')
                ->set_rules('description', 'news Description', 'trim')
            ;
            if (isset($_FILES["image_name"]["name"]) && !empty($_FILES["image_name"]["name"])) {
                $this->form_validation->set_rules('image_name', 'Image', 'callback_file_validate[yes.image_name.jpg,gif,png]');
            }
            // check the validation
            if ($this->form_validation->run()) {
                $addData = array();
                $addData['title']        = $this->input->post('title')       ?  $this->input->post('title')       : $allData->title;
                $addData['description']  = $this->input->post('description') ?  $this->input->post('description') : $allData->description;
                $addData['news_author']  = $this->input->post('news_author') ?  $this->input->post('news_author') : $allData->news_author;
                $addData['news_date']    = $this->input->post('news_date')   ?  $this->input->post('news_date')   : $allData->description;
                $addData['modified_at']  = date('Y-m-d H:i:s');

                if (isset($_FILES["image_name"]["name"]) && $_FILES["image_name"]["name"]) {
                    // delete all image
                    if (!empty($allData->image_name)) {
                        if (file_exists($this->_moduleImagePath . $allData->image_name)) {

                            if (file_exists($this->_moduleImagePath . $allData->image_name)) {
                                unlink($this->_moduleImagePath . $allData->image_name);
                            }

                            if (file_exists($this->_moduleImagePath . 'original/' . $allData->image_name)) {
                                unlink($this->_moduleImagePath . 'original/' . $allData->image_name);
                            }

                            if (file_exists($this->_moduleImagePath . 'thumbs/' . $allData->image_name)) {
                                unlink($this->_moduleImagePath . 'thumbs/' . $allData->image_name);
                            }
                        }
                    }
                    // upload photo
                    $imageName = time();
                    $photo = $this->file_processing->image_upload('image_name', './' . $this->_moduleImagePath . 'original/', 'size[1000,9999]', 'jpg|jpeg|png|gif', $imageName);
                    $initPath   = './'    .$this->_moduleImagePath  . 'original/' . $photo; // original
                    $mainPath   = './'    .$this->_moduleImagePath  . $photo; // main image path
                    $thumbsPath = './'    .$this->_moduleImagePath  . 'thumbs/' . $photo; // thumbs path
                    // resizing the image
                    img_resize($initPath, $mainPath,   $this->_getImageSize['original']); // main path image
                    img_resize($initPath, $thumbsPath, $this->_getImageSize['thumbs']); // resize with thumbs
                    $addData['image_name'] = $photo ? $photo : '';
                }

                if ($this->news_model->update($addData, $id)) {
                    $this->session->set_flashdata('success_msg', 'Updated Successfully !');
                    redirect(admin_url($this->_module));
                }else{
                    $data['error'] = mysql_error();
                }
            } else {
                $data['error'] = validation_errors();
            }
        }
        $data['required_contents'] = $this->load->view($this->_viewPath . 'update', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function view($id) {

        $data = array();
        $data['get_info']       = $this->news_model->getSingleNewsData($id);
        $data['pageTitle']      = "View of " . $data['get_info']->title;
        $data['tabActive']      = $this->_module;
        $data['subTabActive']   = $this->_module . "_manage";

        //Check data
        if (empty($data['get_info'])) {
            $this->session->set_flashdata('error_msg', 'No data found!!');
            redirect($this->_module);
        }

        // load the views
        $data['required_contents'] = $this->load->view($this->_viewPath . 'view', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function delete($id) {

        $newsData = $this->news_model->getSingleInfo($id);

        if (!empty($newsData->image_name)) {
            if (file_exists($this->_moduleImagePath . $newsData->image_name)) {

                if (file_exists($this->_moduleImagePath . $newsData->image_name)) {
                    unlink($this->_moduleImagePath . $newsData->image_name);
                }

                if (file_exists($this->_moduleImagePath . 'original/' . $newsData->image_name)) {
                    unlink($this->_moduleImagePath . 'original/' . $newsData->image_name);
                }

                if (file_exists($this->_moduleImagePath . 'thumbs/' . $newsData->image_name)) {
                    unlink($this->_moduleImagePath . 'thumbs/' . $newsData->image_name);
                }
            }
        }

        // delete the news
        if ($this->global_model->delete($this->_module, array('id' => $id))) {
            $this->session->set_flashdata('success_msg', 'Item Deleted Successfully !!');
            redirect(admin_url($this->_module));
        }
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

/* End of file news.php */
/* Location: ./application/controllers/extremeadmin/news.php */

