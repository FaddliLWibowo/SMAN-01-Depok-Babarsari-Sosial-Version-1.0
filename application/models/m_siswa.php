<?php

class m_siswa extends CI_Model{
	//tes login untuk siswa
	public function can_log_in($nis, $password){
		//membuat perintah sql dengan menggunakan fungsi bawaan ci
        //untuk perintah SELECT
        $this->db->select('*');
        //untuk perintah WHERE
        $this->db->where('nis', $nis);
        //untuk perintah WHERE
        $this->db->where('password', $password);
        //eksekusi peritah sql
        $query = $this->db->get('siswa');
        //struktur kendali untuk cek apakah data ada atau tidak
        if($query->num_rows() > 0){
            //memasukkan hasil eksekusi query kedalam row_array
            return $query->row_array();
        } else {
            return array();
        }
	}
    /*
    * ALL ABOUT STATUS
    */
    //STATUS RES/DES by id SISWA
    public function profile_timeline($id){
        $this->db->where('id_siswa',$id);//IF RESOURCE = $id
        $this->db->or_where('on_id_siswa',$id);//IF DESTINATION = $id
        $this->db->order_by('id_status','desc');
        $this->db->limit(5);
        $query = $this->db->get('status');
        return $query->result_array();
    }  
    //CEK UPDATE STATUS RES/DES by id SISWA
    public function custom_profile_timeline($id,$lastid,$smallid){
        if($lastid > 0){//SETUP LASTID = CHECK LATTEST UPDATES
            $sql = "SELECT * FROM status WHERE id_status > ".$lastid." AND (id_siswa = ".$id." OR on_id_siswa = ".$id.") ORDER BY id_status DESC";
        } else if ($smallid > 0 ){//MORE UPDATES
            $sql = "SELECT * FROM status WHERE id_status < ".$smallid." AND (id_siswa = ".$id." OR on_id_siswa = ".$id.") ORDER BY id_status DESC LIMIT 0,3";
        }                     
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    //get name by NIS
    public function name_by_NIS($nis){
        $this->db->select('nama_lengkap');
        $this->db->where('nis', $nis);
        $query = $this->db->get('siswa');
        $nama = $query->row_array();
        return $nama['nama_lengkap'];
    }
    //get name by id
    public function name_by_id($id){
        $this->db->select('nama_lengkap');
        $this->db->where('id', $id);
        $query = $this->db->get('siswa');
        $nama = $query->row_array();
        return $nama['nama_lengkap'];
    }
    //all data by id
    public function data_by_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get('siswa');
        return $query->row_array();
    }
    //all data by nis
    public function data_by_nis($nis){
        $this->db->where('nis', $nis);
        $query = $this->db->get('siswa');
        return $query->row_array();
    }
    //show timeline by user
    public function timeline_by_NIS($nis){
        $this->db->select('*');
        $this->db->where('nis', $nis);
        $query = $this->db->get('status');
        if($query->num_rows() > 0){
            //memasukkan hasil eksekusi query kedalam row_array
            return $query->result_array();
        } else {
            return array();
        }   
    }
    //SEARCH SISWA
    public function searchsiswa($id){
        $sql = "SELECT * FROM siswa WHERE nis = ?";
        $result = $this->db->query($sql, $id);
        if($result->num_rows()>0) {
            $result = $result->row_array();
            $v ='<div class="well well-sm">
              <p> Siswa : '.$result['nis'].' / '.$result['nama_lengkap']. ' <span style="color:green" class="glyphicon glyphicon-ok-circle"></span></p>
            </div>'; 
        } else {
            $v = '<div class="well well-sm">
              <p>Tidak ada user ditemukan</p>
            </div>';
        }        
        return $v;
    }
    //SEMUA PESAN BERDASAR NIS
    public function semuapesan($penerima){
        $sql = "SELECT pesan.pengirim AS 'pengirim',pesan.penerima AS 'penerima', pesan.isi AS 'isi',pesan.waktu AS 'waktu' FROM (SELECT * FROM pesan WHERE penerima=? ORDER BY waktu ASC) AS pesan WHERE penerima=? GROUP BY pengirim ORDER BY waktu DESC";
        $result = $this->db->query($sql, array($penerima,$penerima));
        if($result->num_rows()>0){
            return $result->result_array();
        }else{
            return array();
        }
    }
    //UPDATE PASSWORD
    public function updatepassword($param){
        $data = array('password'=>md5($param));
        $this->db->where('nis', $this->session->userdata('nis'));
        $this->db->update('siswa',$data);//EXEC
    }
}