<?php

class m_guru extends CI_Model{
	//TES LOGIN UNTUK SISWA
	public function can_log_in($nip, $password){
		//membuat perintah sql dengan menggunakan fungsi bawaan ci
        //untuk perintah SELECT
        $this->db->select('*');
        //untuk perintah WHERE
        $this->db->where('nip', $nip);
        //untuk perintah WHERE
        $this->db->where('password', $password);
        //eksekusi peritah sql
        $query = $this->db->get('guru');
        //struktur kendali untuk cek apakah data ada atau tidak
        if($query->num_rows() > 0){
            //memasukkan hasil eksekusi query kedalam row_array
            return $query->row_array();
        } 
	}

    /*
    * ALL ABOUT STATUS
    */
    //STATUS RES/DES by id guru
    public function profile_timeline($id){
        $this->db->where('id_guru',$id);//IF RESOURCE = $id
        $this->db->or_where('id_guru',$id);//IF DESTINATION = $id
        $this->db->order_by('id_status','desc');
        $this->db->limit(10);
        $query = $this->db->get('status');
        return $query->result_array();
    }   

    //SEARCH GURU
    public function searchguru($id){
        $sql = "SELECT * FROM guru WHERE nip = ?";
        $result = $this->db->query($sql, $id);
        if($result->num_rows()>0) {
            $result = $result->row_array();
            $v ='<div class="well well-sm">
              <p> guru : '.$result['nip'].' / '.$result['nama_guru']. ' <span style="color:green" class="glyphicon glyphicon-ok-circle"></span></p>
            </div>'; 
        } else {
            $v = '<div class="well well-sm">
              <p>Tidak ada user ditemukan</p>
            </div>';
        }        
        return $v;
    }

    //get name by id
    public function name_by_id($id){
        $this->db->select('nama_lengkap');
        $this->db->where('id', $id);
        $query = $this->db->get('guru');
        $nama = $query->row_array();
        return $nama['nama_lengkap'];
    }

    //all data by id
    public function data_by_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get('guru');
        return $query->row_array();
    }

}