<div class="message">
	<?php 
	$grupparams = array($this->session->userdata('id'),$this->session->userdata('id'),0,10);
	$loopgrup = $this->m_guru->joined_grup($grupparams);
	foreach($loopgrup as $lg):
		echo '<a href="'.site_url('grup/welcome/'.$lg['idgrup'].'/'.$lg['nama']).'">'.$lg['nama'].'</a></p>';
	endforeach;
	?>
	<hr width="100%"/>	
	<a href="<?php echo site_url('grup')?>">Semua Grup</a>
</div>