<?php
require_once 'application/controllers/base/base.php';
class all extends base{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		echo '<center><h1>ERROR 403 : FORBIDEN ACCESS</h1></center>';
	}

	/*
	* ALL ABOUT USER
	*/

	public function logout(){
		$data['title']="Processing";
		//fungsi yang digunakan untuk menghapus session
		$this->session->sess_destroy();
		//output
		echo "<script>alert('Anda telah logout');</script>";
		redirect(site_url());
	}

	public function search_user(){
		//cek pencarian guru atau siswa, angka depan 1 adalah guru, angka depan 2 adalah siswa
		$id = $this->input->get('iduser');
		if($id == ''){
			$r = '';
			return $r;
		}
		$status = strlen($id);
		//jika pajang id <5 = siswa :else = guru
		if($status <= 4) {
			$result = $this->m_siswa->searchsiswa($id);
		} else if($status > 4) {
			$result = $this->m_guru->searchguru($id);
		} else {
			$result ='';
		}
		echo $result;
	}

	//SEND MESSAGE FROM TIMELINE
	public function send_message(){
		//cek login guru / siswa
		$this->load->library('user_agent');
		if($this->session->userdata('siswa_logged_in')){
			$pengirim = $this->session->userdata('nis');
		} else if($this->session->userdata('guru_logged_in')) {
			$pengirim = $this->session->userdata('nip');
		}
		$penerima = $this->input->post('penerima');
		$isi = $this->input->post('isi');
		$params = array($pengirim,$penerima,$isi);
		//status pesan
		if($this->m_all->send_message($params)){//sukses kirim pesan
			echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Pesan Terkirim');
					window.location.href='".$this->agent->referrer()."';
					</SCRIPT>");
		} else { //gagal kirim pesan
			echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Pesan Gagal Terkirim');
					window.location.href='".$this->agent->referrer()."';
					</SCRIPT>");
		}
	}

	public function isi_pesan_saya(){
		$pengirim = $this->input->get('pengirim');
		$penerima = $this->input->get('penerima');
		$params = array($pengirim, $penerima, $penerima, $pengirim);
		$isi = $this->m_all->isi_pesan_saya($params);
		foreach($isi as $i):
			echo '
			<div class="comment row">
				<div class="col-md-2">            
					<img src="assets/images/user/profile1.png" />
				</div>
				<div class="col-md-10">
					<p><span><strong><a href="#">'.$i['pengirim'].'</a></strong></span> '.$i['isi'].'</p>
					<h6>'.$i['waktu'].'</h6>
				</div>
			</div>
			';
		endforeach;
		echo '
		<div class="comment row">
			<div class="col-md-2"><img src="assets/images/user/profile1.png" /></div>
			<div class="col-md-8">
				<textarea class="form-control" id="isibalasan" placeholder="reply..."></textarea>
			</div>
			<div class="col-md-2"><button onclick="sendmessageviamodal('.$penerima.','.$pengirim.')" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-send"></span></button</div>
		</div>
		';
	}

	//KIRIM PESAN VIA MODAL
	public function kirim_pesan_via_modal(){
		$isi = $this->input->post('isi');
		$pengirim= $this->input->post('pengirim');
		$penerima=$this->input->post('penerima');
		$params = array($pengirim, $penerima,$isi );
		$this->m_all->kirim_pesan_via_modal($params); //INSERT TO DATABASE
	}

	/*
	* STATUS
	*/
	public function update_status(){
		$isi = $this->input->post('isi');
		$idsiswa = $this->input->post('idsiswa');
		$idguru = $this->input->post('idguru');
		$idgrup = $this->input->post('idgrup');
		$desidsiswa = $this->input->post('desidsiswa');
		$desidguru = $this->input->post('desidguru');
		$desidgrup = $this->input->post('desidgrup');
		//CONVERT 0 TO NULL
		if($idsiswa==0){$idsiswa=NULL;}
		if($idguru==0){$idguru=NULL;}
		if($idgrup==0){$idgrup=NULL;}
		if($desidsiswa==0){$desidsiswa=NULL;}
		if($desidguru==0){$desidguru=NULL;}
		if($desidgrup==0){$desidgrup=NULL;}
		//PARAMETERS TO MODAL
		$params = array('isi_status'=>$isi,'id_siswa'=>$idsiswa,'id_guru'=>$idguru,'id_grup'=>$idgrup,
			'on_id_siswa'=>$desidsiswa,'on_id_guru'=>$desidguru,'on_id_grup'=>$desidgrup);
		$this->m_all->update_status($params);
		//RETURN TRUE FROM MODAL
	}


	//ADD LIKE
	public function addlike(){
		$idstatus = $this->input->get('idpost');
		//update table
		$
		$sql = "UPDATE status SET likes = likes + 1 WHERE id_status = ?";
		return $this->db->query($sql,$idstatus);
	}

	//ADD COMMENT
	public function addcomment(){
		$comment = $this->input->get('comment');
		$idpost = $this->input->get('idpost');
		$idsiswa = $this->input->get('idsiswa');
		$idguru = $this->input->get('idguru');
		if($idsiswa==''){$idsiswa=NULL;}
		if($idguru==''){$idguru=NULL;}
		$params = array($idsiswa,$idpost,$idguru,$comment,$idpost);
		$sql = "INSERT INTO status_komentar(id_siswa,id_status,id_guru,komentar)
		VALUES(?,?,?,?)";
		return $this->db->query($sql,$params);
	}

	/*
	* ALL ABOUT GROUP
	*/
	//group name validation
	public function groupnamevalidation(){
		$name = $this->input->get('name');
		$groupname = explode(' ', $name);
		$this->db->or_where_in('keyword',$groupname);//GROUPNAME LIKE KEYWORD
		$query = $this->db->get('grup_keyword');
		if($query->num_rows()>0){//keyword match
			echo ' <label>Deskripsi Grup : </label><textarea class="form-control" name="txtGroupDetail" placeholder="About Group" required></textarea><br/>
                  <label> Cover Grup : </label><input class="form-control" type="file" name="fileGroup" required><br/>
                  <button class="btn btn-default" type="submit" >Create Group</button><br/>
                </form>';
		}else{//keyword not match
			echo 'Nama Tidak Diperbolehkan';
		}
	}
	//create group
	public function creategroup(){
		$groupname = $this->input->post('txtGroupName');//group name
		$groupdetail = $this->input->post('txtGroupDetail');//group detail
		$id = $this->session->userdata('id');
		$img = $_FILES['fileGroup'];
		//WHO CREATE : TEACHER OR STUDENT
		if($this->session->userdata('siswa_logged_in')) {
			//STUDENT IS lOGGED IN
			$student = $id;
			$teacher = NULL;
		} else if($this->session->userdata('guru_logged_in')) {
			//TEACHER IS LOGGED IN
			$student = NULL;
			$teacher = $id;
		}
		//PROCESSING GROUP COVER
		if(isset($_FILES['fileGroup'])){ //UPLOADED COVER
			$this->load->library('upload');
			$coverName = str_replace(' ','-',$img['name']);
			$config['upload_path'] = './assets/img/grup/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg|GIF|PNG|JPG|JPEG';
			$config['overwrite'] = true;
			$config['max_size'] = 1000000; //1MB
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('fileGroup')){
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Cover Tidak Sesuai');
					window.location.href='".site_url('grup')."';
				</SCRIPT>");	
			} 
			$params = array($groupname,$groupdetail,$student,$teacher,$coverName);
			if($this->m_all->creategroup($params)) { //SUCCESS CREATING GROUP
				echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Success Creating Group');
						window.location.href='".site_url('grup')."';
					</SCRIPT>");
			} else { //FAILED CREATING GROUP
				echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Failed Creating Group');
						window.location.href='".site_url('grup')."';
					</SCRIPT>");
		}

	}
}

	//Membatasi penggunaan user dan manajemen hacker
}