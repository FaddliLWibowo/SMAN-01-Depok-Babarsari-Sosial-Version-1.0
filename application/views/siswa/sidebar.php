<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pesan">
        <h4 class="panel-title">
          <span class="glyphicon glyphicon-comment"></span> Pesan
        </h4>        
      </a>
    </div>
    <div id="pesan" class="panel-collapse collapse">
      <div class="panel-body">
        <?php $this->load->view('siswa/menu/pesan')?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#Grup">
        <h4 class="panel-title">
          <span class="glyphicon glyphicon-comment"></span> Grup
        </h4>
      </a>
    </div>
    <div id="Grup" class="panel-collapse collapse">
      <div class="panel-body">
        <?php $this->load->view('siswa/menu/grup')?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#jadwal">
        <h4 class="panel-title">
          <span class="glyphicon glyphicon-calendar"></span> Jadwal Pelajaran
        </h4>
      </a>
    </div>
    <div id="jadwal" class="panel-collapse collapse">
      <div class="panel-body">
       <?php $this->load->view('siswa/menu/pelajaran')?>
     </div>
   </div>
 </div>

 <div class="panel panel-default">
  <div class="panel-heading">
    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#news">
      <h4 class="panel-title">
       <span class="glyphicon glyphicon-list-alt"></span> Berita
     </h4>
   </a>
 </div>
 <div id="news" class="panel-collapse collapse">
  <div class="panel-body">
    <?php $this->load->view('siswa/menu/berita')?>
  </div>
</div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#materi">
      <h4 class="panel-title">                
       <span class="glyphicon glyphicon-briefcase"></span> Materi                
     </h4>
   </a>
 </div>
 <div id="materi" class="panel-collapse collapse">
  <div class="panel-body">
    <?php $this->load->view('siswa/menu/materi')?>
  </div>
</div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#soal">
      <h4 class="panel-title">
       <span class="glyphicon glyphicon-briefcase"></span> Soal
     </h4>
   </a>
 </div>
 <div id="soal" class="panel-collapse collapse">
  <div class="panel-body">
    <?php $this->load->view('siswa/menu/soal')?>
  </div>
</div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#nilai">
      <h4 class="panel-title">
       <span class="glyphicon glyphicon-briefcase"></span> Nilai
     </h4>
   </a>
 </div>
 <div id="nilai" class="panel-collapse collapse">
  <div class="panel-body">
    <?php $this->load->view('siswa/menu/nilai')?>
  </div>
</div>
</div>
</div>

<!--MESSAGE MODAL-->
<div  class="modal fade" id="kirim-pesan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Kirim Pesan</h4>
      </div>
      <div class="modal-body">
        <p>To : <br/>
          <small>masukan nama depan tujuan, dari daftar rekomendasi pilih salah satu</small>
          <input type="text" class="form-control" placeholder="Nama Tujuan"/><br/>
          <textarea class="form-control" placeholder="Pesan"></textarea>
          <br/>
          <button class="btn btn-warning">Kirim</button>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->