<?php

class m_admin extends CI_Model{
	public function admin_can_login($email,$password){
		//membuat perintah sql dengan menggunakan fungsi bawaan ci
        //untuk perintah SELECT
        $this->db->select('*');
        //untuk perintah WHERE
        $this->db->where('email', $email);
        //untuk perintah WHERE
        $this->db->where('password', $password);
        //eksekusi peritah sql
        $query = $this->db->get('admin');
        //struktur kendali untuk cek apakah data ada atau tidak
        if($query->num_rows() > 0){
            //memasukkan hasil eksekusi query kedalam row_array
            return $query->row_array();
        } else {
            return array();
        }
    }

    //GURU
    public function all_teacher($params){//OFFSET LIMIT
         $sql = "SELECT * FROM guru LIMIT ?,?";
         $query=$this->db->query($sql,$params);
         if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return array();
        }
    }

    //SISWA
    public function all_students($params){//OFFSET LIMIT
         $sql = "SELECT * FROM siswa LIMIT ?,?";
         $query=$this->db->query($sql,$params);
         if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return array();
        }
    }
}