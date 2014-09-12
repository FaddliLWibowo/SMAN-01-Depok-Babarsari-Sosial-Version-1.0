<section id="padding-top"></section>
<section id="timeline-place">
  <div class="container">
   <div style="background-color: rgb(228, 228, 228)" class="col-md-offset-1 col-md-4">
     <div class="fixed-sidebar"><div class="menu"><?php $this->load->view('sidebar')?></div></div>
   </div>

   <div style="background-color: rgb(228, 228, 228);" class="col-md-6">   

    <div class="timeline">
      <div class="page-header">
        <h1>Berita > Baca</h1>
      </div>
      <h1><a href="<?php echo site_url('berita/baca/'.$berita['id_berita'])?>"><?php echo $berita['judul']?></a></h1>
     
      <small style="color:gray">Oleh : <?php echo $berita['author']?> | Diposting : <?php echo $berita['created']?> | Update : <?php echo $berita['edited']?></small><br/>
      <br/>
      <p><img style="width:100%" src="<?php echo base_url('assets/img/news/'.$berita['image'])?>"></p>
      <p><?php echo $berita['konten']?></p>
      <br/>
    </div>

  </div>
</div>
</section>