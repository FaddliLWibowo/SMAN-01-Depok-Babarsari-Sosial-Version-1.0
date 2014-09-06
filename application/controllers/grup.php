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
		$data['title'] = str_replace('-', '', $this->uri->segment(4)); //GRUP NAME AS TITLE
		$data['countmember'] = $this->m_all->count_member($idgrup);
		$data['view'] = $this->m_all->detail_group($idgrup);
		$user = $this->session->userdata('id');
		$data['title'] = str_replace('-',' ',$this->uri->segment(4)).' | ';
		$data['script'] = "$(document).ready(function(){document.getElementById('grup').className='active';});";
		//ARE U TEACHER OR STUDENTS
		//LOGIN AS STUDENT
		if($this->session->userdata('siswa_logged_in')) {              
          //CEK MEMBER OR NOT
          if($this->m_all->check_member_as_siswa($idgrup,$user)){
            $data['memo'] = 'Anda login sebagai member';
            $data['status'] = 'member';
            $this->defaultdisplay('grup/welcome',$data);
          } else if($this->m_all->check_admin_as_siswa($idgrup,$user)){ //CEK ADMIN OR NOT
            $data['memo'] = 'Anda login sebagai admin';
            $data['status'] = 'admin';
            $this->defaultdisplay('grup/welcome',$data);
          } else {
          	$data['memo'] = 'dilarang masuk';
          	$data['status'] = 'publik';
            echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Selain member dilarang masuk');
				window.location.href='".site_url('grup')."';
			</SCRIPT>");
          }
         //LOGIN AS TEACHER
        } else if ($this->session->userdata('guru_logged_in')){
          //CEK MEMBER OR NOT
          if($this->m_all->check_member_as_guru($idgrup,$user)){
            $data['memo'] = 'Anda login sebagai member';
            $data['status'] = 'member';
            $this->defaultdisplay('grup/welcome',$data);
          } else if($this->m_all->check_admin_as_guru($idgrup,$user)){ //CEK ADMIN OR NOT
            $data['memo'] = 'Anda login sebagai admin';
            $data['status'] = 'admin';
            $this->defaultdisplay('grup/welcome',$data);
          } else {
          	$data['memo'] = 'dilarang masuk';
          	$data['status'] = 'publik';
            echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Selain member dilarang masuk');
				window.location.href='".site_url('grup')."';
			</SCRIPT>");
          }
          //GET DATA BUTTON FOR ADMIN.. BUT USER CAN OPEN THE DATA WILL BE CONSIDERING FOREVER
        }
	}
}