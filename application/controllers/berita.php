<?php
require_once 'application/controllers/base/base.php';
class berita extends base{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Berita | ';
		$data['berita'] = $this->m_berita->berita();
		$this->defaultdisplay('berita/semuaberita',$data);
	}
}