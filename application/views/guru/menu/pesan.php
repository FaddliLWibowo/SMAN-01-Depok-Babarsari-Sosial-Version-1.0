<div class="message">	
	<?php $pesansaya = $this->m_all->pesan_saya($this->session->userdata('nip'))?>
	<?php foreach($pesansaya as $p):?>
		<div class="message-item">
			<a><?php echo $p['pengirim']?></a> <span class="message-time"><?php echo $p['waktu']?></span><br/>
				<a onclick="showmessage('<?php echo $p['pengirim']?>','<?php echo $p['penerima']?>')" href="#showmessage" style="color:#000"><p><?php echo substr($p['isi'], 0,20) ?>... </p>
			</a>
		</div>
	<?php endforeach;?>
	<hr width="100%"/>	
	<a href="<?php echo site_url('guru/messages')?>">Semua Pesan</a>
</div>