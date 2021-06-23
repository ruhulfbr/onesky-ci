<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public $user_type;
    public $module;

    function __construct() {
        parent::__construct();
        // load the specific model
        $this->load->model('admin/user_model');

        // set the global variable
        $this->user_type = 'User';
        $this->module = 'printadmin/user';

        // load the custom file processing library
        $this->load->library('file_processing');

        //check login if user is login or not if nor redirect to login page
        if (!loginCheck()) {
            $this->session->set_flashdata('success_msg', 'Please Login First!!');
            redirect('admin/auth/login');
        }
    }

    // create new information
    public function add() {

        $this->session->set_userdata('return_url', $this->module . '/create'); // set the last visit page
        // set the page name
        $data['module'] = $this->module;
        $data['pageGroup'] = $this->user_type;
        $data['pageTitle'] = "Add New " . $this->user_type;
        $data['tabActive'] = 'user';
        $data['subTabActive'] = 'user';

        $data['breadcrumbs'] = array(admin_url('user') => 'Users', '' => 'Add'); //blank key for current item
        // check if click on the submit button
        if ($this->input->post('submit')) {

            // write the validation rule
            $this->form_validation
                    //->set_rules('level_id', 'User Level', 'required')
                    // ->set_rules('user_name', 'User Name', 'required|min_length[6]|max_length[30]|is_unique[users.user_name]')
                    ->set_rules('email', 'E-mail', 'required|valid_email|is_unique[users.email]')
                    ->set_rules('password', 'Password', 'required')
                    //->set_rules('confirm_password', 'Confirm Password', 'required')
                    ->set_rules('first_name', 'First Name', 'required')
                    ->set_rules('last_name', 'Last Name', 'trim')
                    ->set_rules('photo', 'User Photo', 'callback_file_validate[no.photo.jpg,gif,png]')
                    ->set_rules('phone', 'Phone Number ', 'required|numeric');
            // check the validation
            if ($this->form_validation->run()) {
                // receved the post value and store into array               
                $addData['level_id'] = 1;
                $addData['user_name'] = $this->input->post('email');
                $addData['email'] = $this->input->post('email');
                // generate the password and secret code
                $code = geneSecurePass($this->input->post('password'));
                $addData['password'] = $code['password'];
                $addData['secret'] = $code['secret'];
                $addData['first_name'] = $this->input->post('first_name');
                $addData['last_name'] = $this->input->post('last_name');
                $addData['photo'] = $this->file_processing->image_upload('photo', './assets/admin/media/user_image/', 'size[160,201|48,60]');
                $addData['phone'] = $this->input->post('phone');
                $addData['create_date'] = date('Y-m-d H:i;s');
                // call the crate model and inset into database
                if ($this->user_model->create($addData)) {
                    // set the successfull message and redirect                  
                    $this->session->set_flashdata('success_msg', 'New ' . $this->user_type . ' Add Successfully!!');
                    redirect($this->module);
                } else
                    $data['error'] = validation_errors();
            }else {
                $data['error'] = validation_errors();
            }
        }

        // load the views
        $data['inner_contents'] = $this->load->view('admin/user/add', $data, TRUE);
        $this->load->view('admin/template', $data);
    }

    // manage all information
    public function index() {
        $this->session->set_userdata('return_url', $this->module . '/index'); // set the last visit page
        // set the page name
        $data['module'] = $this->module;
        $data['tabActive'] = 'user';
        $data['subTabActive'] = 'user';
        $data['pageGroup'] = $this->user_type;
        $data['pageTitle'] = "Manage " . $this->user_type . "'s";

        $data['breadcrumbs'] = array('' => 'Users'); //blank key for current item
        // get the all information
        $data['users'] = $this->user_model->getAll(0);

        // load the views
        $data['inner_contents'] = $this->load->view('admin/user/index', $data, TRUE);
        $this->load->view('admin/template', $data);
    }

    // view specific information based on id
    public function view($id, $popup = FALSE) {

        $this->session->set_userdata('return_url', $this->module . '/view/' . $id); // set the last visit page
        // set the page name
        $data['module'] = $this->module;
        $data['pageGroup'] = $this->user_type;
        $data['pageTitle'] = "View " . $this->user_type;
        $data['popup'] = $popup;
        $data['leftMenu'] = $this->_leftMenu;

        // get the specific information based on ID
        $data['viewData'] = $this->user_model->getSingleUserInfo($id);

        // load the views
        if (!$popup) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/leftmenu', $data);
        }
        $this->load->view($this->module . '/view', $data);
        if (!$popup)
            $this->load->view('admin/footer', $data);
    }

    // admin panel add new course type
    public function edit($id) {

        $this->session->set_userdata('return_url', $this->module . '/edit/' . $id); // set the last visit page
        // set the page name
        $data['module'] = $this->module;
        $data['pageGroup'] = $this->user_type;
        $data['tabActive'] = 'user';
        $data['subTabActive'] = 'user';
        $data['pageTitle'] = "Edit " . $this->user_type;

        // get the specific information based on ID
        $info = $this->user_model->getSingleUserInfo($id);
        // set the value for first time view
        $data['user_id'] = $info->user_id;
        $data['user_name'] = $info->user_name;
        $data['email'] = $info->email;
        $data['first_name'] = $info->first_name;
        $data['last_name'] = $info->last_name;
        $data['photo'] = $info->photo;
        $data['phone'] = $info->phone;
        $data['status'] = $info->status;

        // check if click on the submit button
        if ($this->input->post('submit')) {
            // set the submit data

            $updateData['user_name'] = $data['user_name'] = $this->input->post('user_name');
            $updateData['first_name'] = $data['first_name'] = $this->input->post('first_name');
            $updateData['last_name'] = $data['last_name'] = $this->input->post('last_name');
            $updateData['email'] = $data['email'] = $this->input->post('email');
            $updateData['phone'] = $data['phone'] = $this->input->post('phone');
            $updateData['status'] = $data['status'] = $this->input->post('status');

            // check the validation
            // $this->form_validation->set_rules('user_name', 'User Name', 'required|min_length[6]|max_length[30]|callback_exists_check[users,user_name,user_id,' . $id . ']');
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim');
            $this->form_validation->set_rules('photo', 'User Photo', 'callback_file_validate[no.photo.jpg,gif,png]');
            $this->form_validation->set_rules('email', 'User Mail', 'required|valid_email|callback_exists_check[users,email,user_id,' . $id . ']');
            $this->form_validation->set_rules('phone', 'Phone Number ', 'required');
            // $this->form_validation->set_rules('status', 'User Status', 'required');
            // password reset option 
            if ($this->input->post('password')) {
                $code = geneSecurePass($this->input->post('password'));
                $updateData['password'] = $code['password'];
                $updateData['secret'] = $code['secret'];
            }
            if ($this->form_validation->run()) {

                if (isset($_FILES["photo"]["name"]) && $_FILES["photo"]["name"]) {
                    $updateData['photo'] = $this->file_processing->image_upload('photo', './uploads/user_image/', 'size[150,157|50,50]');
                    if (isset($updateData['photo']))
                        $this->file_processing->delete_multiple($data['photo'], './uploads/user_image/');
                }
                if ($this->user_model->update($updateData, $id)) {
                    // set the successfull message and redirect
                    $this->session->set_flashdata('success_msg', $this->user_type . ' Update Successfully!!');
                    redirect($this->module);
                } else
                    $data['error_msg'] = mysql_error();
            }else {
                $data['error'] = validation_errors();
            }
        }

        // load the views
        $data['inner_contents'] = $this->load->view('admin/user/edit', $data, TRUE);
        $this->load->view('admin/template', $data);
    }

    // delete the specific record based on ID
    public function delete($id) {
        // get the specfic recoed item
        $item = $this->user_model->getSingleUserInfo($id);

        // path of the image file
        $path = './assets/admin/media/user_image/';

        if ($this->file_processing->delete_multiple($item->photo, $path)) {
            // delete the record from database
            if ($this->user_model->delete($id)) {
                $this->session->set_flashdata('success_msg', 'Delete Successfully !!');
                redirect($this->module);
            }
        }
    }

    // field existing check
    public function exists_check($fieldValue, $params) {
        $param = explode(',', $params);
        $foundData = $this->global_model->existingCheck($fieldValue, $param[0], $param[1], $param[2], $param[3]);
        if (count($foundData)) {
            $this->form_validation->set_message('exists_check', 'The %s field is already exists!! ');
            return FALSE;
        } else
            return TRUE;
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
        } elseif ($type != '' && $filename != '') {
            // get the extention
            $ext = strtolower(substr(strrchr($filename, '.'), 1));
            // get the type as array
            $types = explode(',', $type);
            if (!in_array($ext, $types)) {
                $this->form_validation->set_message('file_validate', 'The %s field must be ' . implode(' OR ', $types) . ' !!');
                return FALSE;
            }
        } else
            return TRUE;
    }

}

/* End of file User.php */
/* Location: ./application/controllers/perfectadmin/User.php */