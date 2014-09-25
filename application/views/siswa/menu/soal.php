<div class="message">
	<?php 
	$soal = $this->m_guru->soal_saya(10,0,$this->session->userdata('id'));
	foreach($soal as $s):
		echo '<p>'.$s['guru'].'<br/>';
		echo '<a href="'.base_url('assets/assets/materi/'.$s['link']).'">'.$s['judul'].'</a></p>';
	endforeach;
	?>
	<hr width="100%"/>	
	<a href="<?php echo site_url('soal')?>">Semua Soal</a>
</div>