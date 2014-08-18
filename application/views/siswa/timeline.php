<script type="text/javascript">
  //WHEN DOCUMENT READY
  $(document).ready(function(){ 
    lattestStatus('<?php echo $this->session->userdata('avatar');?>');//LOAD LATTEST UPDATES
    setInterval(function(){showUpdatedStatus();},20000);//LOAD LATTEST UPDATES EVERY 20 seconds    
  });
  
</script>

<section id="padding-top"></section>
<section id="timeline-place">
  <div class="container">
   <div style="background-color: rgb(228, 228, 228)" class="col-md-offset-1 col-md-4">
     <div class="fixed-sidebar"><div class="menu"><?php $this->load->view('siswa/sidebar')?></div></div>
   </div>

   <div style="background-color: rgb(228, 228, 228);" class="col-md-6">
    <div class="timeline">
      <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active col-md-6"><a class="btn" data-toggle="tab"><span class="glyphicon glyphicon-bullhorn"></span> Post Update</a></li>
        <li class="col-md-6" ><a class="btn" href="#kirimpesan" data-toggle="tab"><span class="glyphicon glyphicon-comment"></span> Kirim Pesan</a></li>
      </ul>
      <br/>
      <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="status"> 
          <div class="col-md-12">  
            <textarea rows="5" class="form-control" id="newpost" placeholder="Update Status"></textarea>
            <br/>
            <button onclick="updateStatus(<?php echo $this->session->userdata('id')?>,0,0,<?php echo $this->session->userdata('id')?>,0,0)" id="btn-newpost">post</button>
          </div>
        </div>
        <div class="tab-pane" id="kirimpesan">
          <form method="POST" action="<?php echo site_url('all/send_message')?>">
            <div class="col-md-12"><input name="penerima" id="txtsearchuser" onkeyup="searchuser()" type="text" class="form-control" placeholder="Masukan NIS/NIP"/></div>
            <center class="col-md-12" style="padding:5px;display:none" id="loader"><img width="30px" src="<?php echo base_url('/assets/css/loader.gif')?>"/></center>
            <div id="resultuser" style="display:none" class="col-md-12">

            </div>
            <div style="margin-top:5px" class="col-md-12">

              <textarea name="isi" rows="5" class="form-control" id="newpost" placeholder="type here..."></textarea>
              <br/>
              <button type="submit" id="btn-newpost">Kirim Pesan</button>
            </form>
          </div>
        </div>           
      </div>
    </div>

    <center id="top-loader" class="col-md-12" style="padding:5px;" ><img width="30px" src="<?php echo base_url('assets/css/loader.gif')?>"/></center>
    <div id="all-timeline"></div>
    <center class="col-md-12" style="padding:5px;display:none" id="bottom-loader"><img width="30px" src="<?php echo base_url('assets/css/loader.gif')?>"/></center>
    <button onclick="showMoreStatus()" id="btn-more" style="width:100%;display:none" class="btn btn-default">Berikutnya</button>
    <!--end of  id all-timeline-->


  </div>
</div>
</section>