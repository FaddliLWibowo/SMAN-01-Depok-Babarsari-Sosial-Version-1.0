<section id="padding-top"></section>
<section id="timeline-place">
  <div class="container">
   <div style="background-color: rgb(228, 228, 228)" class="col-md-offset-1 col-md-4">
     <div class="fixed-sidebar"><div class="menu"><?php $this->load->view('siswa/sidebar')?></div></div>
   </div>

   <div style="background-color: rgb(228, 228, 228);" class="col-md-6">
    <div class="timeline">
      <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active col-md-6"><a class="btn" href="#status" data-toggle="tab"><span class="glyphicon glyphicon-bullhorn"></span> Post Update</a></li>
        <li class="col-md-6" ><a class="btn" href="#kirimpesan" data-toggle="tab"><span class="glyphicon glyphicon-comment"></span> Kirim Pesan</a></li>
      </ul>
      <br/>
      <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="status"> 
          <div class="col-md-12">  
            <textarea rows="5" class="form-control" id="newpost" placeholder="type here..."></textarea>
            <br/>
            <button id="btn-newpost">post</button>
          </div>
        </div>
        <div class="tab-pane" id="kirimpesan">
          <form method="POST" action="<?php echo site_url('all/send_message')?>">
            <div class="col-md-12"><input name="penerima" id="txtsearchuser" onkeyup="searchuser()" type="text" class="form-control" placeholder="Masukan NIS/NIP"/></div>
            <center class="col-md-12" style="padding:5px;display:none" id="loader"><img width="30px" src="<?php echo base_url('<?php echo base_url()?>assets/assets/css/loader.gif')?>"/></center>
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

    <div class="timeline">
      <div class="row">
        <div class="col-md-12"><img src="<?php echo base_url()?>assets/assets/images/user/profile2.png" /><button class="btn btn-xs btn-default" style="float:right;top:0">x</button>
         <h5><a href="#"><strong>Su Metal</strong></a></h5>
         <h6>5 Juli 2014 23:01</h6>
       </div>      
     </div>
     <div class="row">
      <div class="col-md-12">
        <p>lorem ipsum semi dolor, doraemon mata suka haju luthjauhi fuga nataremo</p>
        <p>
          <button class="btn btn-xs btn-default"><span class="glyphicon glyphicon-thumbs-up"></span> </button> <span style="font-size:10px">234</span>
          <button class="btn btn-xs btn-default"><span class="glyphicon glyphicon-thumbs-down"></span> </button> <span style="font-size:10px">35</span>
        </p>
      </div>
    </div>
    <div class="container">
      <div class="comment row">
        <div class="col-md-2">            
          <img src="<?php echo base_url()?>assets/assets/images/user/profile1.png" />
        </div>
        <div class="col-md-10">
         <p><span><strong><a href="#">Dougers</a></strong></span> samina-mina ee waka-waka ee, samina-mina ee waka-waka eesamina-mina ee waka-waka eesamina-mina ee waka-waka eesamina-mina ee waka-waka eesamina-mina ee waka-waka eesamina-mina ee waka-waka eesamina-mina ee waka-waka eesamina-mina ee waka-waka ee</p>
         <h6>5 Juli 2014 23:01</h6>
       </div>
     </div>
     <div class="comment row">
      <div class="col-md-2"><img src="<?php echo base_url()?>assets/assets/images/user/profile1.png" /></div>
      <div class="col-md-10">
        <textarea class="form-control" id="comment" placeholder="your comment..."></textarea>
      </div>
    </div>
  </div>
</div>

<div class="timeline">
  <div class="row">
    <div class="col-md-12"><img src="<?php echo base_url()?>assets/assets/images/user/profile2.png" />
     <h5><a href="#"><strong>Su Metal</strong></a></h5>
     <h6>5 Juli 2014 23:01</h6>
   </div>
 </div>
 <div class="row">
  <div class="col-md-12">
    <p>lorem ipsum semi dolor, doraemon mata suka haju luthjauhi fuga nataremo</p>
    <p>
      <button class="btn btn-xs btn-default"><span class="glyphicon glyphicon-thumbs-up"></span> </button> <span style="font-size:10px">234</span>
      <button class="btn btn-xs btn-default"><span class="glyphicon glyphicon-thumbs-down"></span> </button> <span style="font-size:10px">35</span>
    </p>
  </div>
</div>
<div class="container">
  <div class="comment row">
    <div class="col-md-2"><img src="<?php echo base_url()?>assets/assets/images/user/profile1.png" /></div>
    <div class="col-md-10">
      <textarea class="form-control" id="comment" placeholder="your comment..."></textarea>
    </div>
  </div>
</div>
</div>


</div>
</div>
</section>