<div class="message">
	<?php 
	$materi = $this->m_guru->materi_saya(10,0,$this->session->userdata('id'));
	foreach($materi as $m):
		echo '<p>'.$m['guru'].'<br/>';
		echo '<a href="'.base_url('assets/assets/materi/'.$m['link']).'">'.$m['judul'].'</a></p>';
	endforeach;
	?>
	<hr width="100%"/>	
	<a href="<?php echo site_url('materi')?>">Semua Materi</a>
</div>