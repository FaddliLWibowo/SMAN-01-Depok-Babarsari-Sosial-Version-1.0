<section id="padding-top"></section>
<section id="timeline-place">
  <div class="container">
   <div style="background-color: rgb(228, 228, 228)" class="col-md-offset-1 col-md-4">
     <div class="fixed-sidebar"><div class="menu"><?php $this->load->view('sidebar')?></div></div>
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
            <center class="col-md-12" style="padding:5px;display:none" id="loader"><img width="30px" src="<?php echo base_url('assets/css/loader.gif')?>"/></center>
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
      <div class="page-header">
        <h1>Pesan <small><?php echo $this->session->userdata('nama_lengkap')?></small></h1>
      </div>
      <table class="table table-hover">

        <?php //print_r($messages)?>
        <?php foreach($messages as $m):?>
          <tr>
          <td><strong>Dari : <?php echo $m['pengirim']?></strong> <small style="font-size:10px;color:gray"><?php echo $m['waktu']?></small></td><td><?php echo substr($m['isi'], 0,20)?>...</td><td><a onclick="showmessage(<?php echo $m['pengirim']?>,<?php echo $m['penerima']?>)" href="#showmessages">baca</a></td>
          </tr>
        <?php endforeach;?>
      </table>
    </div>

  </div>
</div>
</section>