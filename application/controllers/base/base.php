<?php

if(!defined('BASEPATH') ) exit ('No direct sript allowed');

//base class
class base extends CI_Controller {
	//constructor
	public function __construct(){
		parent::__construct();
		//auto load model	
		$this->load->model('m_siswa');	
		$this->load->model('m_guru');
		$this->load->model('m_all');
	}

	public function index(){
		echo '<h1>NO ACCESS</h1>';
	}

	public function defaultdisplay( $view_anak = '',$data = '' ) {
		$data['template_anak'] = $view_anak;
		$this->load->view('base/defaultbase', $data);
	}

	//JSON
	public function json_data(){
		if(!is_null($id_siswa)){
			$data = $this->m_siswa->data_by_id($id_siswa);//GET STUDENT NAME BY ID
			$link = 'siswa/profile/'.$data['nis'];
			$name = $data['nama_lengkap'];
			$avatar = $data['avatar'];
		}else if(!is_null($id_guru)){
			$data = $this->m_guru->data_by_id($id_guru);//GET TEACHER NAME BY ID
			$link = 'guru/profile/'.$data['nip'];
			$name = $data['nama_lengkap'];
			$avatar = $data['avatar'];
		}else if(!is_null($id_grup)){
			$name = 'on construct';//GET GROUP NAME BY ID;
		}
	}
}