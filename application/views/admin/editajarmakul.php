<script type="text/javascript">
	$(function() { //SET DEFAULT SUBKATEGORI
		$('#kelas').val('<?php echo $ajar['id_kelas']?>');
		$('#selsubkelas').val('<?php echo $ajar['id_subkelas']?>');
		$('#hari').val('<?php echo $ajar['hari']?>');
		$('#matapelajaran').val('<?php echo $ajar['id_matapelajaran']?>');
	});

	function subkelas(){
		$('#subkelas').html();
		$('#subkelas').show();
		$('#subkelas').html('loading subkelas...');
		var idkelas = $('#kelas').val();
		$.ajax({
			url:'<?php echo site_url("admin/guru?act=ajaxsubkelas&idkelas=")?>'+idkelas,
			success:function(data){
				//$('#subkelas').html();
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
				<h3>Update Jadwal Mengajar</h3>
				<form action="?act=updateajar&idguru=<?php echo $id_guru?>&idajar=<?php echo $id_ajar?>" method="POST" class="form-inline" role="form">
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
					<div style="" id="subkelas" class="form-group">
						<select id="selsubkelas" class="form-control" name="subkelas">
							<option>Subkelas</option><option value="<?php echo $ajar['id_subkelas']?>"><?php echo $ajar['id_subkelas']?></option>
						</select>
					</div>
					<div class="form-group">
						<?php 
						$materi = $this->db->get('matapelajaran');
						$materi = $materi->result_array();
						?>
						<select id="matapelajaran" class="form-control" name="matapelajaran">
							<option>MataPelajaran</option>
							<?php
							foreach($materi as $m):
								echo '<option value="'.$m['id_matapelajaran'].'">'.$m['matapelajaran'].'</option>';
							endforeach;
							?>
						</select>
					</div>										
					<div class="form-group">
						<select class="form-control" name="hari">
							<option value="senin">senin</option>
							<option value="selasa">selasa</option>
							<option value="rabu">rabu</option>
							<option value="kamis">kamis</option>
							<option value="jumat">jum'at</option>
							<option value="sabtu">sabtu</option>
						</select>
					</div>
					<div class="form-group">
						<input class="form-control" type="text" name="mulai" value="<?php echo $ajar['mulai']?>"/>
					</div>
					<div class="form-group">
						<input class="form-control" type="text" name="selesai" value="<?php echo $ajar['selesai']?>"/>
					</div>
					<button type="submit" class="btn btn-primary">+ Update</button>
				</form>
			</div>
		</div>
	</div>