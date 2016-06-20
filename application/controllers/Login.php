<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
//        $user_id = $this->session->userdata('user_id');
//        if (!empty($user_id)) {
//            redirect('welcome');
//        }
        $this->load->helper('cookie');
    }

    
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $user_role = $this->session->userdata('user_role');
        //$user_role = get_cookie('user_role');

        if (!empty($user_id) && !empty($user_role)) {
            $sdata['user_id'] = $user_id;
            $sdata['user_role'] = $user_role;
            $sdata['temp'] = 0;
            $this->session->set_userdata($sdata);

            if ($user_role == 1) {
                redirect('super_admin_c');
            } elseif ($user_role == 2) {
                redirect('admin_c');
            } elseif ($user_role == 3) {
                redirect('super_admin_c');
            }
        } else {
            $this->load->view('Login');
        }
    }

    public function login_check() {
        $data = array();
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $loggedin = $this->login_model->login_check($username, $password);


        if (count($loggedin) == 1) {
            $sdata = array();
            $remember_me = $this->input->post('remember_me', true);
            if ($remember_me == 'on') {
                $user_id = array(
                    'name' => 'user_id',
                    'value' => $loggedin->user_id,
                    'expire' => time() + (86400 * 30)
                );
                $user_role = array(
                    'name' => 'user_role',
                    'value' => $loggedin->user_role,
                    'expire' => time() + (86400 * 30)
                );
                $this->session->set_userdata($user_id);
                $this->session->set_userdata($user_role);
            }

            $sdata['user_id'] = $loggedin->id;
            $sdata['user_name'] = $loggedin->username;
            $sdata['user_role'] = $loggedin->role;

            $this->session->set_userdata($sdata);
//            echo '<pre>';
//            print_r($sdata);
//            die();
            redirect('login');
        } else {
            $sdata = array();
            $sdata['message'] = 'Your Username Or Password is Invalid !';
            $this->session->set_userdata($sdata);
            redirect('login');
        }
    }

    public function show_forgot_form() {
        $this->load->view('Forgot_form');
    }

    public function forgot_password() {
        $email = $this->input->post('email', true);
        $check_email = $this->login_model->get_email($email);
        if (!empty($check_email)) {

            $sender_name = 'Admin';
            $sender_email = 'shaon63@gmail.com';
            $config['protocol'] = 'smtp';

            $config['smtp_host'] = 'ssl://smtp.gmail.com';

            $config['smtp_port'] = '465';

            $config['smtp_timeout'] = '7';

            $config['smtp_user'] = 'optimus6333@gmail.com';

            $config['smtp_pass'] = 'momin6333';

            $config['charset'] = 'utf-8';

            $config['newline'] = "\r\n";

            $config['mailtype'] = 'text'; // or html

            $config['validation'] = TRUE; // bool whether to validate email or not      
            //$this->email->initialize($config);



            $this->load->library('email');
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");

            $email_body = "
                           <strong>Password reset Request recieved:</strong><br>
                           <p>If you really want to reset your password then please click on the bellow link and provide new
                        password. If you don't want to reset your password then please disregard this message</p>
                           ";

            $subject = 'Reset Password for Shop';
            $pass = rand('0000000', '999999');
            $mdpass = md5($pass);

            $password_reset_link = base_url() . 'login/reset_password/' . $check_email->id . '/' . $mdpass;
            $email_body .= '<b>Password Reset Link : </b> <a href="' . $password_reset_link . '">' .
                    $password_reset_link . '</a>\r\n';

//            echo $email_body;
//            exit();
            $this->email->from($sender_email, $sender_name);
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($email_body);
            //$this->email->send();
            if ($this->email->send()) {
                $data['token'] = $mdpass;
                //die($mdpass);
                $data['token_type'] = 'forgot_password';
                $this->login_model->update_token($check_email->id, $data);
                $sdata = array();
                $sdata['message'] = 'Please Check Your Email !';
                $this->session->set_userdata($sdata);
                $this->email->print_debugger();
                //die();
                $this->load->view('Forgot_form', $sdata);
            } else {
                echo $this->email->print_debugger();
                //die("email not sent");
            }
        } else {
            $sdata = array();
            $sdata['message'] = 'Your Email is not valid !';
            $this->session->set_userdata($sdata);
            $this->load->view('Forgot_form', $sdata);
        }
    }

    public function reset_password($id, $token) {
        $data['check_user_id'] = $this->login_model->get_check_token($id, $token);
//        echo "<pre>";
//        print_r($data);
//        die();
        if ($data['check_user_id']) {
            $this->load->view('Feset_password', $data);
        }
    }

    public function update_password() {
        if ($_POST) {
            $this->form_validation->set_rules('new_password', 'Password', 'required|matches[con_password]|min_length[6]');
            $this->form_validation->set_rules('con_password', 'Password Confirmation', 'required');

            $user_id = $this->input->post('reset_id');
            $token = $this->input->post('token');
            $data['token'] = '';
            $data['token_type'] = '';
            $data['password'] = md5($this->input->post('new_password'));


            if ($this->form_validation->run() == FALSE) {
                $data['check_user_id'] = new stdClass();
                $data['check_user_id']->id =  $user_id;
                $data['check_user_id']->token = $token;
                //die("hello");
                $this->load->view('Feset_password', $data);
            } else {
                $this->login_model->update_password($user_id, $data);
                $sdata['message'] = 'Your Password has been changed successfully. You can now log in with your new
                password';

                $this->session->set_userdata($sdata);
                redirect('login/logout');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

}

/*echo '<pre>';
print_r($check_email);
exit();*/