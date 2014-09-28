<?php

class m_guru extends CI_Model{
	//TES LOGIN UNTUK guru
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
    //SEMUA PESAN BERDASAR NIP
    public function semuapesan($penerima){
        $sql = "SELECT pesan.id_pesan AS 'id', pesan.pengirim AS 'pengirim',pesan.penerima AS 'penerima', pesan.isi AS 'isi',pesan.waktu AS 'waktu' FROM (SELECT * FROM pesan WHERE penerima=? ORDER BY id_pesan DESC) AS pesan GROUP BY pesan.pengirim";
        $result = $this->db->query($sql, array($penerima,$penerima));
        if($result->num_rows()>0){
            return $result->result_array();
        }else{
            return array();
        }
    }
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
              <p> guru : '.$result['nip'].' / '.$result['nama_lengkap']. ' <span style="color:green" class="glyphicon glyphicon-ok-circle"></span></p>
            </div>'; 
        } else {
            $v = '<div class="well well-sm">
              <p>Tidak ada user ditemukan</p>
            </div>';
        }        
        return $v;
    }
    //check nip
    public function check_nip($nip){
        $sql = "SELECT * FROM guru WHERE nip = ? ";
        $result = $this->db->query($sql,$nip);
        if($result->num_rows>0){
            return true;
        } else {
            return false;
        }
    }
    //GET NAME BY ID
    public function name_by_id($id){
        $this->db->select('nama_lengkap');
        $this->db->where('id', $id);
        $query = $this->db->get('guru');
        $nama = $query->row_array();
        return $nama['nama_lengkap'];
    }
    //ALL DATA BY ID
    public function data_by_id($id){
        $sql = "SELECT * FROM guru WHERE id = ?";
        $query = $this->db->query($sql,$id);
        return $query->row_array();
    }
    //ALL TEACHER
    public function all_teacher(){
        $this->db->order_by('nama_lengkap','ASC');
        $query = $this->db->get('guru');
        return $query->result_array();
    }
    //GET NAME BY NIP
    public function name_by_NIP($nip){
        $this->db->select('nama_lengkap');
        $this->db->where('nip', $nip);
        $query = $this->db->get('guru');
        $nama = $query->row_array();
        return $nama['nama_lengkap'];
    }
    //ALL DATA BY NIP
    public function data_by_nip($nip){
        $this->db->where('nip', $nip);
        $query = $this->db->get('guru');
        return $query->row_array();
    }
    //UPDATE PASSWORD
    public function updatepassword($param){
        $data = array('password'=>md5($param));
        $this->db->where('nip', $this->session->userdata('nip'));
        $this->db->update('guru',$data);//EXEC
    }
    //UPDATE PROFILE
    public function editprofile($params){
        $sql = "UPDATE guru SET alamat = ?,moto = ?,avatar = ? WHERE id =?";
        if($this->db->query($sql,$params)){
            return true;
        } else {return false;}
    }
    /*
    * ALL ABOUT AJAR MENGAJAR
    */
    public function guru_ajar($idguru){//GURU + SUBCLASS + MATA PELAJARAN
        $sql = "SELECT mengajar.id_mengajar AS 'ajar', guru.nama_lengkap AS 'nama',kelas.id_kelas AS 'id_kelas',kelas.nama_kelas AS 'kelas',subkelas.nama AS 'subkelas',
        matapelajaran.id_matapelajaran AS 'id_matapelajaran', matapelajaran.matapelajaran AS 'matapelajaran',mengajar.hari AS 'hari',mengajar.jam_mulai AS 'mulai',mengajar.jam_selesai AS 'selesai' 
        FROM mengajar 
        LEFT JOIN guru ON guru.id=mengajar.id_guru
        LEFT JOIN matapelajaran ON matapelajaran.id_matapelajaran=mengajar.id_matapelajaran
        LEFT JOIN subkelas ON mengajar.id_subkelas=subkelas.id_subkelas
        LEFT JOIN kelas ON subkelas.kelas = kelas.id_kelas 
        WHERE mengajar.id_guru=?  GROUP BY kelas.id_kelas
        ";
        $query = $this->db->query($sql,$idguru);
        if($query->num_rows()>0){return $query->result_array();}else{return array();}
    }
    public function ajar($idajar){//GURU + SUBCLASS + MATA PELAJARAN
        $sql = "SELECT mengajar.id_mengajar AS 'ajar', guru.nama_lengkap AS 'nama',kelas.id_kelas AS 'id_kelas',kelas.nama_kelas AS 'kelas',mengajar.id_subkelas AS 'id_subkelas',subkelas.nama AS 'subkelas',
        matapelajaran.id_matapelajaran AS 'id_matapelajaran', matapelajaran.matapelajaran AS 'matapelajaran',mengajar.hari AS 'hari',mengajar.jam_mulai AS 'mulai',mengajar.jam_selesai AS 'selesai' 
        FROM mengajar 
        LEFT JOIN guru ON guru.id=mengajar.id_guru
        LEFT JOIN matapelajaran ON matapelajaran.id_matapelajaran=mengajar.id_matapelajaran
        LEFT JOIN subkelas ON mengajar.id_subkelas=subkelas.id_subkelas
        LEFT JOIN kelas ON subkelas.kelas = kelas.id_kelas 
        WHERE mengajar.id_mengajar=?;
        ";
        $query = $this->db->query($sql,$idajar);
        if($query->num_rows()>0){return $query->row_array();}else{return array();}
    }
    //MATERI BY GURU
    public function mymateri($nexus){
        $sql = "SELECT * FROM materi WHERE id_guru = ? AND tahun = ? AND id_matapelajaran= ? AND id_kelas=?
        ORDER BY id_materi DESC";
        $query = $this->db->query($sql,$nexus);
        if($query->num_rows()>0){return $query->result_array();}else{return array();}
    }
    //SORTING MATERI ON SEMUA MATERI
    public function sorting_materi($params){
        
    }
    //SOAL By GURU
    public function mysoal($nexus){
        $sql = "SELECT * FROM soal WHERE id_guru = ? AND tahun = ? AND id_matapelajaran= ? AND id_kelas=? 
        ORDER BY id_soal DESC";
        $query = $this->db->query($sql,$nexus);
        if($query->num_rows()>0){return $query->result_array();}else{return array();}
    }
    //nilai By GURU
    public function mynilai($nexus){
        $sql = "SELECT * FROM nilai WHERE id_guru = ? AND tahun = ? AND id_matapelajaran= ? AND id_kelas=? 
        ORDER BY id_nilai DESC";
        $query = $this->db->query($sql,$nexus);
        if($query->num_rows()>0){return $query->result_array();}else{return array();}
    }

    /*ALL ABOUT GROUP*/
    //SHOW JOINED GROUp
    public function joined_grup($params){//idguru-idguru-limit-offset
        $sql = "SELECT grup.nama_grup AS 'nama', grup.id_grup AS 'idgrup'
        FROM grup INNER JOIN grup_anggota ON grup_anggota.id_grup = grup.id_grup 
        WHERE grup.admin_guru = ? OR grup_anggota.id_guru = ?  ORDER BY grup_anggota.joindate ASC LIMIT ?,?";
        $query = $this->db->query($sql,$params);
        if($query->num_rows>0){
            return $query->result_array();
        }else {
            return array();
        }
    }
    //BTN JOIN GRUP
    public function btn_join_grup($x,$y){
        $this->db->set('id_grup',$x);
        $this->db->set('id_guru',$y);
        if($this->db->insert('grup_anggota')){
            return true;
        } else {
            return false;
        }
    }
    //CEK ADMIN GRUP / BUKAN ADMIN
    public function admin_cek($x,$y){
        $sql = "SELECT * FROM grup WHERE admin_guru = ".$x." AND id_grup =".$y;
        $query = $this->db->query($sql);
        if($query->num_rows>0){
            return true; //YES ADMIN
        } else {return false;} //NOT ADMIN
    }
    //BTN UNJOIN GRUP
    public function btn_unjoin_grup($params){ //X = grup | Y = guru
        $this->db->where('id_grup',$params[0]);
        $this->db->where('id_guru',$params[1]);
        if($this->db->delete('grup_anggota')){
            return true;
        } else {
            return false;
        }
    }
    //jadwal saya
    public function mengajar($id){//id guru
        $sql = "SELECT mengajar.id_guru AS  'guru', kelas.nama_kelas AS  'kelas', subkelas.nama AS  'subkelas', matapelajaran.matapelajaran AS  'mapel', mengajar.hari AS 'hari', mengajar.jam_mulai AS  'mulai', mengajar.jam_selesai AS  'selesai'
        FROM mengajar
        INNER JOIN guru ON mengajar.id_guru = guru.id
        INNER JOIN matapelajaran ON matapelajaran.id_matapelajaran = mengajar.id_matapelajaran
        INNER JOIN subkelas ON subkelas.id_subkelas = mengajar.id_subkelas
        INNER JOIN kelas ON kelas.id_kelas = subkelas.kelas
        WHERE mengajar.id_guru = ?";
        $query = $this->db->query($sql,$id);
        if($query->num_rows()>0){
            return $query->result_array();
        } else {
            return array();
        }
    }
    /*ALL ABOUT MATERI*/
    public function materi_saya($x,$y,$guru){
        $sql="SELECT guru.nip AS 'nip',guru.nama_lengkap AS 'guru',kelas.nama_kelas AS 'kelas',
        matapelajaran.matapelajaran AS 'mapel', judul,link,tahun 
        FROM materi
        INNER JOIN guru ON guru.id = materi.id_guru
        INNER JOIN kelas ON kelas.id_kelas = materi.id_kelas
        INNER JOIN matapelajaran ON matapelajaran.id_matapelajaran= materi.id_matapelajaran
        WHERE materi.id_guru = ".$guru."
        LIMIT ".$y.",".$x;
        $this->db->order_by('id_materi','desc');
        $query = $this->db->query($sql);
        if($query->num_rows()>0){return $query->result_array();}else{return array();}
    }
    /*ALL ABOUT SOAL*/
    public function soal_saya($x,$y,$guru){
        $sql="SELECT guru.nama_lengkap AS 'guru',kelas.nama_kelas AS 'kelas',
        matapelajaran.matapelajaran AS 'mapel', judul,link,tahun 
        FROM soal
        INNER JOIN guru ON guru.id = soal.id_guru
        INNER JOIN kelas ON kelas.id_kelas = soal.id_kelas
        INNER JOIN matapelajaran ON matapelajaran.id_matapelajaran= soal.id_matapelajaran
        WHERE soal.id_guru = ".$guru."
        LIMIT ".$y.",".$x;
        $this->db->order_by('id_soal','desc');
        $query = $this->db->query($sql);
        if($query->num_rows()>0){return $query->result_array();}else{return array();}
    }
    /*ALL ABOUT NILAI*/
    public function nilai_saya($x,$y,$guru){
        $sql="SELECT guru.nama_lengkap AS 'guru',kelas.nama_kelas AS 'kelas',
        matapelajaran.matapelajaran AS 'mapel', judul,link,tahun 
        FROM nilai
        INNER JOIN guru ON guru.id = nilai.id_guru
        INNER JOIN kelas ON kelas.id_kelas = nilai.id_kelas
        INNER JOIN matapelajaran ON matapelajaran.id_matapelajaran= nilai.id_matapelajaran
        WHERE nilai.id_guru = ".$guru."
        LIMIT ".$y.",".$x;
        $this->db->order_by('id_soal','desc');
        $query = $this->db->query($sql);
        if($query->num_rows()>0){return $query->result_array();}else{return array();}
    }
}