<section id="padding-top"></section>
<section style="padding:10px;background-color: rgb(228, 228, 228)">
 <div  class="container">
   <div style="background-color: #fff" class="semua-guru"  class="col-md-offset-1 col-md-10">
     <div class="page-header">
       <h1>Guru <small>semua guru</small></h1>
     </div>
     <div class="row">
      <?php foreach($view as $v):?>
       <div class="col-md-2">
        <div style="height:250px" class="thumbnail">
          <img style="height:100px;width:100px" src="<?php echo base_url('assets/img/avatar/'.$v['avatar'])?>" alt="...">
          <div class="caption">
            <h4><?php echo $v['nama_lengkap']?></h4>
            <p style="color:gray"><a href="<?php echo site_url('guru/profile/'.$v['nip'])?>" class="btn btn-primary">Kunjungi</a></p>
          </div>
        </div>
      </div>
      <?php endforeach;?>

     </div>
   </div>
 </div>
</section>