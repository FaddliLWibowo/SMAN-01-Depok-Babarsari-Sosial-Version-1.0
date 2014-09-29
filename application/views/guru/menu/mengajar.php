<div class="message">
	<?php 
	$mengajar = $this->m_guru->mengajar($this->session->userdata('id')); ?>
	<table style="font-size:10px" class="table">
	<?php foreach($mengajar as $m): ?>		
			<tr>
				<td><?php echo $m['hari'] ?></td>
				<td><?php echo $m['mulai'] ?></td>
				<td><?php echo $m['selesai'] ?></td>
				<td><?php echo $m['kelas'] ?></td>
				<td><?php echo $m['subkelas'] ?></td>
				<td><?php echo $m['mapel'] ?></td>				
			</tr>		
	<?php	
	endforeach;
	?>
	</table>
</div>