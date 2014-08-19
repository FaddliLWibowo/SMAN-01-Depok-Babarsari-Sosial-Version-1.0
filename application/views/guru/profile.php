<style type="text/css">.myavatar{background-image: url('<?php echo base_url("assets/img/avatar/".$this->session->userdata("avatar"))?>');background-size: cover}</style>
<script type="text/javascript">
//WHEN DOCUMENT READY
$(document).ready(function(){ 
  profileStatus();//LOAD LATTEST UPDATES
  setInterval(function(){showUpdatedStatusOnProfile();},20000);//LOAD LATTEST UPDATES EVERY 20 seconds    
});
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
        timeline = '<div class=\'timeline\'>'+
        '<div name=\''+n['id']+'\' class=\'row name\'>'+
        '<div class=\'col-md-12\'><img src=\''+n['avatar']+'\' /><button class=\'btn btn-xs btn-default\' style=\'float:right;top:0\'>x</button>'+
        '<h5><a href=\''+n['profile']+'\'><strong>'+n['name']+'</strong></a> > <a href=\''+n['des_profile']+'\'><strong>'+n['des_name']+'</strong></a></h5><h6>'+n['time']+'</h6>'+
        '</div>'+     
        '</div>'+
        '<div class=\'row\'>'+
        '<div class=\'col-md-12\'>'+
        '<p>'+n['content']+'</p>'+
        '<p>'+
        '<button class=\'btn btn-xs btn-default\'><span class=\'glyphicon glyphicon-thumbs-up\'></span> </button> <span style=\'font-size:10px\'> 234 </span>'+
        '<button class="btn btn-default btn-xs"> Lihat Komentar</button>'+
        '</p>'+
        '</div>'+
        '</div>'+     
        '<div class=\'container\'>'+
        '<div class="comments" name=\''+n['id']+'\'>'
              
        +'</div>'+//END OF #COMMENTS
        '<div class=\'comment row\'>'+
        '<div class=\'col-md-2\'><img class="myavatar" /></div>'+
        '<div class=\'col-md-10\'>'+
        '<textarea class=\'form-control\' id=\'comment\' placeholder=\'your comment...\'></textarea>'+
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
      timeline = '<div class=\'timeline\'>'+
      '<div name=\''+n['id']+'\' class=\'row name\'>'+
      '<div class=\'col-md-12\'><img src=\''+n['avatar']+'\' /><button class=\'btn btn-xs btn-default\' style=\'float:right;top:0\'>x</button>'+
      '<h5><a href=\''+n['profile']+'\'><strong>'+n['name']+'</strong></a> > <a href=\''+n['des_profile']+'\'><strong>'+n['des_name']+'</strong></a></h5><h6>'+n['time']+'</h6>'+
      '</div>'+     
      '</div>'+
      '<div class=\'row\'>'+
      '<div class=\'col-md-12\'>'+
      '<p>'+n['content']+'</p>'+
       '<p>'+
      '<button class=\'btn btn-xs btn-default\'><span class=\'glyphicon glyphicon-thumbs-up\'></span> </button> <span style=\'font-size:10px\'> 234 </span>'+
      '<button class="btn btn-default btn-xs"> Lihat Komentar</button>'+
      '</p>'+
      '</div>'+
      '</div>'+
      '<div class=\'container\'>'+
      '<div class="comments" name=\''+n['id']+'\'>'+
      
      '</div>'+//END #COMMENTS 
      '<div class=\'comment row\'>'+
      '<div class=\'col-md-2\'><img class="myavatar" /></div>'+
      '<div class=\'col-md-10\'>'+
      '<textarea class=\'form-control\' id=\'comment\' placeholder=\'your comment...\'></textarea>'+
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
        timeline = '<div class=\'timeline\'>'+
        '<div name=\''+n['id']+'\' class=\'row name\'>'+
        '<div class=\'col-md-12\'><img src=\''+n['avatar']+'\' /><button class=\'btn btn-xs btn-default\' style=\'float:right;top:0\'>x</button>'+
        '<h5><a href=\''+n['profile']+'\'><strong>'+n['name']+'</strong></a> > <a href=\''+n['des_profile']+'\'><strong>'+n['des_name']+'</strong></a></h5><h6>'+n['time']+'</h6>'+
        '</div>'+     
        '</div>'+
        '<div class=\'row\'>'+
        '<div class=\'col-md-12\'>'+
        '<p>'+n['content']+'</p>'+
        '<p>'+
        '<button class=\'btn btn-xs btn-default\'><span class=\'glyphicon glyphicon-thumbs-up\'></span> </button> <span style=\'font-size:10px\'> 234 </span>'+
        '<button class="btn btn-default btn-xs"> Lihat Komentar</button>'+
        '</p>'+
        '</div>'+
        '</div>'+
        '<div class=\'container\'>'+
        '<div class="comments" name=\''+n['id']+'\'>'+
        
        '</div>'+//end of #comments
        '<div class=\'comment row\'>'+
        '<div class=\'col-md-2\'><img class="myavatar" /></div>'+
        '<div class=\'col-md-10\'>'+
        '<textarea class=\'form-control\' id=\'comment\' placeholder=\'your comment...\'></textarea>'+
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
    url:'http://localhost/2014-Project/SMAN01DEPOKBABARSARI-SOCIAL/index.php/all/update_status',
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
</script>

<section id="padding-top"></section>
<section id="timeline-place">
  <div class="container">
   <div style="background-color: rgb(228, 228, 228)" class="col-md-offset-1 col-md-4">
   <div class="fixed-sidebar"><div class="menu"><?php $this->load->view('siswa/sidebar')?></div></div>
  </div>

  <div style="background-color: rgb(228, 228, 228);" class="col-md-6">
    <div class="header-timeline">
        <center>
          <img src="<?php echo base_url('assets/img/avatar/'.$guru['avatar'])?>"/>
          <h3><?php echo $guru['nama_lengkap']?></h3>
          <p><?php echo $guru['moto']?></p>         
        </center>
    </div>

    <div class="timeline">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a class="btn" href="#sendpost" data-toggle="tab"><span class="glyphicon glyphicon-bullhorn"></span> Post</a></li>
            <li><a class="btn" href="#sendmessage" data-toggle="tab"><span class="glyphicon glyphicon-envelope"></span> Message</a></li>
            <li><a class="btn" href="#materiguru" data-toggle="tab"><span class="glyphicon glyphicon-book"></span> Materi</a></li>
            <li><a class="btn" href="#soalguru" data-toggle="tab"><span class="glyphicon glyphicon-file"></span> Soal</a></li>
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
            materi
            </div>

            <div class="tab-pane" id="soalguru">
            soal
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
              <h4>Kelas dan Mata Pelajaran Yang Diampu</h4>
              <div class="row">

              </div>
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