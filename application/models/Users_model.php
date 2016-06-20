<?php

class Users_model extends CI_Model {

    public function users_list($table, $limit = 250, $start = 0) 
    {
//     	echo $limit;
//     	die();
        $this->db->select('*')->from($table)->where('role', 3)->order_by('full_name', 'asc')->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function users_list1($table)
    {
    	//     	echo $limit;
    	//     	die();
    	$this->db->select('*')->from($table)->where('role', 3);
    	$query = $this->db->get();
    	return $query->num_rows();
    }

    public function create_users($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function user($table, $id) {
        $this->db->select('*')
                ->from($table)
                ->where('id', $id);
        $query_result = $this->db->get();
        return $result = $query_result->row();
    }

    public function update_users($table, $data, $id) {
//        echo '<pre>';
//        print_r($data);
//        die();
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }
    
    public function update_password($table, $data, $id)
    {
        $this->db->where('id', $id);
        $this->db->where('password', md5($data['old_password']));
        $this->db->update($table, $data);
    }

    public function delete_users($table, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }

}
