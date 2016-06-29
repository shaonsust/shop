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

    public function project_report($pid)
    {
        $result = $this->db->query("select a.sku, b.box_name, b.barcode, count(b.barcode) as cbarcode from pick_list a inner join box_report b on a.id = b.pl_id where a.pid = '$pid' group by b.barcode, b.box_name order by b.box_name;");
        return $result->result();
    }

    public function amazon_sub_report($pid, $spid)
    {
        $result = $this->db->query("select a.sku, b.box_name, b.barcode, count(b.barcode) as cbarcode from pick_list a inner join box_report b on a.id = b.pl_id where a.pid = '$pid' and a.spid = '$spid' group by b.barcode, b.box_name order by b.box_name;");
        return $result->result();
    }
}