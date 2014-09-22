<?php //HOW LOGIN??
if($this->session->userdata('siswa_logged_in')){
$this->load->view('siswa/sidebar');
} else if($this->session->userdata('guru_logged_in')){ //END OF SISWA LOGIN
$this->load->view('guru/sidebar');
} else {//END OF GURU LOGGED IN
$this->load->view('publicsidebar');
}?>
