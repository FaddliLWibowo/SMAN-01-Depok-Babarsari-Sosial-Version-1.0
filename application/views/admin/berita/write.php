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
			<?php
			//action manajemen
			if($_GET['act']=='add') {
				$action=site_url('admin/proc_berita?act=add');
			} else if ($_GET['act']=='edit'){
				$action=site_url('admin/proc_berita?act=edit&id='.$view['id_berita']);
			}
			?>
				<form action="<?php echo $action;?>" method="POST" class="col-md-10 form-horizontal" role="form" enctype="multipart/form-data">
					<?php if(!empty($view['image'])){ 
						echo '<center><img style="width:90%" src="'.base_url("assets/img/news/".$view["image"]).'"/></center>';
						echo '<input type="hidden" name="oldGambar" value="'.$view["image"].'">';
					}
					?>
					<br/><br/>
					<div class="form-group">
						<label for="inputGambar" class="col-lg-2 control-label">Gambar</label>
						<div class="col-lg-10">
							<input type="file" class="form-control" name="inputGambar" id="inputGambar" placeholder="gambar">
						</div>
					</div>
					<div class="form-group">
						<label for="inputTitle" class="col-lg-2 control-label">Judul</label>
						<div class="col-lg-10">
							<input value="<?php if(!empty($view['judul'])){ echo $view['judul'];}?>" type="text" class="form-control" name="inputTitle" id="inputTitle" placeholder="judul" required>
						</div>
					</div>
					<div class="form-group">
						<label for="inputIsi" class="col-lg-2 control-label">Isi</label>
						<div class="col-lg-10">
							<textarea rows="10" class="form-control" name="inputIsi" id="inputIsi" placeholder="isi berita" required><?php if(!empty($view['konten'])){ echo $view['konten'];}?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button type="submit" class="btn btn-primary">Post</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>