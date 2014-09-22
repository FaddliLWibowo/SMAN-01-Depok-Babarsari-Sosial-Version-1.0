<div class="message">
	<?php 
	$berita = $this->m_berita->berita(10,0);
	foreach($berita as $b):
		echo '<p><a href="'.site_url('berita/baca/'.$b['id_berita']).'">'.$b['judul'].'</a> <small>'.$b['created'].'</small></p>';
	endforeach;
	?>
	<hr width="100%"/>	
	<a href="<?php echo site_url('berita')?>">Semua Berita</a>
</div>