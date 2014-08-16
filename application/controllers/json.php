<?php
//JSON ENCODER
class json extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_all');//MODELS FOR ALL
		$this->load->model('m_siswa');
		$this->load->model('m_guru');
	}

	public function index(){
		echo '<center><h1>ERROR 403 : FORBIDEN ACCESS</h1></center>';
	}

	//START TIMELINE STATUS
	public function start_status(){
		$status = $this->m_all->start_status();
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
}