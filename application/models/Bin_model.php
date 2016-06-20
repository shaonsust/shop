<?php

class Bin_model extends CI_Model {

    public function insert_bin_number($table, $cdata) {
        $this->db->where('bin_number', $cdata['bin_number']);
        $this->db->where('project_id', $cdata['project_id']);
        $result = $this->db->count_all_results('bin');
        if ($result == 0) {
            $this->db->insert($table, $cdata);
            $newId = $this->db->insert_id();
        } else {
            $newId = 0;
        }
        return $newId;
    }

    public function countItem($binId) {
//        echo $binId."<br>";
        $this->db->where('bin_id', $binId);
        $count = $this->db->count_all_results('item');
        return $count;
    }

    public function insert_item($data) {
        $this->db->insert('item', $data);
        $newId = $this->db->insert_id();
        if (isset($newId) && $newId != 0) {
            $this->db->where('bin_id', $data['bin_id']);
            $result = $this->db->count_all_results('item');
        } else {
            $result = 0;
        }
        return $result;
    }

}
