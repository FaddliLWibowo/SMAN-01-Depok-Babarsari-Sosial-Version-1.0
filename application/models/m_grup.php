<?php

class m_grup extends CI_Model{
	public function data_by_id($id){
        $sql = "SELECT * FROM grup WHERE id_grup = ?";
        $query = $this->db->query($sql,$id);
        return $query->row_array();
    }
}