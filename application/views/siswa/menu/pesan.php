<div class="message">	
	<?php $pesansaya = $this->m_all->pesan_saya($this->session->userdata('nis'))?>
	<?php foreach($pesansaya as $p):?>
		<?php
		if(strlen($p['pengirim'])<5) { //pengirim adalah user
				$sql= "SELECT avatar,nama_lengkap FROM siswa WHERE nis = ".$p['pengirim'];
				//echo $sql;
				$avatar = $this->db->query($sql);
				$avatar = $avatar->row_array();
				$nama = explode(' ', $avatar['nama_lengkap']);
				$nama = $nama[0];
				$img_avatar = base_url('assets/img/avatar/'.$avatar['avatar']);
			} else { //pengirim adalah guru
				$sql= "SELECT avatar,nama_lengkap FROM guru WHERE nip = ".$p['pengirim'];
				$avatar = $this->db->query($sql);
				$avatar = $avatar->row_array();
				$nama = explode(' ', $avatar['nama_lengkap']);
				$nama = $nama[0];
				$img_avatar = base_url('assets/img/avatar/'.$avatar['avatar']);
			}
		?>
		<div class="message-item">
			<a><?php echo $nama;?></a> <span class="message-time"><?php echo $p['waktu']?></span><br/>
				<a onclick="showmessage('<?php echo $p['pengirim']?>','<?php echo $p['penerima']?>')" href="#showmessage" style="color:#000"><p><?php echo substr($p['isi'], 0,20) ?>... </p>
			</a>
		</div>
	<?php endforeach;?>
	<hr width="100%"/>	
	<a href="<?php echo site_url('siswa/messages')?>">Semua Pesan</a>
</div>