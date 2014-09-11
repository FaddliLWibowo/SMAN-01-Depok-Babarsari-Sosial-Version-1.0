<div class="message">
	<?php 
	$nilai = $this->m_all->all_nilai(10,0);
	foreach($nilai as $n):
		echo '<p>'.$n['guru'].'<br/>';
		echo '<a href="'.base_url('assets/assets/materi/'.$n['link']).'">'.$n['judul'].'</a></p>';
	endforeach;
	?>
	<hr width="100%"/>	
	<a href="<?php echo site_url('soal')?>">Semua Soal</a>
</div>