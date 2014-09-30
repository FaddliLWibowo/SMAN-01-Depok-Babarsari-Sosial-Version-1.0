<?php
if($view['status'] == 'blocked'){
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Grup diblokir');
    window.location.href='".site_url('grup')."';
  </SCRIPT>");
}
?>
<style type="text/css">.myavatar{background-image: url('<?php echo base_url("assets/img/avatar/".$this->session->userdata("avatar"))?>');background-size: cover}</style>
<script type="text/javascript">
  $(document).ready(function(){ 
  grupStatus();//LOAD LATTEST UPDATES
  setInterval(function(){updatedGrupStatus();},5000);//LOAD LATTEST UPDATES EVERY 20 seconds    
});

   //write comment
  function writecomment(x){ //x=is id status : y = id siswa : z = id guru
    comment = $('#writecomment'+x).val();
    <?php if($this->session->userdata('siswa_logged_in')) {
      $sis = $this->session->userdata('id');
      $gur = null;
    } else {
      $gur = $this->session->userdata('id');
      $sis = null;
    }
    ?>
    //insert to database
    $.ajax({
      url:'<?php echo site_url("all/addcomment");?>?idsiswa=<?php echo $sis;?>&idguru=<?php echo $gur;?>&idpost='+x+'&comment='+comment,
      success:function(){
        getCommentOnGroupById(x);
      },
      error:function(){
        alert('error add comment');
      },
    });
    $('#writecomment'+x).val()='';
  }

  function grupStatus(){
  $('#top-loader').show();//SHOW LOADING
  $.ajax({
    url:'<?php echo site_url("json/grup_start_status?id=".$view['id_grup'])?>',
    dataType:'json',
    timeout: 50000,//50000MS
    success:function(data){
      timeline ='';
      $.each(data['result'], function(i,n){
        timeline = '<div class=\'timeline\'><button data-dismiss="alert" onclick="deleteGroupStatus('+n['id']+')" class=\'close btn btn-xs btn-default\' style=\'float:right;top:0\'>x</button>'+
        '<div name=\''+n['id']+'\' class=\'row name\'>'+
        '<div class=\'col-md-12\'><img src=\''+n['avatar']+'\' />'+
        '<h5><a href=\''+n['profile']+'\'><strong>'+n['name']+'</strong></a> > <a href=\''+n['des_profile']+'\'><strong>'+n['des_name']+'</strong></a></h5><h6>'+n['time']+'</h6>'+
        '</div>'+     
        '</div>'+
        '<div class=\'row\'>'+
        '<div class=\'col-md-12\'>'+
        '<p>'+n['content']+'</p>'+
        '<p><small>upload file : <a href="'+n['upload']+'">'+n['uploadname']+'</a></small></p>'+
        '<p>'+
        '<button onclick="addlikegroup('+n['id']+')" class=\'btn btn-xs btn-default\'><span class=\'glyphicon glyphicon-thumbs-up\'></span> </button> <span class="'+n['id']+'" style=\'font-size:10px\'> '+n['like']+' </span>'+
        '<button onclick=\'getCommentOnGroupById('+n['id']+')\' class="btn btn-default btn-xs"> Lihat Komentar</button>'+
        '</p>'+
        '</div>'+
        '</div>'+     
        '<div class=\'container\'>'+
        '<div class="comments'+n['id']+'" name=\''+n['id']+'\'>'+        
        '</div>'+//END OF #COMMENTS   
        '<div class=\'comment row\'>'+
        '<div class=\'col-md-2\'><img class="myavatar" /></div>'+
        '<div class=\'col-md-10\'>'+
        '<div class="input-group"><textarea id="writecomment'+n['id']+'" class=\'form-control\' id=\'comment\' placeholder=\'your comment...\'></textarea><span class="input-group-btn"><button class="btn btn-default" onclick="writecomment('+n['id']+')"><span class="glyphicon glyphicon-play"></span></button></span></div>'+
        '</div>'+
        '</div>'+    
        '</div>'+
        '</div>'+
        '</div>';
        timeline = timeline+'';
        $('#all-timeline').append(timeline);//ADD NEW TO BOTTOM prepend() //TO TOP
        $('#top-loader').hide();
      });
      $('#btn-more').show();//show btn to more status
    },
    error: function(){
      alert('Tidak Ada Status');
      $('#top-loader').hide();
    }
  });
}

function updatedGrupStatus(){
  $('#top-loader').show();//SHOW LOADING
  lastid = $('#all-timeline .timeline div').first().attr('name');//GET ELEMENT NAME
  $.ajax({
    url:'<?php echo site_url("json/grup_start_status?id=".$view['id_grup']."&last=")?>'+lastid,
    dataType:'json',
    timeout: 50000,//50000MS
    success:function(data){
      timeline ='';
      $.each(data['result'], function(i,n){
        timeline = '<div class=\'timeline\'><button data-dismiss="alert" onclick="deleteGroupStatus('+n['id']+')" class=\'close btn btn-xs btn-default\' style=\'float:right;top:0\'>x</button>'+
        '<div name=\''+n['id']+'\' class=\'row name\'>'+
        '<div class=\'col-md-12\'><img src=\''+n['avatar']+'\' />'+
        '<h5><a href=\''+n['profile']+'\'><strong>'+n['name']+'</strong></a> > <a href=\''+n['des_profile']+'\'><strong>'+n['des_name']+'</strong></a></h5><h6>'+n['time']+'</h6>'+
        '</div>'+     
        '</div>'+
        '<div class=\'row\'>'+
        '<div class=\'col-md-12\'>'+
        '<p>'+n['content']+'</p>'+
        '<p><small>upload file : <a href="'+n['upload']+'">'+n['uploadname']+'</a></small></p>'+
        '<p>'+
        '<button onclick="addlikegroup('+n['id']+')" class=\'btn btn-xs btn-default\'><span class=\'glyphicon glyphicon-thumbs-up\'></span> </button> <span class="'+n['id']+'" style=\'font-size:10px\'> '+n['like']+' </span>'+
        '<button onclick=\'getCommentOnGroupById('+n['id']+')\' class="btn btn-default btn-xs"> Lihat Komentar</button>'+
        '</p>'+
        '</div>'+
        '</div>'+     
        '<div class=\'container\'>'+
        '<div class="comments'+n['id']+'" name=\''+n['id']+'\'>'        
        +'</div>'+//END OF #COMMENTS
        '<div class=\'comment row\'>'+
        '<div class=\'col-md-2\'><img class="myavatar" /></div>'+
        '<div class=\'col-md-10\'>'+
        '<div class="input-group"><textarea id="writecomment'+n['id']+'" class=\'form-control\' id=\'comment\' placeholder=\'your comment...\'></textarea><span class="input-group-btn"><button class="btn btn-default" onclick="writecomment('+n['id']+')"><span class="glyphicon glyphicon-play"></span></button></span></div>'+
        '</div>'+
        '</div>'+       
        '</div>'+
        '</div>'+
        '</div>';
        timeline = timeline+'';
        $('#all-timeline').prepend(timeline);//ADD NEW TO BOTTOM prepend() //TO TOP
        $('#top-loader').hide();
      });
      $('#btn-more').show();//show btn to more status
    },
    error: function(){
      //alert('Tidak Ada Status');
      $('#top-loader').hide();
    }
  });
}

function moreGrupStatus(){
  $('#bottom-loader').show();//SHOW LOADING
  smallid = $('#all-timeline .timeline div').last().attr('name');//GET ELEMENT NAME
  $.ajax({
    url:'<?php echo site_url("json/grup_start_status?id=".$view['id_grup']."&small=")?>'+smallid,
    dataType:'json',
    timeout: 50000,//50000MS
    success:function(data){
      timeline ='';
      $.each(data['result'], function(i,n){
        timeline = '<div class=\'timeline\'><button data-dismiss="alert" onclick="deleteGroupStatus('+n['id']+')" class=\'close btn btn-xs btn-default\' style=\'float:right;top:0\'>x</button>'+
        '<div name=\''+n['id']+'\' class=\'row name\'>'+
        '<div class=\'col-md-12\'><img src=\''+n['avatar']+'\' />'+
        '<h5><a href=\''+n['profile']+'\'><strong>'+n['name']+'</strong></a> > <a href=\''+n['des_profile']+'\'><strong>'+n['des_name']+'</strong></a></h5><h6>'+n['time']+'</h6>'+
        '</div>'+     
        '</div>'+
        '<div class=\'row\'>'+
        '<div class=\'col-md-12\'>'+
        '<p>'+n['content']+'</p>'+
        '<p><small>upload file : <a href="'+n['upload']+'">'+n['uploadname']+'</a></small></p>'+
        '<p>'+
        '<button onclick="addlikegroup('+n['id']+')" class=\'btn btn-xs btn-default\'><span class=\'glyphicon glyphicon-thumbs-up\'></span> </button> <span class="'+n['id']+'" style=\'font-size:10px\'> '+n['like']+' </span>'+
        '<button onclick=\'getCommentOnGroupById('+n['id']+')\' class="btn btn-default btn-xs"> Lihat Komentar</button>'+
        '</p>'+
        '</div>'+
        '</div>'+     
        '<div class=\'container\'>'+
        '<div class="comments'+n['id']+'" name=\''+n['id']+'\'>'        
        +'</div>'+//END OF #COMMENTS       
        '<div class=\'comment row\'>'+
        '<div class=\'col-md-2\'><img class="myavatar" /></div>'+
        '<div class=\'col-md-10\'>'+
        '<div class="input-group"><textarea id="writecomment'+n['id']+'" class=\'form-control\' id=\'comment\' placeholder=\'your comment...\'></textarea><span class="input-group-btn"><button class="btn btn-default" onclick="writecomment('+n['id']+')"><span class="glyphicon glyphicon-play"></span></button></span></div>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>';
        timeline = timeline+'';
        $('#all-timeline').append(timeline);//ADD NEW TO BOTTOM prepend() //TO TOP
        $('#bottom-loader').hide();
      });
      $('#btn-more').show();//show btn to more status
    },
    error: function(){
      alert('Tidak Ada Status');
      $('#bottom-loader').hide();
    }
  });
}
</script>

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
        <!-- <li><a class="btn" href="#files" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span> Files</a></li> -->
        <?php 
        if($status == 'admin') { //jika admin grup yang login
          echo ' <li><a class="btn" href="#admin" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> admin</a></li>';
        }
        ?>
      </ul>
      <br/><br/>
      <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="post">
          <form method="POST" action="<?php echo site_url('grup/addstatus')?>" enctype="multipart/form-data">
            <textarea name="txtStatus" rows="5" class="form-control" id="newpost" placeholder="type here..." required></textarea>
            <h6>support : pdf,odt,ods,doc,docx,txt | maks : 1 MB</h6>
            <input name="upload" type="file" class="form-control" placeholder="upload">
            <input name="idgrup" type="hidden" value="<?php echo $view['id_grup']?>">
           <?php //CEK YANG LOGIN 
           if($this->session->userdata('siswa_logged_in')){
            ?>
            <input name="idsiswa" type="hidden" value="<?php echo $this->session->userdata('id');?>" />
            <button type="submit" id="btn-newpost">Post</button>  
            <?php } else if($this->session->userdata('guru_logged_in')){?>
            <input name="idguru" type="hidden" value="<?php echo $this->session->userdata('id');?>"/>
            <button type="submit" id="btn-newpost">Post</button> 
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
          <button onclick="moreGrupStatus()" id="btn-more" style="width:100%;display:none" class="btn btn-default">Berikutnya</button>
          <!--end of  id all-timeline-->
        </div>
      </div>
    </section>