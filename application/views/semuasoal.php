<script>
  $(function() {
    <?php
    switch ($this->input->get('act')) {
      case 'byclass':
      echo "$('#materikelas').addClass('active')";
      break;

      case 'all':
      echo "$('#materisemua').addClass('active')";
      break;    
    }
    ?>
  });
</script>
<section id="padding-top"></section>
<section id="timeline-place">
  <div class="container">
   <div style="background-color: rgb(228, 228, 228)" class="col-md-offset-1 col-md-4">
     <div class="fixed-sidebar"><div class="menu"><?php $this->load->view('sidebar')?></div></div>
   </div>

   <div style="background-color: rgb(228, 228, 228);" class="col-md-6">   

    <div class="timeline">
      <div class="page-header">
        <h1>Soal <small>Untuk filter soal lebih lengkap,silahkan mengunjungi halaman profil guru</small></h1>
      </div>
      <ul class="nav nav-tabs">
        <li id="soalkelas"><a href="?act=byclass">Soal Saya</a></li>
        <li id="soalsemua"><a href="?act=all">Semua Soal</a></li>
      </ul>
      <table class="table table-striped">  
        <tr><th>Judul</th><th>Guru</th><th>Mata Pelajaran</th><th>Kelas</th><th>Tahun</th><th></th></tr>
        <?php foreach($view as $v):
        echo '<tr>
        <td>'.$v['judul'].'</td><td>'.$v['guru'].'</td><td>'.$v['kelas'].'<td>'.$v['mapel'].'</td></td><td>'.$v['tahun'].'</td><td><a href="'.base_url('assets/assets/materi/'.$v['link']).'" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span></a></td>
      </tr>';
      endforeach;?>
    </table>
    <center><?php echo $page?></center>
  </div>

</div>
</div>
</section>