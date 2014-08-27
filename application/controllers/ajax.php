<?php
class ajax extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_all');//MODELS FOR ALL
	}

	public function index(){
		echo '<center><h1>ERROR 403 : FORBIDEN ACCESS</h1></center>';
	}

	//START TIMELINE STATUS
	public function start_status(){
		$status = $this->m_all->start_status();
	}

	//FILTER MATERI/SOAL GURU
	public filter_guru(){
		//GET AJAX
		if(isset($this->input->get())){//JIKA SETTING GET
			$guru = $this->input->get('guru');
			//GET DATA FROM DATABASE
			$sql = "SELECT guru.nama_lengkap AS 'guru',kelas.nama_kelas AS 'kelas',matapelajaran.matapelajaran AS 'mapel', tahun
			FROM materi INNER JOIN guru ON guru.id = materi.id_guru
			INNER JOIN matapelajaran ON matapelajaran.id_matapelajaran = materi.id_matapelajaran
			INNER JOIN kelas ON kelas.id_kelas = materi.id_kelas
			WHERE guru.nama_lengkap LIKE '%".$guru."%'";

		} else {
			echo '<p class="form-group" style="color:red">Guru Tidak Ditemukan</p>';
		}
	}
}