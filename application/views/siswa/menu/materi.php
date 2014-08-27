<div class="message">
	<?php 
	$materi = $this->m_all->all_materi(10,0);
	foreach($materi as $m):
		echo '<p>'.$m['guru'].'<br/>';
		echo '<a href="'.base_url('assets/assets/materi/'.$m['link']).'">'.$m['judul'].'</a></p>';
	endforeach;
	?>
	<hr width="100%"/>	
	<a href="<?php echo site_url('materi')?>">Semua Materi</a>
</div>