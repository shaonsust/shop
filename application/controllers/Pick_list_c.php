<?php
class Pick_list_c extends CI_Controller
{
    public function create_projects()
    {
        $this->load->view('Create_projects');
    }

    public function projects($start=0, $fp = 1)
    {
        $this->load->model('Super_admin_c_model');
        $data['msg']='Please select a project for new count page';
//      $data ['projects'] = $this->Super_admin_c_model->projects_list('projects');
        $sdata['project_id']="";
        $this->session->set_userdata($sdata);

        $this->load->library('pagination');
        $config['base_url'] = base_url() . "super_admin_c/projects/";
        if($fp == 1)
        {
            $config['total_rows'] = $this->db->get('projects')->num_rows();
            $config['per_page'] = 30;
            $data['project_no'] = $config['total_rows'];
            $data ['projects'] = $this->Super_admin_c_model->projects_list('projects', $config['per_page'], $start);
            $data ['projects1'] = $this->Super_admin_c_model->projects_list1('projects', $config['per_page'], $start);
        }
        else if($fp == 2)
        {
            $config['total_rows'] = $this->Super_admin_c_model->project_count(0);
            $config['per_page'] = 30;
            $data['project_no'] = $config['total_rows'];
            $data ['projects'] = $this->Super_admin_c_model->project_no(0, $config['per_page'], $start);
            $data ['projects1'] = $this->Super_admin_c_model->project_filter(0, $config['per_page'], $start);
        }
        else
        {
            $config['total_rows'] = $this->Super_admin_c_model->project_count(1);
            $config['per_page'] = 30;
            $data['project_no'] = $config['total_rows'];
            $data ['projects'] = $this->Super_admin_c_model->project_no(1, $config['per_page'], $start);
            $data ['projects1'] = $this->Super_admin_c_model->project_filter(1, $config['per_page'], $start);
        }

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination" align="center">';
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

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        //die();
        $this->load->view('Projects',$data);
    }

    public function project_calculation()
    {
        $data['output'] = $this->input->post('project_name');
        $cdata['project_name'] = $data['output'];
        $cdata['user_id'] = $this->session->userdata('user_id');
        $cdata['created_date'] = date("Y-m-d");
        $cdata['updated_date'] = date("Y-m-d");
        $cdata['status'] = 1;

        $this->load->model('Super_admin_c_model');
        $project_id = $this->Super_admin_c_model->insert_project_name('projects', $cdata);
        if (isset($project_id) && $project_id != 0) {
            $sdata['message'] = "New Project has been added Successfully";
            $this->session->set_userdata($sdata);
            $this->session->set_userdata('project_id', $project_id);
//            $this->projects();
            $this->upload_pick_list($project_id, 1);
//             $this->newbin();
// 			redirect('super_admin_c/newbin');
        } else if (isset($project_id) && $project_id == 0) {
            $sdata['message'] = "The Project name you entered already exists in the database. Please insert a new Project name.";
            $this->session->set_userdata($sdata);
            $this->projects();
//            redirect('super_admin_c/create_projects/');
        } else {
            $sdata['message'] = "Something went wrong while adding new bin. Please try again.";
            $this->session->set_userdata($sdata);
            $this->projects();
//            redirect('super_admin_c/create_projects/');
        }
    }

    public function show_details($id, $start=0)
    {
        $data ['details'] = $this->Super_admin_c_model->show_details('projects', $id);
        /*echo '<pre>';
        print_r($data['details']);
        exit;*/
        $data['bin_count'] = $this->Super_admin_c_model->count_bin_by_pro_id('bin', $id);
//         echo $data['bin_count'];
//         die();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "super_admin_c/show_details/$id/";
        $config['total_rows'] = $data['bin_count'];
        $config['per_page'] = 5;

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination" align="center">';
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

        $data['pro_bin'] = $this->Super_admin_c_model->select_bin_by_pro_id('bin', $id, $config['per_page'], $start);
        $data ['msg'] = "";
        $sdata['project_id']=$id;
        $data['pid'] = $id;

        $this->session->set_userdata($sdata);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $val = $this->Super_admin_c_model->pro($id);
        if($val->pick_list == 1)
        {
            $data['list'] = $this->Super_admin_c_model->select_list($id);
            $this->load->view('box_details', $data);
        }
        else
        {
            $this->load->view('Pro_details', $data);
        }
    }

    function upload_pick_list($pid = 0, $flag = 0)
    {
        $data['pid'] = $pid;
        $data['flag'] = $flag;
        $this->load->view('Upload_pick_list', $data);
    }

    public function newbin() {

        $this->load->view('Newbin');
    }
}