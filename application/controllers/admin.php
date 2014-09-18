<?php
require_once 'application/controllers/base/base.php';
class admin extends base{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
	}
	
	//ADMIN LOGIN
	public function index(){
		//CLEAR  ALL SESSION
		if($this->session->userdata('admin_logged_in')){
			redirect(site_url('admin/dashboard'));
		} else {
			$this->session->sess_destroy();
			$data['title'] = 'Admin Login | ';
			$this->defaultdisplay('admin/login',$data);
		}		
		
	}
	//ADMIN DASHBOARD
	public function dashboard(){
		if(!$this->session->userdata('admin_logged_in')){
			redirect(site_url('admin'));
		}
		$data['title'] = 'Dashboard | ';
		$this->defaultdisplay('admin/dashboard',$data);
	}
	//ADMIN DASHBOARD FOR NEWS
	public function berita(){
		if(!$this->session->userdata('admin_logged_in')){
			redirect(site_url('admin'));
		}
		switch ($this->input->get('act')) {
			case 'add':
			$data['title'] = 'Tambah Berita | ';
			$this->defaultdisplay('admin/berita/write',$data);
			break;

			case 'edit':
			$data['title'] = 'Edit Berita | ';
			$id = $this->input->get('id');
			$data['view'] = $this->m_berita->berita_by_id($id);
			$this->defaultdisplay('admin/berita/write',$data);
			break;
			
			default:
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
			$data['view'] = $this->m_berita->berita($config['per_page'],$uri);
				//pagination management
			$this->defaultdisplay('admin/berita',$data);
			break;
		}
		
	}
	//GROUP MANAGEMENT
	public function grup(){
		if(!$this->session->userdata('admin_logged_in')){
			redirect(site_url('admin'));
		}
		switch ($this->input->get('act')) {
			case 'addkeyword':
			$keyword = $this->input->post('keyword');
			$data = array('keyword'=>$keyword);
			$this->db->insert('grup_keyword', $data);
			redirect(site_url('admin/grup#keyword')); 
			break;
			case 'delete':
			$id = $this->input->get('id');
			$this->db->delete('grup_keyword',array('id_keyword'=>$id));
			redirect(site_url('admin/grup#keyword'));
			break;
			case 'blockgrup':
			$id = $this->input->get('id');
			$data = array('status'=>'blocked');
			$this->db->where('id_grup', $id);
			$this->db->update('grup', $data); 
			redirect(site_url('admin/grup'));
			break;			
			default://SHOW ALL GROUP
			$params = array(0,20);
			$data['title'] = 'Grup | ';
			$query = $this->db->get('grup_keyword');
			$data['keyword'] = $query->result_array();
			$data['view']=$this->m_all->show_all_group($params);
			$this->defaultdisplay('admin/grup',$data);
			break;
		}
	} 

	public function kelas(){
		$allclass = $this->db->get('kelas'); 
		$data['button'] = $allclass->result_array();
		if(!empty($this->input->get('act'))) {
			switch ($this->input->get('act')) {
				case 'subkelas':
				$idkelas = $this->input->get('id');
				$data['title'] = 'Kelas | ';
				$kelas = "SELECT nama_kelas FROM kelas WHERE id_kelas = ".$idkelas;
				$kelas = $this->db->query($kelas);
				$data['kelas']= $kelas->row_array();				
				$subkelas = "SELECT * FROM subkelas WHERE kelas = ".$idkelas;
				$subkelas= $this->db->query($subkelas);
				$data['view'] = $subkelas->result_array();				
				$this->defaultdisplay('admin/kelas',$data);
				break;

				case 'addsubkelas':
				$idkelas = $this->input->post('kelas');//idsubkelas
				$subkelas = $this->input->post('subkelas');//subkelas name
				$params = array($idkelas,$subkelas);
				$sql = "INSERT INTO subkelas(kelas,nama) VALUES(?,?)";
				$this->db->query($sql,$params);
				redirect(site_url('admin/kelas?act=subkelas&id='.$idkelas));
				break;
			
				case 'hapussubkelas':
				$idkelas = $this->input->get('id');
				$idsubkelas = $this->input->get('sub');
				$this->db->delete('subkelas',array('id_subkelas'=>$idsubkelas));
				redirect(site_url('admin/kelas?act=subkelas&id='.$idkelas));
				break;
			}
		} else {			
			$data['title'] = 'Kelas | ';
			$data['kelas']['nama_kelas']='';
			$this->defaultdisplay('admin/kelas',$data);	
		}
	}



	////////////////////////////////////////////////////////////////////
	/////////////// ALL ABOUT PROCESSING ///////////////////////////////
	////////////////////////////////////////////////////////////////////

	public function login(){
		$email = $this->input->post('txtEmail');
		$password = md5($this->input->post('txtPassword'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtEmail','email','required|xss_clean');
		$this->form_validation->set_rules('txtPassword','password','required|md5|xss_clean');
		if($this->form_validation->run()){
			$email = $this->input->post('txtEmail');
			$password = $this->input->post('txtPassword');
			$admindata = $this->m_admin->admin_can_login($email,$password);
			if(!empty($admindata)){
				$sessionData = $admindata;
				$sessionData['admin_logged_in'] = 1;
				$this->session->set_userdata($sessionData);
				//alert login berhasil
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Login Sebagai Admin Berhasil');
					window.location.href='".site_url('admin/dashboard')."';
				</SCRIPT>");
			} else {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Login Sebagai Admin gagal, coba lagi');
					window.location.href='".site_url('admin')."';
				</SCRIPT>");
			}
		} else {
			$data['title'] = 'Error Login';
			$this->defaultdisplay('admin/login',$data);
		}
	}
	//validasi login admin
	public function validate_credentials(){
		$email = $this->input->post('txtEmail');
		$password = md5($this->input->post('txtPassword'));
		//struktur kendali untuk cek bisa login atau tidak
		if ($this->m_admin->admin_can_login($email, $password)){
			return true;
		} else {
			//memberikan pesan jika login tidak berhasil
			$this->form_validation->set_message('validate_credentials', 'email/Password tidak cucok');
			return false;
		}
	}

	//process for berita
	public function proc_berita(){
		switch ($this->input->get('act')) {
			case 'add':
			$judul = $this->input->post('inputTitle');
			$isi = $this->input->post('inputIsi');
				$filename = $_FILES['inputGambar']; //nama gambar
				if(!empty($_FILES['inputGambar']['name'])) {//jika upload gambar
					$this->load->library('upload');
					$filename = str_replace(' ', '-', $filename['name']);
					$config['upload_path'] = './assets/img/news';
					$config['allowed_types'] = 'gif|png|jpg|jpeg|GIF|PNG|JPG|JPEG';
					$config['overwrite'] = true;
					$config['max_size'] = 1000000; //1MB
					$this->upload->initialize($config);
					if(!$this->upload->do_upload('inputGambar')){
						redirect(site_url('admin/berita'));
					}	 
				} else {
					$filename = '';
				}
				$params = array($judul,$isi,$filename);
				if($this->m_berita->add_berita($params)){
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Tambah berita berhasil');
						window.location.href='".site_url('admin/berita')."';
					</SCRIPT>");
				} else {
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Tambah berita gagal');
						window.location.href='".site_url('admin/berita')."';
					</SCRIPT>");
				}
				break;
				
				case 'edit':
				$id = $this->input->get('id');
				$judul = $this->input->post('inputTitle');
				$isi = $this->input->post('inputIsi');
				$filename = $_FILES['inputGambar']; //nama gambar
				$oldfilename = $this->input->post('oldGambar');
				if(!empty($_FILES['inputGambar']['name'])) {//jika upload gambar
					$this->load->library('upload');
					$filename = str_replace(' ', '-', $filename['name']);
					$config['upload_path'] = './assets/img/news';
					$config['allowed_types'] = 'gif|png|jpg|jpeg|GIF|PNG|JPG|JPEG';
					$config['overwrite'] = true;
					$config['max_size'] = 1000000; //1MB
					$this->upload->initialize($config);
					if(!$this->upload->do_upload('inputGambar')){
						redirect(site_url('admin/berita'));
					}	 
				} else {
					$filename = $oldfilename;
				}
				$params = array($judul,$isi,$filename,$id);
				if($this->m_berita->edit_berita($params)){
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Edit berita berhasil');
						window.location.href='".site_url('admin/berita')."';
					</SCRIPT>");
				} else {
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Edit berita gagal');
						window.location.href='".site_url('admin/berita')."';
					</SCRIPT>");
				}
				break;

				case 'delete':
				$id = $this->input->get('id');
				$this->db->where('id_berita', $id);
				$this->db->delete('berita');
				redirect(site_url('admin/berita')); 
				break;


				default:
				echo 'No Command';
				break;
			}
		}
		public function logout(){
			$this->session->sess_destroy();
			redirect(site_url('admin'));
		}
	}