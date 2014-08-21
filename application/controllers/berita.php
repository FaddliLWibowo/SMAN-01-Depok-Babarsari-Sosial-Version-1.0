<?php
require_once 'application/controllers/base/base.php';
class berita extends base{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Berita | ';
		//pagination setup
		$this->load->library('pagination');
		$config['base_url'] = site_url('berita?p=on');
		$config['total_rows'] = $this->db->count_all('berita');
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
		$data['berita'] = $this->m_berita->berita($config['per_page'],$uri);
		$this->defaultdisplay('berita/semuaberita',$data);
	}

	public function baca(){
		$id = $this->uri->segment('3');
		$data['berita'] = $this->m_berita->berita_by_id($id);
		$data['title']=$data['berita']['judul'];
		$this->defaultdisplay('berita/berita',$data);	
	}
}