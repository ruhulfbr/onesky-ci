<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    function __construct() {
        parent::__construct();
        // load the specific model
        //$this->load->model('admin/settings_model', 'settings');
        //check login if user is login or not if nor redirect to login page
        if (!loginCheck()) {
            $this->session->set_flashdata('success_msg', 'Please Login First!!');
            redirect('admin/auth/login');
        }
    }

    public function email_receiver() {
        $data['tabActive'] = 'settings';
        $data['subTabActive'] = 'email_receiver';
        $data['pageGroup'] = "Settings";
        $data['pageTitle'] = "Email Receiver Address";

        $data['breadcrumbs'] = array(admin_url('settings/email_receiver') => 'Settings', '' => 'Email Receiver Address'); //blank key for current item
        $data['email'] = $this->global_model->get_data('sconfig', array('name' => 'email_receiver'));

        if ($this->input->post('save')) {
            $email = $this->input->post('email');

            if ($this->global_model->get_row('sconfig', array('name' => 'email_receiver'))) {
                $this->global_model->update('sconfig', array('value' => $email), array('name' => 'email_receiver'));
            } else {
                $this->global_model->insert('sconfig', array('name' => 'email_receiver', 'value' => $email));
            }

            //add log
            $logData = array();
            $logData['type'] = 'settings';
            $logData['message'] = 'Update by ' . $this->session->userdata('email');
            $logData['action_id'] = '';
            $logData['user_id'] = $this->session->userdata('user_id');
            $logData['added'] = date('Y-m-d H:i:s', time());
            addLog($logData);

            $this->session->set_flashdata('success_msg', "Update successfully.");
            redirect(admin_url('settings/email_receiver'));
        }

        // load the views
        $data['inner_contents'] = $this->load->view('admin/settings/email_receiver', $data, TRUE);
        $this->load->view('admin/template', $data);
    }

    public function sms() {
        $data['tabActive'] = 'settings';
        $data['subTabActive'] = 'sms';
        $data['pageGroup'] = "Settings";
        $data['pageTitle'] = "SMS Gateway Access";

        $data['breadcrumbs'] = array(admin_url('settings/sms') => 'Settings', '' => 'SMS Gateway Access'); //blank key for current item
        $data['sms_user'] = $this->global_model->get_data('sconfig', array('name' => 'sms_user'));
        $data['sms_password'] = $this->global_model->get_data('sconfig', array('name' => 'sms_password'));

        if ($this->input->post('save')) {
            $sms_user = $this->input->post('sms_user');
            $sms_password = $this->input->post('sms_password');

            if ($this->global_model->get_row('sconfig', array('name' => 'sms_user'))) {
                $this->global_model->update('sconfig', array('value' => $sms_user), array('name' => 'sms_user'));
            } else {
                $this->global_model->insert('sconfig', array('name' => 'sms_user', 'value' => $sms_user));
            }

            if ($this->global_model->get_row('sconfig', array('name' => 'sms_password'))) {
                $this->global_model->update('sconfig', array('value' => $sms_password), array('name' => 'sms_password'));
            } else {
                $this->global_model->insert('sconfig', array('name' => 'sms_password', 'value' => $sms_password));
            }

            //add log
            $logData = array();
            $logData['type'] = 'settings';
            $logData['message'] = 'SMS Gateway Access setting update by ' . $this->session->userdata('email');
            $logData['action_id'] = '';
            $logData['user_id'] = $this->session->userdata('user_id');
            $logData['added'] = date('Y-m-d H:i:s', time());
            addLog($logData);

            $this->session->set_flashdata('success_msg', "Update successfully.");
            redirect(admin_url('settings/sms'));
        }

        // load the views
        $data['inner_contents'] = $this->load->view('admin/settings/sms', $data, TRUE);
        $this->load->view('admin/template', $data);
    }

}

/* End of file Settings.php */
/* Location: ./application/controllers/perfectadmin/Settings.php */