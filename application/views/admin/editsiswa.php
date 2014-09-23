<script type="text/javascript">
	$(function() { //SET DEFAULT SUBKATEGORI
		var status = '<?php echo $profile['status']?>';
		$('#status').val(status);
		<?php if(!empty($profile['subkelas1'])){ ?>
			var subkelas10 = '<?php echo $profile['subkelas1']?>';
			$('#subkelas10').val(subkelas10);
			<?php } ?>
			<?php if(!empty($profile['subkelas2'])){ ?>
				var subkelas11 = '<?php echo $profile['subkelas2']?>';
				$('#subkelas11').val(subkelas11);
				<?php } ?>
				<?php if(!empty($profile['subkelas3'])){ ?>
					var subkelas12 = '<?php echo $profile['subkelas3']?>';
					$('#subkelas12').val(subkelas12);
					<?php } ?>
				});	
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
							<select class="form-control" id="subkelas10" name="subkelas10">
								<option value="">Pilih Subkelas</option>
								<option value="1">Kelas 10 A</option>
								<option value="2">Kelas 10 B</option>
								<option value="3">Kelas 10 C</option>
								<option value="17">Kelas 10 D</option>
								<option value="18">Kelas 10 E</option>
								<option value="19">Kelas 10 F</option>								
							</select>							
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Kelas 11</label>						
						<div class="col-lg-2">
							<select class="form-control" id="subkelas11" name="subkelas11">
								<option value="">Pilih Subkelas</option>
								<option value="4">Kelas 11 IPA 1</option>
								<option value="5">Kelas 11 IPA 2</option>
								<option value="10">Kelas 11 IPA 3</option>
								<option value="6">Kelas 11 IPS 1</option>
								<option value="7">Kelas 11 IPS 2</option>
								<option value="13">Kelas 11 IPS 3</option>
							</select>							
						</div>
					</div>		
					<div class="form-group">
						<label class="col-lg-2 control-label">Kelas 12</label>						
						<div class="col-lg-2">
							<select class="form-control" id="subkelas12" name="subkelas12">
								<option value="">Pilih Subkelas</option>
								<option value="11">Kelas 12 IPA 1</option>
								<option value="12">Kelas 12 IPA 2</option>
								<option value="14">Kelas 12 IPA 3</option>
								<option value="9">Kelas 12 IPS 2</option>
								<option value="15">Kelas 12 IPS 2</option>
								<option value="16">Kelas 12 IPS 3</option>
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
								<option>Status</option>
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