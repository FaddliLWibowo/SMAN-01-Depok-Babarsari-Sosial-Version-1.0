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

	public function grup_start_status($id){
		$this->db->where('on_id_grup',$id);
		$this->db->limit(8);
		$this->db->order_by('id_status','desc');
		$query = $this->db->get('status');
		if($query->num_rows()>0){
			return $query->result_array();
		}else{return array();}
	}

	public function grup_update_status($id,$lastid){
		$this->db->where('id_status >',$lastid);
		$this->db->where('on_id_grup',$id);
		$this->db->limit(8);
		$this->db->order_by('id_status','desc');
		$query = $this->db->get('status');
		if($query->num_rows()>0){
			return $query->result_array();
		}else{return array();}
	}

	public function grup_more_status($id,$smallid){
		$this->db->where('id_status <',$smallid);
		$this->db->where('on_id_grup',$id);
		$this->db->limit(5);
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
	public function show_more_status($smallid){
		$this->db->where('publik',1);
		$this->db->where('id_status <',$smallid);//ID BIGGER THEN $lastid
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
		$sql = "SELECT pesan.id_pesan AS 'id', pesan.pengirim AS 'pengirim',pesan.penerima AS 'penerima', pesan.isi AS 'isi',pesan.waktu AS 'waktu' FROM (SELECT * FROM pesan WHERE penerima=? ORDER BY id_pesan DESC) AS pesan GROUP BY pesan.pengirim ORDER BY pesan.id_pesan DESC LIMIT 0,10";
		$result = $this->db->query($sql, array($param,$param));
		if($result->num_rows>0) {
			return $result->result_array();
		} else {	
			return array();
		}
	}
	//ISI PESAN SAYA
	public function isi_pesan_saya($params){
		$sql = "SELECT pesan.pengirim AS 'pengirim',pesan.penerima AS 'penerima',pesan.id_pesan AS 'id_pesan',pesan.waktu AS 'waktu',pesan.isi AS 'isi'
		FROM `pesan`WHERE (pengirim = ? AND penerima= ?) OR (pengirim = ? AND penerima = ?) ORDER BY waktu ASC";
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

	/*
	* MATERI
	*/
	//ALL MATERI
	public function all_materi($x,$y){
		$sql="SELECT guru.nip AS 'nip',guru.nama_lengkap AS 'guru',kelas.nama_kelas AS 'kelas',
		matapelajaran.matapelajaran AS 'mapel', judul,link,tahun 
		FROM materi
		INNER JOIN guru ON guru.id = materi.id_guru
		INNER JOIN kelas ON kelas.id_kelas = materi.id_kelas
		INNER JOIN matapelajaran ON matapelajaran.id_matapelajaran= materi.id_matapelajaran
		LIMIT ".$y.",".$x;
		$this->db->order_by('id_materi','desc');
		$query = $this->db->query($sql);
		if($query->num_rows()>0){return $query->result_array();}else{return array();}
	}
	//ALL SOAL
	public function all_soal($x,$y){
		$sql="SELECT guru.nama_lengkap AS 'guru',kelas.nama_kelas AS 'kelas',
		matapelajaran.matapelajaran AS 'mapel', judul,link,tahun 
		FROM soal
		INNER JOIN guru ON guru.id = soal.id_guru
		INNER JOIN kelas ON kelas.id_kelas = soal.id_kelas
		INNER JOIN matapelajaran ON matapelajaran.id_matapelajaran= soal.id_matapelajaran
		LIMIT ".$y.",".$x;
		$this->db->order_by('id_soal','desc');
		$query = $this->db->query($sql);
		if($query->num_rows()>0){return $query->result_array();}else{return array();}
	}
	//ALL SOAL
	public function all_nilai($x,$y){
		$sql="SELECT guru.nama_lengkap AS 'guru',kelas.nama_kelas AS 'kelas',
		matapelajaran.matapelajaran AS 'mapel', judul,link,tahun 
		FROM nilai
		INNER JOIN guru ON guru.id = nilai.id_guru
		INNER JOIN kelas ON kelas.id_kelas = nilai.id_kelas
		INNER JOIN matapelajaran ON matapelajaran.id_matapelajaran= nilai.id_matapelajaran
		LIMIT ".$y.",".$x;
		$this->db->order_by('id_soal','desc');
		$query = $this->db->query($sql);
		if($query->num_rows()>0){return $query->result_array();}else{return array();}
	}
	/*
	* ALL ABOUT GROUP
	*/
	//CREATING GRUP
	public function creategroup($params){
		$sql = "INSERT INTO grup(nama_grup,deskripsi_grup,admin_siswa,admin_guru,avatar)
		VALUES(?,?,?,?,?)";
		if($this->db->query($sql,$params)) {return true;} else {return false;}
	}
	public function deletegroup($id){
		
	}
	//DELETE GROUP
	//SHOW ALL GRUP
	public function show_all_group($params){//LIMIT + OFFSET
		$sql = "SELECT * FROM grup ORDER BY id_grup DESC LIMIT ?,?";
		$query = $this->db->query($sql,$params);
		if($query->num_rows>0){
			return $query->result_array();			
		}else{
			return array();
		}
	}
	//SHOW GRUP DETAIL
	public function detail_group($id){
		$this->db->where('id_grup',$id);
		$query = $this->db->get('grup');
		if($query->num_rows>0){
			return $query->row_array();
		} else {
			return array();
		}
	}
	//SHOW ALL MEMBER
	public function show_all_member($id){
		$sql = "SELECT grup_anggota.id_siswa AS 'siswa', grup_anggota.id_guru AS 'guru'
		FROM grup_anggota 
		WHERE grup_anggota.id_grup = ?
		ORDER BY grup_anggota.joindate DESC
		LIMIT 0,5";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	//COUNT GROUP MEMBER
	public function count_member($id){
		$this->db->where('id_grup',$id);
		return $this->db->count_all_results('grup_anggota');
	}
	//CEK TEACHER IS MEMBER ?
	public function check_member_as_guru($x,$y){//ID GRUP ID ANGGOTA
		$sql = "SELECT * FROM grup_anggota WHERE id_grup = ".$x." AND id_guru = ".$y;
		$query = $this->db->query($sql);
		if($query->num_rows>0){return true;}else{return false;}
	}
	//CEK STUDENT IS MEMBER ?
	public function check_member_as_siswa($x,$y){//ID GRUP ID ANGGOTA
		$sql = "SELECT * FROM grup_anggota WHERE id_grup = ".$x." AND id_siswa = ".$y;
		$query = $this->db->query($sql);
		if($query->num_rows>0){return true;}else{return false;}
	}
	//CEK TEACHER IS ADMIN
	public function check_admin_as_guru($x,$y){
		$sql = "SELECT * FROM grup WHERE id_grup = ".$x." AND admin_guru = ".$y;
		$query = $this->db->query($sql);
		if($query->num_rows>0){return true;}else{return false;}
	}
	//CEK STUDENT IS ADMIN
	public function check_admin_as_siswa($x,$y){
		$sql = "SELECT * FROM grup WHERE id_grup = ".$x." AND admin_siswa = ".$y;
		$query = $this->db->query($sql);
		if($query->num_rows>0){return true;}else{return false;}	
	}

	///////////////////// FOR ADMIN ONLY /////////////////////////
	
}