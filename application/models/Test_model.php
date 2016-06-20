<?php
class Test_model extends CI_Model{
    
    public function projects_list($table) {

       
  /*  $this->db->select ( '*' ); 
    $this->db->from ( 'projects' );
    //$this->db->join ( 'projects', 'projects.id =bin.project_id' );
    //$this->db->join ( 'item', 'item.bin_id = bin.bin_id' );
    $query = $this->db->get ();
    return $query->result ();*/
         $sql = "select * from $table";
        $query = $this->db->query($sql);
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
    public function select_bin_by_pro_id($table, $id) {
        $this->db->select('*')
                ->from($table)
                ->where('project_id', $id);
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
        public function select_item_by_bin_id($table, $id) {
        $this->db->select('*')
                ->from($table)
                ->where('bin_id', $id);
        $query = $this->db->get();
       return $query->result_array();
    }
        public function edit_pro_by_pro_id($table, $id) {
        $this->db->select('*')
                ->from($table)
                ->where('id', $id);
        $query_result = $this->db->get();
        return $result = $query_result->row();
    }
    public function edit_bin_by_bin_id($table, $bin_id) {
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
    public function inactive_project($table,$id,$data){
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }
    public function change_pro_by_pro_id($table,$id){
          $this->db->select('*')
                ->from($table)
                ->where('id', $id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $r=$result->status;
    }
}