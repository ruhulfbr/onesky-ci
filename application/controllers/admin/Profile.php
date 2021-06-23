<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public $_pageGroup;
    public $module;
    public $_leftMenu;
    public $_moduleImagePath;
    public $_moduleAchievementImagePath;

    function __construct() {
        parent::__construct();

        //check login if user is login or not if nor redirect to login page
        if (!loginCheck()) {
            $this->session->set_flashdata('success_msg', 'Please Login First !!');
            redirect(admin_url('auth/login'));
        }
        // load specific variable
        $this->_pageGroup = "Profile";
        $this->module = "printadmin/profile";
        $this->_moduleAchievementImagePath = 'assets/media/achievement/';

        // load specific model
        $this->load->model('admin/user_model');
        // load the custom file processing library
        $this->load->library('file_processing');
    }

    // admin panel dashboard
    public function dashboard() {

        $this->session->set_userdata('return_url', admin_url('profile/dashboard')); // set the last visit page
        // set the page name
        $data['module'] = $this->module;
        $data['pageGroup'] = "Dashboard";
        $data['pageTitle'] = "Dashboard";
        $data['tabActive'] = "dashboard";
        $data['page'] = 0;

        $data['bannerGallery'] = $bannerGallery = $this->global_model->getDashboardGallery('banners', 4);
        $data['totalBanners'] = $this->global_model->countRow('banners');
        $data['totalMember'] = $this->global_model->countRow('member');
        $data['totalVideo'] = $this->global_model->countRow('video');
        $data['totalGallery'] = $this->global_model->countRow('gallery');

        $data['projectGallery'] = $projectGallery = $this->global_model->getProjectDashboard(4);
        $data['photoGallery'] = $photoGallery = $this->global_model->getGalleryDashboard(4);

        // load the views
        $data['required_contents'] = $this->load->view('admin/dashboard', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    // view information based on id
    public function view($popup = FALSE) {

        $this->session->set_userdata('return_url', $this->module . '/view/' . $this->session->userdata('user_id')); // set the last visit page
        // set the page name
        $data['pageGroup'] = $this->_pageGroup;
        $data['pageTitle'] = "View My Profile";
        $data['module'] = $this->module;
        $data['popup'] = $popup;
        $data['leftMenu'] = $this->_leftMenu;

        // get the specific information based on ID
        $data['viewData'] = $this->user_model->getSingleUserInfo($this->session->userdata('user_id'));

        // load the views
        if (!$popup) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/leftmenu', $data);
        }
        $this->load->view($this->module . '/view', $data);
        if (!$popup)
            $this->load->view('admin/footer', $data);
    }

    // Update basic information
    public function edit() {

        $this->session->set_userdata('return_url', $this->module . '/edit/' . $this->session->userdata('user_id')); // set the last visit page
        // set the page name
        $data['pageTitle'] = "Profile Modify";
        $data['tabActive'] = "";

        // get the specific information based on ID
        $info = $this->user_model->getSingleUserInfo($this->session->userdata('user_id'));
        // set the value for first time view
        $data['user_id'] = $info->user_id;
        $data['user_name'] = $info->user_name;
        $data['first_name'] = $info->first_name;
        $data['last_name'] = $info->last_name;
        $data['email'] = $info->email;
        $data['phone'] = $info->phone;
        $data['photo'] = $info->photo;

        $id = $this->session->userdata('user_id');


        // check if click on the submit button
        if ($this->input->post('profileInfoSubmit')) {
            // set the submit data
            $updateData['first_name'] = $data['first_name'] = $this->input->post('first_name');
            $updateData['last_name'] = $data['last_name'] = $this->input->post('last_name');
            $updateData['phone'] = $data['phone'] = $this->input->post('phone');
            // add the validation
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim');
            $this->form_validation->set_rules('phone', 'Phone Number ', 'trim');

            //run the validation
            if ($this->form_validation->run()) {
                if ($this->user_model->update($updateData, $this->session->userdata('user_id'))) {
                    // set the successfull message and redirect
                    $this->session->set_flashdata('success_msg', 'Profile Info Update Successfully!!');
                    redirect(admin_url('profile/edit'));
                }
            } else {
                $data['error'] = validation_errors();
            }
        }

        // check if click on the submit button
        if ($this->input->post('avatarSubmit')) {
            // check the validation
            $this->form_validation->set_rules('photo', 'Avatar Photo', 'callback_file_validate[no.photo.jpg,gif,png]');

            if ($this->form_validation->run()) {
                if (isset($_FILES["photo"]["name"]) && $_FILES["photo"]["name"]) {

                    $updateData['photo'] = $this->file_processing->image_upload('photo', './assets/media/admin_user/', 'size[160,201|48,60]');
                    if ($updateData['photo'])
                        $this->file_processing->delete_multiple($data['photo'], './assets/media/admin_user/');
                }

                if (!empty($updateData)) {
                    if ($this->user_model->update($updateData, $this->session->userdata('user_id'))) {
                        // set the successfull message and redirect
                        $this->session->set_flashdata('success_msg', 'Avatar Photo Change Successfully!!');
                        redirect(admin_url('profile/edit'));
                    } else {
                        $data['error'] = mysql_error();
                    }
                }
            } else {
                $data['error'] = validation_errors();
            }
        }

        // check if click on the submit button
        if ($this->input->post('passwordSubmit')) {
            // check the validation
            $this->form_validation->set_rules('old_password', 'Old Password', 'required');
            $this->form_validation->set_rules('password', 'New Password', 'required|min_length[6]|max_length[30]|matches[confirm_new_password]');
            $this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'required|min_length[6]|max_length[30]');

            if ($this->form_validation->run()) {
                $input_pass = geneSecurePass($this->input->post('old_password'), $info->secret);
                if ($input_pass == $info->password) {
                    // generate the password and secret code
                    $code = geneSecurePass($this->input->post('password'));
                    $updateData['password'] = $code['password'];
                    $updateData['secret'] = $code['secret'];

                    if ($this->user_model->update($updateData, $this->session->userdata('user_id'))) {
                        // set the successfull message and redirect
                        $this->session->set_flashdata('success_msg', 'Password Update Successfully!!');
                        redirect(admin_url('profile/edit'));
                    } else
                        $data['error_msg'] = mysql_error();
                } else
                    $data['error'] = "Your Given password Does't match";
            }else {
                $data['error'] = validation_errors();
            }
        }

        // load the views
        $data['required_contents'] = $this->load->view('admin/profile_edit', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function changeUserName() {

        $this->session->set_userdata('return_url', $this->module . '/changeUserName/' . $this->session->userdata('user_id')); // set the last visit page
        // set the page name
        $data['pageGroup'] = $this->_pageGroup;
        $data['pageTitle'] = "Change User Name";
        $data['module'] = $this->module;
        $data['leftMenu'] = $this->_leftMenu;

        // get the specific information based on ID
        $info = $this->user_model->getSingleUserInfo($this->session->userdata('user_id'));
        // set the value for first time view
        $data['user_id'] = $info->user_id;
        $data['user_name'] = $info->user_name;

        // check if click on the submit button
        if ($this->input->post('Update')) {
            // set the submit data
            $updateData['user_name'] = $data['user_name'] = $this->input->post('user_name');
            // check the validation
            $this->form_validation->set_rules('user_name', 'User Name', 'required|min_length[6]|max_length[30]|callback_exists_check[users,user_name,user_id,' . $this->session->userdata('user_id') . ']');

            if ($this->form_validation->run()) {

                if ($this->user_model->update($updateData, $this->session->userdata('user_id'))) {
                    // set the successfull message and redirect
                    $this->session->set_flashdata('success_msg', $this->_pageGroup . ' Update Successfully!!');
                    redirect($this->module . '/view');
                } else
                    $data['error_msg'] = mysql_error();
            }
        }

        // load the views
        $this->load->view('admin/header', $data);
        $this->load->view('admin/leftmenu', $data);
        $this->load->view($this->module . '/change_user_name', $data);
        $this->load->view('admin/footer', $data);
    }

    // change the user password
    public function changePassword() {

        $this->session->set_userdata('return_url', $this->module . '/changeUserName/' . $this->session->userdata('user_id')); // set the last visit page
        // set the page name
        $data['pageGroup'] = $this->_pageGroup;
        $data['pageTitle'] = "Change Password";
        $data['module'] = $this->module;
        $data['leftMenu'] = $this->_leftMenu;

        // get the specific information based on ID
        $info = $this->user_model->getSingleUserInfo($this->session->userdata('user_id'));
        // set the value for first time view
        $data['user_id'] = $info->user_id;

        // check if click on the submit button
        if ($this->input->post('Update')) {
            // check the validation
            $this->form_validation->set_rules('old_password', 'Old Password', 'required');
            $this->form_validation->set_rules('password', 'New Password', 'required|min_length[6]|max_length[30]|matches[confirm_new_password]');
            $this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'required|min_length[6]|max_length[30]');

            if ($this->form_validation->run()) {
                $input_pass = geneSecurePass($this->input->post('old_password'), $info->secret);
                if ($input_pass == $info->password) {
                    // generate the password and secret code
                    $code = geneSecurePass($this->input->post('password'));
                    $updateData['password'] = $code['password'];
                    $updateData['secret'] = $code['secret'];

                    if ($this->user_model->update($updateData, $this->session->userdata('user_id'))) {
                        // set the successfull message and redirect
                        $this->session->set_flashdata('success_msg', $this->_pageGroup . ' Update Successfully!!');
                        redirect($this->module . '/view');
                    } else
                        $data['error_msg'] = mysql_error();
                } else
                    $data['error_msg'] = "Your Given password Does't match";
            }
        }

        // load the views
        $this->load->view('admin/header', $data);
        $this->load->view('admin/leftmenu', $data);
        $this->load->view($this->module . '/change_password', $data);
        $this->load->view('admin/footer', $data);
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

    // field existing check
    public function exists_check($fieldValue, $params) {
        $param = explode(',', $params);
        $foundData = $this->global_model->existingCheck($fieldValue, $param[0], $param[1], $param[2], $param[3]);

        if (count($foundData)) {
            $this->form_validation->set_message('exists_check', 'The %s is already taken by other!! ');
            return FALSE;
        } else
            return TRUE;
    }

}

/* End of file Profile.php */
/* Location: ./application/controllers/perfectadmin/Profile.php */