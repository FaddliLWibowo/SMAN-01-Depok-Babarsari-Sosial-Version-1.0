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
				<a href="<?php echo site_url('admin/berita?act=add')?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Berita Baru</a>
				<br/><br/>
				<table class="table table-striped">
					<tr>
						<td><strong>No.</strong></td>
						<td><strong>Judul</strong></td>
						<td><strong>Created</strong></td>
						<td><strong>Updated</strong></td>
						<td></td>
					</tr>
					<?php $i=1;foreach($view as $v):?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $v['judul']?></td>
						<td><?php echo $v['created']?></td>
						<td><?php echo $v['edited']?></td>
						<td>
						<div class="btn-group">
							<a href="<?php echo site_url('admin/berita?act=edit&id='.$v['id_berita'])?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="<?php echo site_url('admin/proc_berita?act=delete&id='.$v['id_berita'])?>" onclick="return confirm('Anda yakin?')" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></a>
						</div>
						</td>
					</tr>
				<?php $i++;endforeach;?>
				</table>
				 <center><?php echo $page?></center>
			</div>
		</div>
	</div>
</div>