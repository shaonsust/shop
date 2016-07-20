<?php

class Super_admin_c extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();

        $user_id = $this->session->userdata('user_id');
        $user_role = $this->session->userdata('user_role');
        $user_name = $this->session->userdata('user_name');
        $this->load->model('Super_admin_c_model');

        if (empty($user_id) || empty($user_role))
            redirect('login');
    }

    public function index() {
        $this->load->view('Home');
    }
    public function projects($start=0, $fp = 3)
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
            $config['per_page'] = 10;
        	$data['project_no'] = $config['total_rows'];
        	$data ['projects'] = $this->Super_admin_c_model->projects_list('projects', 10000, $start);
        	$data ['projects1'] = $this->Super_admin_c_model->projects_list1('projects', 10000, $start);
        }
        else if($fp == 2)
        {
        	$config['total_rows'] = $this->Super_admin_c_model->project_count(0);
        	$config['per_page'] = 10;
        	$data['project_no'] = $config['total_rows'];
        	$data ['projects'] = $this->Super_admin_c_model->project_no(0, 10000, $start);
            $data ['projects1'] = $this->Super_admin_c_model->project_filter(0, 10000, $start);
        }
        else
        {
        	$config['total_rows'] = $this->Super_admin_c_model->project_count(1);
        	$config['per_page'] = 10;
        	$data['project_no'] = $config['total_rows'];
        	$data ['projects'] = $this->Super_admin_c_model->project_no(1, 10000, $start);
            $data ['projects1'] = $this->Super_admin_c_model->project_filter(1, 10000, $start);
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
           		
//        $this->pagination->initialize($config);
//        $data['pagination'] = $this->pagination->create_links();
        //die();
        $this->load->view('Projects',$data);
    }
    public function create_projects() 
    {
        $this->load->view('Create_projects');
    }
    public function project_calculation() 
    {
        //die("hello");
        $data['output'] = $this->input->post('project');
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
//            $this->show_details($project_id);
             $this->newbin();
// 			redirect('super_admin_c/newbin');
        } else if (isset($project_id) && $project_id == 0) {
            $sdata['message'] = "The Project name you entered already exists in the database. Please insert a new Project name.";
            $this->session->set_userdata($sdata);
//            redirect('super_admin_c/create_projects/');
            $this->projects();
        } else {
            $sdata['message'] = "Something went wrong while adding new bin. Please try again.";
            $this->session->set_userdata($sdata);
//            redirect('super_admin_c/create_projects/');
            $this->projects();
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
//        $data['status'] = $data['pro_bin'][0]['status'];
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
//            $data['status'] = $data['list'][0]['status'];
        	$this->load->view('box_details', $data);
        }
        else
        {
        	$this->load->view('Pro_details', $data);
        }
    }
    public function show_bin_details($id, $pro_status, $start = 0)
       {
        $this->load->model('Super_admin_c_model');
        $data ['details'] = $this->Super_admin_c_model->show_details('projects', $pro_status);
        $data ['bin'] = $this->Super_admin_c_model->select_bin_details('bin', $id);
        $data['item_bin'] = $this->Super_admin_c_model->select_item_by_bin_id('item', $id, 3000, $start);
        $data['item_count'] = $this->Super_admin_c_model->count_item_by_bin_id('item', $id);
        $data ['msg'] = "";
        $this->load->view('Bin_details', $data);
    }
    public function edit_pro($id) {
        $this->load->model('Super_admin_c_model');
        $data ['pro'] = $this->Super_admin_c_model->edit_pro_by_pro_id('projects', $id);
        $data ['msg'] = "";
        $this->load->view('Edit_pro', $data);
    }
    public function update_projects($id)
        {
        if ($_POST) 
        {
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

                $data ['pro'] = $this->Super_admin_c_model->edit_pro_by_pro_id('projects', $id);
                $data ['msg'] = "Project Data Updated Successfully.";
                $this->load->view('Edit_pro', $data);
           
        }
        
    }
    public function edit_bin($bin_id) {
        $this->load->model('Super_admin_c_model');
        $data ['bin'] = $this->Super_admin_c_model->edit_bin_by_bin_id('bin', $bin_id);
        $data ['msg'] = "";
        $this->load->view('Edit_bin', $data);
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
                $this->Super_admin_c_model->update_bin_by_id('bin', $data, $bin_id);

                $data ['bin'] = $this->Super_admin_c_model->edit_bin_by_bin_id('bin', $bin_id);
                $data ['msg'] = "Bin Data Updated Successfully.";
                $this->load->view('Edit_bin', $data);
           
        }
        
    }
    public function delete_projects($id) {
        $this->load->model('Super_admin_c_model');
        $this->Super_admin_c_model->delete_projects_by_pro_id('projects', $id);
        redirect('Super_admin_c/projects');
        //die($id);
    }
    public function delete_bin($bin_id) {
        $this->load->model('Super_admin_c_model');
        $id=$this->Super_admin_c_model->select_project_id_by_bin_id('bin', $bin_id);
           /* echo '<pre>';
          print_r($id);
            die();*/
        $this->Super_admin_c_model->delete_bin_by_bin_id('bin', $bin_id);
        
       
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
            $sdata['message'] = "The bin number you entered already exists in this project. Please insert a new bin name/number.";
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
        
        $this->load->view('Newbin');
    }
    public function item($bin_id, $bin_number) {
        $this->load->model('bin_model');
        $data['bin_id'] = $bin_id;
        $data['pro_id']=$this->session->userdata('project_id');
        $data['bin_number'] = $bin_number;
        $data['numberOfItem'] = $this->bin_model->countItem($bin_id);
        $this->load->view('Itemnumber', $data);
    }
    public function Finish_Start_new_project($bin_id){
        $id=$this->session->userdata('project_id');
        $this->load->model('Super_admin_c_model');
        $data['status']=0;
        $this->Super_admin_c_model->inactive_project('projects',$id,$data);
        $status = 0;
//         redirect('super_admin_c/show_bin_details/'.$bin_id);
        $this->projects();
    }
    public function change_project_status($id){
        $this->load->model('Super_admin_c_model');
        $pro_status= $this->Super_admin_c_model->change_pro_by_pro_id('projects', $id);
        if($pro_status!=0)
            {
            $data['status']=0;
            $this->Super_admin_c_model->inactive_project('projects',$id,$data);
            }
          else {
              $data['status']=1;
            $this->Super_admin_c_model->active_project('projects',$id,$data);
          }
        $this->projects();
    }
    function read_excel($pid, $path_parts, $status)
    {

    		$file = $path_parts;
    		    		
    		$head [0] = 'pid';
    		$head [1] = 'user_id';
    		$head [2] = 'sku';
    		$head [3] = 'barcode';
    		$head [4] = 'qty';
    		$head [5] = 'created_date';
    		$head [6] = 'updated_date';
    		$head [7] = 'status';
    		$head [8] = 'extra';
    
    	//load the excel library
    	$this->load->library('excel');
    	try {
    		$objPHPExcel = PHPExcel_IOFactory::load($file);
    	} catch(Exception $e) {
    		die("Error loading file :" . $e->getMessage());
    	}
    	
    	$y =1;
    	//get only the Cell Collection
    	foreach ( $objPHPExcel->getWorksheetIterator () as $worksheet ) 
    	{
    		$worksheetTitle = $worksheet->getTitle ();
    		$highestRow = $worksheet->getHighestRow (); // e.g. 10
    		$highestColumn = $worksheet->getHighestDataColumn (); // e.g 'F'
    		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString ( $highestColumn );
    		$nrColumns = ord ( $highestColumn ) - 64;   
    		for($row = 2; $row <= $highestRow; ++ $row) 
    		{
    			$x = 2;
    			for($col = 0; $col < $highestColumnIndex; ++ $col) 
    			{
    				$cell = $worksheet->getCellByColumnAndRow ( $col, $row );
    				$val = $cell->getValue ();
    				$data[$head[$x++]] = $val;
//     				echo $val."                    ";    				
    			}
    			$data['status'] = 0;
    			$data['created_date'] = date("Y-m-d");
    			$data['updated_date'] = date("Y-m-d");
    			$data['extra'] = 1;
    			$data['user_id'] = $this->session->userdata('user_id');
    			$data['pid'] = $pid;
    			$this->load->model('Super_admin_c_model');
    			$this->Super_admin_c_model->insert_pick_list('pick_list',$data);
    			
    		}
//     	}
    }
    
    $this->Super_admin_c_model->update($pid, $status);
    $dat['list'] = $this->Super_admin_c_model->select_list($pid);
    //$this->load->view('Pick_list', $dat);
    $this->pick_list($pid);
  }
    function pick_list($pid)
    {
    	$dat['list'] = $this->Super_admin_c_model->select_list($pid);
    	$dat['pid'] = $pid;
    	$this->load->view('Pick_list', $dat);
    }
    function box_list($pid)
    {
    	$dat['list'] = $this->Super_admin_c_model->box_report1($pid);
    	$box = $this->Super_admin_c_model->box_no($pid);
    	$dat['box_no'] = $box->no;
//     	echo $dat['box_no'];
//     	die();
    	$dat['pid'] = $pid;
//     	$dat['barcode'] = $barcode;
    	$this->load->view('Box_list', $dat);
    }
    function create_box($pid, $barcode)
    {
    	$data['pid'] = $pid;
    	$data['barcode'] = $barcode;
    	$this->load->view('Create_box', $data);
    }
    function box_calculation($pid)
    {
    	$data['pid'] = $pid;
    	$dat['pid'] = $pid;
//     	$data['barcode'] = $barcode;
    	$data['box_name'] = $this->input->post('box_name');
    	$data['created_date'] = date("Y-m-d");
    	$data['updated_date'] = date("Y-m-d");
    	$this->load->model('Super_admin_c_model');
    	$val = $this->Super_admin_c_model->check_box($pid, $data['box_name']);
    	if($val)
    	{
    		$dat['list'] = $this->Super_admin_c_model->select_list($pid);
    		$dat['pid'] = $pid;
    		$dat['msg'] = "Box is already exist. Please try again.";
    		$dat['box_list'] = $this->Super_admin_c_model->select_box($pid);
    		$this->load->view('Pick_list', $dat);
    	}
    	else 
    	{
    		$bid = $this->Super_admin_c_model->insert_pick_list('box', $data);
    		$dat['bdetails'] = $this->Super_admin_c_model->select_box_id($bid);
    		$dat['list'] = $this->Super_admin_c_model->select_list($pid);
    		$dat['box_list'] = $this->Super_admin_c_model->select_box($pid);
    		$this->load->view('box_pick_list', $dat);
    	}
//     	$this->box_list($pid, $barcode, 1);
    }
    function box_calculation1($pid, $bid)
    {
    	$dat['pid'] = $pid;
    	$this->load->model('Super_admin_c_model');
    	$dat['bdetails'] = $this->Super_admin_c_model->select_box_id($bid);
    	$dat['list'] = $this->Super_admin_c_model->select_list($pid);
    	$dat['box_list'] = $this->Super_admin_c_model->select_box($pid);
    	$this->load->view('box_pick_list', $dat);
    	//     	$this->box_list($pid, $barcode, 1);
    }
    function barcode_scan($pid, $barcode, $box_id)
    {
    	$data['pid'] = $pid;
    	$data['barcode'] = $barcode;
    	$data['box_id'] = $box_id;
    	$data['total_item1'] = $this->Super_admin_c_model->count_barcode($barcode, $pid);
//     	echo $data['total_item1']->qty_scaned."<br>";
//     	echo $data['total_item1']->qty;
//     	die();
    	$this->load->view('Barcode_scan', $data);
    }
    function barcode_calculation($pid, $bid)
    {
    	$cdata['pid'] = $pid;
    	$cdata['barcode'] = $this->input->post('barcode');
//     	$cdata['bar_no'] = $this->input->post('bar_no');
//     	$cdata['box_id'] = $this->input->post('box_id');
    	$cdata['user_id'] = $this->session->userdata('user_id');
    	$cdata['created_date'] = date("Y-m-d H:i:s");
    	$cdata['updated_date'] = date("Y-m-d H:i:s");
    	$cdata['status'] = 1;
    	
    	$this->load->model('Super_admin_c_model');
    	$val5 = $this->Super_admin_c_model->picklist($cdata['barcode'], $pid);
    	$dat['box_list'] = $this->Super_admin_c_model->select_box($pid);
//      	print_r($val);
//     	die();
		if($val5)
		{
	    	if(($val5->qty) > ($val5->qty_scaned))
	    	{
	    		$this->Super_admin_c_model->update_box($bid);
	    		$this->Super_admin_c_model->update_pick($cdata['barcode'], $pid);
	    		$val = $this->Super_admin_c_model->count_barcode($cdata['barcode'], $cdata['pid']);
	    		$val1 = $val->qty_scaned;
	    		$val2 = $val->qty;
                $dat['sc'] = $val->qty_scaned;
                $dat['qnt'] = $val->qty;
                $dat['sku'] = $val->sku;
	    		if($val1 == $val2)
	    		{
	    			$this->Super_admin_c_model->update_picklist_status($cdata['barcode'], $cdata['pid']);
                    $val6 = $val = $this->Super_admin_c_model->picklist2($val5->id, $cdata['pid']);
                    if($val6) {
                        foreach ($val6 as $val7) {
                            if(trim($val7->qty_scaned) != trim($val7->qty)) {
                                $dat['sc'] = trim($val7->qty_scaned);
                                $dat['qnt'] = trim($val7->qty);
                                $dat['sku'] = trim($val7->sku);
                                break;
                            }
                        }
                    }
	    		}
	    		$dat['pid'] = $pid;
	    		$dat['flag'] = 0;
	    		$dat['msg'] = "Data inserted successfully";
	    		$dat['bdetails'] = $this->Super_admin_c_model->select_box_id($bid);
	    		$cdata['box_id'] = $bid;
                $cdata['pl_id'] = $val5->id;
	    		$cdata['box_name'] = $dat['bdetails']->box_name;
	    		$breport = $this->Super_admin_c_model->insert_box_report($cdata);
	    		$dat['list'] = $this->Super_admin_c_model->select_list($pid);
	    		$this->load->view('box_pick_list', $dat);
	    		//echo $val1;
	    	}
	    	else 
	    	{
// 	    		echo "too much data inserted";
	    		$dat['pid'] = $pid;
	    		$dat['flag'] = 2;
	    		// 			$dat['msg'] = "Data inserted successfully";
	    		$dat['bdetails'] = $this->Super_admin_c_model->select_box_id($bid);
	    		$dat['list'] = $this->Super_admin_c_model->select_list($pid);
	    		$this->load->view('box_pick_list', $dat);
	    	}
		}
		else 
		{
// 			echo "Barcode is not found";
			$dat['pid'] = $pid;
			$dat['flag'] = 1;
// 			$dat['msg'] = "Data inserted successfully";
			$dat['bdetails'] = $this->Super_admin_c_model->select_box_id($bid);
			$dat['list'] = $this->Super_admin_c_model->select_list($pid);
			$this->load->view('box_pick_list', $dat);
		}
    }
    function select_box_report($pid, $bid)
    {
//     	echo "working well";
    	$this->load->model('Super_admin_c_model');
    	$dat['list'] = $this->Super_admin_c_model->box_report($pid, $bid);
    	$this->load->view('Box_report', $dat);
//     	echo "<pre>";
//     	print_r($dat);
    }
    function upload_pick_list($pid = 0, $flag = 0)
    {
    	$data['pid'] = $pid;
        $data['flag'] = $flag;
    	$this->load->view('Upload_pick_list', $data);
    }
    function create_csv()
    {
    	$query = $this->db->get('projects');
    	
    	if(!$query)
    		return false;
    	
    		// Starting the PHPExcel library
    		$this->load->library('excel');
//     		$this->load->library('PHPExcel/IOFactory');
    	
    		$objPHPExcel = new PHPExcel();
    		$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
    	
    		$objPHPExcel->setActiveSheetIndex(0);
    	
    		// Field names in the first row
    		$fields = $query->list_fields();
    		$col = 0;
    		foreach ($fields as $field)
    		{
    			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
    			$col++;
    		}
    	
    		// Fetching the table data
    		$row = 2;
    		foreach($query->result() as $data)
    		{
    			$col = 0;
    			foreach ($fields as $field)
    			{
    				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
    				$col++;
    			}
    	
    			$row++;
    		}
    	
    		$objPHPExcel->setActiveSheetIndex(0);
    	
    		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
    	
    		// Sending headers to force the user to download the file
    		header('Content-Type: application/vnd.ms-excel');
    		header('Content-Disposition: attachment;filename="Products_'.date('dMy').'.csv"');
    		header('Cache-Control: max-age=0');
    	
    		$objWriter->save('php://output');
    	}
    function check_format($pid, $status)
    	{
    		if (isset ( $_FILES ['read']['name'] ) && ! empty ( $_FILES ['read']['name'] )) 
    		{    		    			
	    		$path_parts = pathinfo ( $_FILES ['read'] ['name'] );
	    		$file = $path_parts ['dirname'] . '/' . $path_parts ['basename'];
	    		
	    		
	    		$this->load->library('upload');
				$config['upload_path'] ='./';
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = TRUE;                        
				$this->upload->initialize($config);
				
				$upload=$this->upload->do_upload('read');
				$images_file = $this->upload->data();
                $file = $images_file['file_name'];
	// 			print_r($images_file);
	// 			exit();
				if(!$upload)
				{
					$this->upload->display_errors();   
				}
				
				if ($path_parts['extension'] == "csv") 
				{ 
// 					echo "csv";
					$this->read_csv($pid, $file, $status);
				}
				else if($path_parts['extension'] == "xlsx" || $path_parts['extension'] == "xls" || $path_parts['extension'] == "ods")
				{
// 					echo "xlsx";
					$this->read_excel($pid, $file, $status);
				}
    		}
    	}
    function read_csv($pid, $path_parts, $status)
    	{
    		$file = $path_parts;
    		$head [0] = 'pid';
    		$head [1] = 'user_id';
    		$head [2] = 'sku';
    		$head [3] = 'barcode';
    		$head [4] = 'qty';
    		$head [5] = 'created_date';
    		$head [6] = 'updated_date';
    		$head [7] = 'status';
    		$head [8] = 'extra';
    		
    		$inputFileType = 'CSV';
    		$inputFileName = $file;
    		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
    		$objPHPExcel = $objReader->load($inputFileName);
    		
    		$worksheet = $objPHPExcel->getActiveSheet();
    		foreach ($worksheet->getRowIterator() as $row) 
    		{    			
    			$x = 2;
    			$cellIterator = $row->getCellIterator();
    			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
    			foreach ($cellIterator as $cell) 
    			{
    				if (!is_null($cell)) 
    				{
    					$data[$head[$x++]] = $cell->getValue();
    				}
    			}
    			$data['status'] = 0;
    			$data['created_date'] = date("Y-m-d");
    			$data['updated_date'] = date("Y-m-d");
    			$data['extra'] = 1;
    			$data['user_id'] = $this->session->userdata('user_id');
    			$data['pid'] = $pid;
    			$this->load->model('Super_admin_c_model');
    			$this->Super_admin_c_model->insert_pick_list('pick_list',$data);
    		}
    		
    		$this->Super_admin_c_model->update($pid, $status);
    		$dat['list'] = $this->Super_admin_c_model->select_list($pid);
    		$dat['pid'] = $pid;
    		$this->load->view('Pick_list', $dat);
//     	}
    }
    function box_pick($pid)
    {
 		$this->load->model('Super_admin_c_model');
    	$dat['list'] = $this->Super_admin_c_model->select_list($pid);
    	$this->load->view('box_pick_list', $dat);
    }
    function test()
    {
        $this->load->model('Super_admin_c_model');
        $this->Super_admin_c_model->box_report('','');
    }
}
?>