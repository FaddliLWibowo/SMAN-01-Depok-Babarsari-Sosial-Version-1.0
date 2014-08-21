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
		$this->teacher_login();
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
		$data['mengajar'] =$this->m_guru->guru_ajar($data['guru']['id']);
		$this->defaultdisplay('guru/profile', $data);
	}
	//MATERI YANG DIUPLOAD GURU
	public function mymateri(){
		$idguru = $this->input->get('idguru');
		$tahun = $this->input->get('tahun');
		$mapel = $this->input->get('mapel');
		$kelas = $this->input->get('idkelas');
		$params = array($idguru,$tahun,$mapel,$kelas);
		$materi = $this->m_guru->mymateri($params);
		if(empty($materi)){
			echo '<center><p>Materi Kosong</p></center>';
		}else{
			echo '<table class="table table-striped" >';
			foreach($materi as $m):
				echo '<tr>';
			echo '<td>'.$m['judul'].'</td>';
			echo '<td><a target="_blank" href="'.base_url('assets/assets/materi/'.$m['link']).'">download</a></td>';
			echo '</tr>';
			endforeach;
			echo "</table>";
		}
	}
	//SOAL YANG DIUPLOAD GURU
	public function mysoal(){
		//SOAL UPLOAD BY GURU , SORT BY TAHUN, KELAS,MATA PELAJARAN
		$idguru = $this->input->get('idguru');
		$tahun = $this->input->get('tahun');
		$mapel = $this->input->get('mapel');
		$kelas = $this->input->get('idkelas');
		$params = array($idguru,$tahun,$mapel,$kelas);
		$materi = $this->m_guru->mysoal($params);
		if(empty($materi)){
			echo '<center><p>Materi Kosong</p></center>';
		}else{
			echo '<table class="table table-striped" >';
			foreach($materi as $m):
				echo '<tr>';
			echo '<td>'.$m['judul'].'</td>';
			echo '<td><a target="_blank" href="'.base_url('assets/assets/materi/'.$m['link']).'">download</a></td>';
			echo '</tr>';
			endforeach;
			echo "</table>";
		}
	}
}