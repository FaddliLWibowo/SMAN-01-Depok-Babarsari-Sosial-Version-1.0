<div class="message">
	<?php 
	$nilai = $this->m_guru->nilai_saya(10,0);
	foreach($nilai as $n):
		echo '<p>'.$n['guru'].'<br/>';
		echo '<a href="'.base_url('assets/assets/materi/'.$n['link']).'">'.$n['judul'].'</a></p>';
	endforeach;
	?>
	<hr width="100%"/>	
	<a href="<?php echo site_url('nilai')?>">Semua Nilai</a>
</div>