<section id="padding-top"></section>
<div class="container">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="jumbotron">
		  <div class="container">
		    <h1>Admin</h1>
		    <p>loginlah disini</p>		    
		  </div>		 
		</div>
		 <?php
		  if(!empty($this->input->get('error'))) {
		  	echo '<div class="alert alert-block alert-danger fade in">  
		  	<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>      
        <h4>Login error!</h4>
        <p>Email dan Password tidak cucok</p>       
      </div>';
		  }
		  ?>
		<form role="form" method="POST" action="<?php echo site_url('admin/login')?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Email address</label>
				<input name="txtEmail" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input name="txtPassword" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			</div>			
			<div class="checkbox">
				<label>
					<input type="checkbox"> Check me out
				</label>
			</div>
			<button type="submit" class="btn btn-primary">Login</button>
		</form>
	</div>
	<div class="col-md-4"></div>
</div>