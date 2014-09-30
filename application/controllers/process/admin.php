<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/controllers/base/base.php';

class admin extends base{

	//membuat construktor
	public function __construct() {
		parent::__construct();
		$this->load->model('m_siswa');
		error_reporting(0);
	}
	
	public function index(){
		echo '403 : Forbidden Acces';
	}	
	//import teacher data
	public function importguru(){		
		require_once 'application/controllers/base/excel_reader2.php';		
		echo '<html><head><title>Loading...</title></head><body></body></html>';		
		$xls = $_FILES['data-import'];
		if(!empty($_FILES['data-import']['name'])) {
			$this->load->library('upload');//load upload lobrary
			$xls_name = str_replace(' ', '_', $xls['name']);
			$config['upload_path'] = './assets/xls/'; 
			$config['allowed_types'] = '*';
			$config['max_size'] = '2000000';//2MB
			$config['overwrite']= true;
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('data-import')) { //Upload Failed
				echo  $this->upload->display_errors();
			} else { //Upload Complete
				$guru=new Spreadsheet_Excel_Reader('./assets/xls/'.$xls_name);
				$rows = $guru->rowcount(0);
				// echo $rows;
				//looping to insert database
				for($i=2 ; $i<$rows ; $i++){
					$nip = $guru->val($i,1,0);//baris ke $i, kolom 1, sheet 1
					$nama = $guru->val($i,2,0);
					$status = $guru->val($i,3,0);
					$kelamin = $guru->val($i,4,0);
					$password=md5($nip);
					$data = array(
						'nip'=>$nip,
						'nama_lengkap'=>$nama,
						'status'=>$status,
						'password'=>$password,
						'kelamin'=>$kelamin
						);
					// echo '<br/>';
					// print_r($data);
					//insert to table
					$this->db->insert('guru',$data);
				}
				echo 'Berhasil Import Data Guru <a href="'.site_url("admin/guru").'">kembali</a>';
			}
		}
	}
	//import student data
	public function importsiswa(){
		require_once 'application/controllers/base/excel_reader2.php';		
		echo '<html><head><title>Loading...</title></head><body></body></html>';		
		$xls = $_FILES['data-import'];
		if(!empty($_FILES['data-import']['name'])) {
			$this->load->library('upload');//load upload lobrary
			$xls_name = str_replace(' ', '_', $xls['name']);
			$config['upload_path'] = './assets/xls/'; 
			$config['allowed_types'] = '*';
			$config['max_size'] = '2000000';//2MB
			$config['overwrite']= true;
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('data-import')) { //Upload Failed
				echo  $this->upload->display_errors();
			} else { //Upload Complete
				$siswa=new Spreadsheet_Excel_Reader('./assets/xls/'.$xls_name);
				$rows = $siswa->rowcount(0);
				// echo $rows;
				//looping to insert database
				for($i=2 ; $i<$rows ; $i++){
					$nis = $siswa->val($i,1,0);//baris ke $i, kolom 1, sheet 1
					$angkatan = $siswa->val($i,2,0);
					$nama = $siswa->val($i,3,0);
					$subkelas1 = $siswa->val($i,4,0);
					$subkelas2 = $siswa->val($i,5,0);
					$subkelas3 = $siswa->val($i,6,0);
					if(empty($subkelas1)){$subkelas1 = null;}
					if(empty($subkelas2)){$subkelas2 = null;}
					if(empty($subkelas3)){$subkelas3 = null;}					
					$status = $siswa->val($i,7,0);
					$kelamin = $siswa->val($i,8,0);
					$password=md5($nis);
					$data = array(
						'nis'=>$nis,
						'angkatan'=>$angkatan,
						'nama_lengkap'=>$nama,
						'subkelas1'=>$subkelas1,
						'subkelas2'=>$subkelas2,
						'subkelas3'=>$subkelas3,
						'status'=>$status,
						'password'=>$password,
						'kelamin'=>$kelamin
						);
					// echo '<br/>';
					// print_r($data);
					//insert to table
					$this->db->insert('siswa',$data);
				}
				echo 'Berhasil Import Data Siswa <a href="'.site_url("admin/siswa").'">kembali</a>';
			}
		} else {
			echo 'XLS Not Found!';
		}
	}
}