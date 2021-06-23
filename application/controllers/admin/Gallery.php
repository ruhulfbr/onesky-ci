<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

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
            'original' => array('width' => 1600, 'height' => 800, 'crop' => FALSE),
            'small' => array('width' => 360, 'height' => 300, 'crop' => FALSE),
        );

        // load specific model & library
        $this->load->model('admin/gallery_model', 'gallery');
        $this->load->library('file_processing');

        $this->_module = 'gallery';
        $this->_moduleName = 'Gallery';
        $this->_moduleImagePath = 'assets/media/gallery/';
        $this->_viewPath = 'admin/gallery/';
    }

    // manage all information
    public function index($id = false) {

        $data['pageTitle'] = "Manage " . $this->_moduleName;
        $data['moduleImagePath'] = $this->_moduleImagePath;

        $data['gallery_id'] = $id;
        $data['tabActive'] = $this->_module;
        $data['subTabActive'] = $this->_module . "_manage";

        if ($id && ($gallery = $this->gallery->getSingleInfo($id))) {
            $data['gallery'] = $gallery;
        }

        // Set Pagination
        $perPage = 8;
        $uriSegment = 4;

        $data['offset'] = $offset = 0;
        if ($this->uri->segment($uriSegment) === FALSE) {
            $data['offset'] = $offset = 0;
        } else {
            $data['offset'] = $offset = $this->uri->segment($uriSegment) ? $this->uri->segment($uriSegment) : 0;
        }

        // get the all information
        $result = $this->gallery->getAll($perPage, $offset);

        $data['allData'] = $result['result'];
        $totalRow = $result['totalRow'];
        generatePagging('perfectadmin/gallery/index', $totalRow, $perPage, $uriSegment, 4);

        // load the views
        $data['required_contents'] = $this->load->view($this->_viewPath . 'gallery', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function add() {

        $data = array();
        $data['tabActive'] = $this->_module;
        $data['subTabActive'] = $this->_module . "_add";

        if ($this->input->post('submit')) {

            $this->form_validation
                    ->set_rules('title', 'Title', 'trim|required')
                    ->set_rules('gallery_images', 'Images', 'callback_file_validate[yes.gallery_images.jpg,jpeg,gif,png]')
            ;

            if ($this->form_validation->run()) {

                $addData['title'] = $this->input->post('title');
                $addData['created'] = date('Y-m-d H:i:s');
                
                if ($this->gallery->create($addData)) {
                    $typeId = $this->db->insert_id();
                  
                    if ($this->multiplePhotoUpload('gallery_images', $typeId)) {
                        $this->session->set_flashdata('success_msg', 'New Album added Successfully !');
                        redirect(admin_url($this->_module));
                    }
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

        $data['allData'] = $allData = $this->gallery->getSingleInfo($id);
        $data['photos'] = $photos = $this->global_model->get('media', array('type_id' => $id, 'type' => $this->_module));

        if ($this->input->post('submit')) {
            // write the validation rule
            $this->form_validation
                    ->set_rules('title', 'Title', 'trim|required')
                    ->set_rules('gallery_images', 'Images', 'callback_file_validate[no.gallery_images.jpg,jpeg,gif,png]')
            ;

            // check the validation
            if ($this->form_validation->run()) {
                $addData['title'] = $this->input->post('title');
                $addData['modified'] = date('Y-m-d H:i:s');

                $captionOld = $this->input->post('caption_old');
                // $cover = $this->input->post('is_home_old');
                // $cover = !empty($this->input->post('is_home_old')) ? $this->input->post('is_home_old') : $this->input->post('is_home');

                if (!empty($photos)) {
                    foreach ($photos as $key => $photo) {

                        $photoData = array(
                            'type_id' => $photo->type_id,
                            'title' => $captionOld[$key],
                                // 'is_home' => (($cover == $key) ? 1 : 0),
                        );
                        $this->global_model->update('media', $photoData, array('id' => $photo->id));
                    }
                }

                if ($this->gallery->update($addData, $id)) {
                    if (array_filter($_FILES['gallery_images']['name'])) {
                        $this->multiplePhotoUpload('gallery_images', $id);
                    }

                    $this->session->set_flashdata('success_msg', 'Updated Successfully !');
                    redirect(admin_url($this->_module));
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
        $data['get_info'] = $this->gallery->getSingleInfo($id);
        $data['pageTitle'] = "View of " . $data['get_info']->title;
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

        // get the specfic record item
        $allPhotos = $this->global_model->get('media', array('type' => $this->_module, 'type_id' => $id));
        if (!empty($allPhotos) && count($allPhotos) > 0) {
            foreach ($allPhotos as $photo) {

                // delete the record from database
                if ($photo->images) {
                    if ($this->global_model->delete('media', array('id' => $photo->id, 'type' => $this->_module))) {
                        if (file_exists($this->_moduleImagePath . $photo->images)) {
                            unlink($this->_moduleImagePath . $photo->images);
                        }

                        if (file_exists($this->_moduleImagePath . 'original/' . $photo->images)) {
                            unlink($this->_moduleImagePath . 'original/' . $photo->images);
                        }

                        if (file_exists($this->_moduleImagePath . 'small/' . $photo->images)) {
                            unlink($this->_moduleImagePath . 'small/' . $photo->images);
                        }
                    }
                }
            }
        }

        // delete the album
        if ($this->global_model->delete($this->_module, array('gallery_id' => $id))) {
            $this->session->set_flashdata('success_msg', 'Item Deleted Successfully !!');
            redirect(admin_url($this->_module));
        }
    }

    // delete single photo of a album
    public function delete_photo($photoId, $typeId) {

        // get the specfic recoed item
        $item = $this->global_model->get_data('media', array('type' => $this->_module, 'type_id' => $typeId, 'id' => $photoId));

        // delete the record from database
        if ($this->global_model->delete('media', array('id' => $photoId))) {
            if (file_exists($this->_moduleImagePath . $item['images'])) {
                unlink($this->_moduleImagePath . $item['images']);
                unlink($this->_moduleImagePath . 'small/' . $item['images']);
                unlink($this->_moduleImagePath . 'original/' . $item['images']);
            }
            $this->session->set_flashdata('success_msg', 'Item deleted successfully !!');
            redirect(admin_url($this->_module . '/update/' . $typeId));
        }
    }

    public function deletePhotoDashboard($photoId, $typeId) {
        // get the specfic recoed item
        $item = $this->global_model->get_data('media', array('id' => $photoId, 'type_id' => $typeId));

        // delete the record from database
        if ($this->global_model->delete('media', array('id' => $photoId))) {

            if (file_exists($this->_moduleImagePath . $item['images'])) {
                unlink($this->_moduleImagePath . $item['images']);
                unlink($this->_moduleImagePath . 'small/' . $item['images']);
                unlink($this->_moduleImagePath . 'original/' . $item['images']);
            }
            $this->session->set_flashdata('success_msg', 'Item Delete Successfully !!');
            redirect(admin_url());
        }
    }

    // file validation
    public function file_validate($fieldValue, $params) {
        // get the parameter as variable
        list($require, $fieldName, $type) = explode('.', $params);

        // get the type as array
        $types = explode(',', $type);

        // get the file field name
        $filename = $_FILES[$fieldName]['name'];

        if (is_array($filename)) {
            // filter the array
            $filename = array_filter($filename);

            if (count($filename) == 0 && $require == 'yes') {
                $this->form_validation->set_message('file_validate', 'The %s field is required');
                return FALSE;
            } elseif ($type != '' && count($filename) != 0) {
                foreach ($filename as $aFile) {
                    // get the extention
                    $ext = strtolower(substr(strrchr($aFile, '.'), 1));

                    if (!in_array($ext, $types)) {
                        $this->form_validation->set_message('file_validate', 'The %s field must be ' . implode(' OR ', $types) . ' !!');
                        return FALSE;
                    }
                }
                return true;
            } else {
                return TRUE;
            }
        } else {
            if ($filename == '' && $require == 'yes') {
                $this->form_validation->set_message('file_validate', 'The %s field is required');
                return FALSE;
            } elseif ($type != '' && $filename != '') {
                // get the extention
                $ext = strtolower(substr(strrchr($filename, '.'), 1));

                if (!in_array($ext, $types)) {
                    $this->form_validation->set_message('file_validate', 'The %s field must be ' . implode(' OR ', $types) . ' !!');
                    return FALSE;
                }
            } else
                return TRUE;
        }
    }

    private function multiplePhotoUpload($imageField, $typeId = 0) {

        $photoCount = array();

        // generate the photo name
        $photoName = time();

        // filter the array
        $allFiles = array_filter($_FILES[$imageField]['name']);
       
        // save the photo of album
        foreach ($allFiles as $key => $aPhoto) {

            // populate the single File field 
            $_FILES['photo']['name'] = $_FILES[$imageField]['name'][$key];
            $_FILES['photo']['type'] = $_FILES[$imageField]['type'][$key];
            $_FILES['photo']['tmp_name'] = $_FILES[$imageField]['tmp_name'][$key];
            $_FILES['photo']['size'] = $_FILES[$imageField]['size'][$key];
            $_FILES['photo']['error'] = $_FILES[$imageField]['error'][$key];

            $imageName = $photoName . "_" . $key;
            
            // upload photo
            $photo = $this->file_processing->image_upload('photo', './' . $this->_moduleImagePath . 'original/', 'size[1100,999]', 'jpg|jpeg|png|gif', $imageName);
            
            if (isset($photo['error_msg'])) {
                $photoError = $photo['error_msg'];
            } else {

                $mainPath = './' . $this->_moduleImagePath . $photo;
                $iniPath = './' . $this->_moduleImagePath . 'original/' . $photo; // original image path
                $smallPath = './' . $this->_moduleImagePath . 'small/' . $photo; // small image path

                img_resize($iniPath, $mainPath, $this->_getImageSize['original']);
                img_resize($iniPath, $smallPath, $this->_getImageSize['small']); // small image

                $caption = $this->input->post('caption');
                // $cover = $this->input->post('is_home');
                // generate the photo data
                $photoData = array(
                    'type_id' => $typeId,
                    'images' => $photo,
                    'title' => $caption[$key],
                    // 'is_home' => (($cover == $key) ? 1 : 0),
                    'type' => $this->_module,
                    'created' => date('Y-m-d H:i:s')
                );

                $this->global_model->saveNewMedia($photoData);
                $photoCount[] = array('type_id' => $typeId);
            }
        }

        if (count($photoCount)) {
            return true;
        } else {
            return true;
        }
    }

}

/* End of file Gallery.php */
/* Location: ./application/controllers/perfectadmin/Gallery.php */

