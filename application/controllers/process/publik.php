<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/controllers/base/base.php';

class publik extends base{

	//membuat construktor
	public function __construct() {
		parent::__construct();
		$this->load->model('m_siswa');
	}
	
	public function index(){
		echo '403 Forbidden';
	}	

	public function deletestatus(){
		$idstatus = $this->input->get('id');
		$sql = "SELECT id_siswa,id_guru FROM status WHERE id_status = ?";
		$status = $this->db->query($sql,$idstatus);
		$status = $status->row_array();
		//WHO CREATE STATUS
		if($this->session->userdata('siswa_logged_in')){
			if($status['id_siswa'] == $this->session->userdata('id')){
				$this->db->where('id_status',$idstatus);
				$this->db->delete('status');
			} else {
				$this->db->delete('xxx');
			}
		} else {
			if($status['id_guru'] == $this->session->userdata('id')){
				$this->db->where('id_status',$idstatus);
				$this->db->delete('status');
			} else {
				$this->db->delete('xxx');
			}
		}
		
	}
}