<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'application/controllers/base/base.php';

class publik extends base{

	//membuat construktor
	public function __construct() {
		parent::__construct();
	}
	
	public function index(){
		//testing tampilan
		$data['title'] =''; 
		$data['script'] = "$(document).ready(function(){document.getElementById('home').className='active';});";
		$data['berita'] = $this->m_berita->berita(3,0);
		$this->defaultdisplay('publik/home',$data);
	}	
}