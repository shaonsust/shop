<?php
class Amazon_model extends CI_Model
{
    public function check_project($table, $field, $data)
    {
        $this->db->select("*")->from($table)->where('project_name', $field);
        $query = $this->db->get();
        $result = $query->result();

        if ($query->num_rows() > 0) {
            return $result[0]->id;
        } else {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
    }

    public function check_sub_project($pid, $sp, $data)
    {
        $this->db->select("*")->from('sub_project')->where(array('pid' => $pid, 'sub_project_name' => $sp));
        $query = $this->db->get();
        $result = $query->result();

        if ($query->num_rows() > 0) {
            return 0;
        } else {
            $this->db->insert('sub_project', $data);
            return $this->db->insert_id();
        }
    }

    public function select_all($table, $pid)
    {
        $this->db->select("*")->from("$table")->where('pid', $pid);
        $query = $this->db->get();
        return $query->result();
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function amazon_item($pid, $spid)
    {
        $this->db->select("*")->from('pick_list')->where(array('pid' => $pid, 'spid' => $spid));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function amazon_full_report($pid)
    {
        $result = $this->db->query("select sku, barcode, sum(qty_scaned) as scanned, sum(qty) as quantity from pick_list where pid = '$pid' group by barcode;");
        return $result->result();
    }

    public function box_report1($pid, $spid)
    {
        $result = $this->db->query("select count(distinct b.barcode) as dtype, a.box_name, scanned, a.pid, a.box_id, a.spid 
                                    from box a left join box_report b on a.box_id = b.box_id 
                                    where a.pid = '$pid' and a.spid = '$spid' group by box_name");
        return $result->result_array();
    }

    public function box_report($pid, $spid)
    {
        $result = $this->db->query("select * from box where pid = '$pid' and spid = '$spid' group by box_name");
        return $result->result_array();
    }

    public function box_report2($pid, $bid, $spid)
    {
        $result = $this->db->query("select box_name, barcode, count(barcode) as cbarcode from box_report where spid = '$spid' and box_id = '$bid' group by barcode");
        return $result->result_array();
    }

    public function box_no($pid, $spid)
    {
        $result = $this->db->query("select count(distinct box_name) as no from box_report where pid = '$pid' and spid = '$spid'");
//     	$result = $this->db->count_all_results('pick_list');
        return $result->row();
    }

    function check_box($pid, $bname, $spid)
    {
        $this->db->select("*")->from('box')->where(array('box_name'=>$bname, 'pid'=>$pid, 'spid'=>$spid));
        $result = $this->db->get();
//        $result = $this->db->query("select * from box where box_name = '$bname' and pid = '$pid'");
        return $result->row();
    }

    public function select_list($pid, $spid)
    {
        $this->db->select()->from('pick_list')->where(array('pid'=>$pid, 'spid'=>$spid))->order_by('status', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function select_box($pid, $spid)
    {
        $this->db->select()->from('box')->where(array('pid'=>$pid, 'spid'=>$spid));
        $query = $this->db->get();
        return $query->result_array();
    }

    function picklist($barcode, $pid, $spid)
    {
//        $result = $this->db->query("select * from pick_list where barcode = '$barcode' and pid = '$pid'");
     	$this->db->select('*')->from('pick_list')->where(array('barcode'=>$barcode, 'pid'=>$pid, 'spid'=>$spid));
     	$result = $this->db->get();
        return $result->row() ;
    }

    function update_pick($barcode, $spid)
    {
        $this->db->query("update pick_list set qty_scaned = qty_scaned + 1 where barcode = '$barcode' and spid = '$spid'");
    }

    public function count_barcode($barcode, $spid)
    {
        $result = $this->db->query("select qty_scaned, qty, barcode from pick_list where barcode = '$barcode' and spid = '$spid'");
//     	$result = $this->db->count_all_results('pick_list');
        return $result->row();
    }

    public function update_picklist_status($barcode, $spid)
    {
        $result = $this->db->query("update pick_list set status = 1 where barcode = '$barcode' and spid = '$spid'");
    }

}