<?php
require_once 'application/controllers/base/base.php';
class guru extends base{
	public function __construct(){
		parent::__construct();
	}
	//ALL TEACHER
	public function index(){
		$data['title'] = 'Guru | ';
		$data['script'] = "$(document).ready(function(){document.getElementById('guru').className='active';});";
		$data['view'] = $this->m_guru-> all_teacher();
		$this->defaultdisplay('guru/guru', $data);
	}
	//TIMELINE VIEW
	public function timeline(){
		$data['title'] = 'Timeline | ';
		$data['script'] = "$(document).ready(function(){document.getElementById('home').className='active';});";
		$this->defaultdisplay('guru/timeline',$data);
	}
	//GURU PROFILE
	public function profile(){
		$nip = $this->uri->segment(3);
		$nama = $this->m_guru->name_by_NIP($nip);//completed
		$data['script'] = "$(document).ready(function(){document.getElementById('home').className='active';});";
		$data['title'] = $nama.' | ';
		$data['guru'] = $this->m_guru->data_by_nip($nip);
		$this->defaultdisplay('guru/profile', $data);
	}
}