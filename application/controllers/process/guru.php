<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/controllers/base/base.php';

class guru extends base{

	//membuat construktor
	public function __construct() {
		parent::__construct();
	}
	
	public function index(){
		echo '<h1><center>ERROR 403 : FORBIDDEN ACCESS</center></h1>';
	}	

	//validasi login guru
	public function validate_credentials(){
		$nip = $this->input->post('login-guru-nip'); 
		$password = md5($this->input->post('login-guru-password'));
		//struktur kendali untuk cek bisa login atau tidak
		if ($this->m_guru->can_log_in($nip, $password)){
			return true;
		} else {
			//memberikan pesan jika login tidak berhasil
			$this->form_validation->set_message('validate_credentials', 'nip/Password salah');
			return false;
		}
	}

	//login untuk guru
	public function login(){
		$this->load->library('form_validation');//form validation untuk guru
		//validasi 
		$this->form_validation->set_rules('login-guru-nip', 'Login-guru-nip', 'required|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('login-guru-password', 'Login-guru-password', 'required|md5|trim|xss_clean');
		//check valid
		if($this->form_validation->run()) {
			//ambil data
			$nip = $this->input->post('login-guru-nip');
			$password = $this->input->post('login-guru-password');
			//cek apakah nip dan password sesuai
			$userdata = $this->m_guru->can_log_in($nip, $password);
			if(!empty($userdata)) { //jika guru ditemukan
				//set session
				$sessionData = $userdata;
				$sessionData['guru_logged_in'] = 1;
				//activate session
				$this->session->set_userdata($sessionData);
				//alert login berhasil
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Login Sebagai Guru Berhasil');
					window.location.href='".site_url('guru/timeline')."';
				</SCRIPT>");
			} else { //jika guru tidak ditemukan
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Terjadi kesalahan, silahkan ulangi lagi');
					window.location.href='".site_url()."';
				</SCRIPT>");
			}
		} else { //jika form validasi tidak jalan
			$data['title'] = 'Error Login';
			$data['berita'] = $this->m_berita->berita(3,0);
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('NIP dan Password tidak cocok');
			</SCRIPT>");
			$this->defaultdisplay('publik/home', $data);//menampilkan publik home dan error
		}
	}

	//UPDATE PROFILE
	public function updateprofile(){
		$idguru = $this->session->userdata('id'); 
		$alamat = $this->input->post('txtAlamat');
		$moto = $this->input->post('txtMoto');
		$img = $_FILES['myAvatar'];
		//GET PICTURE
		$this->load->library('form_validation');//CALL FORM VALIDATION LIBRARY
		$this->form_validation->set_rules('txtAlamat','Alamat','required');
		$this->form_validation->set_rules('txtMoto','Alamat','required');
		if($this->form_validation->run()){ //FORM VALIDATION IS WORK
			//UPLOAD AVATAR MANAGEMENT
			if(!empty($_FILES['myAvatar']['name'])){ //IF UPLOAD NEW AVATAR
				$this->load->library('upload');
				$avatarname = str_replace(' ', '_', $img['name']);
				$config['upload_path'] = './assets/img/avatar';
				$config['allowed_types'] = 'gif|png|jpg|jpeg|GIF|PNG|JPG|JPEG';
				$config['overwrite'] = true;
				$config['max_size'] = 1000000; //1MB
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('myAvatar')){
					redirect(site_url('guru/edit_profile?note=fail'));
				}	 
			} else {//NOT UPLOAD NEW AVATAR
				$avatarname = $this->input->post('reccentAvatar');
			}
			//UPDATE DATABASE
			$params = array($alamat,$moto,$avatarname,$idguru);
			if($this->m_guru->editprofile($params)) {
				redirect(site_url('guru/edit_profile?note=success'));
			} else {
				redirect(site_url('guru/edit_profile?note=fail'));
			}
		} else { //FORM VALIDATION NOT WORK
			redirect(site_url('guru/edit_profile?note=fail'));
		}

	}

	//UPDATE PASSWORD
	public function updatepassword(){
		$pass = $this->session->userdata('password');
		$txtrecentpass =md5($this->input->post('txtrecentpass'));
		$txtnewpass1 = $this->input->post('txtnewpass1');
		$txtnewpass2 = $this->input->post('txtnewpass2');
		if($pass == $txtrecentpass){ //current password match
			$this->load->library('form_validation');//CI LIBRARY : FROM VALIDATION
			$this->form_validation->set_rules('txtnewpass1','Password Baru','required');
			$this->form_validation->set_rules('txtnewpass2','Ulangi Password Baru','required|matches[txtnewpass1]');
			if($this->form_validation->run()){ //SESUAI RULES
				$this->m_guru->updatepassword($txtnewpass1);//QUERY UPDATE PASS
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Password Berhasil Diubah');
					window.location.href='".site_url('guru/edit_profile')."';
				</SCRIPT>");
			} else { //TIDAK SESUAI RULES
				$data['title'] = 'Error Ubah Password | ';
				$data['siswa'] = $this->m_guru->data_by_id($this->session->userdata('id'));
				$data['guru'] = $this->m_guru->data_by_id($this->session->userdata('id'));
				$this->defaultdisplay('guru/editprofile', $data);
			}			
		}else{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Password Lama Tidak Cocok');
				window.location.href='".site_url('guru/edit_profile')."';
			</SCRIPT>");
		}
		
	}

	//JOIN GRUP
	public function join_grup(){
		$idgrup = $this->input->post('idgrup');
		$idguru = $this->session->userdata('id');
		if(isset($_POST['btn_join'])){//KLIK BTN JOIN
			if($this->m_guru->btn_join_grup($idgrup,$idguru)){ //JOIN SUCCESS
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Gabung grup Sukses');
					window.location.href='".site_url('grup')."';
				</SCRIPT>");
			} else { //JOIN FAILED
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Gagal gabung ke grup');
					window.location.href='".site_url('grup')."';
				</SCRIPT>");
			}
		}
	}
	//UNJOIN GRUP
	public function unjoin_grup(){
		$idgrup = $this->input->post('idgrup');
		$idguru = $this->session->userdata('id');
		$params = array($idgrup,$idguru);
		if(isset($_POST['btn_unjoin'])){ //KLIK BTN UNJOIN
			if($this->m_guru->admin_cek($idguru,$idgrup)){ //YES ADMIN
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Anda admin lo!!!');
					window.location.href='".site_url('grup')."';
				</SCRIPT>");
			} else { //NOT ADMIN
				if($this->m_guru->btn_unjoin_grup($params)){ //UNJOIN COMPLETED
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Anda sudah keluar dari grup');
						window.location.href='".site_url('grup')."';
					</SCRIPT>");
				} else { //UNJOIN FAILED
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Kesalahan sistem, silahkan ulangi lagi');
						window.location.href='".site_url('grup')."';
					</SCRIPT>");
				}				
			}
		} //END OF BTN_UNJOIN
	} //END OF FUNCTION

	/****************** ALL ABOUT MATERI ******************/
	public function addmateri(){
		//INSTANITATION
		$idguru =$this->session->userdata('id');//GET IDGURU
		$idkelas = $this->input->post('slcKelas');//ID KELASif
		$idmapel = $this->input->post('slcMataPelajaran'); //ID MATA PELAJARAN
		$judul = $this->input->post('txtMateri');//judul materi
		$link = $_FILES['fileUpload'];
		$year = date("Y");//CURRENT YEAR
		//CI FILE UPLOAD MANAGEMENT
		$this->load->library('form_validation');
		$this->form_validation->set_rules('slcKelas', 'Kelas', 'required');
		$this->form_validation->set_rules('slcMataPelajaran', 'Mata Pelajaran', 'required');
		$this->form_validation->set_rules('txtMateri', 'Materi', 'required');
		if($this->form_validation->run()){ //DATA VALID
			$this->load->library('upload');
			$title = str_replace(' ', '_', $link['name']);//GET NAME FROM UPLOADED MATERI
			$config['upload_path'] = './assets/assets/materi/';
			$config['allowed_types'] = 'doc|docx|pdf|xls|xlsx|odt|ods';
			$config['overwrite'] = true;
			$config['max_size'] = 1000000; //1MB
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('fileUpload')){
				//redirect(site_url('guru/profile/'.$this->session->userdata('nip')));//BACK TO PROFILE PAGE
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('".$this->upload->display_errors('', '')."');
					window.location.href='".site_url('guru/profile/'.$this->session->userdata('nip'))."';
				</SCRIPT>");
			}
		} else { //DATA NOT VALID
			echo 'Insert Error';
		}

		$params = array($idkelas,$idmapel,$idguru,$judul,$title,$year);
		$sql = "INSERT INTO materi(id_kelas,id_matapelajaran,id_guru,judul,link,tahun) 
		VALUES(?,?,?,?,?,?)";
		if($this->db->query($sql,$params)) { //SUCCESS UPLOAD MATERI
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Sukses Upload Materi');
				window.location.href='".site_url('guru/profile/'.$this->session->userdata('nip'))."';
			</SCRIPT>");
		}else{ //UPLOAD MATERI ERROR
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Gagal Upload Materi, Coba Lagi');
				window.location.href='".site_url('guru/profile/'.$this->session->userdata('nip'))."';
			</SCRIPT>");
		}
	}

	/****************** ALL ABOUT SOAL ******************/
	public function addsoal(){
		//INSTANITATION
		$idguru =$this->session->userdata('id');//GET IDGURU
		$idkelas = $this->input->post('slcKelas');//ID KELASif
		$idmapel = $this->input->post('slcMataPelajaran'); //ID MATA PELAJARAN
		$judul = $this->input->post('txtMateri');//judul materi
		$link = $_FILES['fileUpload'];
		$year = date("Y");//CURRENT YEAR
		//CI FILE UPLOAD MANAGEMENT
		$this->load->library('form_validation');
		$this->form_validation->set_rules('slcKelas', 'Kelas', 'required');
		$this->form_validation->set_rules('slcMataPelajaran', 'Mata Pelajaran', 'required');
		$this->form_validation->set_rules('txtMateri', 'Materi', 'required');
		if($this->form_validation->run()){ //DATA VALID
			$this->load->library('upload');
			$title = str_replace(' ', '_', $link['name']);//GET NAME FROM UPLOADED MATERI
			$config['upload_path'] = './assets/assets/materi/';
			$config['allowed_types'] = 'doc|docx|pdf|xls|xlsx|odt|ods';
			$config['overwrite'] = true;
			$config['max_size'] = 1000000; //1MB
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('fileUpload')){
				//redirect(site_url('guru/profile/'.$this->session->userdata('nip')));//BACK TO PROFILE PAGE
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('".$this->upload->display_errors('', '')."');
					window.location.href='".site_url('guru/profile/'.$this->session->userdata('nip'))."';
				</SCRIPT>");
			}
		} else { //DATA NOT VALID
			echo 'Insert Error';
		}

		$params = array($idkelas,$idmapel,$idguru,$judul,$title,$year);
		$sql = "INSERT INTO soal(id_kelas,id_matapelajaran,id_guru,judul,link,tahun) 
		VALUES(?,?,?,?,?,?)";
		if($this->db->query($sql,$params)) { //SUCCESS UPLOAD MATERI
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Sukses Upload Soal');
				window.location.href='".site_url('guru/profile/'.$this->session->userdata('nip'))."';
			</SCRIPT>");
		}else{ //UPLOAD MATERI ERROR
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Gagal Upload Soal, Coba Lagi');
				window.location.href='".site_url('guru/profile/'.$this->session->userdata('nip'))."';
			</SCRIPT>");
		}
	}
	/****************** ALL ABOUT nilai ******************/
	public function addnilai(){
    //INSTANITATION
    $idguru =$this->session->userdata('id');//GET IDGURU
    $idkelas = $this->input->post('slcKelas');//ID KELASif
    $idmapel = $this->input->post('slcMataPelajaran'); //ID MATA PELAJARAN
    $judul = $this->input->post('txtMateri');//judul materi
    $link = $_FILES['fileUpload'];
    $year = date("Y");//CURRENT YEAR
    //CI FILE UPLOAD MANAGEMENT
    $this->load->library('form_validation');
    $this->form_validation->set_rules('slcKelas', 'Kelas', 'required');
    $this->form_validation->set_rules('slcMataPelajaran', 'Mata Pelajaran', 'required');
    $this->form_validation->set_rules('txtMateri', 'Materi', 'required');
    if($this->form_validation->run()){ //DATA VALID
    	$this->load->library('upload');
      $title = str_replace(' ', '_', $link['name']);//GET NAME FROM UPLOADED MATERI
      $config['upload_path'] = './assets/assets/materi/';
      $config['allowed_types'] = 'doc|docx|pdf|xls|xlsx|odt|ods';
      $config['overwrite'] = true;
      $config['max_size'] = 1000000; //1MB
      $this->upload->initialize($config);
      if(!$this->upload->do_upload('fileUpload')){
        //redirect(site_url('guru/profile/'.$this->session->userdata('nip')));//BACK TO PROFILE PAGE
      	echo ("<SCRIPT LANGUAGE='JavaScript'>
      		window.alert('".$this->upload->display_errors('', '')."');
      		window.location.href='".site_url('guru/profile/'.$this->session->userdata('nip'))."';
      	</SCRIPT>");
      }
    } else { //DATA NOT VALID
    	echo 'Insert Error';
    }

    $params = array($idkelas,$idmapel,$idguru,$judul,$title,$year);
    $sql = "INSERT INTO nilai(id_kelas,id_matapelajaran,id_guru,judul,link,tahun) 
    VALUES(?,?,?,?,?,?)";
    if($this->db->query($sql,$params)) { //SUCCESS UPLOAD MATERI
    	echo ("<SCRIPT LANGUAGE='JavaScript'>
    		window.alert('Sukses Upload nilai');
    		window.location.href='".site_url('guru/profile/'.$this->session->userdata('nip'))."';
    	</SCRIPT>");
    }else{ //UPLOAD MATERI ERROR
    	echo ("<SCRIPT LANGUAGE='JavaScript'>
    		window.alert('Gagal Upload nilai, Coba Lagi');
    		window.location.href='".site_url('guru/profile/'.$this->session->userdata('nip'))."';
    	</SCRIPT>");
    }
}
}