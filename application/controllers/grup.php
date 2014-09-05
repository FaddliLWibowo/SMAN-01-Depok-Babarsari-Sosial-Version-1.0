<?php
require_once 'application/controllers/base/base.php';
class grup extends base{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Semua Grup | ';
		$data['script'] = "$(document).ready(function(){document.getElementById('grup').className='active';});";
		$params = array(0,10);//OFFSET 0 - LIMIT 10
		$data['view']= $this->m_all->show_all_group($params);
		$this->defaultdisplay('grup/semuagrup',$data);
	}

	public function welcome(){
		$idgrup = $this->uri->segment(3); //GET GRUP ID
		$idsiswa = $this->session->userdata('id');
		$data['title'] = str_replace('-',' ',$this->uri->segment(4)).' | ';
		$data['script'] = "$(document).ready(function(){document.getElementById('grup').className='active';});";
		//HE IS ADMIN / MEMBER / NON MEMBER
		if($this->m_siswa->admin_cek($idgrup,$idsiswa)){//ADMIN
			$data['memo'] = 'Anda login sebagai admin';
			$this->defaultdisplay('grup/welcome',$data);
		} else if($this->m_siswa->check_member_as_siswa($idgrup,$idsiswa)){ //MEMBER
			$data['memo'] = 'Anda login sebagai member';
			$this->defaultdisplay('grup/welcome',$data);
		} else { //NON MEMBER
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Selain member dilarang masuk');
				window.location.href='".site_url('grup')."';
			</SCRIPT>");
		}		
		
	}
}