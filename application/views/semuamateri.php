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
        <h1>Materi <small>materi dari guru 
          <?php
          switch ($this->input->get('act')) {
            case 'byclass':
            echo 'berdasarkan kelas';
            break;
            case 'all':
            echo 'semua materi';
            break;          
            default:
            echo 'error';
            break;
          }
          ?>
        </small></h1>
        <ul class="nav nav-tabs">
          <li id="materikelas"><a href="?act=byclass">Materi Saya</a></li>
          <li id="materisemua"><a href="?act=all">Semua Materi</a></li>
        </ul>
      </div>
      <!-- <form role="form" class="form-inline">
        <div class="form-group"><input id="txtguru" onkeyup="materiSorter()" name="guru" class="input-sm form-control" type="text" placeholder="guru"/></div>
        <img id="loader-sorter" style="display:none" width="20px" class="form-group" src="<?php echo base_url('assets/css/loader.gif')?>"/>
        <div id="sorting" class="form-group">
          <div class="form-group"><select name="mapel" class="input-sm form-control"><option value="">Mata Pelajaran</option></select></div>
          <div class="form-group"><select name="kelas" class="input-sm form-control"><option value="">Kelas</option></select></div>
          <div class="form-group"><select name="tahun" class="input-sm form-control"><option value="">Tahun</option><option value="2012">2012</option><option value="2013">2013</option><option value="2014">2014</option></select></div>
          <button class="input-sm btn btn-primary">cari</button>
        </div>
      </form> -->
      <br/>
      <table class="table table-striped">  
        <tr><th>Judul</th><th>Guru</th><th>Mata Pelajaran</th><th>Kelas</th><th>Tahun</th><th></th></tr>
        <?php foreach($view as $v):
        echo '<tr>
        <td>'.$v['judul'].'</td><td><a href="'.site_url('guru/profile/'.$v['nip']).'">'.$v['guru'].'</a></td><td>'.$v['kelas'].'<td>'.$v['mapel'].'</td></td><td>'.$v['tahun'].'</td><td><a href="'.base_url('assets/assets/materi/'.$v['link']).'" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span></a></td>
      </tr>';
      endforeach;?>
    </table>
    <center><?php echo $page?></center>
  </div>

</div>
</div>
</section>