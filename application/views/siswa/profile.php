<section id="padding-top"></section>
<section id="timeline-place">
  <div class="container">
   <div style="background-color: rgb(228, 228, 228)" class="col-md-offset-1 col-md-4">
   <div class="fixed-sidebar"><div class="menu"><?php $this->load->view('siswa/sidebar')?></div></div>
  </div>

  <div style="background-color: rgb(228, 228, 228);" class="col-md-6">
    <div class="header-timeline">
        <center>
          <img src="#"/>
          <h3>Nama Siswa / NIS</h3>
          <p>Moto siswa Moto siswa Moto siswa Moto siswa Moto siswa</p>
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
              <button id="btn-newpost">Post</button>  
              <br/><br/>
            </div>

            <div class="tab-pane" id="sendmessage">   
              <textarea rows="5" class="form-control" id="newpost" placeholder="type here..."></textarea>
              <button id="btn-newpost">Message</button>  
              <br/><br/>
            </div>
        </div>

    </div>

    <div class="timeline">
      <div class="row">
        <div class="col-md-12"><img src="assets/images/user/profile2.png" /><button class="btn btn-xs btn-default" style="float:right;top:0">x</button>
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
          <img src="assets/images/user/profile1.png" />
        </div>
        <div class="col-md-10">
         <p><span><strong><a href="#">Dougers</a></strong></span> samina-mina ee waka-waka ee, samina-mina ee waka-waka eesamina-mina ee waka-waka eesamina-mina ee waka-waka eesamina-mina ee waka-waka eesamina-mina ee waka-waka eesamina-mina ee waka-waka eesamina-mina ee waka-waka eesamina-mina ee waka-waka ee</p>
         <h6>5 Juli 2014 23:01</h6>
       </div>
     </div>
     <div class="comment row">
      <div class="col-md-2"><img src="assets/images/user/profile1.png" /></div>
      <div class="col-md-10">
        <textarea class="form-control" id="comment" placeholder="your comment..."></textarea>
      </div>
    </div>
  </div>
</div>

<div class="timeline">
  <div class="row">
    <div class="col-md-12"><img src="assets/images/user/profile2.png" />
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
    <div class="col-md-2"><img src="assets/images/user/profile1.png" /></div>
    <div class="col-md-10">
      <textarea class="form-control" id="comment" placeholder="your comment..."></textarea>
    </div>
  </div>
</div>
</div>


</div>
</div>
</section>