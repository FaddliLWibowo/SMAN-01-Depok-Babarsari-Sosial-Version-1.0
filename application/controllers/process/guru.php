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
			$this->defaultdisplay('publik/home', $data);//menampilkan publik home dan error
		}
	}
}