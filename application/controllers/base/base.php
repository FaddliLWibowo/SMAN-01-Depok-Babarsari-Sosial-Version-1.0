<?php

if(!defined('BASEPATH') ) exit ('No direct sript allowed');

//base class
class base extends CI_Controller {
	//constructor
	public function __construct(){
		parent::__construct();
		//auto load model	
		$this->load->model('m_siswa');	
		$this->load->model('m_guru');
		$this->load->model('m_all');
	}

	public function index(){
		echo '<h1>NO ACCESS</h1>';
	}

	public function defaultdisplay( $view_anak = '',$data = '' ) {
		$data['template_anak'] = $view_anak;
		$this->load->view('base/defaultbase', $data);
	}
}