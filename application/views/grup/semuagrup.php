<script>
  function groupNameValidation(){
    $('#showadd').html('<small><i>cheking name...</i></small');
    var groupName = $('#txtGroupName').val();
    if(groupName == ''){
      $('#showadd').html('');
    }
    //ajax for cheking name
    $.ajax({
      type:'GET',
      url:'<?php echo site_url("all/groupnamevalidation")?>',
      timeout:50000,
      data:'name='+groupName,
      success:function(data){
        $('#showadd').html(data);
      },
      error:function(){
        $('#showadd').html('<p style="color:red">Nama Tidak Diperbolehkan</p>');
      }
    });
  }
</script>
<section id="padding-top"></section>
<section style="padding:10px;background-color: rgb(228, 228, 228)">
 <div  class="container">
   <div style="background-color: #fff" class="semua-guru"  class="col-md-offset-1 col-md-10">
     <div class="page-header">
       <h1>Grup <small>semua grup</small></h1>       
       <!-- Modal -->
        <div class="modal fade" id="creategroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create Group</h4>
              </div>
              <div class="modal-body">
                <small>*Nama grup wajib menggunakan nama mata pelajaran</small>
                <form action="<?php echo site_url('all/creategroup')?>" method="POST" enctype="multipart/form-data">
                  <h6>Jika nama sesuai dengan kebijakan, maka grup dapat dibuat</h6>
                  <label>Nama Grup :</label><input onkeyup="groupNameValidation()" class="form-control" id="txtGroupName" name="txtGroupName" type="text" placeholder="Nama Grup" required/><br/>
                  <div id="showadd"></div>
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
     </div>
     <div class="row">

      <?php foreach($view as $v):
      $idgrup = $v['id_grup'];      
      $user = $this->session->userdata('id');
      $count = $this->m_all->count_member($v['id_grup']);
      $url_nama_grup = str_replace(' ', '-', $v['nama_grup']);
      //AVATAR
      if(!empty($v['avatar'])){//IF AVATAR UPLOADED
        $avatar = base_url('assets/img/grup/'.$v['avatar']);
      } else { //AVATAR NOT UPLOADED
        $avatar = base_url('assets/img/grup/avatar.png');
      }
      ?>
      <div class="col-sm-6 col-md-3">       
        <div class="thumbnail" style="height:400px">         
          <img height="200px" src="<?php echo $avatar;?>" alt="...">
          <div class="caption">
            <h3><a href="<?php echo site_url('grup/welcome/'.$idgrup.'/'.$url_nama_grup)?>"><?php echo $v['nama_grup']?></a></h3>
            <small>Created <?php echo $v['created']?> | <?php echo $v['status']?></small>
            <p><?php echo $v['deskripsi_grup']?></p>
            <?php 
            //CEK YANG LOGIN SISWA ATAU GURU
            if($this->session->userdata('siswa_logged_in')) {              
              //CEK MEMBER OR NOT
              if($this->m_all->check_member_as_siswa($idgrup,$user)){
                echo '<p style="color:gray"><form action="'.site_url("process/siswa/unjoin_grup").'" method="POST"><input type="hidden" name="idgrup" value="'.$idgrup.'"><button type="submit" name="btn_unjoin" class="btn btn-xs btn-default">Joined</button> <small>member '.$count.'</small></form></p>';
              } else if($this->m_all->check_admin_as_siswa($idgrup,$user)){ //CEK ADMIN OR NOT
                echo '<p style="color:gray">i\'m admin</p>';
              } else {
                echo '<p style="color:gray"><form action="'.site_url("process/siswa/join_grup").'" method="POST"><input type="hidden" name="idgrup" value="'.$idgrup.'"><button type="submit" name="btn_join" class="btn btn-xs btn-primary">Join</button> <small>member '.$count.'</small></form></p>';
              }
            } else if ($this->session->userdata('guru_logged_in')){
              //CEK MEMBER OR NOT
              if($this->m_all->check_member_as_guru($idgrup,$user)){
                echo '<p style="color:gray"><form action="'.site_url("process/guru/unjoin_grup").'" method="POST"><input type="hidden" name="idgrup" value="'.$idgrup.'"><button type="submit" name="btn_unjoin" class="btn btn-xs btn-default">Joined</button> <small>member '.$count.'</small></form></p>';
              } else if($this->m_all->check_admin_as_guru($idgrup,$user)){ //CEK ADMIN OR NOT
                echo '<p style="color:gray">i\'m admin</p>';
              } else {
                echo '<p style="color:gray"><form action="'.site_url("process/guru/join_grup").'" method="POST"><input type="hidden" name="idgrup" value="'.$idgrup.'"><button type="submit" name="btn_join" class="btn btn-xs btn-primary">Join</button> <s>member '.$count.'</form></p>';
              }
              //GET DATA BUTTON FOR ADMIN.. BUT USER CAN OPEN THE DATA WILL BE CONSIDERING FOREVER
            }
            ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
  <br/>
<a href="#creategroup" data-toggle="modal">+ Create Group</a>
</div>
</div>
</section>