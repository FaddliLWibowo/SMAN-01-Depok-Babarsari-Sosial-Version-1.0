<section id="padding-top"></section>
<section style="padding:10px;background-color: rgb(228, 228, 228)">
 <div  class="container">
   <div style="background-color: #fff" class="semua-guru"  class="col-md-offset-1 col-md-10">
     <h3>Data Guru</h3>
     <div class="row">
      <?php foreach($view as $v):?>
       <a href="<?php echo site_url('guru/profile/'.$v['nip'])?>">
         <div class="guru col-md-2">
           <img src="<?php echo base_url('assets/img/avatar/'.$v['avatar'])?>"/> 
           <span><p style="margin:auto"><?php echo $v['nama_lengkap']?><p></span>
         </div>
       </a>
      <?php endforeach;?>

     </div>
   </div>
 </div>
</section>