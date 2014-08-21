<section id="padding-top"></section>
<section id="timeline-place">
  <div class="container">
   <div style="background-color: rgb(228, 228, 228)" class="col-md-offset-1 col-md-4">
     <div class="fixed-sidebar"><div class="menu"><?php $this->load->view('sidebar')?></div></div>
   </div>

   <div style="background-color: rgb(228, 228, 228);" class="col-md-6">   

    <div class="timeline">
      <div class="page-header">
        <h1>Berita <small>SMAN 01 Depok Babarsari</small></h1>
      </div>    
        <?php foreach($berita as $b):?>
          <a><h2><?php echo $b['judul']?></h2></a><small>Oleh Admin | Post | Update</small><br/>
          <p><?php echo $b['konten']?></p><p><a class="btn btn-warning" href="#">selengkapnya</a></p>
        <?php endforeach;?>
    </div>

  </div>
</div>
</section>