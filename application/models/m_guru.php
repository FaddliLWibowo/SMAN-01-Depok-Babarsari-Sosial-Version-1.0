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
        $this->db->or_where('on_id_guru',$id);//IF DESTINATION = $id
        $this->db->order_by('id_status','desc');
        $this->db->limit(5);
        $query = $this->db->get('status');
        return $query->result_array();
    }
    //CEK UPDATE STATUS RES/DES by id guru
    public function custom_profile_timeline($id,$lastid,$smallid){
        if($lastid > 0){//SETUP LASTID = CHECK LATTEST UPDATES
            $sql = "SELECT * FROM status WHERE id_status > ".$lastid." AND (id_guru = ".$id." OR on_id_guru = ".$id.") ORDER BY id_status DESC";
        } else if ($smallid > 0 ){//MORE UPDATES
            $sql = "SELECT * FROM status WHERE id_status < ".$smallid." AND (id_guru = ".$id." OR on_id_guru = ".$id.") ORDER BY id_status DESC LIMIT 0,3";
        }                     
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    /*
    * ALL ABOUT DATA
    */
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
    //all teacher
    public function all_teacher(){
        $this->db->order_by('nama_lengkap','ASC');
        $query = $this->db->get('guru');
        return $query->result_array();
    }
     //get name by NIP
    public function name_by_NIP($nip){
        $this->db->select('nama_lengkap');
        $this->db->where('nip', $nip);
        $query = $this->db->get('guru');
        $nama = $query->row_array();
        return $nama['nama_lengkap'];
    }
    //all data by NIP
    public function data_by_nip($nip){
        $this->db->where('nip', $nip);
        $query = $this->db->get('guru');
        return $query->row_array();
    }

}