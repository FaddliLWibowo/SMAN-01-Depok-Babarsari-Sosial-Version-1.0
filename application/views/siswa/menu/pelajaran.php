<div class="message">
	<?php 
	//get lattest subkelas
	if(!empty($this->session->userdata('subkelas1'))){
		$subkelas = $this->session->userdata('subkelas1');
	}else if(!empty($this->session->userdata('subkelas2'))){
		$subkelas = $this->session->userdata('subkelas2');
	}else if(!empty($this->session->userdata('subkelas3'))){
		$subkelas = $this->session->userdata('subkelas3');
	}
	$pelajaran = $this->m_siswa->pelajaran($subkelas);?>
	<table style="font-size:10px" class="table">
	<?php foreach($pelajaran as $p): ?>		
			<tr>
				<td><?php echo $p['hari'] ?></td>
				<td><?php echo $p['mulai'] ?></td>
				<td><?php echo $p['selesai'] ?></td>
				<td><?php echo $p['kelas'] ?></td>
				<td><?php echo $p['subkelas'] ?></td>
				<td><?php echo $p['mapel'] ?></td>	
				<td><?php echo $p['guru'] ?></td>				
			</tr>		
	<?php	
	endforeach;
	?>
	</table>
</div>