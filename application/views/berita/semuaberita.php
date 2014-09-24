<section id="padding-top"></section>
<section id="timeline-place">
  <div class="container">
   <div style="background-color: rgb(228, 228, 228)" class="col-md-offset-1 col-md-4">
     <div class="fixed-sidebar"><div class="menu"><?php $this->load->view('sidebar')?></div></div>
   </div>

   <div style="background-color: rgb(228, 228, 228);" class="col-md-6">   

    <div class="timeline">
      <div class="page-header">
        <h1>Berita</h1>
      </div>    
        <?php foreach($berita as $b):
        $konten = substr($b['konten'], 0,300)
        ?>
          <a href="<?php echo site_url('berita/baca/'.$b['id_berita'])?>"><h2><?php echo $b['judul']?></h2></a><small style="color:gray">Oleh Admin | Post | Update</small><br/>
          <p><?php echo $konten?></p><p><a class="btn btn-warning" href="<?php echo site_url('berita/baca/'.$b['id_berita'])?>">selengkapnya</a></p>
          <br/>
        <?php endforeach;?>
        <center><?php echo $page?></center>
    </div>

  </div>
</div>
</section>