<?php

class m_berita extends CI_Model{
	//LIHAT SEMUA BERITA
	function berita(){
		$query = $this->db->get('berita');
		if($query->num_rows()>0){return $query->result_array();}else{return array();}
	}
	//BERITA BY ID
	function berita_by_id($id){
		$this->db->where('id_berita',$id_berita);
		$query = $this->db->get('berita');
		if($query->num_rows()>0){return $query->result_array();}else{return array();}
	}
}