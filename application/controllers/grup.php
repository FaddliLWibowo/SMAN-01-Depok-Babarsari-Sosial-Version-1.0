<?php
require_once 'application/controllers/base/base.php';
class grup extends base{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Semua Grup | ';
		$data['script'] = "$(document).ready(function(){document.getElementById('grup').className='active';});";
		$params = array(0,10);//OFFSET 0 - LIMIT 10
		$data['view']= $this->m_all->show_all_group($params);
		$this->defaultdisplay('grup/semuagrup',$data);
	}
}