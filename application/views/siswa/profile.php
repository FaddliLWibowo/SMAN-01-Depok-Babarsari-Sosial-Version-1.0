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
    url:'<?php echo site_url("json/start_status?idsiswa=".$siswa["id"])?>',
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
        '<div class=\'col-md-2\'><img src=\'http://localhost/2014-Project/SMAN01DEPOKBABARSARI-SOCIAL/assets/img/avatar/\' /></div>'+
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
      alert('Terjadi masalah');
      $('#top-loader').hide();
    }
  });
}
//AUTO UPDATE LATTEST STATUS BY ME OR FOR ME
function showUpdatedStatusOnProfile(){
$('#top-loader').show();//SHOW LOADING
lastid = $('#all-timeline .timeline div').first().attr('name');//GET ELEMENT NAME
$.ajax({
  url:'<?php echo site_url("json/start_status?idsiswa=".$siswa["id"]."&last=")?>'+lastid,
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
      '<div class=\'col-md-2\'><img src=\'http://localhost/2014-Project/SMAN01DEPOKBABARSARI-SOCIAL/assets/img/avatar/avatar.jpg\' /></div>'+
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
    url:'<?php echo site_url("json/start_status?idsiswa=".$siswa["id"]."&small=")?>'+id,
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
        '<div class=\'col-md-2\'><img src=\'http://localhost/2014-Project/SMAN01DEPOKBABARSARI-SOCIAL/assets/img/avatar/avatar.jpg\' /></div>'+
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
          <img src="<?php echo base_url('assets/img/avatar/'.$siswa['avatar'])?>"/>
          <h3><?php echo $siswa['nama_lengkap']?></h3>
          <p><?php echo $siswa['moto']?></p>
        </center>
    </div>

    <div class="timeline">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active col-md-6"><a class="btn" href="#sendpost" data-toggle="tab"><span class="glyphicon glyphicon-bullhorn"></span> Send Post to User</a></li>
            <li class="col-md-6" ><a class="btn" href="#sendmessage" data-toggle="tab"><span class="glyphicon glyphicon-envelope"></span> Send Message to User</a></li>
        </ul>
        <br/><br/>
        <div id="my-tab-content" class="tab-content">
            <div class="tab-pane active" id="sendpost">
              <textarea rows="5" class="form-control" id="newpost" placeholder="type here..."></textarea>
              <button onclick="updateStatus(<?php echo $this->session->userdata('id')?>,0,0,<?php echo $siswa['id']?>,0,0)" id="btn-newpost">Post</button>  
              <br/><br/>
            </div>

            <div class="tab-pane" id="sendmessage">   
              <textarea rows="5" class="form-control" id="newpost" placeholder="type here..."></textarea>
              <button id="btn-newpost">Message</button>  
              <br/><br/>
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