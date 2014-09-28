<style type="text/css">.myavatar{background-image: url('<?php echo base_url("assets/img/avatar/".$this->session->userdata("avatar"))?>');background-size: cover}</style>
<script type="text/javascript">
//WHEN DOCUMENT READY
$(document).ready(function(){ 
  profileStatus();//LOAD LATTEST UPDATES
  setInterval(function(){showUpdatedStatusOnProfile();},5000);//LOAD LATTEST UPDATES EVERY 20 seconds    
});
//SHOALL
function semuamateri(x){
  $('#modaldarisaya').modal('show');
  $('#darisaya').html('loading...');
  $.ajax({
    url:'<?php echo site_url("ajax/materiguru?id=");?>'+x,
    success:function(data){
      $('#darisaya').html(data);
    },
    error:function(){
      $('#darisaya').html('<center>Gagal Load Materi</center>');
    },
  });
}
function semuasoal(x){
  $('#modaldarisaya').modal('show');
  $('#darisaya').html('loading...');
  $.ajax({
    url:'<?php echo site_url("ajax/soalguru?id=");?>'+x,
    success:function(data){
      $('#darisaya').html(data);
    },
    error:function(){
      $('#darisaya').html('<center>Gagal Load Soal</center>');
    },
  });
}
function semuanilai(x){
  $('#modaldarisaya').modal('show');
  $('#darisaya').html('loading...');
  $.ajax({
    url:'<?php echo site_url("ajax/nilaiguru?id=");?>'+x,
    success:function(data){
      $('#darisaya').html(data);
    },
    error:function(){
      $('#darisaya').html('<center>Gagal Load Nilai</center>');
    },
  });
}
//DELETE ALL
function deletemateri(x,y){
 var act=confirm('Yakin?');
 if(act = true){
    $.ajax({
      url:'<?php echo site_url("ajax/deletemateri?id=");?>'+x,
      success:function(){
        $.ajax({
          url:'<?php echo site_url("ajax/materiguru?id=");?>'+y,
          success:function(data){
            $('#darisaya').html(data);
          },
          error:function(){
            $('#darisaya').html('<center>Gagal Load Materi</center>');
          },
        });
      }
    });
  }
}
function deletesoal(x,y){
 var act=confirm('Yakin?');
 if(act = true){
    $.ajax({
      url:'<?php echo site_url("ajax/deletesoal?id=");?>'+x,
      success:function(){
        $.ajax({
          url:'<?php echo site_url("ajax/soalguru?id=");?>'+y,
          success:function(data){
            $('#darisaya').html(data);
          },
          error:function(){
            $('#darisaya').html('<center>Gagal Load Soal</center>');
          },
        });
      }
    });
  }
}
function deletenilai(x,y){
 var act=confirm('Yakin?');
 if(act = true){
    $.ajax({
      url:'<?php echo site_url("ajax/deletenilai?id=");?>'+x,
      success:function(){
        $.ajax({
          url:'<?php echo site_url("ajax/nilaiguru?id=");?>'+y,
          success:function(data){
            $('#darisaya').html(data);
          },
          error:function(){
            $('#darisaya').html('<center>Gagal Load Nilai</center>');
          },
        });
      }
    });
  }
}

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
        getCommentOnProfileById(x);
      },
      error:function(){
        alert('error add comment');
      },
    });
    $('#writecomment'+x).val()='';
  }
//STATUS BY ME OR FOR ME
function profileStatus(){
  $('#top-loader').show();//SHOW LOADING
  $.ajax({
    url:'<?php echo site_url("json/start_status?idguru=".$guru["id"])?>',
    dataType:'json',
    timeout: 50000,//50000MS
    success:function(data){
      timeline ='';
      $.each(data['result'], function(i,n){
        timeline = '<div class=\'timeline\'><button data-dismiss="alert" onclick="deleteProfileStatus('+n['id']+')" class=\'close btn btn-xs btn-default\' style=\'float:right;top:0\'>x</button>'+
        '<div name=\''+n['id']+'\' class=\'row name\'>'+
        '<div class=\'col-md-12\'><img src=\''+n['avatar']+'\' />'+
        '<h5><a href=\''+n['profile']+'\'><strong>'+n['name']+'</strong></a> > <a href=\''+n['des_profile']+'\'><strong>'+n['des_name']+'</strong></a></h5><h6>'+n['time']+'</h6>'+
        '</div>'+     
        '</div>'+
        '<div class=\'row\'>'+
        '<div class=\'col-md-12\'>'+
        '<p>'+n['content']+'</p>'+
        '<p>'+
        '<button onclick="addlike('+n['id']+')" class=\'btn btn-xs btn-default\'><span class=\'glyphicon glyphicon-thumbs-up\'></span> </button> <span class="'+n['id']+'" style=\'font-size:10px\'>'+n['like']+'</span>'+
        '<button onclick=\'getCommentOnProfileById('+n['id']+')\' class="btn btn-default btn-xs"> Lihat Komentar</button>'+
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
//AUTO UPDATE LATTEST STATUS BY ME OR FOR ME
function showUpdatedStatusOnProfile(){
$('#top-loader').show();//SHOW LOADING
lastid = $('#all-timeline .timeline div').first().attr('name');//GET ELEMENT NAME
$.ajax({
  url:'<?php echo site_url("json/start_status?idguru=".$guru["id"]."&last=")?>'+lastid,
  dataType:'json',
  timeout: 50000,//50000MS
  success:function(data){
    timeline ='';
    $.each(data['result'], function(i,n){
      timeline = '<div class=\'timeline\'><button data-dismiss="alert" onclick="deleteProfileStatus('+n['id']+')" class=\'close btn btn-xs btn-default\' style=\'float:right;top:0\'>x</button>'+
      '<div name=\''+n['id']+'\' class=\'row name\'>'+
      '<div class=\'col-md-12\'><img src=\''+n['avatar']+'\' />'+
      '<h5><a href=\''+n['profile']+'\'><strong>'+n['name']+'</strong></a> > <a href=\''+n['des_profile']+'\'><strong>'+n['des_name']+'</strong></a></h5><h6>'+n['time']+'</h6>'+
      '</div>'+     
      '</div>'+
      '<div class=\'row\'>'+
      '<div class=\'col-md-12\'>'+
      '<p>'+n['content']+'</p>'+
      '<p>'+
      '<button onclick="addlike('+n['id']+')" class=\'btn btn-xs btn-default\'><span class=\'glyphicon glyphicon-thumbs-up\'></span> </button> <span class="'+n['id']+'" style=\'font-size:10px\'>'+n['like']+'</span>'+
      '<button onclick=\'getCommentOnProfileById('+n['id']+')\' class="btn btn-default btn-xs"> Lihat Komentar</button>'+
      '</p>'+
      '</div>'+
      '</div>'+
      '<div class=\'container\'>'+
      '<div class="comments'+n['id']+'" name=\''+n['id']+'\'>'+
      
      '</div>'+//END #COMMENTS 
      '<div class=\'comment row\'>'+
      '<div class=\'col-md-2\'><img class="myavatar" /></div>'+
      '<div class=\'col-md-10\'>'+
      '<div class="input-group"><textarea id="writecomment'+n['id']+'" class=\'form-control\' id=\'comment\' placeholder=\'your comment...\'></textarea><span class="input-group-btn"><button class="btn btn-default" onclick="writecomment('+n['id']+')"><span class="glyphicon glyphicon-play"></span></button></span></div>'+
      '</div>'+
      '</div>'+
      '</div>'+
      '</div>';
      timeline = timeline+'';
    $('#all-timeline').prepend(timeline);//ADD NEW TO BOTTOM prepend() //TO TOP
  });
},
error: function(){
    //alert('Terjadi masalah');
  }
});
  $('#top-loader').hide();//SHOW LOADING
}

//MORESTATUS
function showMoreStatusOnProfile(){
  $('#bottom-loader').show();//SHOW LOADING
  var id = $('#all-timeline .timeline .name').last().attr('name');//GET ELEMENT NAME
  //alert(id);
  $.ajax({
    url:'<?php echo site_url("json/start_status?idguru=".$guru["id"]."&small=")?>'+id,
    dataType:'json',
    timeout: 50000,//50000MS
    success:function(data){
      timeline ='';
      $.each(data['result'], function(i,n){
        timeline = '<div class=\'timeline\'><button data-dismiss="alert" onclick="deleteProfileStatus('+n['id']+')" class=\'close btn btn-xs btn-default\' style=\'float:right;top:0\'>x</button>'+
        '<div name=\''+n['id']+'\' class=\'row name\'>'+
        '<div class=\'col-md-12\'><img src=\''+n['avatar']+'\' />'+
        '<h5><a href=\''+n['profile']+'\'><strong>'+n['name']+'</strong></a> > <a href=\''+n['des_profile']+'\'><strong>'+n['des_name']+'</strong></a></h5><h6>'+n['time']+'</h6>'+
        '</div>'+     
        '</div>'+
        '<div class=\'row\'>'+
        '<div class=\'col-md-12\'>'+
        '<p>'+n['content']+'</p>'+
        '<p>'+
        '<button onclick="addlike('+n['id']+')" class=\'btn btn-xs btn-default\'><span class=\'glyphicon glyphicon-thumbs-up\'></span> </button> <span class="'+n['id']+'" style=\'font-size:10px\'>'+n['like']+'</span>'+
        '<button onclick=\'getCommentOnProfileById('+n['id']+')\' class="btn btn-default btn-xs"> Lihat Komentar</button>'+
        '</p>'+
        '</div>'+
        '</div>'+
        '<div class=\'container\'>'+
        '<div class="comments'+n['id']+'" name=\''+n['id']+'\'>'+
        
        '</div>'+//end of #comments
        '<div class=\'comment row\'>'+
        '<div class=\'col-md-2\'><img class="myavatar" /></div>'+
        '<div class=\'col-md-10\'>'+
        '<div class="input-group"><textarea id="writecomment'+n['id']+'" class=\'form-control\' id=\'comment\' placeholder=\'your comment...\'></textarea><span class="input-group-btn"><button class="btn btn-default" onclick="writecomment('+n['id']+')"><span class="glyphicon glyphicon-play"></span></button></span></div>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>';
        timeline = timeline+'';
      $('#all-timeline').append(timeline);//ADD NEW TO BOTTOM prepend() //TO TOP
    });
},
error: function(){
  alert('Tidak ada lagi status');
}
});
  $('#bottom-loader').hide();//SHOW LOADING
}
/////////////////UPDATE STATUS
function updateGuruStatus(x,y,z,a,b,c){ //X= ID_SISWA,y = ID_GURU,Z = ID_GRUP | a = DES_ID_SISWA,b = DES_ID_GURU,c=DES_ID_GRUP  
  $('#top-loader').show();//SHOW LOADING
  var isi = $('#newpost').val();//GET STATUS FROM TEXAREA
  if(isi == ''){//NOT FILL UP STATUS = ALERT + REFRESH PAGE
    $('#top-loader').hide();//SHOW LOADING
    $('#newpost').val() = '';//EMPTY STATUS TEXTAREA
    alert('Status Harus Diisi');
  } else {
    $.ajax({
      type:'POST',
      url:'<?php echo site_url("all/update_status")?>',
    timeout: 50000,//50000MS
    data:{idsiswa:x,idguru:y,idgrup:z,isi:isi,desidsiswa:a,desidguru:b,desidgrup:c},
    success:function(data){ //SUCCESS INSERT TO DB
      showUpdatedStatusOnProfile();
    },
    error:function(data){
      alert('ERROR'+data);
    }
  });
    $('#newpost').val() = '';//EMPTY STATUS TEXTAREA
    $('#top-loader').hide();//SHOW LOADING
  }
}
//materi DIUPLOAD GURU
function materiGuru(){
  $('#loadingguru').show();
  var tahun=$('#materiguru #inputTahun').val();
  var kelas=$('#materiguru #inputKelas').val();
  var mapel=$('#materiguru #inputMapel').val();;
  var materiurl = '<?php echo site_url("guru/mymateri?idguru=".$guru["id"])?>&tahun='+tahun+'&mapel='+mapel+'&idkelas='+kelas;
  $.ajax({
    type:"GET",
    url:materiurl,
    timeout:50000,
    success:function(data){
      $('#tampilanmateri').html(data);
    },
    error:function(data){
      alert('terjadi masalah, ulangi lagi');
    }
  });
  $('#loadingguru').hide();
}
//soal DIUPLOAD GURU
function soalGuru(){
  $('#loadingguru').show();
  var tahun=$('#soalguru #inputTahun').val();
  var kelas=$('#soalguru #inputKelas').val();
  var mapel=$('#soalguru #inputMapel').val();;
  var soalurl = '<?php echo site_url("guru/mysoal?idguru=".$guru["id"])?>&tahun='+tahun+'&mapel='+mapel+'&idkelas='+kelas;
  $.ajax({
    type:"GET",
    url:soalurl,
    timeout:50000,
    success:function(data){
      $('#tampilansoal').html(data);
    },
    error:function(data){
      alert('terjadi masalah, ulangi lagi');
    }
  });
  $('#loadingguru').hide();
}
//nilai DIUPLOAD GURU
function nilaiGuru(){
  $('#loadingguru').show();
  var tahun=$('#nilaiguru #inputTahun').val();
  var kelas=$('#nilaiguru #inputKelas').val();
  var mapel=$('#nilaiguru #inputMapel').val();;
  var nilaiurl = '<?php echo site_url("guru/mynilai?idguru=".$guru["id"])?>&tahun='+tahun+'&mapel='+mapel+'&idkelas='+kelas;
  $.ajax({
    type:"GET",
    url:nilaiurl,
    timeout:50000,
    success:function(data){
      $('#tampilannilai').html(data);
    },
    error:function(data){
      alert('terjadi masalah, ulangi lagi');
    }
  });
  $('#loadingguru').hide();
}

</script>

<section id="padding-top"></section>
<section id="timeline-place">
  <div class="container">
   <div style="background-color: rgb(228, 228, 228)" class="col-md-offset-1 col-md-4">
     <div class="fixed-sidebar"><div class="menu"><?php $this->load->view('sidebar')?></div></div>
   </div>

   <div style="background-color: rgb(228, 228, 228);" class="col-md-6">
    <div class="header-timeline">
      <center>
        <?php
        $dont = array('',' ','-');        
        if(!in_array($guru['avatar'] , $dont)){
          $avatar = base_url('assets/img/avatar/'.$guru['avatar']);
        } else {
          $avatar = base_url('assets/img/avatar/avatar.jpg');
        }
        ?>
        <img src="<?php echo $avatar; ?>"/>
        <h3><?php echo $guru['nama_lengkap']?></h3>
        <p>"<?php echo $guru['moto']?>"</p>         
      </center>
    </div>

    <div class="timeline">
      <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a class="btn" href="#sendpost" data-toggle="tab"><span class="glyphicon glyphicon-bullhorn"></span> Post</a></li>
        <li><a class="btn" href="#sendmessage" data-toggle="tab"><span class="glyphicon glyphicon-envelope"></span> Message</a></li>
        <li><a class="btn" href="#materiguru" data-toggle="tab"><span class="glyphicon glyphicon-book"></span> Materi</a></li>
        <li><a class="btn" href="#soalguru" data-toggle="tab"><span class="glyphicon glyphicon-file"></span> Soal</a></li>        
        <li><a class="btn" href="#nilaiguru" data-toggle="tab"><span class="glyphicon glyphicon-file"></span> Nilai</a></li>
        <li><a class="btn" href="#info" data-toggle="tab"><span class="glyphicon glyphicon-info-sign"></span> info</a></li>
      </ul>
      <br/><br/>
      <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="sendpost">
          <textarea rows="5" class="form-control" id="newpost" placeholder="type here..."></textarea>
              <?php //CEK YANG LOGIN 
              if($this->session->userdata('siswa_logged_in')){
                ?>
                <button onclick="updateGuruStatus(<?php echo $this->session->userdata('id')?>,0,0,0,<?php echo $guru['id']?>,0)" id="btn-newpost">Post</button>  
                <?php } else if($this->session->userdata('guru_logged_in')){?>
                <button onclick="updateGuruStatus(0,<?php echo $this->session->userdata('id')?>,0,0,<?php echo $guru['id']?>,0)" id="btn-newpost">Post</button> 
                <?php } ?>              
                <br/><br/>
              </div>

              <div class="tab-pane" id="sendmessage">
                <form action="<?php echo site_url('all/send_message')?>" method="POST">   
                  <input type="hidden" name="penerima" value="<?php echo $guru['nip'];?>" />
                  <textarea name="isi" rows="5" class="form-control" id="newpost" placeholder="type here..."></textarea>
                  <button id="btn-newpost">Message</button> 
                </form> 
                <br/><br/>
              </div>

              <div class="tab-pane" id="materiguru">
                <a class="btn btn-primary btn-xs" href="#uploadmateri" data-toggle="modal">+ Upload Materi</a>
                <?php 
                if($this->session->userdata('guru_logged_in')){
                  if($this->session->userdata('nip') == $this->uri->segment(3)){
                    echo '<a class="btn btn-primary btn-xs" onclick="semuamateri('.$this->session->userdata('id').')">+ Semua Materi</a>';
                  }
                }
                ?>

                <!--modal to upload materi-->
                <div class="modal fade" id="uploadmateri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-book"></span> Upload Materi</h4>
                      </div>
                      <div class="modal-body">
                        <form class="form-inline" action="<?php echo site_url('process/guru/addmateri')?>" method="POST" role="form" enctype="multipart/form-data">
                          <div class="form-group">                           
                            <select class="form-control input-sm" name="slcKelas">
                              <option>Kelas</option>
                              <?php foreach($mengajar as $k):
                              echo '<option value="'.$k['id_kelas'].'">'.$k['kelas'].'</option>';
                              endforeach;?>
                            </select>
                          </div>
                          <div class="form-group">
                            <select class="form-control input-sm" name="slcMataPelajaran">
                              <option>Mapel</option>
                              <?php foreach($mengajar as $m):
                              echo '<option value="'.$m['id_matapelajaran'].'">'.$m['matapelajaran'].'</option>';
                              endforeach;?>
                            </select>
                          </div>
                          <div class="form-group">
                            <input type="text" placeholder="Judul" name="txtMateri" class="form-control input-sm"/>
                          </div> 
                          <div class="form-group">
                            <input type="file" name="fileUpload" class="input-sm"/><span><small>maks 1MB , support PDF,DOCX,ODT</small></span>
                          </div><br/> 
                          <button type="submit" class="btn-xs btn btn-primary">+ Upload</button>
                        </form>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <!--end of modal-->
                <br/><br/>
                <div class="choose form-inline" id="downloadmateri">
                  <div class="form-group">
                    <select id="inputKelas" class="input-sm form-control" name="kelas" required>
                      <option>Kelas</option>
                      <?php foreach($mengajar as $k):
                      echo '<option value="'.$k['id_kelas'].'">'.$k['kelas'].'</option>';
                      endforeach;
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <select id="inputMapel" class="input-sm form-control" name="mapel" required>
                      <option>Mata Pelajaran</option>
                      <?php foreach($mengajar as $m):
                      echo '<option value="'.$m['id_matapelajaran'].'">'.$m['matapelajaran'].'</option>';
                      endforeach;?>
                    </select>
                  </div>
                  <div class="form-group"><select id="inputTahun" class="input-sm form-control" name="tahun" required>
                    <option>Tahun</option><option name="2012">2012</option><option name="2013">2013</option><option name="2014">2014</option>
                  </select></div>
                  <div class="form-group"><button class="btn btn-xs btn-primary" onclick="materiGuru()">Lihat Materi</button></div>
                  <div class="form-group" id="loadingguru" style="display:none"><img style="width:20px" src="<?php echo base_url('assets/css/loader.gif')?>"></div>
                </div>
                <div id="tampilanmateri"></div>
                <br/>
              </div>

              <div class="tab-pane" id="soalguru">
                <a class="btn btn-primary btn-xs" href="#uploadsoal" data-toggle="modal">+ Upload Soal</a>
                <?php 
                if($this->session->userdata('guru_logged_in')){
                  if($this->session->userdata('nip') == $this->uri->segment(3)){
                    echo '<a class="btn btn-primary btn-xs" onclick="semuasoal('.$this->session->userdata('id').')">+ Semua Soal</a>';
                  }
                }
                ?>
                <br/><br/>
                <!--modal to upload materi-->
                <div class="modal fade" id="uploadsoal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-book"></span> Upload Soal</h4>
                      </div>
                      <div class="modal-body">
                        <form class="form-inline" action="<?php echo site_url('process/guru/addsoal')?>" method="POST" role="form" enctype="multipart/form-data">
                          <div class="form-group">                           
                            <select class="form-control input-sm" name="slcKelas">
                              <option>Kelas</option>
                              <?php foreach($mengajar as $k):
                              echo '<option value="'.$k['id_kelas'].'">'.$k['kelas'].' </option>';
                              endforeach;?>
                            </select>
                          </div>
                          <div class="form-group">
                            <select class="form-control input-sm" name="slcMataPelajaran">
                              <option>Mapel</option>
                              <?php foreach($mengajar as $m):
                              echo '<option value="'.$m['id_matapelajaran'].'">'.$m['matapelajaran'].'</option>';
                              endforeach;?>
                            </select>
                          </div>
                          <div class="form-group">
                            <input type="text" placeholder="Judul" name="txtMateri" class="form-control input-sm"/>
                          </div> 
                          <div class="form-group">
                            <input type="file" name="fileUpload" class="input-sm"/><span><small>maks 1MB , support PDF,DOCX,ODT</small></span>
                          </div><br/> 
                          <button type="submit" class="btn-xs btn btn-primary">+ Upload</button>
                        </form>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <!--end of modal-->
                <div class="choose form-inline" id="downloadmateri">
                  <div class="form-group">
                    <select id="inputKelas" class="input-sm form-control" name="kelas" required>
                      <option>Kelas</option>
                      <?php foreach($mengajar as $k):
                      echo '<option value="'.$k['id_kelas'].'">'.$k['kelas'].'</option>';
                      endforeach;
                      ?>
                    </select></div>
                    <div class="form-group">
                      <select id="inputMapel" class="input-sm form-control" name="mapel" required>
                        <option>Mata Pelajaran</option>
                        <?php foreach($mengajar as $m):
                        echo '<option value="'.$m['id_matapelajaran'].'">'.$m['matapelajaran'].'</option>';
                        endforeach;?>
                      </select>
                    </div>
                    <div class="form-group"><select id="inputTahun" class="input-sm form-control" name="tahun" required>
                      <option>Tahun</option><option name="2012">2012</option><option name="2013">2013</option><option name="2014">2014</option>
                    </select></div>
                    <div class="form-group"><button class="btn btn-xs btn-primary" onclick="soalGuru()">Lihat Soal</button></div>
                    <div id="loadingguru" style="display:none" class="form-group"><img style="width:20px" src="<?php echo base_url('assets/css/loader.gif')?>"></div>
                  </div>
                  <div id="tampilansoal"></div>
                  <br/>
                </div>

                <div class="tab-pane" id="nilaiguru">
                <a class="btn btn-primary btn-xs" href="#uploadnilai" data-toggle="modal">+ Upload nilai</a>
                  <?php 
                  if($this->session->userdata('guru_logged_in')){
                    if($this->session->userdata('nip') == $this->uri->segment(3)){
                      echo '<a class="btn btn-primary btn-xs" onclick="semuanilai('.$this->session->userdata('id').')">+ Semua Nilai</a>';
                    }
                  }
                  ?>
                  <br/>
                  <br/>
                  <!--modal to upload materi-->
                  <div class="modal fade" id="uploadnilai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title"><span class="glyphicon glyphicon-book"></span> Upload nilai</h4>
                        </div>
                        <div class="modal-body">
                          <form class="form-inline" action="<?php echo site_url('process/guru/addnilai')?>" method="POST" role="form" enctype="multipart/form-data">
                            <div class="form-group">                           
                              <select class="form-control input-sm" name="slcKelas">
                                <option>Kelas</option>
                                <?php foreach($mengajar as $k):
                                echo '<option value="'.$k['id_kelas'].'">'.$k['kelas'].'  </option>';
                                endforeach;?>
                              </select>
                            </div>
                            <div class="form-group">
                              <select class="form-control input-sm" name="slcMataPelajaran">
                                <option>Mapel</option>
                                <?php foreach($mengajar as $m):
                                echo '<option value="'.$m['id_matapelajaran'].'">'.$m['matapelajaran'].'</option>';
                                endforeach;?>
                              </select>
                            </div>
                            <div class="form-group">
                              <input type="text" placeholder="Judul" name="txtMateri" class="form-control input-sm"/>
                            </div> 
                            <div class="form-group">
                              <input type="file" name="fileUpload" class="input-sm"/><span><small>maks 1MB , support PDF,DOCX,ODT</small></span>
                            </div><br/> 
                            <button type="submit" class="btn-xs btn btn-primary">+ Upload</button>
                          </form>
                        </div>
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
                  <!--end of modal-->
                  <div class="choose form-inline" id="downloadmateri">
                    <div class="form-group">
                      <select id="inputKelas" class="input-sm form-control" name="kelas" required>
                        <option>Kelas</option>
                        <?php foreach($mengajar as $k):
                        echo '<option value="'.$k['id_kelas'].'">'.$k['kelas'].' </option>';
                        endforeach;
                        ?>
                      </select></div>
                      <div class="form-group">
                        <select id="inputMapel" class="input-sm form-control" name="mapel" required>
                          <option>Mata Pelajaran</option>
                          <?php foreach($mengajar as $m):
                          echo '<option value="'.$m['id_matapelajaran'].'">'.$m['matapelajaran'].'</option>';
                          endforeach;?>
                        </select>
                      </div>
                      <div class="form-group"><select id="inputTahun" class="input-sm form-control" name="tahun" required>
                        <option>Tahun</option><option name="2012">2012</option><option name="2013">2013</option><option name="2014">2014</option>
                      </select></div>
                      <div class="form-group"><button class="btn btn-xs btn-primary" onclick="nilaiGuru()">Lihat nilai</button></div>
                      <div id="loadingguru" style="display:none" class="form-group"><img style="width:20px" src="<?php echo base_url('assets/css/loader.gif')?>"></div>
                    </div>
                    <div id="tampilannilai"></div>
                    <br/>
                  </div>

                  <div class="tab-pane" id="info">
                    <h4>Info Guru</h4>
                    <p>Jangan menyalahgunakan data yang ada disini, data guru hanya digunakan untuk urusan kegiatan belajar mengajar</p>
                    <div class="row">
                      <div class="col-md-2"><strong>Nama</strong></div><div class="col-md-10"><?php echo $guru['nama_lengkap']?></div>
                      <div class="col-md-2"><strong>NIP</strong></div><div class="col-md-10"><?php echo $guru['nip']?></div>
                      <div class="col-md-2"><strong>Alamat</strong></div><div class="col-md-10"><?php echo $guru['alamat']?></div>
                      <div class="col-md-2"><strong>Email</strong></div><div class="col-md-10"><?php echo $guru['email']?></div>
                      <div class="col-md-2"><strong>Telp</strong></div><div class="col-md-10"><?php echo $guru['telp']?></div>
                    </div>
                    <hr>
                    <h4>Jadwal Mengajar</h4>

                    <table class="table table-striped">
                      <thead>
                        <tr>                 
                          <th>Mata Pelajaran</th>
                          <th>Kelas</th>
                          <th>Mapel</th>
                          <th>Hari</th>
                          <th>Mulai</th>
                          <th>Selesai</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($mengajar as $m):?>
                          <tr>
                            <td><?php echo $m['matapelajaran']?></td>
                            <td><?php echo $m['kelas'].' '.$m['subkelas']?></td>
                            <td><?php echo $m['matapelajaran'];?></td>
                            <td><?php echo $m['hari'];?></td>
                            <td><?php echo $m['mulai'];?></td>
                            <td><?php echo $m['selesai'];?></td>
                          </tr>
                        <?php endforeach;?>
                      </tbody>
                    </table>
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

        <!--modal for all-->
        <div class="modal fade" id="modaldarisaya" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Upload Saya</h4>
              </div>
              <div class="modal-body">
                <div id="darisaya"></div>
              </div>                      
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->