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

	public function welcome(){
		$idgrup = $this->uri->segment(3); //GET GRUP ID
		$data['title'] = str_replace('-', '', $this->uri->segment(4)); //GRUP NAME AS TITLE
		$data['countmember'] = $this->m_all->count_member($idgrup);
		$data['view'] = $this->m_all->detail_group($idgrup); //GRUP DESCRIPTIONS
    $data['member'] = $this->m_all->show_all_member($idgrup);//GRUP MEMBER
    $user = $this->session->userdata('id');
    $data['title'] = str_replace('-',' ',$this->uri->segment(4)).' | ';
    $data['script'] = "$(document).ready(function(){document.getElementById('grup').className='active';});";
		//ARE U TEACHER OR STUDENTS
		//LOGIN AS STUDENT
    if($this->session->userdata('siswa_logged_in')) {              
          //CEK MEMBER OR NOT
      if($this->m_all->check_member_as_siswa($idgrup,$user)){
        $data['memo'] = 'Anda login sebagai member';
        $data['status'] = 'member';
        $this->defaultdisplay('grup/welcome',$data);
          } else if($this->m_all->check_admin_as_siswa($idgrup,$user)){ //CEK ADMIN OR NOT
            $data['memo'] = 'Anda login sebagai admin';
            $data['status'] = 'admin';
            $this->defaultdisplay('grup/welcome',$data);
          } else {
          	$data['memo'] = 'dilarang masuk';
          	$data['status'] = 'publik';
            echo ("<SCRIPT LANGUAGE='JavaScript'>
              window.alert('Selain member dilarang masuk');
              window.location.href='".site_url('grup')."';
            </SCRIPT>");
          }
         //LOGIN AS TEACHER
        } else if ($this->session->userdata('guru_logged_in')){
          //CEK MEMBER OR NOT
          if($this->m_all->check_member_as_guru($idgrup,$user)){
            $data['memo'] = 'Anda login sebagai member';
            $data['status'] = 'member';
            $this->defaultdisplay('grup/welcome',$data);
          } else if($this->m_all->check_admin_as_guru($idgrup,$user)){ //CEK ADMIN OR NOT
            $data['memo'] = 'Anda login sebagai admin';
            $data['status'] = 'admin';
            $this->defaultdisplay('grup/welcome',$data);
          } else {
          	$data['memo'] = 'dilarang masuk';
          	$data['status'] = 'publik';
            echo ("<SCRIPT LANGUAGE='JavaScript'>
              window.alert('Selain member dilarang masuk');
              window.location.href='".site_url('grup')."';
            </SCRIPT>");
          }
          //GET DATA BUTTON FOR ADMIN.. BUT USER CAN OPEN THE DATA WILL BE CONSIDERING FOREVER
        }
      }

      public function update(){
        $id = $this->input->post('id');
        $name = $this->input->post('txtGroupName');
        $deskripsi = $this->input->post('txtGroupDetail');
        if(!empty($_FILES['filecover']['name'])){
          $newcover = $_FILES['filecover'];
          $covername = str_replace(' ', '_', $newcover['name']);
          //upload new cover
          $this->load->library('upload');
          $config['upload_path'] = './assets/img/grup';
          $config['allowed_types'] = 'gif|png|jpg|jpeg|GIF|PNG|JPG|JPEG';
          $config['overwrite'] = true;
          $config['max_size'] = 1000000; //1MB
          $this->upload->initialize($config);
          if(!$this->upload->do_upload('filecover')){
            redirect(site_url('grup/welcome/'.$id));
          }  
        } else {
          $covername = $this->input->post('oldcover');
        }
        //update database
        $data = array(
          'nama_grup' => $name,
          'deskripsi_grup' => $deskripsi,
          'avatar' => $covername
          );
        $this->db->where('id_grup',$id);
        $this->db->update('grup',$data);
        redirect('grup/welcome/'.$id.'/'.$name);
      }

    //delete grup
      public function delete_group(){
        $id = $this->input->get('id');
      //query for delete group
        if($this->m_all->delete_group($id)) {
          echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Success Group Deleted');
            window.location.href='".site_url('grup')."';
          </SCRIPT>");
        } else {
          echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Error Deleting Group');
            window.location.href='".site_url('grup')."';
          </SCRIPT>");
        }
      }

    //add status
      public function addstatus(){
        $this->load->library('user_agent');
        $status = $this->input->post('txtStatus');
        $upload = $_FILES['upload'];
        $idsiswa = $this->input->post('idsiswa');
        $idguru = $this->input->post('idguru');
        if ($idsiswa == 0) {
          $idsiswa = null;
        }
        if ($idguru == 0) {
          $idguru = null;
        }
        $idgrup = $this->input->post('idgrup');
      //upload file management
      if(!empty($_FILES['upload']['name'])) { //if upload file
        $this->load->library('upload');
        $filename = str_replace(' ', '_', $upload['name']);
        $config['upload_path'] = './assets/upload/';
        $config['allowed_types'] = 'docx|doc|odt|ods|xls|xlsx|txt|pdf';
        $config['overwrite'] = true;
        $config['max_size'] = 1000000; //1MB
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('upload')){ //if upload failed
         echo $this->upload->display_errors();
         redirect($this->agent->referrer());
       }
     } else {
      $filename = null;
    }
      //parameter to insert
    $params = array($status,$idsiswa,$idguru,$filename,$idgrup);
      //excute query
    $sql = "INSERT INTO status(isi_status, id_siswa,id_guru,publik,file,on_id_grup)
    VALUES (?,?,?,0,?,?)";
      if($this->db->query($sql,$params)){ //success add post
        redirect($this->agent->referrer());
      }else{ //failed add post
        echo ("<SCRIPT LANGUAGE='JavaScript'>
          window.alert('Gagal post');
          window.location.href='".$this->agent->referrer()."';
        </SCRIPT>");
      }
    }
  }