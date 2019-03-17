<?php                   // Memulai session
include 'navbar.php';                     // Panggil koneksi ke database



?>

  <section id="slider">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><img src="assets/images/home/logo2.jpg" width="190"alt="" /></h1>
									<h2> Jasa Grooming</h2>
									<p> Kami Menyediakan Jasa Grooming Langsung Di Tempat Anda</p>
									<a href="grooming.php"><button type="button" class="btn btn-default get"> Pesan Sekarang</button></a>
								</div>
								<div class="col-sm-6">
									<img src="<?php echo $base_url ?>assets/images/home/slider2.jpg" class="girl img-responsive" alt="" />
									
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><img src="assets/images/home/logo2.jpg" width="190"alt="" /></h1>
									<h2> Jasa Penitipan Hewan</h2>
									<p> Kami Menyediakan Jasa penitipan Hewan, Kami Jemput Hewan Anda Langsung Di Rumah</p>
									<a href="penitipan_hewan.php"><button type="button" class="btn btn-default get"> Pesan Sekarang</button></a>
								</div>
								<div class="col-sm-6">
								<img src="<?php echo $base_url ?>assets/images/home/slider1.jpg" class="girl img-responsive" alt="" />
									
								</div>
							</div>
							
							
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
  <section>
  <br><br>
		<div class="container">
			<div class="row">
				
				
				<div class="col-sm-12 padding-right">
					<div class="features_items"><!--features_items-->
					<center><a href="index.php"><img src="gambar/logo_kucing.png" width="250"alt="" /></a></center>
					<br><br>
          <div class="productinfo text-center">
		  
		  <h2> Petshop dr.Reny</h2></div>
            <div class="productinfo text-center"><p> PetShop drh.Reny adalah salon anjing dan kucing yang menyediakan jasa grooming di rumah pelanggan
			<br>Kami juga menyediakan jasa penitipan hewan, kami siap menjemput hewan langsung ke rumah anda
			<br>Service kami sangat diminati oleh mereka yang menginginkan privasi & kenyamanan salon exclusive tanpa harus meninggalkan rumah 
			<br>Kualitas kerja dan service kami terjamin dengan harga terjangkau.</p></div>
            <br><br><br>

            <div class="productinfo text-center"><h2> Layanan Kami</h2></div>
			<br><br>
            <div class="col-sm-2">
							
						</div>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="gambar/servis1.jpg" alt="" />
											<br><br>
											
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												
												<a href="penitipan_hewan.php" style="margin-bottom:23px" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> Pesan Sekarang</a>
											</div>
										</div>
								</div>
								
							</div>
						</div>


						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="gambar/servis2.jpg" alt="" />
											<br><br>
											
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												
												<a href="grooming.php" style="margin-bottom:23px" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> Pesan Sekarang</a>
											</div>
										</div>
								</div>
								
							</div>
						</div>
            <div class="col-sm-2">
							
						</div>
						


					

					
				</div>
			</div>
		</div>
	</section>
	<br><br><br><br>
	<section>
		<div class="container">
			<div class="row">
				

					
					<h2 class="title text-center"> Paket Grooming Terbaru</h2>
					<br><br>

					<?php

// Memanggil data dari tabel produk diurutkan dengan id_produk secara DESC dan dibatasi sesuai $start dan $per_halaman
$data     = mysqli_query($conn, "SELECT * FROM paket_grooming ORDER BY id_paket_grooming DESC LIMIT 4");
$numrows  = mysqli_num_rows($data);
?>

<?php
// Jika data ketemu, maka akan ditampilkan dengan While
if($numrows > 0)
{
  while($row = mysqli_fetch_assoc($data))
  {
    
?>

            <div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="gambar/<?php echo $row['gambar']; ?>" alt="" />
											<h2><?php echo number_format($row['harga'], 0, ',', '.'); ?></h2>
											<p><?php echo $row['nama_paket']; ?></p>
                      <p><?php echo $row['deskripsi']; ?></p>
											<a href="grooming_detail.php?id_paket_grooming=<?php echo $row['id_paket_grooming']; ?>" style="margin-bottom:23px" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> Pesan</a>
                      

										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2><?php echo number_format($row['harga'], 0, ',', '.'); ?></h2>
												<p><?php echo $row['nama_paket']; ?></p>
                        <p><?php echo $row['deskripsi']; ?></p>
												<a href="grooming_detail.php?id_paket_grooming=<?php echo $row['id_paket_grooming']; ?>" style="margin-bottom:23px" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> Pesan</a>
                      
											</div>
										</div>
								</div>
								
							</div>
						</div>
  
  <?php
  // Mengakhiri pengulangan while
  }
}
  else
  {
    echo "<script>alert('Data tidak ditemukan');location.replace('$base_url')</script>";
  }
?>


						
												
					</div><!--Latest_Brend_items-->



					
					<div class="category-tab"><!--category-tab-->
						
						
						
					</div><!--/category-tab-->
					<br><br><br><br>
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center"> paket penitipan terbaru</h2>
						<br><br>
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
								<?php

// Memanggil data dari tabel produk diurutkan dengan id_produk secara DESC dan dibatasi sesuai $start dan $per_halaman
$data     = mysqli_query($conn, "SELECT * FROM paket_penitipan ORDER BY id_paket_penitipan DESC LIMIT 4");
$numrows  = mysqli_num_rows($data);
?>

<?php
// Jika data ketemu, maka akan ditampilkan dengan While
if($numrows > 0)
{
  while($row = mysqli_fetch_assoc($data))
  {
    
?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
												<img src="gambar/<?php echo $row['gambar']; ?>" alt="" />
												<h2><?php echo number_format($row['harga'], 0, ',', '.'); ?></h2>
												
											<p><?php echo $row['nama_paket']; ?></p>
                      						<p><?php echo $row['deskripsi']; ?></p>
											  <a href="penitipan_detail.php?id_paket_penitipan=<?php echo $row['id_paket_penitipan']; ?>" style="margin-bottom:23px" class="btn btn-default add-to-cart"><i class="fa fa-plus-square"></i> Pesan</a>
												</div>
												
											</div>
										</div>
									</div>
									
							 			
						
            
  
  <?php
  // Mengakhiri pengulangan while
  }
}
  else
  {
    echo "<script>alert('Data tidak ditemukan');location.replace('$base_url')</script>";
  }
?>	
									</div>
									</div>	
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
	


 <?php                   // Memulai session
include 'footer.php';                     // Panggil koneksi ke database



?>

