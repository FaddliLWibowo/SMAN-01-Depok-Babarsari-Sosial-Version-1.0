<?php
require_once 'application/controllers/base/base.php';
class guru extends base{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Guru | ';
		$data['script'] = "$(document).ready(function(){document.getElementById('guru').className='active';});";
		$this->defaultdisplay('guru/guru', $data);
	}

	public function timeline(){
		$data['title'] = 'Timeline | ';
		$data['script'] = "$(document).ready(function(){document.getElementById('home').className='active';});";
		$this->defaultdisplay('guru/timeline',$data);
	}
}