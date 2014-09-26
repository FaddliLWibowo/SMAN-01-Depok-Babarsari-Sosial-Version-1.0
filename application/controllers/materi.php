<?php
require_once 'application/controllers/base/base.php';
class materi extends base{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['title'] = 'materi | ';
		//pagination setup
		$this->load->library('pagination');
		$config['base_url'] = site_url('materi?p=on');
		$config['total_rows'] = $this->db->count_all('materi');
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
		switch ($this->input->get('act')) {
			case 'byclass':
			//who login
			if($this->session->userdata('siswa_logged_in')){ //siswa login
				//result : my last class
				$lastclass = $this->my_last_class($this->session->userdata('id'));
				$data['view'] = $this->m_siswa->my_class_materi($config['per_page'],$uri,$lastclass);
			} else if($this->session->userdata('guru_logged_in')) { //guru login
				$data['scriptmenu'] = "<script>$('#materikelas').addClass('active');</script>";
				$data['view'] = $this->m_guru->materi_saya(10,0,$this->session->userdata('id'));
			}            
            break;
          case 'all':
	        $data['scriptmenu'] = "<script>$('#materisemua').addClass('active');</script>";
            $data['view'] = $this->m_all->all_materi($config['per_page'],$uri);
            break;          
          default:
            redirect('materi?act=byclass');
            break;
		}		
		$this->defaultdisplay('semuamateri',$data);
	}
}