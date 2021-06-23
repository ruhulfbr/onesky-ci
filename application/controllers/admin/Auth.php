<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public $_pageGroup;
    public $module;

    function __construct() {
        parent::__construct();
        // load specific model
        $this->load->model('admin/user_model');

        // load specific variable
        $this->_pageGroup = "User";
        $this->module = "auth";
    }

    public function index() {
        //login check if login then redirect to dashboard
        if (loginCheck()) {
            redirect(admin_url('profile/dashboard'));
        } else {
            redirect(admin_url('auth/login'));
        }
    }


    

    // login page for user panel
    public function login() {
        // set page title
        $data['pageGroup'] = $this->_pageGroup;

        // if login then redirect to dashboard
        if (loginCheck()) { // globally check login function
            redirect(admin_url('profile/dashboard'));
        }

        // check if click on the submit button
        if ($this->input->post('sign-in')) {

            // set the validation rule
            $this->form_validation->set_rules('email', 'Email', 'required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|max_length[30]');

            // run the validation
            if ($this->form_validation->run()) {

                // get the value from post
                $data['email'] = $this->input->post('email');
                $data['password'] = $this->input->post('password');

                // get the dta from database using username
                $result = $this->user_model->check_email($data['email']);

                // check if any data found or not
                if (!empty($result) ) {
                    // check the password is correct or not
                    list($first, $second) = str_split($result->secret, strlen($result->secret) / 2);
                    $given_password = md5($first . $data['password'] . $second);
                    if ($given_password == $result->password) {
                        // check the user is active or not
                        if ($result->status == 1) {
                            // set the login data to the session
                            $user_data = array(
                                'user_id' => $result->user_id,
                                'user_name' => $result->user_name,
                                'first_name' => $result->first_name,
                                'user_level' => $result->level_id,
                                'status' => $result->status,
                                'email' => $result->email,
                                'photo' => $result->photo
                            );
                            $this->session->set_userdata($user_data);

                            // update the login information to the database
                            $updateData['lastlogin_ip'] = ip2long($_SERVER['REMOTE_ADDR']);
                            $updateData['lastlogin_date'] = time();
                            $this->user_model->updateUser($updateData, $result->user_id);

                            // set the successfull message
                            $this->session->set_flashdata('success_msg', 'You have login successfully !!');
                            // return to the return URL
                            if ($this->session->userdata('return_url')) {
                                redirect($this->session->userdata('return_url'));
                            } else {
                                redirect(admin_url('profile/dashboard'));
                            }
                        } else {
                            $data['error'] = "<p>User is not active!! Please Active First!!</p>";
                        }
                    } else {
                        $data['error'] = "<p>Password is incorrect try again</p>";
                    }
                } else {
                    $data['error'] = "<p>Login e-mail is incorrect try again</p>";
                }
            } else {
                $data['error'] = validation_errors();
            }
        }
        // load the view page for login
        $this->load->view('admin/login', $data);
    }

    // logout from admin panel
    public function logout() {
        // unset the login data to the session
        $this->session->sess_destroy();

        // set the successfull message and redirect
        $this->session->set_flashdata('success_msg', 'Successfully logout');
        redirect(admin_url('auth/login'));
    }

    // forget password 
    public function forget_password() {
        // check if click on the submit button
        if ($this->input->post('forgetPassword')) {

            // set the validation rule
            $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');

            // run the validation
            if ($this->form_validation->run()) {
                // get the value from post
                $email = $this->input->post('email');

                // get the data from database using email
                $result = $this->user_model->check_email($email);

                // check if any data found or not
                if (count($result) > 0) {
                    // generate the password and secret code
                    $newpassword = mt_rand(100000, 999999);
                    $code = geneSecurePass($newpassword);
                    $updateData['password'] = $code['password'];
                    $updateData['secret'] = $code['secret'];

                    if ($this->user_model->updateUser($updateData, $result->user_id)) {

                        $comment = "<p>Hello:,</p>";
                        $comment .= "<p>You recently requested a new password<br/>";
                        $comment .= "New password is : <strong>" . $newpassword . "</strong><br/>";
                        $comment .= "This is auto generated password<br/>";
                        $comment .= "you may change your password using profile setting<br/></p>";
                        $comment .= "<p>Thanks<br/>";
                        $comment .= $this->config->item('PROJECT_TITLE') . "</p>";

                        $this->load->library('email');

                        $this->email->from('support@(YOUR SITE NAME).com', $this->config->item('PROJECT_TITLE'));
                        $this->email->to($email);

                        $this->email->subject('Admin Password Reset request received for - ' . $this->config->item('PROJECT_TITLE'));
                        $this->email->message($comment);
                        $this->email->set_mailtype('html');

                        if ($this->email->send()) {
                            echo '<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-trash"></i></button>You have been sent an email with password reset instruction. If the email does not arrive within several minutes, be sure to check your spam or junk mail folders.</div>';
                        } else {
                            echo '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-trash"></i></button>Error: mail not send....</div>';
                        }
                    }
                } else
                    echo '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-trash"></i></button>Password reset Failed!! <br>Please enter valid Email ID to reset your password.</div>';
            }else {
                echo '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-trash"></i></button>' . validation_errors() . '</div>';
            }
        }
    }



}

/* End of file Auth.php */
/* Location: ./application/controllers/perfectadmin/Auth.php */