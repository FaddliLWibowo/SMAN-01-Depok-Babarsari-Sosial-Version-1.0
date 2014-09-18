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
				<ul class="nav nav-tabs">
					<li class="active"><a href="#grup"  data-toggle="tab">Manajemen Grup</a></li>
					<li><a href="#keyword" data-toggle="tab">Manajemen Keyword</a></li>
				</ul>
				<br/>
				<div class="tab-content">
					<div class="tab-pane active" id="grup">
						<table class="table table-striped">
							<tr>
								<td><strong>No.</strong></td>
								<td><strong>Avatar</strong></td>
								<td><strong>Nama</strong></td>
								<td><strong>Deskripsi</strong></td>
								<td><strong>Admin Siswa</strong></td>
								<td><strong>Admin Guru</strong></td>
								<td><strong>Created</strong></td>
								<td><strong>Status</strong></td>
								<td></td>
							</tr>
							<?php $i=1;foreach($view as $v):?>
							<tr>
								<td><?php echo $i;?></td>
								<td>
									<?php if(!empty($v['avatar'])){
										echo '<img width="50px" src="'.base_url('assets/img/grup/'.$v['avatar']).'">';}else{echo '';}
										?>
									</td>
									<td><?php echo $v['nama_grup']?></td>
									<td><?php echo $v['deskripsi_grup']?></td>
									<td><?php echo $v['admin_siswa']?></td>
									<td><?php echo $v['admin_guru']?></td>
									<td><?php echo $v['created']?></td>
									<td><?php echo $v['status']?></td>
									<td>
										<div class="btn-group">
											<a title="block" href="<?php echo site_url('admin/grup?act=blockgrup&id='.$v['id_grup'])?>" onclick="return confirm('Anda yakin?')" type="button" class="btn btn-default"><span class="glyphicon glyphicon-exclamation-sign"></span></a>
										</div>
									</td>
								</tr>
								<?php $i++;endforeach;?>
							</table>
						</div>

						<div class="tab-pane" id="keyword">
							<form method="POST" action="<?php echo site_url('admin/grup?act=addkeyword')?>" class="form-inline" role="form">
							  <div class="form-group">
							    <input type="text" name="keyword" class="form-control" placeholder="Tambah Keyword">
							  </div>							  
							  <button type="submit" class="btn btn-default">+ Keyword</button>
							</form>
							<br/><br/>
							<table class="table table-striped">
							<tr>
								<td><strong>No.</strong></td>
								<td><strong>Keyword</strong></td>
								<td></td>
							</tr>
							<?php $n=1;foreach($keyword AS $k):?>
							<tr>
								<td><?php echo $n;?></td>
								<td><?php echo $k['keyword'];?></td>
								<td><a title="hapus" href="<?php echo site_url('admin/grup?act=delete&id='.$k['id_keyword'])?>" onclick="return confirm('Anda yakin?')" type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></a></td>
							</tr>
							<?php $n++;endforeach;?>
							</table>
						</div>

					</div>

					<center><?php //echo $page?></center>
				</div>
			</div>
		</div>
	</div>