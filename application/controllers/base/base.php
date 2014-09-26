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
		$this->load->model('m_berita');
		$this->load->model('m_event');
		$this->load->model('m_grup');
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

	//ONLY STUDENT
	public function student_login(){
		if(!$this->session->userdata('siswa_logged_in')) {return redirect(site_url());}
	}
	//ONLY TEACHER
	public function teacher_login(){
		if(!$this->session->userdata('guru_logged_in')) {return redirect(site_url());}
	}
	//show my class
	public function my_last_class($idsiswa){
		$data = $this->session->userdata;
		//check last class
		if(!empty($data['subkelas3'])){
			$subkelas = $data['subkelas3'];
		} else if(!empty($data['subkelas2'])){
			$subkelas = $data['subkelas2'];
		} else if(!empty($data['subkelas1'])){
			$subkelas = $data['subkelas1'];
		}
		//check my class
		$sql = "SELECT kelas.id_kelas AS 'class' FROM subkelas
		INNER JOIN kelas ON kelas.id_kelas = subkelas.kelas
		WHERE subkelas.id_subkelas = ? ";
		$myclass = $this->db->query($sql,$subkelas);
		$myclass = $myclass->row_array();
		return $myclass['class'];//result my last class
	}
}