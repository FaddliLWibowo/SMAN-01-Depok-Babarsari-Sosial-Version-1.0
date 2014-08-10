<?php

class m_all extends CI_Model{
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