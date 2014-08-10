<?php
require_once 'application/controllers/base/base.php';
class siswa extends base{
	public function __construct(){
		parent::__construct();
		//jika siswa belum login maka balik ke halaman home
		if(!$this->session->userdata('siswa_logged_in')) {
			redirect(site_url());
		}
	}

	public function index(){
		echo '<h1>ERROR 403 : FORBIDDEN ACCESS</h1>';
	}

	public function timeline(){
		$data['title'] = 'Timeline | ';
		$data['script'] = "$(document).ready(function(){document.getElementById('home').className='active';});";
		$this->defaultdisplay('siswa/timeline', $data);
	}

	//MENAMPILKAN SEMUA PESAN
	public function messages(){
		$data['title'] = 'Pesan | ';
		$data['script'] = "$(document).ready(function(){document.getElementById('home').className='active';});";
		$nis = $this->session->userdata('nis');
		$data['messages'] = $this->m_siswa->semuapesan($nis);
		$this->defaultdisplay('siswa/messages',$data);

	}

	public function profile(){
		$nis = $this->uri->segment(3);
		$nama = $this->m_siswa->name_by_NIS($nis);
		$data['script'] = "$(document).ready(function(){document.getElementById('home').className='active';});";
		$data['title'] = $nama.' | ';
		$this->defaultdisplay('siswa/profile', $data);
	}

	public function edit_profile(){
		$data['title']= 'Edit Profile | ';
		$nis = $this->session->userdata('nis');
		$data['script'] = "$(document).ready(function(){document.getElementById('home').className='active';});";
		$password = md5($this->session->userdata('password'));
		$data['profile'] = $this->m_siswa->can_log_in($nis, $password);
		$this->defaultdisplay('siswa/editprofile',$data);
	}
}