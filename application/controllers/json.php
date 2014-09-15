<?php
//JSON ENCODER
class json extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_all');//MODELS FOR ALL
		$this->load->model('m_siswa');
		$this->load->model('m_guru');
		$this->load->model('m_grup');
	}

	public function index(){
		echo '<center><h1>ERROR 403 : FORBIDEN ACCESS</h1></center>';
	}

	/*
	* ALL ABOUT STATUS
	*/

	//START TIMELINE STATUS
	public function start_status(){
		//QUERY
		if(!empty($this->input->get('idsiswa'))){ //POST ON PROFILE SISWA
			$idsiswa = $this->input->get('idsiswa');			
			if(!empty($this->input->get('last'))){
				$lastid=$this->input->get('last');
				$smallid=0;
				$status = $this->m_siswa->custom_profile_timeline($idsiswa,$lastid,$smallid);
			}
			else if(!empty($this->input->get('small'))){				
				$smallid=$this->input->get('small');
				$lastid=0; 
				$status = $this->m_siswa->custom_profile_timeline($idsiswa,$lastid,$smallid);
			}
			else {//STATUS ON SISWA PROFILE PAGE		
				$status = $this->m_siswa->profile_timeline($idsiswa);
			}
		} else if(!empty($this->input->get('idguru'))){ //POST ON PROFILE GURU
			$idguru = $this->input->get('idguru');
			if(!empty($this->input->get('last'))){
				$lastid=$this->input->get('last');
				$smallid=0;
				$status = $this->m_guru->custom_profile_timeline($idguru,$lastid,$smallid);
			}
			else if(!empty($this->input->get('small'))){				
				$smallid=$this->input->get('small');
				$lastid=0; 
				$status = $this->m_guru->custom_profile_timeline($idguru,$lastid,$smallid);
			}
			else {//STATUS ON SISWA PROFILE PAGE		
				$status = $this->m_guru->profile_timeline($idguru);
			}			
		} else if(!empty($this->input->get('lastid'))){ //CHECK LATTEST STATUS FOR TIMELINE
			$lastid = $this->input->get('lastid');
			$status = $this->m_all->show_updated_status($lastid);
		} else if(!empty($this->input->get('smallid'))){ //CHECK MORE STATUS FOR TIMELINE
			$smallid = $this->input->get('smallid');
			$status = $this->m_all->show_more_status($smallid);
		} else { //DEFAULT JSON
			$status = $this->m_all->start_status(); //STATUS ON TIMELINE
		}	
		//LOOPING	
		foreach($status as $s):
			$id=$s['id_status'];
		$content=$s['isi_status'];
		$tag=$s['tag'];
		$id_siswa=$s['id_siswa'];
		$id_guru=$s['id_guru'];
		$id_grup=$s['id_grup'];
		$des_id_siswa=$s['on_id_siswa'];
		$des_id_guru=$s['on_id_guru'];
		$des_id_grup=$s['on_id_grup'];	
		$waktu=$s['waktu'];
			//GET RESOURCE NAME,LINK,AVATAR
		if(!is_null($id_siswa)){
				$data = $this->m_siswa->data_by_id($id_siswa);//GET STUDENT NAME BY ID
				$link = site_url('siswa/profile/'.$data['nis']);
				$name = $data['nama_lengkap'];
				$avatar = $data['avatar'];
			}else if(!is_null($id_guru)){
				$data = $this->m_guru->data_by_id($id_guru);//GET TEACHER NAME BY ID
				$link = site_url('guru/profile/'.$data['nip']);
				$name = $data['nama_lengkap'];
				$avatar = $data['avatar'];
			}else if(!is_null($id_grup)){
				$name = 'on construct';//GET GROUP NAME BY ID;
			}
			//IF NOT SET AVATAR			
			if(!$avatar){ //IF NOT UPLOAD AVATAR
				$avatar = base_url('assets/img/avatar/avatar.jpg');
			} else{ //UPLOADED AVATAR , GET AVATAR LOCATION
				$avatar = base_url('assets/img/avatar/'.$avatar);
			}
			//GET DESTINATION NAME,LINK,AVATAR
			if(!is_null($des_id_siswa)){
				$des_data = $this->m_siswa->data_by_id($des_id_siswa);//GET STUDENT NAME BY ID
				$des_link = site_url('siswa/profile/'.$des_data['nis']);
				$des_name = $des_data['nama_lengkap'];
				$des_avatar = $des_data['avatar'];
			}else if(!is_null($des_id_guru)){
				$des_data = $this->m_guru->data_by_id($des_id_guru);//GET TEACHER NAME BY ID
				$des_link = site_url('guru/profile/'.$des_data['nip']);
				$des_name = $des_data['nama_lengkap'];
				$des_avatar = $des_data['avatar'];
			}else if(!is_null($des_id_grup)){
				$des_name = 'on construct';//GET GROUP NAME BY ID;
			}

			$result[] = array('id'=>$id,'content'=>$content,'tag'=>$tag,'profile'=>$link,'name'=>$name,'avatar'=>$avatar,
				'des_profile'=>$des_link,'des_name'=>$des_name,'des_avatar'=>$des_avatar,'time'=>$waktu);
			endforeach;
		//ENCODE TO JSON
			$json['result'] = $result;
		//ECHO JSON
			echo json_encode($json);
		}

	//SHOW UPDATED STATUS
		public function show_updated_status(){
			$lastid = $this->input->get('lastid');
			$status = $this->m_all->show_updated_status($lastid);
			foreach($status as $s):
				$id=$s['id_status'];
			$content=$s['isi_status'];
			$tag=$s['tag'];
			$id_siswa=$s['id_siswa'];
			$id_guru=$s['id_guru'];
			$id_grup=$s['id_grup'];
			$waktu=$s['waktu'];
			//GET USER NAME
			if(!is_null($id_siswa)){
				$data = $this->m_siswa->data_by_id($id_siswa);//GET STUDENT NAME BY ID
			}else if(!is_null($id_guru)){
				$data = $this->m_guru->data_by_id($id_guru);//GET TEACHER NAME BY ID
			}else if(!is_null($id_grup)){
				$name = 'on construct';//GET GROUP NAME BY ID;
			}
			$name = $data['nama_lengkap'];
			$avatar = $data['avatar'];
			if(!$avatar){ //IF NOT UPLOAD AVATAR
				$avatar = base_url('assets/img/avatar/avatar.jpg');
			} else{ //UPLOADED AVATAR , GET AVATAR LOCATION
				$avatar = base_url('assets/img/avatar/'.$avatar);
			}
			$result[] = array('id'=>$id,'content'=>$content,'tag'=>$tag,'name'=>$name,'avatar'=>$avatar,'time'=>$waktu);
			endforeach;
		//ENCODE TO JSON
			$json['result'] = $result;
		//ECHO JSON
			echo json_encode($json);
		}

	//SHOW MORE STATUS
		public function show_more_status(){
			$lastid = $this->input->get('lastid');
			$status = $this->m_all->show_more_status($lastid);
			foreach($status as $s):
				$id=$s['id_status'];
			$content=$s['isi_status'];
			$tag=$s['tag'];
			$id_siswa=$s['id_siswa'];
			$id_guru=$s['id_guru'];
			$id_grup=$s['id_grup'];
			$waktu=$s['waktu'];
			//GET USER NAME
			if(!is_null($id_siswa)){
				$data = $this->m_siswa->data_by_id($id_siswa);//GET STUDENT NAME BY ID
			}else if(!is_null($id_guru)){
				$data = $this->m_guru->data_by_id($id_guru);//GET TEACHER NAME BY ID
			}else if(!is_null($id_grup)){
				$name = 'on construct';//GET GROUP NAME BY ID;
			}
			$name = $data['nama_lengkap'];
			$avatar = $data['avatar'];
			if(!$avatar){ //IF NOT UPLOAD AVATAR
				$avatar = base_url('assets/img/avatar/avatar.jpg');
			} else{ //UPLOADED AVATAR , GET AVATAR LOCATION
				$avatar = base_url('assets/img/avatar/'.$avatar);
			}
			$result[] = array('id'=>$id,'content'=>$content,'tag'=>$tag,'name'=>$name,'avatar'=>$avatar,'time'=>$waktu);
			endforeach;
		//ENCODE TO JSON
			$json['result'] = $result;
		//ECHO JSON
			echo json_encode($json);
		}

	/*
	* ALL ABOUT COMMENT
	*/
	public function show_comment_by_id(){
		$id = $this->input->get('id');
		$comments = $this->m_all->show_comment_by_id($id);
		foreach($comments as $c):
			$id_komentar =$c['id_komentar'];
		$id_status = $c['id_status'];
		$id_siswa = $c['id_siswa'];
		$id_guru = $c['id_guru'];
		$isi = $c['komentar'];
		$waktu = $c['time'];
			//GET USER NAME
		if(!is_null($id_siswa)){
				$data = $this->m_siswa->data_by_id($id_siswa);//GET STUDENT NAME BY ID
			}else if(!is_null($id_guru)){
				$data = $this->m_guru->data_by_id($id_guru);//GET TEACHER NAME BY ID
			}else if(!is_null($id_grup)){
				$name = 'on construct';//GET GROUP NAME BY ID;
			}
			$name = $data['nama_lengkap'];
			$avatar = $data['avatar'];
			if(!$avatar){ //IF NOT UPLOAD AVATAR
				$avatar = base_url('assets/img/avatar/avatar.jpg');
			} else{ //UPLOADED AVATAR , GET AVATAR LOCATION
				$avatar = base_url('assets/img/avatar/'.$avatar);
			}
			$result[] = array('id_komentar'=>$id_komentar,'id_status'=>$id_status,'name'=>$name,'avatar'=>$avatar,'isi'=>$isi,'waktu'=>$waktu);
			endforeach;
			if(!empty($result)){
			//ENCODE TO JSON
				$json['result'] = $result;
		//ECHO JSON
				echo json_encode($json);
			} else {
				echo 'tidak ada status';
			}

		}
		public function	grup_start_status(){
			$idgrup = $this->input->get('id');
			if(!empty($this->input->get('last'))){ //CHECK LATTEST STATUS FOR TIMELINE
				$lastid = $this->input->get('last');
				$status = $this->m_all->grup_update_status($idgrup,$lastid);
			} else if(!empty($this->input->get('small'))){ //CHECK MORE STATUS FOR TIMELINE
				$smallid = $this->input->get('small');
				$status = $this->m_all->grup_more_status($idgrup,$smallid);
			} else { //DEFAULT JSON
				$status = $this->m_all->grup_start_status($idgrup); //STATUS ON TIMELINE
			}
			//LOOPING	
			foreach($status as $s):
				$id=$s['id_status'];
			$content=$s['isi_status'];
			$tag=$s['tag'];
			$id_siswa=$s['id_siswa'];
			$id_guru=$s['id_guru'];
			$id_grup=$s['id_grup'];
			$des_id_siswa=$s['on_id_siswa'];
			$des_id_guru=$s['on_id_guru'];
			$des_id_grup=$s['on_id_grup'];	
			$waktu=$s['waktu'];
			$noupload= array(' ','','null','0');
			if(in_array($s['file'], $noupload)) {			
				$uploadname = 'kosong';
				$upload = null;
			} else {
				$uploadname = $s['file'];
				$upload = base_url('assets/upload/'.$s['file']);
			}
				//GET RESOURCE NAME,LINK,AVATAR
			if(!is_null($id_siswa)){
					$data = $this->m_siswa->data_by_id($id_siswa);//GET STUDENT NAME BY ID
					$link = site_url('siswa/profile/'.$data['nis']);
					$name = $data['nama_lengkap'];
					$avatar = $data['avatar'];
				}else if(!is_null($id_guru)){
					$data = $this->m_guru->data_by_id($id_guru);//GET TEACHER NAME BY ID
					$link = site_url('guru/profile/'.$data['nip']);
					$name = $data['nama_lengkap'];
					$avatar = $data['avatar'];
				}
				//IF NOT SET AVATAR			
				if(!$avatar){ //IF NOT UPLOAD AVATAR
					$avatar = base_url('assets/img/avatar/avatar.jpg');
				} else{ //UPLOADED AVATAR , GET AVATAR LOCATION
					$avatar = base_url('assets/img/avatar/'.$avatar);
				}
				//GET DESTINATION NAME,LINK,AVATAR
				if(!is_null($des_id_grup)){
					$des_data = $this->m_grup->data_by_id($des_id_grup);//get grup data
					$des_link = site_url('grup/welcome/'.$des_data['id_grup'].'/'.$des_data['nama_grup']);
					$des_name = $des_data['nama_grup'];
					$des_avatar = $des_data['avatar'];
				}

				$result[] = array('id'=>$id,'content'=>$content,'tag'=>$tag,'profile'=>$link,'name'=>$name,'avatar'=>$avatar,
					'des_profile'=>$des_link,'des_name'=>$des_name,'des_avatar'=>$des_avatar,'time'=>$waktu, 'upload'=>$upload,'uploadname'=>$uploadname);
				endforeach;
			//ENCODE TO JSON
				$json['result'] = $result;
			//ECHO JSON
				echo json_encode($json);
		}
	}