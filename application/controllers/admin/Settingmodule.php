<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settingmodule extends CI_Controller {

    public $_module;
    public $_moduleName;
    public $_viewPath;
    public $_moduleImagePath;
    public $_moduleAttachmentPath;
    public $_getImageSize;
    public $_setImageLimit;
    public $_setPDFLimit;

    function __construct() {

        parent::__construct();

        if (!loginCheck()) {
            $this->session->set_userdata('return_url', current_url()); // set the last visit page
            $this->session->set_flashdata('success_msg', 'Please Login First !!');
            redirect(admin_url('auth/login'));
        }
        $this->_module = 'settingmodule';
        $this->_moduleName = 'Settingmodule';
        $this->_viewPath = 'admin/settings';
    }

    public function index() {

        $data = array();
        $data['tabActive'] = $data['subTabActive'] = "settingmodule";
        //$data['tabActive'] = $this->_module;
        //$data['subTabActive'] = $this->_module . "_add";

        if ($this->input->post()) {

            foreach ($this->input->post() as $key => $value) {

                $setting = $this->global_model->get_data('settings', array('setting_key' => $key)); // $this->settings->get_settings_by_key($key);
                if ($setting) {
                    $this->global_model->update('settings', array('setting_value' => $value), array('setting_id' => $setting['setting_id']));
                } else {
                    $this->global_model->insert('settings', array('setting_key' => $key, 'setting_value' => $value));
                }
            }
            $this->session->set_flashdata('success_msg', 'Change save successfully');
            redirect(admin_url($this->_module));
        }

        $data['required_contents'] = $this->load->view($this->_viewPath . '/index', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

}

/* End of file Settings.php */
/* Location: ./application/controllers/greatadmin/Settings.php */