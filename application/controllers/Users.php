<?php

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $user_id = $this->session->userdata('user_id');
        $user_role = $this->session->userdata('user_role');
        $user_name = $this->session->userdata('user_name');

        if (empty($user_id) || empty($user_role))
            redirect('login');
    }

    public function users_list($start = 0) 
    {
    	$this->load->model('users_model');
    	$config['base_url'] = base_url() . "users/users_list/";
    	$config['per_page'] = 10;
    	$config['total_rows'] = $this->users_model->users_list1('users');
//     	$config['total_rows'] = 5;
    	//config for bootstrap pagination class integration
    	$config['full_tag_open'] = '<ul class="pagination" align="center" style="margin-left:10px">';
    	$config['full_tag_close'] = '</ul>';
    	$config['first_link'] = false;
    	$config['last_link'] = false;
    	$config['first_tag_open'] = '<li>';
    	$config['first_tag_close'] = '</li>';
    	$config['prev_link'] = '&laquo';
    	$config['prev_tag_open'] = '<li class="prev">';
    	$config['prev_tag_close'] = '</li>';
    	$config['next_link'] = '&raquo';
    	$config['next_tag_open'] = '<li>';
    	$config['next_tag_close'] = '</li>';
    	$config['last_tag_open'] = '<li>';
    	$config['last_tag_close'] = '</li>';
    	$config['cur_tag_open'] = '<li class="active"><a href="#">';
    	$config['cur_tag_close'] = '</a></li>';
    	$config['num_tag_open'] = '<li>';
    	$config['num_tag_close'] = '</li>';
    	      
        $data ['users'] = $this->users_model->users_list('users', $config['per_page'], $start);
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('Users_list', $data);
    }

    public function create_users() {
        $msg['msg'] = '';
        $this->load->view('Create_users', $msg);
    }

    public function insert_users() {
        if ($_POST) {
            // set rules for validation
            $this->form_validation->set_rules('user_name', 'Username', 'required|is_unique[users.username]');
            $this->form_validation->set_rules('full_name', 'Full Name', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|matches[con_password]|min_length[6]');
            $this->form_validation->set_rules('con_password', 'Password Confirmation', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('Create_users');
            } else {
                $data ['username'] = $this->input->post('user_name');
                $data ['full_name'] = $this->input->post('full_name');
                $data ['email'] = $this->input->post('email');
                $data ['password'] = $this->input->post('password');
                $data ['password'] = md5($data ['password']);
                $data ['old_password'] = $data ['password'];
                $data ['role'] = 3;
                $data ['status'] = 1;

                $this->load->model('users_model');
                $id = $this->users_model->create_users('users', $data);
                if ($id > 0)
                    $msg ['msg'] = "User Create Successfully.";
                else
                    $msg ['msg'] = "Something Wrong. Please try again";
                $this->load->view('Create_users', $msg);
            }
        }
    }

    public function edit_users($id) {
        $this->load->model('users_model');
        $data ['user'] = $this->users_model->user('users', $id);
        $data ['msg'] = "";
        $this->load->view('Edit_users', $data);
    }

    public function myaccount($id) {
        $this->load->model('users_model');
        $data ['user'] = $this->users_model->user('users', $id);
        $data ['msg'] = "";
        $this->load->view('Myaccount', $data);
    }

    public function change_password($id) {
        $this->load->model('users_model');
        $data ['user'] = $this->users_model->user('users', $id);
        $data ['id'] = $id;
        $data ['msg'] = "";
        $this->load->view('Change_password', $data);
    }

    public function update_users($id) {
        if ($_POST) {
            $data ['username'] = $this->input->post('user_name');
            $data ['full_name'] = $this->input->post('full_name');
            $data ['email'] = $this->input->post('email');

            // set rules for validation
            $this->form_validation->set_rules('user_name', 'Username', 'required');
            $this->form_validation->set_rules('full_name', 'Full Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run() == FALSE) {
                $this->load->model('users_model');
                $data ['user'] = $this->users_model->user('users', $id);
                $this->load->view('Myaccount', $data);
            } else {
                $this->load->model('users_model');
                $this->users_model->update_users('users', $data, $id);

                $data ['user'] = $this->users_model->user('users', $id);
                $data ['msg'] = "Accounts Data Updated Successfully.";
                $this->load->view('Myaccount', $data);
            }
        }
    }

    public function update_password($id) {
        if ($_POST) {
            $data ['old_password'] = $this->input->post('old_password');
            $data ['password'] = $this->input->post('new_password');
            $data ['password'] = md5($data ['password']);


            $this->form_validation->set_rules('old_password', 'Old Password', 'required|min_length[6]');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|matches[con_password]|min_length[6]');
            $this->form_validation->set_rules('con_password', 'Password Confirmation', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->model('users_model');
                $data ['user'] = $this->users_model->user('users', $id);
                $data ['id'] = $id;
                $data['msg'] = "";
                $this->load->view('Change_password', $data);
            } else {
                $this->load->model('users_model');
                $user = $this->users_model->user('users', $id);
                if (md5($data['old_password']) == $user->password) {
                    $this->users_model->update_password('users', $data, $id);
                    $data ['msg'] = "Password has changed successfully.";
                    $data ['id'] = $id;
                } else {
                    $data['msg'] = "Old password does not match. Please try again.";
                    $data ['id'] = $id;
                }
                $this->load->view('Change_password', $data);
            }
        }
    }

    public function delete_users($id) {
        $this->load->model('users_model');
        $this->users_model->delete_users('users', $id);
        redirect('users/users_list');
        //die($id);
    }

}
?>

