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
				<h2><span class="glyphicon glyphicon-stats"></span> Statistik Media Sosial</h2>
				<br/>
				<div class="container">
					<center>
					<div class="col-md-3">
						<h2><strong><?php echo $this->db->count_all('status'); ?></strong></h2>
						<p>Status</p>
					</div>
					<div class="col-md-3">
						<h2><strong><?php echo $this->db->count_all('status_komentar'); ?></strong></h2>
						<p>Komentar</p>
					</div>
					<div class="col-md-3">
						<h2><strong><?php echo $this->db->count_all('status_komentar'); ?></strong></h2>
						<p>Like</p>
					</div>
					<div class="col-md-3">
						<h2><strong><?php echo $this->db->count_all('grup'); ?></strong></h2>
						<p>Grup</p>
					</div>
					</center>
				</div>
				<hr>
				<h2><span class="glyphicon glyphicon-stats"> Statistik E-Learning</h2>
				<br/>
				<div class="container">
					<center>
					<div class="col-md-3">
						<h2><strong><?php echo $this->db->count_all('guru'); ?></strong></h2>
						<p>Guru</p>
					</div>
					<div class="col-md-3">
						<h2><strong><?php echo $this->db->count_all('siswa'); ?></strong></h2>
						<p>Siswa</p>
					</div>
					<div class="col-md-3">
						<h2><strong><?php echo $this->db->count_all('materi'); ?></strong></h2>
						<p>Materi</p>
					</div>
					<div class="col-md-3">
						<h2><strong><?php echo $this->db->count_all('soal'); ?></strong></h2>
						<p>Soal</p>
					</div>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>