<?php
require_once 'application/controllers/base/base.php';
class nilai extends base{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['title'] = 'nilai | ';
		//pagination setup
		$this->load->library('pagination');
		$config['base_url'] = site_url('nilai?p=on');
		$config['total_rows'] = $this->db->count_all('nilai');
		$config['per_page']= 10;
		$config['num_link']=2;
		$config['page_query_string'] = TRUE;
		$this->pagination->initialize($config); 
		$data['page'] = $this->pagination->create_links();		
		if(isset($_GET['per_page'])) {
			if($_GET['per_page'] == '') { 
				$uri = 0;
			} else {
				$uri = $_GET['per_page'];
			}
		} else {
			$uri = 0;
		}
		//end pagination setup
		$data['view'] = $this->m_all->all_nilai($config['per_page'],$uri);
		$this->defaultdisplay('semuanilai',$data);
	}
}