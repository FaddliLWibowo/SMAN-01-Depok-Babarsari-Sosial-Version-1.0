<script type="text/javascript">
	$(function() { //SET DEFAULT SUBKATEGORI
		var status = '<?php echo $profile['status']?>';
		$('#status').val(status);
	});

	function subkelas10(){
		$('#subkelas').html();
		$('#subkelas').show();
		$('#subkelas').html('loading subkelas...');
		var idkelas = $('#kelas').val();
		$.ajax({
			url:'<?php echo site_url("admin/siswa?act=ajaxsubkelas&idkelas=")?>'+idkelas,
			success:function(data){
				$('#subkelas').html();
				$('#subkelas').html(data);
			},
			error:function(data){
				alert(data);
			}
		});
	}

	function subkelas11(){
		$('#subkelas').html();
		$('#subkelas').show();
		$('#subkelas').html('loading subkelas...');
		var idkelas = $('#kelas').val();
		$.ajax({
			url:'<?php echo site_url("admin/siswa?act=ajaxsubkelas&idkelas=")?>'+idkelas,
			success:function(data){
				$('#subkelas').html();
				$('#subkelas').html(data);
			},
			error:function(data){
				alert(data);
			}
		});
	}
</script>
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
				<h3>Profile siswa</h3>
				<form method="POST" action="?act=editprofilesiswa" class="form-horizontal" role="form">
					<input type="hidden" name="id" value="<?php echo $profile['id']?>">
					<div class="form-group">					
						<label class="col-lg-2 control-label">Avatar</label>
						<div class="col-lg-5">
							<img src="<?php echo base_url('assets/img/avatar/'.$profile['avatar'])?>" width="200px"/>
						</div>
					</div>	
					<div class="form-group">
						<label class="col-lg-2 control-label">nis</label>
						<div class="col-lg-5">
							<input name="nis" type="text" class="form-control" value="<?php echo $profile['nis']?>">
						</div>
					</div>	
					<div class="form-group">
						<label class="col-lg-2 control-label">Nama Lengkap</label>
						<div class="col-lg-5">
							<input name="nama" type="text" class="form-control" value="<?php echo $profile['nama_lengkap']?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Kelas 10</label>
						<div class="col-lg-2">
							<select class="form-control" id="kelas10" name="kelas10">
								<option>Kelas 10</option>
								<?php foreach($kelas as $k):
									echo '<option value="'.$k['id_kelas'].'">'.$k['nama_kelas'].'</option>';
								endforeach;?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Kelas 11</label>
						<div class="col-lg-2">
							<select class="form-control" id="kelas11" name="kelas11">
								<option >Kelas 11</option>
								<?php foreach($kelas as $k):
									echo '<option value="'.$k['id_kelas'].'">'.$k['nama_kelas'].'</option>';
								endforeach;?>
							</select>
						</div>
					</div>		
					<div class="form-group">
						<label class="col-lg-2 control-label">Kelas 12</label>
						<div class="col-lg-2">
							<select class="form-control" id="kelas12" name="kelas12">
								<option>Kelas 12</option>
								<?php foreach($kelas as $k):
									echo '<option value="'.$k['id_kelas'].'">'.$k['nama_kelas'].'</option>';
								endforeach;?>
							</select>
						</div>
					</div>	
					<div class="form-group">
						<label class="col-lg-2 control-label">Alamat</label>
						<div class="col-lg-5">
							<textarea class="form-control" name="alamat" disabled><?php echo $profile['alamat']?></textarea>
						</div>
					</div>	
					<div class="form-group">
						<label class="col-lg-2 control-label">Email</label>
						<div class="col-lg-5">
							<input name="email" type="email" class="form-control" value="<?php echo $profile['email']?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Telp</label>
						<div class="col-lg-5">
							<input type="text" class="form-control" value="<?php echo $profile['telp']?>" disabled>
						</div>
					</div>		
					<div class="form-group">
						<label class="col-lg-2 control-label">Status</label>
						<div class="col-lg-5">
							<select id="status" class="form-control" name="status">
								<option value="aktif">Aktif</option>	
								<option value="nonaktif">NonAktif</option>	
							</select>
						</div>
					</div>		
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-5">
							<button type="submit" class="btn btn-default">Ubah</button>
						</div>
					</div>
				</form>
				<!--end modal for add mengajar-->
			</div>
		</div>
	</div>