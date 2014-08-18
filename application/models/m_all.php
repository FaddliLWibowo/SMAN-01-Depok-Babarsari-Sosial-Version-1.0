<?php

class m_all extends CI_Model{
	/*
	* ALL ABOUT STATUS
	*/

	//UPDATE STATUS
	public function update_status($params){
		if($this->db->insert('status',$params)){return true;}else{return false;}
	}

	//SHOW ALL STATUS, AUTO LOAD WHERE OPEN TIMELINE LIMIT 3 STATUS
	public function start_status(){
		$this->db->where('publik',1);
		$this->db->limit(8);
		$this->db->order_by('id_status','desc');
		$query = $this->db->get('status');
		if($query->num_rows()>0){
			return $query->result_array();
		}else{return array();}
	}

	//SHOW UPDATED STATUS
	public function show_updated_status($lastid){
		$this->db->where('publik',1);
		$this->db->where('id_status >',$lastid);//ID BIGGER THEN $lastid , post yang ditampilkan sekarang
		$this->db->order_by('id_status','desc');
		$query = $this->db->get('status');
		if($query->num_rows()>0){
			return $query->result_array();
		}else{return array();}
	}

	//SHOW MORE STATUS
	public function show_more_status($lastid){
		$this->db->where('publik',1);
		$this->db->where('id_status <',$lastid);//ID BIGGER THEN $lastid
		$this->db->limit(3);
		$this->db->order_by('id_status','desc');
		$query = $this->db->get('status');
		if($query->num_rows()>0){
			return $query->result_array();
		}else{return array();}
	}

	/*
	* ALL ABOUT COMMENTS
	*/

	public function show_comment_by_id($id){
		$this->db->where('id_status',$id);
		$this->db->limit(3);
		$query = $this->db->get('status_komentar');
		if($query->num_rows > 0){
			$query = $query->result_array();
			return $query;
		} else {
			return array();
		}

	} 

	/*
	* ALL ABOUT MESSAGES
	*/

	//KIRIM PESAN
	public function send_message($params){
		$sql = "INSERT INTO pesan(pengirim, penerima, isi, waktu) VALUES(?,?,?, CURTIME())";
		if($this->db->query($sql, $params)){return true;} else {return false;}
	}
	//PESAN SAYA
	public function pesan_saya($param){
		$sql = "SELECT pesan.pengirim AS 'pengirim',pesan.penerima AS 'penerima', pesan.isi AS 'isi',pesan.waktu AS 'waktu' FROM (SELECT * FROM pesan WHERE penerima=? ORDER BY waktu ASC) AS pesan WHERE penerima=? GROUP BY pengirim ORDER BY waktu DESC LIMIT 10 OFFSET 0";
		$result = $this->db->query($sql, array($param,$param));
		if($result->num_rows>0) {
			return $result->result_array();
		} else {	
			return array();
		}
	}
	//ISI PESAN SAYA
	public function isi_pesan_saya($params){
		$sql = "SELECT * FROM `pesan`WHERE (pengirim = ? AND penerima= ?) OR (pengirim = ? AND penerima = ?) ORDER BY waktu ASC";
		$result = $this->db->query($sql, $params);
		if($result->num_rows>0) {
			return $result->result_array();
		} else {	
			return array();
		}
	}
	//KIRIM PESAN VIA MODAL
	public function kirim_pesan_via_modal($params){
		$sql ="INSERT INTO pesan(pengirim,penerima,isi, waktu) VALUES(?,?,?, CURTIME())";
		$this->db->query($sql,$params);
	}
}