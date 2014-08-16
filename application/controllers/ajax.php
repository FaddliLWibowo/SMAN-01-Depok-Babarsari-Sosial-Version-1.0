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
}