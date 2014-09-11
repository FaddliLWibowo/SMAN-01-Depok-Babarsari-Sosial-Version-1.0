<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title.' '?>SMAN 1 Depok Social</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport"/>
	<link href="<?php echo base_url('assets/css/bootstrap.css') ?>" media="screen"  rel="stylesheet" />
	<link href="<?php echo base_url('assets/css/style.css') ?>" media="screen" rel="stylesheet" />	
	<link rel="icon" href="<?php echo base_url('assets/assets/images/icon.png')?>" />
	<script src="<?php echo base_url('assets/js/myajax.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script>
		$(function () {
        $("[data-toggle='tooltip']").tooltip();
    });
	</script>
	<script>
		<?php if(isset($script)){echo $script;}//skrip untuk ubah class active di topmenu?>
	</script>
</head>
<body>
	<section id="topmenu">
		<div class="container">
			<div class="col-md-2"><a href="<?php echo site_url()?>" alt="logo"><span class="web-logo" src="#"><img style="height:60px;padding:8px" src="<?php echo base_url('assets/assets/images/logo.png')?>" alt="logo"/></span></a></div>
			<div class="top-menu col-md-10">
				<ul>
					<?php
					$name = explode(' ', $this->session->userdata('nama_lengkap'));
					$name = $name[0];
					$nis = $this->session->userdata('nis');
					$session = $this->session->userdata;
					//apakah user sudah logged in
					if($this->session->userdata('siswa_logged_in')) {						
						$avatar = $session['avatar'];
						if(!empty($avatar)) {//jika sudah upload avatar
							$src = 'assets/img/avatar/'.$avatar;
						} else { //jika belum upload avatar
							$src = 'assets/img/avatar/avatar.jpg';
						}						
						echo '
						<li style="width:120px" class="profile-menu">
							<div class="dropdown">
								<a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
									<span><img src="'.base_url($src).'" /></span> '.$name.' <span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
									<li><a href="'.site_url("siswa/profile/".$nis).'">My Profile</a></li>
									<li><a href="'.site_url('siswa/timeline').'">Timeline</a></li>
									<li class="divider"></li>
									<li><a href="'.site_url('siswa/edit_profile').'">Edit Profile</a></li>
									<li><a href="'.site_url("all/logout").'"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
								</ul>
							</div>
						</li>
						<li id="grup"><a href="'.site_url('grup').'">Grup</a></li>
						<li id="guru"><a href="'.site_url('guru').'">Guru</a></li>
						<li id="home"><a href="'.site_url('siswa/timeline').'">Home</a></li>
						';
					} else if($this->session->userdata('guru_logged_in')) {
						$avatar = $session['avatar'];
						if(!empty($avatar)) {//jika sudah upload avatar
							$src = 'assets/img/avatar/'.$avatar;
						} else { //jika belum upload avatar
							$src = 'assets/img/avatar/avatar.jpg';
						}
						echo '
						<li style="width:120px" class="profile-menu">
							<div class="dropdown">
								<a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
									<span><img src="'.base_url($src).'" /></span> '.$name.' <span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
									<li><a href="'.site_url('guru/profile/'.$this->session->userdata('nip')).'">My Profile</a></li>
									<li><a href="'.site_url('guru/timeline').'">Timeline</a></li>
									<li class="divider"></li>
									<li><a href="'.site_url('guru/edit_profile').'">Edit Profile</a></li>
									<li><a href="'.site_url("all/logout").'"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
								</ul>
							</div>
						</li>
						<li id="grup"><a href="'.site_url('grup').'">Grup</a></li>
						<li id="guru"><a href="'.site_url('guru').'">Guru</a></li>
						<li id="home"><a href="'.site_url('guru/timeline').'">Home</a></li>
						';
					} else {
						echo '<li><a data-toggle="modal" href="#login">Login '.validation_errors().'</a></li>
						<li id="about"><a href="#">About</a></li>
						<li id="home"><a href="'.site_url().'">Home</a></li>
						';					
					}
					?>				
					
				</ul>
			</div>
		</div>	
	</section>


	<!--modal login-->
	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Login</h4>
				</div>
				<div class="modal-body">
					<!--LOGIN SELECTION-->
					<div id="content">
						<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
							<li class="col-md-6"><a class="btn" href="#gurulogin" data-toggle="tab">Login Sebagai Guru</a></li>
							<li class="col-md-6" ><a class="btn" href="#siswalogin" data-toggle="tab">Login Sebagai Siswa</a></li>
						</ul>
						<br/><br/>
						<div id="my-tab-content" class="tab-content">
							<div class="tab-pane" id="gurulogin">		        	     	
								<form method="POST" action="<?php echo site_url('process/guru/login')?>" class="col-md-offset-2 form-horizontal" role="form">
									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">NIP</label>
										<div class="col-lg-7">
											<input name="login-guru-nip" type="number" class="form-control" id="inputEmail1" placeholder="">
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword1" class="col-lg-2 control-label">Password</label>
										<div class="col-lg-7">
											<input name="login-guru-password" type="password" class="form-control" id="inputPassword1" placeholder="">
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-7">
											<div class="checkbox">
												<label>
													<input type="checkbox"> Ingat saya
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-9">
											<button data-loading-text="Loading..." type="submit" class="btn btn-default">Sign in</button>
										</div>
									</div>
								</form>
							</div>

							<div class="tab-pane" id="siswalogin">
								<form method="POST" action="<?php echo site_url('process/siswa/login')?>" class="col-md-offset-2 form-horizontal" role="form">
									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">NIS</label>
										<div class="col-lg-7">
											<input name="login-siswa-nis" type="number" class="form-control" id="inputEmail1" placeholder="">
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword1" class="col-lg-2 control-label">Password</label>
										<div class="col-lg-7">
											<input name="login-siswa-password" type="password" class="form-control" id="inputPassword1" placeholder="" required>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-7">
											<div class="checkbox">
												<label>
													<input type="checkbox"> Ingat saya
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-9">
											<button data-loading-text="Loading..." type="submit" class="btn btn-default">Sign in</button>
										</div>
									</div>
								</form>

							</div>		       
						</div>
					</div>

					<script type="text/javascript">
						jQuery(document).ready(function ($) {
							$('#tabs').tab();
						});
					</script> 
				</div>

				<div class="modal-footer">
					<center><h6>SMAN 1 Depok Babarsari</h6></center>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!--modal thread-->
	<div class="modal fade" id="isithread" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Pesan > <span id="pengirim"></span> <small>Maks 10 threads</small></h4>
				</div>
				<div class="modal-body">
					<center class="col-md-12" style="padding:5px;display:none" id="loader"><img width="30px" src="<?php echo base_url('assets/css/loader.gif')?>"/></center>
					<div style="display:none" id="isipesan"></div>
				</div>

			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
  </div><!-- /.modal -->