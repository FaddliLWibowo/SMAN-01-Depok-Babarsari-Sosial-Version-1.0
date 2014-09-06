<section id="padding-top"></section>
<section id="timeline-place">
  <div class="container">
   <div style="background-color:rgb(228, 228, 228)" class="col-md-offset-1 col-md-4">
     <div class="fixed-sidebar"><div class="menu"><?php $this->load->view('sidebar')?></div></div>
   </div>

   <div style="min-height:300px;background-color:rgb(228, 228, 228);" class="col-md-6">
    <div class="timeline">
      <div class="page-header">
        <h1>Edit Profile <small><?php echo $this->session->userdata('nama_lengkap')?></small></h1>
      </div>
      <p><form method="POST" action="<?php echo site_url('process/siswa/updateprofile')?>">
        <h3>Data Diri</h3><br/>
        <?php 
        if(isset($this->input->get('note'))){
          switch ($this->input->get('note')) {
            case 'success':
              echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Success Edit Profile</div>';
              break;
            case 'fail':
              echo '<div class="alert alert-danger alert-dismissable" ><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Failed Edit Profile, Try Again!</div>';
              break;
          }
        }
        ?>
        <div class="row">
          <div class="col-md-2"><strong>Status  </strong></div><div class="col-md-10"><?php echo $this->session->userdata('status')?></div><br/>
        </div>
        <br/>
        <div class="row">
          <div class="col-md-2"><strong>NIS  </strong></div><div class="col-md-10"><?php echo $this->session->userdata('nis')?></div><br/>
        </div>
        <br/>
        <div class="row">
          <div class="col-md-2"><strong>Nama  </strong></div><div class="col-md-10"><?php echo $this->session->userdata('nama_lengkap')?></div><br/>
        </div>
        <br/>
        <div class="row">
          <div class="col-md-2"><strong>Kelamin  </strong></div><div class="col-md-10"><?php echo $this->session->userdata('kelamin')?></div><br/>
        </div>
        <br/>
        <div class="row">
          <div class="col-md-2"><strong>Alamat </strong></div><div class="col-md-10">
          <small>maks 500 karakter</small>
          <textarea name="txtAlamat" class="form-control" required><?php echo $siswa['alamat']?></textarea><br/>
        </div>
      </div>
      <br/>
      <div class="row">
        <div class="col-md-2"><strong>Moto  </strong></div><div class="col-md-10">
        <small>maks 200 karakter</small>
        <textarea name="txtMoto" class="form-control" required><?php echo $siswa['moto']?></textarea><br/>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2"><strong>Avatar</strong></div>
      <div class="col-md-10">
        <?php
        //show avatar
        if(empty($siswa['avatar'])){
          $src = base_url('assets/img/avatar/avatar.jpg');
        } else{
          $myavatar = $siswa['avatar'];
          $src = base_url('assets/img/avatar/'.$myavatar);
        }
        ?>
        <img src="<?php echo $src?>" width="100px" height="100px"/>
        <small>JPG, JPEG, PNG (100px x 100px),Maks 100 MB</small>
        <input type="file" name="myAvatar" class="form-control"/>
        <input type="hidden" name="reccentAvatar" value="<?php echo $siswa['avatar']?>"/>
        <br/>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
  <br/>   
</form>
<hr/>
<h3>Ubah Password</h3>
<form method="POST" action="<?php echo site_url('process/siswa/updatepassword')?>">
 <div class="row">
  <div class="col-md-2"><strong>Ubah password  </strong></div>
  <div class="col-md-10">
    <?php echo validation_errors()?>
    <small>Password Lama</small>
    <input class="form-control" name="txtrecentpass" type="password" required/>
    <small>Password Baru</small>
    <input class="form-control" name="txtnewpass1" type="password" required/>
    <small>Ulangi Password Baru</small>
    <input class="form-control" name="txtnewpass2" type="password" required/>
    <br/>
    <button class="btn btn-primary" type="submit">Update</button>
  </div>
</div>
</form>
</p>
</div>
</div>




</div>
</div>
</section>