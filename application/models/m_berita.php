<?php

class m_berita extends CI_Model{
	//LIHAT SEMUA BERITA
	function berita($x,$y){
		$sql = "SELECT * FROM berita ORDER BY id_berita DESC LIMIT ".$y.",".$x;
		$query =$this->db->query($sql);
		if($query->num_rows()>0){return $query->result_array();}else{return array();}
	}
	//BERITA BY ID
	function berita_by_id($id){
		$this->db->where('id_berita',$id);
		$query = $this->db->get('berita');
		if($query->num_rows()>0){return $query->row_array();}else{return array();}
	}
}