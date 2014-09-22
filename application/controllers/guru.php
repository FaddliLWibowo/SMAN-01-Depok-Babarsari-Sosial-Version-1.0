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
	//MENAMPILKAN SEMUA PESAN
	public function messages(){
		$this->teacher_login();
		$data['title'] = 'Pesan | ';
		$data['script'] = "$(document).ready(function(){document.getElementById('home').className='active';});";
		$nip = $this->session->userdata('nip');
		$data['messages'] = $this->m_guru->semuapesan($nip);
		$this->defaultdisplay('siswa/messages',$data);

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
	//NILAI YANG DIUPLOAD GURU
	public function mynilai(){
		//SOAL UPLOAD BY GURU , SORT BY TAHUN, KELAS,MATA PELAJARAN
		$idguru = $this->input->get('idguru');
		$tahun = $this->input->get('tahun');
		$mapel = $this->input->get('mapel');
		$kelas = $this->input->get('idkelas');
		$params = array($idguru,$tahun,$mapel,$kelas);
		$materi = $this->m_guru->mynilai($params);
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

	//EDIT PROFILE GURU
	public function edit_profile(){
		$this->teacher_login();
		$data['title']= 'Edit Profile | ';
		$nip = $this->session->userdata('nip');
		$data['guru'] = $this->m_guru->data_by_id($this->session->userdata('id'));
		$data['script'] = "$(document).ready(function(){document.getElementById('home').className='active';});";
		$password = $this->session->userdata('password');
		$data['profile'] = $this->m_guru->can_log_in($nip, $password);
		$this->defaultdisplay('guru/editprofile',$data);
	}
}