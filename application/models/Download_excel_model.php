<?php
class Download_excel_model extends CI_Model
{
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function select_all_data($table)
    {
        $query = $this->db->get($table);
        return $query->result();
    }

    public function table_field_name($table)
    {
        $query = $this->db->list_fields($table);
        return $query;
    }

    public function check_data($table, $field, $val)
    {
        $this->db->select('id')->from($table)->where("$field", "$val");
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function get_id($table, $field, $val)
    {
        $this->db->select('id')->from($table)->where("$field", "$val");
        $query = $this->db->get();
        return $query->row_array();
    }
}