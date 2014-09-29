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
				<div class="col-md-8 btn-group">
					<?php foreach($button as $k):
					echo '<a href="?act=subkelas&id='.$k['id_kelas'].'" class="btn btn-default">'.$k['nama_kelas'].'</a>';
					endforeach;?>					
				</div>
				<!-- <form class="col-md-4 form-inline" role="form">
					<div class="form-group">
						<label class="sr-only" >kelas</label>
						<input type="text" class="form-control" placeholder="Kelas">
					</div>					  
					<button type="submit" class="btn btn-default">+ Add Kelas</button>
				</form> -->
				<br/><br/>
				<?php echo '<h2>'.$kelas['nama_kelas'].'</h2>'?>
				<div class="col-md-5">
					
					<form class="form-inline" role="form" method="POST" action="?act=addsubkelas">
						<div class="form-group">
						<input type="hidden" name="kelas" value="<?php echo $this->input->get('id');?>">
						<label class="sr-only" >subkelas</label>
							<input type="text" name="subkelas" class="form-control" placeholder="SubKelas">
						</div>					  
						<button type="submit" class="btn btn-default">+ Add SubKelas</button>
					</form>
					<br/>
					<?php if (!empty($view)){?>
					<table class="table table-striped">
						<?php foreach($view as $v):
						echo '<tr>';
						echo '<td>'.$kelas['nama_kelas'].'</td>';
						echo '<td>'.$v["nama"].'</td>';
						echo '<td><a href="?act=hapussubkelas&sub='.$v['id_subkelas'].'&id='.$this->input->get('id').'" onclick="return confirm(\'Data yang anda hapus mempengaruhi data lainnya\n Apa anda yakin ?\')" class="btn btn-default" title="hapus"><span class="glyphicon glyphicon-trash"></span></td>';
						echo '</tr>';
						endforeach;?>
					</table>
					<?php } ?>
				</div>
				<center><?php //echo $page?></center>
			</div>
		</div>
	</div>
</div>