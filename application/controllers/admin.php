<?php
require_once 'application/controllers/base/base.php';
class admin extends base{
	public function __construct(){
		parent::__construct();
	}
	
	//ADMIN LOGIN
	public function index(){
		//CLEAR  ALL SESSION
		$this->session->sess_destroy();
		$data['title'] = 'Admin Login | ';
		$this->defaultdisplay('admin/login',$data);
	}
}