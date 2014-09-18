<script type="text/javascript">
	$(function() { //SET DEFAULT SUBKATEGORI
		var status = '<?php echo $profile['status']?>';
		$('#status').val(status);
	});

	function subkelas(){
		$('#subkelas').html();
		$('#subkelas').show();
		$('#subkelas').html('loading subkelas...');
		var idkelas = $('#kelas').val();
		$.ajax({
			url:'<?php echo site_url("admin/guru?act=ajaxsubkelas&idkelas=")?>'+idkelas,
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
				<h3>Profile Guru</h3>
				<form method="POST" action="?act=editprofileguru" class="form-horizontal" role="form">
					<input type="hidden" name="id" value="<?php echo $profile['id']?>">
					<div class="form-group">					
						<label class="col-lg-2 control-label">Avatar</label>
						<div class="col-lg-5">
							<img src="<?php echo base_url('assets/img/avatar/'.$profile['avatar'])?>" width="200px"/>
						</div>
					</div>	
					<div class="form-group">
						<label class="col-lg-2 control-label">NIP</label>
						<div class="col-lg-5">
							<input name="nip" type="text" class="form-control" value="<?php echo $profile['nip']?>">
						</div>
					</div>	
					<div class="form-group">
						<label class="col-lg-2 control-label">Nama Lengkap</label>
						<div class="col-lg-5">
							<input name="nama" type="text" class="form-control" value="<?php echo $profile['nama_lengkap']?>">
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
				<hr/>
				<h3>Jadwal Mengajar</h3>
				<a data-toggle="modal" href="#addmengajar" class="btn btn-primary">+ Add Mengajar</a>
				<br/><br/>
				<table class="table table-striped">
					<tr>
						<td><strong>No.</strong></td>
						<td><strong>Kelas</strong></td>
						<td><strong>SubKelas</strong></td>
						<td><strong>Mata Pelajaran</strong></td>
						<td></td>
					</tr>
					<?php $n=1;foreach($ajar as $a):?>
					<tr>
						<td><?php echo $n;?></td>
						<td><?php echo $a['kelas'];?></td>
						<td><?php echo $a['subkelas'];?></td>
						<td><?php echo $a['matapelajaran'];?></td>
						<td><a class="btn btn-default" onclick="return confirm('Anda Yakin')" href="<?php echo site_url('admin/guru?act=deleteajar&idajar='.$a['ajar'].'&guru='.$profile['id'])?>"><span class="glyphicon glyphicon-trash"></span></a></td>
					</tr>
					<?php $n++;endforeach;?>
				</table>
				<!--modal for add mengajar-->
				<div class="modal fade" id="addmengajar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								<h4 class="modal-title">Add Mengajar</h4>
							</div>
							<div class="modal-body">
								<form action="?act=addajar" method="POST" class="form-inline" role="form">
									<input type="hidden" name="guru" value="<?php echo $profile['id'];?>">
									<div class="form-group">
										<?php 
										$kelas = $this->db->get('kelas');
										$kelas = $kelas->result_array();
										?>
										<select id="kelas" onchange="subkelas()" class="form-control" name="kelas">
											<option>Kelas</option>
											<?php
											foreach($kelas as $k):
												echo '<option value="'.$k['id_kelas'].'">'.$k['nama_kelas'].'</option>';
											endforeach;
											?>
										</select>
									</div>
									<div style="display:none" id="subkelas" class="form-group"></div>
									<div class="form-group">
										<?php 
										$materi = $this->db->get('matapelajaran');
										$materi = $materi->result_array();
										?>
										<select class="form-control" name="matapelajaran">
											<option>MataPelajaran</option>
											<?php
											foreach($materi as $m):
												echo '<option value="'.$m['id_matapelajaran'].'">'.$m['matapelajaran'].'</option>';
											endforeach;
											?>
										</select>
									</div>										
									<button type="submit" class="btn btn-primary">+ Tambah</button>
								</form>
							</div>							
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!--end modal for add mengajar-->
			</div>
		</div>
	</div>