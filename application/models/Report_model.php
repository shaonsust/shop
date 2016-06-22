<?php
class Report_model extends CI_Model
{
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

    public function select_list($pid)
    {
        $this->db->select()->from('pick_list')->where('pid', $pid)->order_by('status', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function select_box_name($pid, $barcode)
    {
        $result = $this->db->query("select DISTINCT box_name from box_report where barcode = '$barcode' AND pid = '$pid'");
        return $result->result();
    }
}