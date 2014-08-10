<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/controllers/base/base.php';

class publik extends base{

	//membuat construktor
	public function __construct() {
		parent::__construct();
		$this->load->model('m_siswa');
	}
	
	public function index(){
		
	}	
}