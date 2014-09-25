<script>
  $(function() {
    <?php echo $scriptadmin;?>
  });
</script>
<div class="col-md-2">
	<div class="list-group">
		<a id="dashboard" href="<?php echo site_url('admin/dashboard')?>" class="list-group-item">Dashboard</a>
		<a id="berita" href="<?php echo site_url('admin/berita')?>" class="list-group-item">Berita</a>
		<a id="guru" href="<?php echo site_url('admin/guru')?>" class="list-group-item">Guru</a>
		<a id="siswa" href="<?php echo site_url('admin/siswa')?>" class="list-group-item">Siswa</a>
		<a id="grup" href="<?php echo site_url('admin/grup')?>" class="list-group-item">Grup</a>
		<a id="kelas" href="<?php echo site_url('admin/kelas')?>" class="list-group-item">Kelas</a>
		<a id="mapel" href="<?php echo site_url('admin/matapelajaran')?>" class="list-group-item">Mata Pelajaran</a>
		<a id="logout" href="<?php echo site_url('admin/logout')?>" class="list-group-item"><span class="glyphicon glyphicon-remove-circle"></span> Logout</a>
	</div>
</div>