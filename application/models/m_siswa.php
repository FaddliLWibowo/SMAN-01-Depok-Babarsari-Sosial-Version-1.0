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
        $sql = "SELECT pesan.id_pesan AS 'id', pesan.pengirim AS 'pengirim',pesan.penerima AS 'penerima', pesan.isi AS 'isi',pesan.waktu AS 'waktu' FROM (SELECT * FROM pesan WHERE penerima=? ORDER BY id_pesan DESC) AS pesan GROUP BY pesan.pengirim";
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
    //UPDATE PROFILE
    public function editprofile($params){
        $sql = "UPDATE siswa SET alamat = ?,moto = ?,avatar = ? WHERE id =?";
        if($this->db->query($sql,$params)){
            return true;
        } else {return false;}
    }
    //SHOW JOINED GROUp
    public function joined_grup($params){//idsiswa-idsiswa-limit-offset
        $sql = "SELECT grup.nama_grup AS 'nama', grup.id_grup AS 'idgrup'
        FROM grup INNER JOIN grup_anggota ON grup_anggota.id_grup = grup.id_grup 
        WHERE grup.admin_siswa = ? OR grup_anggota.id_siswa = ?  ORDER BY grup_anggota.joindate ASC LIMIT ?,?";
        $query = $this->db->query($sql,$params);
        if($query->num_rows>0){
            return $query->result_array();
        }else {
            return array();
        }
    }
    //CEK ADMIN GRUP / BUKAN ADMIN
    public function admin_cek($params){
        $sql = "SELECT * FROM grup WHERE admin_siswa = ? AND id_grup =?";
        $query = $this->db->query($sql,$params);
        if($query->num_row>0){
            return true; //YES ADMIN
        } else {return false;} //NOT ADMIN
    }
    //BTN UNJOIN GRUP
    public function btn_unjoin_grup($params){ //X = grup | Y = siswa
        $this->db->where('id_grup',$params[0]);
        $this->db->where('id_siswa',$params[1]);
        if($this->db->delete('grup_anggota')){
            return true;
        } else {
            return false;
        }
    }
    //BTN JOIN GRUP
    public function btn_join_grup($params){
        $this->db->set('id_grup',$x);
        $this->db->set('id_siswa',$y);
        if($this->db->insert('grup_anggota')){
            return true;
        } else {
            return false;
        }
    }
}