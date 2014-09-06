<style type="text/css">.myavatar{background-image: url('<?php echo base_url("assets/img/avatar/".$this->session->userdata("avatar"))?>');background-size: cover}</style>
<section id="padding-top"></section>
<section id="timeline-place">
  <div class="container">
   <div style="background-color: rgb(228, 228, 228)" class="col-md-offset-1 col-md-4">
     <div class="fixed-sidebar"><div class="menu"><?php $this->load->view('sidebar')?></div></div>
   </div>
    <?php
    $dont = array('',' ','-');        
    if(!in_array($view['avatar'] , $dont)){
      $avatargroup = base_url('assets/img/avatar/'.$siswa['avatar']);
    } else {
      $avatargroup = base_url('assets/img/grup/avatar.png');
    }
    ?>
   <div style="background-color:rgb(228, 228, 228);" class="col-md-6">
    <div style="height:250px;background-size:cover;background-image:url('<?php echo $avatargroup; ?>')" class="header-timeline">
      <center>
        <h3><?php echo $view['nama_grup']?></h3>
        <p>"<?php echo $view['deskripsi_grup']?>"</p>
        <small>created <?php echo $view['created']?></small>
      </center>
    </div>

    <div class="alert alert-warning fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <?php echo $memo?>
    </div>

    <div class="timeline">    
      <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a class="btn" href="#post" data-toggle="tab"><span class="glyphicon glyphicon-bullhorn"></span> post to group</a></li>
        <li><a class="btn" href="#member" data-toggle="tab"><span class="glyphicon glyphicon-envelope"></span> member</a></li>
        <?php 
          if($status == 'admin') {
            echo ' <li><a class="btn" href="#admin" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> admin</a></li>';
          }
        ?>
      </ul>
      <br/><br/>
      <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="post">
          <textarea rows="5" class="form-control" id="newpost" placeholder="type here..."></textarea>
           <?php //CEK YANG LOGIN 
           if($this->session->userdata('siswa_logged_in')){
            ?>
            <button onclick="updateSiswaStatus(<?php echo $this->session->userdata('id')?>,0,0,0,0,<?php echo $view['id_grup']?>)" id="btn-newpost">Post</button>  
            <?php } else if($this->session->userdata('guru_logged_in')){?>
            <button onclick="updateSiswaStatus(0,<?php echo $this->session->userdata('id')?>,0,0,0,<?php echo $view['id_grup']?>)" id="btn-newpost">Post</button> 
            <?php } ?> <br/><br/>
          </div>
          
          <div class="tab-pane" id="member">
              <h2>Member</h2>
              <hr>
              <strong>Admin</strong><br/><br/>
              <?php
              //ADMIN SHOW
              if(!empty($view['admin_siswa'])) { //ADMIN IS STUDENT
                $usergroup = $this->m_siswa->data_by_id($view['admin_siswa']);
                $profilegroup = site_url('siswa/profile/'.$usergroup['nis']);
                //avatar
                if(empty($usergroup['avatar'])) {//NOT UPLOAD AVATAR
                  $avatargroup = base_url('assets/img/avatar/avatar.jpg');
                }else{ //UPLOADED AVATAR
                  $avatargroup = base_url('assets/img/avatar/'.$usergroup['avatar']);
                }
              } else { //ADMIN IS TEACHER
                $usergroup = $this->m_guru->data_by_id($view['admin_guru']);
                $profilegroup = site_url('guru/profile/'.$usergroup['nip']);
                //avatar
                if(empty($usergroup['avatar'])) {//NOT UPLOAD AVATAR
                  $avatargroup = base_url('assets/img/avatar/avatar.jpg');
                }else{ //UPLOADED AVATAR
                  $avatargroup = base_url('assets/img/avatar/'.$usergroup['avatar']);
                }
              }
              ?>
              <a class="member" data-placement="top" data-toggle="tooltip" title="<?php echo $usergroup['nama_lengkap']?>" href="<?php echo $profilegroup?>"><img src="<?php echo $avatargroup?>"/></a>
              <br/><hr>
              <strong>New 20 members from <?php echo $countmember?> members</strong><br/><br/>

          </div>

          <div class="tab-pane" id="admin">
              <h2>Admin Setup</h2>
              <hr>

          </div>

        </div>

      </div>

      <center id="top-loader" class="col-md-12" style="padding:5px;display:none" ><img width="30px" src="<?php echo base_url('assets/css/loader.gif')?>"/></center>
      <div id="all-timeline"></div>
      <center id="bottom-loader" class="col-md-12" style="padding:5px;display:none"><img width="30px" src="<?php echo base_url('assets/css/loader.gif')?>"/></center>
      <button onclick="showMoreStatusOnProfile()" id="btn-more" style="width:100%;display:none" class="btn btn-default">Berikutnya</button>
      <!--end of  id all-timeline-->
    </div>
  </div>
</section>