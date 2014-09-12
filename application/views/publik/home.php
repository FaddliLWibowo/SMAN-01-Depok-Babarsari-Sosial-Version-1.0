<section id="padding-top"></section>
<section id="slider">
	<div id="carousel-example-generic" class="carousel slide">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"></li>
			<li data-target="#carousel-example-generic" data-slide-to="3"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner">		    

			<div class="item active">
				<img style="height:500px" class="slidder-news" src="<?php echo base_url('assets/img/news/home.jpg')?>" alt="berita 1"/>
				<div class="carousel-caption">
					<div class="row">
						<div class="col-md-6"></div>
						<div style="padding-bottom:20px;text-align:left" class="col-md-6">
							<h2>SMAN 01 Depok Babarsari</h2>
							<p style="padding-bottom:20px">Cuma sekedar sekolah berprestasi yang ada di Yogyakarta, tidak ada tandingannya.
							</p>
									  
						</div>
					</div>
				</div>
			</div>

			<?php foreach($berita as $b):
			$konten = substr($b['konten'], 0,300);
			$judul = str_replace(' ', '-', $b['judul'])
			?>
			<div class="item">
				<img style="height:500px" class="slidder-news" src="<?php echo base_url('assets/img/news/'.$b['image'])?>" alt="berita 2"/>
				<div class="carousel-caption">
					<div class="row">
						<div class="col-md-6"></div>
						<div style="padding-bottom:20px;text-align:left" class="col-md-6">
							<h2><?php echo $b['judul']?></h2>
							<p style="padding-bottom:20px"><?php echo $konten?>
							</p>
							<p>
								<a class="white-transparent-button" href="<?php echo site_url('berita/baca/'.$b['id_berita'])?>">Selengkapnya</a>
							</p>			  
						</div>
					</div>
				</div>
			</div>
		<?php endforeach;?>

		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
			<span class="icon-prev"></span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
			<span class="icon-next"></span>
		</a>
	</div>
</section>


<!-- 
<section id="map">
	<center>GOOGLE MAP</center>
</section> -->