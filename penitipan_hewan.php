<?php                   // Memulai session
include 'navbar.php';                     // Panggil koneksi ke database



?>

  <section>
		<div class="container">
			<div class="row">
      <div class="col-sm-12 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center"> Penitipan Hewan</h2>
				
								
<?php

// Memanggil data dari tabel produk diurutkan dengan id_produk secara DESC dan dibatasi sesuai $start dan $per_halaman
$data     = mysqli_query($conn, "SELECT * FROM paket_penitipan ORDER BY id_paket_penitipan DESC ");
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
										<div class="product-overlay">
											<div class="overlay-content">
												<h2><?php echo number_format($row['harga'], 0, ',', '.'); ?></h2>
												<p><?php echo $row['nama_paket']; ?></p>
                        <p><?php echo $row['deskripsi']; ?></p>
												<a href="penitipan_detail.php?id_paket_penitipan=<?php echo $row['id_paket_penitipan']; ?>" style="margin-bottom:23px" class="btn btn-default add-to-cart"><i class="fa fa-plus-square"></i> Pesan</a>
                      
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



					
					
					
					
					
				</div>
			</div>
		</div>
	</section>


 <?php                   // Memulai session
include 'footer.php';                     // Panggil koneksi ke database



?>

