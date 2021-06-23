<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public $_viewPath;
    public $_bannerImagePath;
    public $_projectImagePath;
    public $_galleryImagePath;
    public $_testEmailAddress;
    public $_moduleAttachmentPath;

    function __construct() {
        parent::__construct();

        $this->_viewPath = 'frontend/';
        $this->_bannerImagePath = 'assets/media/banners/';
        $this->_projectImagePath = 'assets/media/projects/';
        $this->_galleryImagePath = 'assets/media/gallery/';
        $this->_testEmailAddress = "ruhul11bd@gmail.com";
        $this->_moduleAttachmentPath = 'assets/media/career/';
        $this->_setPDFLimit = 10240;
        $this->_fileName = time();
        $this->load->library('file_processing');
        $this->load->library('session');
    }

    public function index() {
        $data = array();
        $data['pageTitle'] = "Welcome to " . $this->config->item('PROJECT_TITLE');
        $data['tabActive'] = "home";
        $data['banners'] = getBanners();
        $data['banner_path'] = $this->_bannerImagePath;

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'slider', $data);
        $this->load->view($this->_viewPath . 'index', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function about() {
        $data = array();
        $data['pageTitle'] = "About Us";
        $data['tabActive'] = "about";

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'about', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function service() {
        $data = array();
        $data['pageTitle'] = "Services";
        $data['tabActive'] = "service";

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'services', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function packages() {
        $category="Home";
        if(!empty($_GET['category'])){
           $category=$_GET['category']; 
        }

        $data = array();
        $data['pageTitle'] = "Packages";
        $data['tabActive'] = "package";
        $data['category'] = $category;

        $data['items'] = $this->global_model->get('packages', array('status'=>'active','category'=>$category), false, array('filed'=>'view_order', 'order'=>'ASC'));

        //pr($data['items']);

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'package', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function branches() {
        $data = array();
        $data['pageTitle'] = "Branches";
        $data['tabActive'] = "branch";

        $data['items_in_dhaka'] = $this->global_model->get('branch', array('status'=>'active', 'category'=>'Inside Dhaka'), false, array('filed'=>'view_order', 'order'=>'ASC'));
        $data['items_out_dhaka'] = $this->global_model->get('branch', array('status'=>'active', 'category'=>'Out of Dhaka'), false, array('filed'=>'view_order', 'order'=>'ASC'));

        //pr($data['items']);

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'branch', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function bkashPayment() {
        $data = array();
        $data['pageTitle'] = "bKash Payment";
        $data['tabActive'] = "payment";

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'bkash_payment', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function onlinePayment() {
        $data = array();
        $data['pageTitle'] = "Online Payment";
        $data['tabActive'] = "payment";

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'online_payment', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function contact() {

        $data = array();
        $data['pageTitle'] = "Contact Us";
        $data['tabActive'] = "contact";

        if ($this->input->post()) {
            $this->form_validation
                    ->set_rules('name', 'name', 'trim|required')
                    ->set_rules('email', 'email', 'trim|required')
                    ->set_rules('phone', 'phone', 'trim|required')
                    ->set_rules('subject', 'subject', 'trim|required')
                    ->set_rules('company_name', 'Company Name', 'trim')
                    ->set_rules('message', 'phone', 'trim|required')
            ;

            $this->form_validation->set_error_delimiters('', '</br>');
            if ($this->form_validation->run() == TRUE) {

                $addData['name'] = $data['name'] = $name = $this->input->post('name');
                $addData['email'] = $data['email'] = $email = $this->input->post('email');
                $addData['phone'] = $data['phone'] = $subject = $this->input->post('phone');
                $addData['subject'] = $data['subject'] = $subject = $this->input->post('subject');
                $addData['company_name'] = $data['company_name'] = $company_name = $this->input->post('company_name');
                $addData['message'] = $data['message'] = $message = $this->input->post('message');
                $addData['created_at'] = $data['created_at'] = $created_at = date('Y-m-d H:i:s');

                //pr($addData);

                if($this->global_model->insert('contact',  $addData)){                    
                    $this->session->set_flashdata('success_msg', 'Successfully sent');
                    redirect('main/contact');

                }else{
                    $this->session->set_flashdata('error_msg', 'Something Went Wrong');
                    redirect('main/contact');
                }

            } else {
                $this->session->set_flashdata('error_msg', validation_errors());
                redirect('main/contact');
            }
        }


        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'contact', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }


    public function sendQuickContact() {

        $resp = array();
        if ($this->input->post()) {
            $this->form_validation
                    ->set_rules('name', 'name', 'trim|required')
                    ->set_rules('email', 'email', 'trim|required')
                    ->set_rules('phone', 'phone', 'trim|required')
                    ->set_rules('subject', 'subject', 'trim|required')
                    ->set_rules('message', 'phone', 'trim|required')
            ;

            $this->form_validation->set_error_delimiters('', '</br>');
            if ($this->form_validation->run() == TRUE) {

                $addData['name'] = $data['name'] = $name = $this->input->post('name');
                $addData['email'] = $data['email'] = $email = $this->input->post('email');
                $addData['phone'] = $data['phone'] = $subject = $this->input->post('phone');
                $addData['subject'] = $data['subject'] = $subject = $this->input->post('subject');
                $addData['message'] = $data['message'] = $message = $this->input->post('message');

                // email section
                $data['site_url'] = site_url();

                $data['logo_url'] = base_url('assets/frontend/images/logo.png');
                $data['project_title'] = $this->config->item('PROJECT_TITLE');

                // $data['to_email'] = $this->config->item('EMAIL_ADDRESS');
                $emSubject = "Contact E-Mail From " . $name . ' ( ' . $email . ' )';
//                $toEmail = $this->_testEmailAddress;
                $toEmail = $this->config->item('EMAIL_ADDRESS') . ',' . $this->_testEmailAddress;
                echo $toEmail; exit();
                $htmlContent = $this->load->view('frontend/contact_mail_templates', $data, TRUE);

                if ($this->global_model->insert('contacts', $addData)) {

                    if (sendContactMail($toEmail, $emSubject, $htmlContent, $email, $name)) {
                        $resp['status'] = 1;
                        $successMsg = "Thank You for your email !! Soon we will contact with you.";
                        $resp['message'] = $successMsg;
                        $resp['redirectUrl'] = site_url();
                    } else {
                        $resp['status'] = 0;
                        $resp['message'] = 'Mail sending failed. Please try again later';
                    }
                } else {
                    $add_data['error'] = mysql_error();
                }
            } else {
                $resp['status'] = 0;
                $resp['message'] = validation_errors();
            }
        }

        echo json_encode($resp);
    }

}
