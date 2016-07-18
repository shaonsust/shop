<?php

class Super_admin_c_model extends CI_Model {
    
    public function projects_list($table, $limit = 25, $start = 0) 
    {   
  /*  $this->db->select ( '*' ); 
    $this->db->from ( 'projects' );
    //$this->db->join ( 'projects', 'projects.id =bin.project_id' );
    //$this->db->join ( 'item', 'item.bin_id = bin.bin_id' );
    $query = $this->db->get ();
    return $query->result ();
  */
    	$this->db->select()->from($table)->order_by('created_date', 'asc')->limit($limit, $start);
    	$query = $this->db->get();
       // $sql = "select * from $table order by 'created_date' desc limit 5, $start";
        //$query = $this->db->query($sql);
       	return $query->result_array();
       //exit();  
/*
        $query = $this->db->select(' 
                projects.id as project_id,                 
                (select count(project_id) as total_bins from bin where project_id = projects.id) as total_bins,   
                 ')
                ->from('projects')               
                ->group_by('projects.id')
                ->get();
        $data['bin']=$query->result();
         //$query->result();
         //echo '<pre>',print_r($query->result());
    
        $query2 = $this->db->select('             
                bin.bin_id,                   
                (select count(bin_id) as total_items from item where bin_id = bin.bin_id) as total_items,                  
                 ')
                ->from('bin')    
                ->group_by('bin.bin_id')
                ->get();
        $data['items']=$query2->result();
       return $data;
           //     exit();
*/
    }
    
    public function projects_list1($table, $limit = 25, $start = 0)
    {

    	$this->db->select()->from($table)->order_by('created_date', 'asc')->limit($limit, $start);
    	$query = $this->db->get();
    	// $sql = "select * from $table order by 'created_date' desc limit 5, $start";
    	//$query = $this->db->query($sql);
    	return $query->result_array();
    }
    
    public function project_count($status)
    {
    	$this->db->select()->from('projects')->where('status', $status);
    	$query = $this->db->get();
    	return $query->num_rows();
    }
    
    public function project_no($status, $limit = 25, $start = 0)
    {
    	$this->db->select()->from('projects')->where('status', $status)->order_by('created_date', 'asc')->limit($limit, $start);
    	$query = $this->db->get();
    	return $query->result_array();
    }

    public function project_filter($status, $limit = 25, $start = 0)
    {
        $this->db->select()->from('projects')->where('status', $status)->order_by('created_date', 'dsc')->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function insert_pick_list($table,$data)
    {
    	$this->db->insert($table, $data);
    	return $this->db->insert_id();
    }
    
    public function select_list($pid)
    {
    	$this->db->select()->from('pick_list')->where('pid', $pid)->order_by('status', 'asc');
    	$query = $this->db->get();
    	return $query->result_array();
    }
    
    public function select_box($pid)
    {
//     	$this->db->where('pid', $pid);
//     	$this->db->where('barcode', $barcode);
    	$this->db->select()->from('box')->where('pid', $pid);
    	$query = $this->db->get();
    	return $query->result_array();
    }
    
    public function select_box_id($bid)
    {
    	//     	$this->db->where('pid', $pid);
    	//     	$this->db->where('barcode', $barcode);
    	$this->db->select()->from('box')->where('box_id', $bid);
    	$query = $this->db->get();
    	return $query->row();
    }
    
    public function update($pid, $status)
    {
    	$data['pick_list'] = $status;
    	$this->db->where('id', $pid);
    	$this->db->update('projects', $data);
    }

    public function insert_project_name($table, $data) {
        $this->db->where('project_name', $data['project_name']);
        $result = $this->db->count_all_results('projects');
        if ($result == 0) {
            $this->db->insert($table, $data);
            $newId = $this->db->insert_id();
        } else {
            $newId = 0;
        }
        return $newId;
    }
    public function show_details($table, $id) {
        $this->db->select('*')
                ->from($table)
                ->where('id', $id);
        $query_result = $this->db->get();
        //echo $this->db->last_query();
        return $result = $query_result->row();
    }
    
    public function select_bin_by_pro_id($table, $id, $limit = 25, $start = 0) {
        $this->db->select('*')
                ->from($table)
                ->where('project_id', $id)
        		->order_by('created_date', 'asc')
        		->limit($limit, $start);
        $query = $this->db->get();
       return $query->result_array();
    }
    
    public function count_bin_by_pro_id($table, $id) {
        $this->db->select('*')
                ->from($table)
                ->where('project_id', $id);
       $query = $this->db->get();
        return $query->num_rows();
    }
       public function select_bin_details($table, $id) {
        $this->db->select('*')
                ->from($table)
                ->where('bin_id', $id);
        $query_result = $this->db->get();
        return $result = $query_result->row();
    }
      public function count_item_by_bin_id($table, $id) {
        $this->db->select('*')
                ->from($table)
                ->where('bin_id', $id);
       $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_item_by_bin_id1($table, $id) 
    {
    	$this->db->distinct();
    	$this->db->select('item_number')
    	->from($table)
    	->where('bin_id', $id);
    	$query = $this->db->get();
    	return $query->num_rows();
    }
    public function select_item_by_bin_id($table, $id, $limit=250, $start=0) 
    {
        $this->db->select('item_number, count(item_number) as it_no, bin_id, created_time, updated_time, status')
                ->from($table)
                ->where('bin_id', $id)->group_by('item_number')
                ->order_by('created_time', 'asc')
                ->limit($limit, $start);
        $query = $this->db->get();
       return $query->result_array();
    }
    public function edit_pro_by_pro_id($table, $id) 
    {
        $this->db->select('*')
                ->from($table)
                ->where('id', $id);
        $query_result = $this->db->get();
        return $result = $query_result->row();
    }
    public function edit_bin_by_bin_id($table, $bin_id) 
    {
        $this->db->select('*')
                ->from($table)
                ->where('bin_id', $bin_id);
        $query_result = $this->db->get();
        return $result = $query_result->row();
    }
    public function select_project_id_by_bin_id($table, $bin_id) {
        $this->db->select('project_id')
                ->from($table)
                ->where('bin_id', $bin_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $id_bin=$result->project_id;
    }
    public function update_project_by_id($table, $data, $id) {
//        
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }
    public function update_bin_by_id($table, $data, $bin_id) {
//        
        $this->db->where('bin_id', $bin_id);
        $this->db->update($table, $data);
    }
    public function delete_projects_by_pro_id($table, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }
    public function delete_bin_by_bin_id($table, $bin_id)
    {
        $this->db->where('bin_id', $bin_id);
        $this->db->delete($table);
    }
    public function count_bin_number() {
        $this->db->select('project_id');
         $this->db->from('bin');
         $this->db->group_by("project_id"); 
        $query_result = $this->db->get();
        return $query_result ;
    }
    public function active_project($table,$id,$data){
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }
    public function inactive_project($table,$id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }
    public function change_pro_by_pro_id($table,$id)
    {
          $this->db->select('*')
                ->from($table)
                ->where('id', $id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $r=$result->status;
    }
    
    function check_box($pid, $bname)
    {
    	$result = $this->db->query("select * from box where box_name = '$bname' and pid = '$pid'");
    	return $result->row();
    }
    
    function update_box($box_id)
    {
    	$this->db->query("update box set scanned = scanned + 1 where box_id = '$box_id'");
    }
    
    function update_pick($barcode, $pid)
    {
    	$this->db->query("update pick_list set qty_scaned = qty_scaned + 1 where barcode = '$barcode' and pid = '$pid'");
    }
    
    function picklist($barcode, $pid)
    {
    	$result = $this->db->query("select * from pick_list where barcode = '$barcode' and pid = '$pid'");
//     	$this->db->select('*')->from('pick_list')->where('barcode', $barcode);
//     	$query_result = $this->db->get();
    	return $result->row() ;
    }
    
    function pro($pid)
    {
    	$this->db->select('*')->from('projects')->where('id', $pid);
    	$query_result = $this->db->get();
    	return $query_result->row() ;
    }
    
    public function count_barcode($barcode, $pid) 
    {
    	$result = $this->db->query("select sku, qty_scaned, qty, barcode from pick_list where barcode = '$barcode' and pid = '$pid'");
//     	$result = $this->db->count_all_results('pick_list');
    	return $result->row();
    }

    function picklist1($id, $pid)
    {
        $id = $id + 1;
//        $result = $this->db->query("select * from pick_list where barcode = '$barcode' and pid = '$pid'");
        $this->db->select('*')->from('pick_list')->where(array('id'=>$id, 'pid'=>$pid));
        $result = $this->db->get();
        return $result->row() ;
    }
    
    public function box_no($pid)
    {
    	$result = $this->db->query("select count(distinct box_name) as no from box_report where pid = '$pid'");
//     	$result = $this->db->count_all_results('pick_list');
    	return $result->row();
    }
    
    public function update_picklist_status($barcode, $pid)
    {
    	$result = $this->db->query("update pick_list set status = 1 where barcode = '$barcode' and pid = '$pid'");
    }
    
    public function insert_box_report($data)
    {
    	$this->db->insert('box_report', $data);
    	return $this->db->insert_id();
    }
    
    public function box_report($pid, $bid)
    {
    	$result = $this->db->query("select box_name, barcode, count(barcode) as cbarcode from box_report where pid = '$pid' and box_id = '$bid' group by barcode");
    	return $result->result_array();
    }

    public function box_report1($pid)
    {
        $result = $this->db->query("select count(distinct b.barcode) as dtype, a.box_name, scanned, a.pid, a.box_id 
                                    from box a left join box_report b on a.box_id = b.box_id 
                                    where a.pid = '$pid' group by box_name");
        return $result->result_array();
    }
    
}


