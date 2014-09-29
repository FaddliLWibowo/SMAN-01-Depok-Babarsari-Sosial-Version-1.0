<section id="padding-top"></section>
<?php 
if(isset($script)){
	echo $script;
}
?>
<div style="padding-left:10px" class="page-header">
	<h1>Dashboard<small> Administrator Management</small></h1>
</div>
<div>
	<?php $this->load->view('admin/panel')?>
	<div class="col-md-10">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo $title;?> Admin</h3>
			</div>
			<div style="height:auto" class="panel-body">
				<?php if(!empty($this->input->get())){ 
					$id = $this->input->get('id');
					$this->db->where('id_matapelajaran',$id);
					$matapelajaran = $this->db->get('matapelajaran');
					$matapelajaran = $matapelajaran->row_array();
					$mapelnya = $matapelajaran['matapelajaran'];
				?>
				<form method="POST" action="?act=procedit" class="form-inline" role="form">
					<div class="form-group">
						<input type="hidden" name="id_matapelajaran" value="<?php echo $id?>">
						<input type="text" class="form-control" name="matapelajaran" value="<?php echo $mapelnya?>" placeholder="Masukan Mata Pelajaran" required>
					</div>				  			  
					<button type="submit" class="btn btn-primary">Edit Mata Pelajaran</button>
				</form>
				<?php }else { ?>
				<form method="POST" action="?act=add" class="form-inline" role="form">
					<div class="form-group">
						<input type="text" name="matapelajaran" class="form-control" placeholder="Masukan Mata Pelajaran" required>
					</div>				  			  
					<button type="submit" class="btn btn-primary">+ Mata Pelajaran</button>
				</form>
				<?php }?>
				
				<br/>
				
				<table class="table table-striped">
					<tr>
						<td><strong>No.</strong></td>
						<td><strong>Mata Pelajaran</strong></td>
						<td></td>
					</tr>
					<?php $i=1;foreach($mapel as $m):?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $m['matapelajaran']?></td>						
						<td>
							<div class="btn-group">
								<a title="edit" href="<?php echo '?act=edit&id='.$m['id_matapelajaran']; ?>" onclick="return confirm('Anda yakin?')" type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
								<a title="delete" href="<?php echo '?act=delete&id='.$m['id_matapelajaran']; ?>" onclick="return confirm('Anda yakin?')" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></a>
							</div>
						</td>
					</tr>
					<?php $i++;endforeach;?>
				</table>


				<center><?php //echo $page?></center>
			</div>
		</div>
	</div>
</div>