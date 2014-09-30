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
				<div class="col-md-2">
					<a data-toggle="modal" href="#addguru" class="btn btn-primary">+ Tambah Guru</a>
				</div>

				<form class="form-inline" role="form" action="<?php echo site_url('process/admin/importguru')?>" role="form" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="sr-only" for="exampleInputEmail2">Email address</label>
						<input class="form-control" type="file" id="upload" name="data-import" />
					</div>
					<button type="submit" class="btn btn-primary">+ Upload Guru</button>
				</form>
				</div>
				
				<!--modal add guru-->
				<div class="modal fade" id="addguru" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Tambah Guru</h4>
							</div>
							<div class="modal-body">
								<form method="POST" action="?act=add" class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-lg-2 control-label">NIP</label>
										<div class="col-lg-10">
											<input name="nip" type="text" class="form-control" required>
										</div>
									</div>	
									<div class="form-group">
										<label class="col-lg-2 control-label">Nama Lengkap</label>
										<div class="col-lg-10">
											<input name="nama" type="text" class="form-control" required>
										</div>
									</div>	
									<div class="form-group">
										<label class="col-lg-2 control-label">Status</label>
										<div class="col-lg-10">
											<select name="status" id="status" class="form-control" required>
												<option value="aktif">Aktif</option>	
												<option value="nonaktif">NonAktif</option>	
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Kelamin</label>
										<div class="col-lg-10">
											<select name="kelamin" class="form-control" required>
												<option value="laki-laki">Laki-laki</option>	
												<option value="perempuan">Perempuan</option>	
											</select>
										</div>
									</div>			
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-5">
											<button type="submit" class="btn btn-primary">Tambah</button>
										</div>
									</div>
								</form>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!--end modal add guru-->
				<div class="col-md-4">
					<!-- <form class="form-inline" role="form">
						<div class="form-group">
							<input type="text" name="nip" class="form-control" placeholder="masukan NIP">
						</div>						
						<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Cari Guru</button>
					</form> -->
				</div>

				<br/><br/>
				<table class="table table-striped">
					<thead>
						<tr>
							<td><strong>No.<strong></td>
							<td><strong>NIP<strong></td>
							<td><strong>Avatar<strong></td>
							<td><strong>Nama Lengkap<strong></td>	
							<td><strong>Alamat<strong></td>	
							<td><strong>Telp<strong></td>		
							<td><strong>Kelamin<strong></td>
							<td><strong>Status<strong></td>
							<td></td>			
						</tr>
					</thead>
					<tbody>
						<?php $i=1;foreach($view as $v):?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $v['nip'];?></td>
							<td><?php echo '<img src="'.base_url('assets/img/avatar/'.$v['avatar']).'" width="40px" height="40px">';?></td>
							<td><?php echo $v['nama_lengkap'];?></td>
							<td><?php echo $v['alamat']?></td>
							<td><?php echo $v['telp']?></td>
							<td><?php echo $v['kelamin']?></td>
							<td><?php echo $v['status']?></td>
							<td>
								<div class="btn-group">
									<a href="?act=edit&id=<?php echo $v['id']?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span><a>
										<a href="?act=delete&id=<?php echo $v['id']?>" onclick="return confirm('Hapus data guru \n Anda yakin?')" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span><a>								
										</div>
									</td>
								</tr>
								<?php $i++;endforeach;?>
							</tbody>
						</table>
					</div>
				</div>
			</div>