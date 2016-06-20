<?php

class Super_admin_c extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $user_id = $this->session->userdata('user_id');
        $user_role = $this->session->userdata('user_role');
        $user_name = $this->session->userdata('user_name');
        $this->load->model('super_admin_c_model');

        if (empty($user_id) || empty($user_role))
            redirect('login');
    }

    public function index() {
        $this->load->view('home');
    }
    
    public function projects() {
        $this->load->model('super_admin_c_model');
        $data['msg']='Please select a project for new count page';
        $data ['projects'] = $this->super_admin_c_model->projects_list('projects');
        $sdata['project_id']="";
        $this->session->set_userdata($sdata);
        //$data ['no_of_bin'] = $this->super_admin_c_model->count_bin_number();
         /* echo '<pre>';
          print_r($data);
            die();*/
        $this->load->view('projects',$data);
    }
    public function create_projects() {

        $this->load->view('create_projects');
    }
        public function project_calculation() {
        //die("hello");
        $data['output'] = $this->input->post('project');
        $cdata['project_name'] = $data['output'];
        $cdata['user_id'] = $this->session->userdata('user_id');
        $cdata['created_date'] = date("Y-m-d");
        $cdata['updated_date'] = date("Y-m-d");
        $cdata['status'] = 1;

        $this->load->model('super_admin_c_model');
        $project_id = $this->super_admin_c_model->insert_project_name('projects', $cdata);
        if (isset($project_id) && $project_id != 0) {
            $sdata['message'] = "New Project has been added Successfully";
            $this->session->set_userdata($sdata);
            $this->projects();
        } else if (isset($project_id) && $project_id == 0) {
            $sdata['message'] = "The Project name you entered already exists in the database. Please insert a new Project name.";
            $this->session->set_userdata($sdata);
            redirect('super_admin_c/create_projects/');
        } else {
            $sdata['message'] = "Something went wrong while adding new bin. Please try again.";
            $this->session->set_userdata($sdata);
            redirect('super_admin_c/create_projects/');
        }
    }
    public function show_details($id) {
        $data ['details'] = $this->super_admin_c_model->show_details('projects', $id);
        /*echo '<pre>';
        print_r($data['details']);
        exit;*/
        $data['pro_bin'] = $this->super_admin_c_model->select_bin_by_pro_id('bin', $id);
        $data['bin_count'] = $this->super_admin_c_model->count_bin_by_pro_id('bin', $id);
        $data ['msg'] = "";
        $sdata['project_id']=$id;
        $this->session->set_userdata($sdata);
        $this->load->view('pro_details', $data);
    }
       public function show_bin_details($id) {
        $this->load->model('Super_admin_c_model');
        $data ['bin'] = $this->super_admin_c_model->select_bin_details('bin', $id);
        $data['item_bin'] = $this->super_admin_c_model->select_item_by_bin_id('item', $id);
        $data['item_count'] = $this->super_admin_c_model->count_item_by_bin_id('item', $id);
        $data ['msg'] = "";
        $this->load->view('bin_details', $data);
    }
    public function edit_pro($id) {
        $this->load->model('Super_admin_c_model');
        $data ['pro'] = $this->super_admin_c_model->edit_pro_by_pro_id('projects', $id);
        $data ['msg'] = "";
        $this->load->view('edit_pro', $data);
    }
        public function update_projects($id) {
        
        if ($_POST) {
            $data ['project_name'] = $this->input->post('project_name');
            $data ['created_date'] = $this->input->post('created_date');
            $data ['updated_date'] = $this->input->post('updated_date');
            $data ['status'] = $this->input->post('status');
            
          /*  echo '<pre>';
          print_r($data);
            die();*/
            // set rules for validation
            
                $this->load->model('Super_admin_c_model');
                $this->Super_admin_c_model->update_project_by_id('projects', $data, $id);

                $data ['pro'] = $this->super_admin_c_model->edit_pro_by_pro_id('projects', $id);
                $data ['msg'] = "Project Data Updated Successfully.";
                $this->load->view('edit_pro', $data);
           
        }
        
    }
    
    public function edit_bin($bin_id) {
        $this->load->model('Super_admin_c_model');
        $data ['bin'] = $this->super_admin_c_model->edit_bin_by_bin_id('bin', $bin_id);
        $data ['msg'] = "";
        $this->load->view('edit_bin', $data);
    }
            public function update_bin($bin_id) {
        
        if ($_POST) {
            $data ['bin_number'] = $this->input->post('bin_number');
            $data ['created_date'] = $this->input->post('created_date');
            $data ['updated_date'] = $this->input->post('updated_date');
            $data ['status'] = $this->input->post('status');
            
          /*  echo '<pre>';
          print_r($data);
            die();*/
            // set rules for validation
            
                $this->load->model('Super_admin_c_model');
                $this->super_admin_c_model->update_bin_by_id('bin', $data, $bin_id);

                $data ['bin'] = $this->super_admin_c_model->edit_bin_by_bin_id('bin', $bin_id);
                $data ['msg'] = "Bin Data Updated Successfully.";
                $this->load->view('edit_bin', $data);
           
        }
        
    }
    public function delete_projects($id) {
        $this->load->model('Super_admin_c_model');
        $this->super_admin_c_model->delete_projects_by_pro_id('projects', $id);
        redirect('Super_admin_c/projects');
        //die($id);
    }
      public function delete_bin($bin_id) {
        $this->load->model('Super_admin_c_model');
        $id=$this->super_admin_c_model->select_project_id_by_bin_id('bin', $bin_id);
           /* echo '<pre>';
          print_r($id);
            die();*/
        $this->super_admin_c_model->delete_bin_by_bin_id('bin', $bin_id);
        
       
        $this->show_details($id);
        //die($id);
    }
    public function bin_calculation() {
        if($this->session->userdata('project_id')==0)
            {
            $this->projects();
            }
            else {
        //die("hello");
        $data['output'] = $this->input->post('bin');
        $cdata['bin_number'] = $data['output'];
        $cdata['user_id'] = $this->session->userdata('user_id');
        $cdata['project_id'] = $this->session->userdata('project_id');
        $cdata['created_date'] = date("Y-m-d");
        $cdata['updated_date'] = date("Y-m-d");
        $cdata['status'] = 1;

        $this->load->model('bin_model');
        $bin_id = $this->bin_model->insert_bin_number('bin', $cdata);
        if (isset($bin_id) && $bin_id != 0) {
            $sdata['message'] = "New Bin has been added Successfully";
            $this->session->set_userdata($sdata);
            redirect('super_admin_c/item/' . $bin_id . '/' . $data['output']);
        } else if (isset($bin_id) && $bin_id == 0) {
            $sdata['message'] = "The bin number you entered already exists in the database. Please insert a new bin number.";
            $this->session->set_userdata($sdata);
            redirect('super_admin_c/newbin/');
        } else {
            $sdata['message'] = "Something went wrong while adding new bin. Please try again.";
            $this->session->set_userdata($sdata);
            redirect('super_admin_c/newbin/');
            }
            
        }
    }

    public function item_calculation() {
        $cdata['bin_id'] = $this->input->post('bin_id');
        $cdata['item_number'] = $this->input->post('item');
        $cdata['user_id'] = $this->session->userdata('user_id');
        $cdata['created_time'] = date("Y-m-d H:i:s");
        $cdata['updated_time'] = date("Y-m-d H:i:s");
        $cdata['status'] = 1;
        $this->load->model('bin_model');
        $item_id = $this->bin_model->insert_item($cdata);
        echo $item_id;
    }

    public function newbin() {
        
        $this->load->view('newbin');
    }

    public function item($bin_id, $bin_number) {
        $this->load->model('bin_model');
        $data['bin_id'] = $bin_id;
        $data['bin_number'] = $bin_number;
        $data['numberOfItem'] = $this->bin_model->countItem($bin_id);
        $this->load->view('itemnumber', $data);
    }
    public function Finish_Start_new_project(){
        $id=$this->session->userdata('project_id');
        
        $this->load->model('super_admin_c_model');
        $data['status']=0;
        $this->super_admin_c_model->inactive_project('projects',$id,$data);
        $this->projects();
    }
    public function change_project_status($id){
        $this->load->model('super_admin_c_model');
        $pro_status= $this->super_admin_c_model->change_pro_by_pro_id('projects', $id);
        if($pro_status!=0)
            {
            $data['status']=0;
            $this->super_admin_c_model->inactive_project('projects',$id,$data);
            }
          else {
              $data['status']=1;
            $this->super_admin_c_model->active_project('projects',$id,$data);
          }  
         /*echo '<pre>';
          print_r($pro_status);
            die();*/
        $this->projects();
        
    }
}
?>