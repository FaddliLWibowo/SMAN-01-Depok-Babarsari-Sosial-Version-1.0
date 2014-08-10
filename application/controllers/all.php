<?php
require_once 'application/controllers/base/base.php';
class all extends base{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		echo '<center><h1>ERROR 403 : FORBIDEN ACCESS</h1></center>';
	}

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
		$status = $id[0];
		if($status == 1) {
			$result = $this->m_siswa->searchsiswa($id);
		} else if($status == 2) {
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

	//Membatasi penggunaan user dan manajemen hacker
}