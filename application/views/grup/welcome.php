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
    $avatargroup = base_url('assets/img/grup/'.$view['avatar']);
  } else {
    $avatargroup = base_url('assets/img/grup/avatar.png');
  }
  ?>
  <div style="background-color:rgb(228, 228, 228);" class="col-md-6">
    <div style="height:250px;background-size:cover;background-image:url('<?php echo $avatargroup; ?>')" class="header-timeline">
      <center>
        <h3 style="text-shadow:1px 1px #000"><?php echo $view['nama_grup']?></h3>
        <p style="text-shadow:1px 1px #000">"<?php echo $view['deskripsi_grup']?>"</p>
        <small style="text-shadow:1px 1px #000">created <?php echo $view['created']?></small>
      </center>
    </div>

    <div class="alert alert-warning fade in">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
      <?php echo $memo?>
    </div>

    <div class="timeline">    
      <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a class="btn" href="#post" data-toggle="tab"><span class="glyphicon glyphicon-bullhorn"></span> Post to group</a></li>
        <li><a class="btn" href="#member" data-toggle="tab"><span class="glyphicon glyphicon-envelope"></span> Member</a></li>
        <li><a class="btn" href="#files" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span> Files</a></li>
        <?php 
        if($status == 'admin') {
          echo ' <li><a class="btn" href="#admin" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> admin</a></li>';
        }
        ?>
      </ul>
      <br/><br/>
      <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="post">
          <form action="" enctype="multipart/form-data">
            <textarea rows="5" class="form-control" id="newpost" placeholder="type here..."></textarea>
            <h6>support : pdf,odt,doc,docx</h6>
            <input type="file" class="form-control" name="uploadfile" placeholder="upload">
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
              <?php
              foreach($member as $m):
                if(!empty($m['siswa'])) { //MEMBER IS STUDENT
                  $membergroup = $this->m_siswa->data_by_id($m['siswa']);
                  $membername = $membergroup['nama_lengkap'];
                  $memberlink = site_url('siswa/profile/'.$membergroup['nis']);
                  //avatar
                  if(empty($membergroup['avatar'])) {//NOT UPLOAD AVATAR
                    $memberavatar = base_url('assets/img/avatar/avatar.jpg');
                  }else{ //UPLOADED AVATAR
                    $memberavatar = base_url('assets/img/avatar/'.$membergroup['avatar']);
                  }
                } else { //MEMBER IS TEACHER
                  $membergroup = $this->m_guru->data_by_id($m['guru']);
                  $membername = $membergroup['nama_lengkap'];
                  $memberlink = site_url('guru/profile/'.$membergroup['nip']);
                  //avatar
                  if(empty($membergroup['avatar'])) {//NOT UPLOAD AVATAR
                    $memberavatar = base_url('assets/img/avatar/avatar.jpg');
                  }else{ //UPLOADED AVATAR
                    $memberavatar = base_url('assets/img/avatar/'.$membergroup['avatar']);
                  }
                }
                //ECHO IMAGE+LINK+NAME
                echo '<a class="member" data-placement="top" data-toggle="tooltip" title="'.$membername.'" href="'.$memberlink.'"><img src="'.$memberavatar.'"/></a>';
                endforeach;
                ?>
              </div>

              <div class="tab-pane" id="files">
                <h2>Uploaded Files</h2>
              </div>

              <div style="height:450px" class="tab-pane" id="admin">
                <h2>Admin Setup</h2>
                <hr>
                <form class="form-horizontal" role="form">
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-10">
                      <input type="text" name="txtGroupName" class="form-control" value="<?php echo $view['nama_grup']?>"></br>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Detail</label>
                    <div class="col-lg-10">
                      <textarea name="txtGroupDetail" class="form-control"><?php echo $view['deskripsi_grup']?></textarea></br>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Cover</label>
                    <div class="col-lg-10">
                      <?php
                    //IF COVER SET
                      if(!empty($view['avatar'])) {
                        echo '<img width="50%" src="'.base_url().'/assets/img/grup/'.$view['avatar'].'"/>';
                        echo '<input type="hidden" value="'.$view['avatar'].'">';
                      }
                      ?>
                      <input type="file" name="fileCover"/></br>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button type="submit" class="btn btn-primary">Update Group</button>
                      <a onclick="return confirm('Anda Yakin')" class="btn btn-danger" href="<?php echo site_url('grup/delete_group?id='.$view['id_grup'])?>"><span class="glyphicon glyphicon-ban-circle"></span> Hapus Grup</a>
                    </div>
                  </div>
                </form>
                <br/>                
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