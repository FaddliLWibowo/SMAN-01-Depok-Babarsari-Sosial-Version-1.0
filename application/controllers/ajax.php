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
	public function filter_guru(){
		//GET AJAX
		if(!empty($this->input->get())){//JIKA SETTING GET
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
	/************* ONLY FOR GURU ************/
	public function materiguru(){
		$x = $this->input->get('id');
		$sql = "SELECT materi.id_guru AS 'guru',materi.id_materi AS 'id',matapelajaran.matapelajaran AS 'mapel', materi.judul AS 'materi',kelas.nama_kelas AS 'kelas'
		FROM materi 
		INNER JOIN matapelajaran ON matapelajaran.id_matapelajaran = materi.id_matapelajaran
		INNER JOIN guru ON guru.id = materi.id_guru
		INNER JOIN kelas ON kelas.id_kelas = materi.id_kelas
		WHERE materi.id_guru = ?";
		$materi = $this->db->query($sql,$x);
		if($materi->num_rows()>0) {
			$materi = $materi->result_array();
			//echo '<tr><td>judul</td><td>mapel</td><td>kelas</td><td></td></tr>';
			echo '<table class="table table-striped">';
			foreach ($materi as $m) {				
				echo '<tr>';
				echo '<td>'.$m['materi'].'</td><td>'.$m['mapel'].'</td><td>'.$m['kelas'].'</td><td><button onclick="deletemateri('.$m['id'].','.$m['guru'].')" class="btn btn-primary btn-xs" >delete</button></td';
				echo '</tr>';
			}
			echo '</table>';
			
		} else {
			echo '<center>Belum Upload Materi</center>';
		}
	}
	public function soalguru(){
		$x = $this->input->get('id');
		$sql = "SELECT soal.id_guru AS 'guru',soal.id_soal AS 'id',matapelajaran.matapelajaran AS 'mapel', soal.judul AS 'soal',kelas.nama_kelas AS 'kelas'
		FROM soal 
		INNER JOIN matapelajaran ON matapelajaran.id_matapelajaran = soal.id_matapelajaran
		INNER JOIN guru ON guru.id = soal.id_guru
		INNER JOIN kelas ON kelas.id_kelas = soal.id_kelas
		WHERE soal.id_guru = ?";
		$soal = $this->db->query($sql,$x);
		if($soal->num_rows()>0) {
			$soal = $soal->result_array();
			//echo '<tr><td>judul</td><td>mapel</td><td>kelas</td><td></td></tr>';
			echo '<table class="table table-striped">';
			foreach ($soal as $m) {				
				echo '<tr>';
				echo '<td>'.$m['soal'].'</td><td>'.$m['mapel'].'</td><td>'.$m['kelas'].'</td><td><button onclick="deletesoal('.$m['id'].','.$m['guru'].')" class="btn btn-primary btn-xs" >delete</button></td';
				echo '</tr>';
			}
			echo '</table>';
			
		} else {
			echo '<center>Belum Upload soal</center>';
		}
	}
	public function nilaiguru(){
		$x = $this->input->get('id');
		$sql = "SELECT nilai.id_guru AS 'guru',nilai.id_nilai AS 'id',matapelajaran.matapelajaran AS 'mapel', nilai.judul AS 'nilai',kelas.nama_kelas AS 'kelas'
		FROM nilai 
		INNER JOIN matapelajaran ON matapelajaran.id_matapelajaran = nilai.id_matapelajaran
		INNER JOIN guru ON guru.id = nilai.id_guru
		INNER JOIN kelas ON kelas.id_kelas = nilai.id_kelas
		WHERE nilai.id_guru = ?";
		$nilai = $this->db->query($sql,$x);
		if($nilai->num_rows()>0) {
			$nilai = $nilai->result_array();
			//echo '<tr><td>judul</td><td>mapel</td><td>kelas</td><td></td></tr>';
			echo '<table class="table table-striped">';
			foreach ($nilai as $m) {				
				echo '<tr>';
				echo '<td>'.$m['nilai'].'</td><td>'.$m['mapel'].'</td><td>'.$m['kelas'].'</td><td><button onclick="deletenilai('.$m['id'].','.$m['guru'].')" class="btn btn-primary btn-xs" >delete</button></td';
				echo '</tr>';
			}
			echo '</table>';
			
		} else {
			echo '<center>Belum Upload nilai</center>';
		}
	}
	public function deletemateri(){
		$x = $this->input->get('id');
		$this->db->where('id_materi',$x);
		$this->db->delete('materi');	
	}
	public function deletesoal(){
		$x = $this->input->get('id');
		$this->db->where('id_materi',$x);
		$this->db->delete('soal');	
	}
	public function deletenilai(){
		$x = $this->input->get('id');
		$this->db->where('id_materi',$x);
		$this->db->delete('nilai');	
	}
}