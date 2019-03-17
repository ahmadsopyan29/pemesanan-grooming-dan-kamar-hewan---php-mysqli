<?php                   // Memulai session
include 'navbar.php';                     // Panggil koneksi ke database
?>
<?php

// Memanggil data dari tabel produk diurutkan dengan id_produk secara DESC dan dibatasi sesuai $start dan $per_halaman
$id_paket_penitipan= mysqli_real_escape_string($conn,$_GET['id_paket_penitipan']);
$data     = mysqli_query($conn, "SELECT * FROM paket_penitipan WHERE id_paket_penitipan='$id_paket_penitipan' ");
$numrows  = mysqli_num_rows($data);
$row = mysqli_fetch_assoc($data);
?>
  
	<section>
		<div class="container">
			<div class="row">
				
				
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<!--Code for Zoom-->
							<div class="view-product">
								<img id="zoom_01" src='gambar/<?php echo $row['gambar']; ?>' data-zoom-image="images/product-details/roy.jpg"/>
							</div>
							
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="" class="newarrival" alt="" />
								<h2><?php echo $row['nama_paket']; ?></h2>
								
								
								<h1 style="color: #FE980F"><?php echo $row['harga']; ?></h1>
								<p><?php echo $row['deskripsi']; ?></p>
								<br>
								<form method="post" action="pesan_penitipan.php?id_paket_penitipan=<?php echo $row['id_paket_penitipan']; ?>">
								<p style="float:"><strong> Tanggal Masuk&nbsp;&nbsp;: &nbsp;</strong>
									<input type="date" name="tanggal_masuk"  id="tanggal" style="width:150px;border:1px solid #e3e3e3;border-radius:2px" required>
									</p>
									<p style="float:"><strong> Tanggal Keluar &nbsp;&nbsp;: &nbsp;</strong>
									<input type="date" name="tanggal_keluar"  id="tanggal" style="width:150px;border:1px solid #e3e3e3;border-radius:2px" required>
									</p>
									<p style=""><strong>Kandang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;</strong>
										<select name="id_kandang" id="jam" style="width:140px;border:1px solid #e3e3e3;border-radius:2px" required>
											<option value="">--Pilih Kandang--</option>
											
											<?php
											$prov = "SELECT * FROM tb_kandang ORDER BY id_kandang";
											$result = mysqli_query($conn, $prov);
											if (mysqli_num_rows($result) > 0)
											{
											while ($data = mysqli_fetch_array($result))
											{
												echo "<option value='$data[id_kandang]'>No. $data[id_kandang]</option>\n";
											}
											}
											else
											{
												echo "Belum ada data";
											}
											?>
										
										</select>
									</p>
									<p style="float:"><strong> Nama Hewan &nbsp;&nbsp;: &nbsp;</strong>
									<input type="text" name="nama_hewan"  id="nama_hewan" style="width:150px;border:1px solid #e3e3e3;border-radius:2px" required>
									</p>
								<div style="float:left;margin-top:20px;">
									
										<button type="submit" name="pesan_penitipan" class="btn btn-fefault cart cart_wishlist">
											<i class="fa fa-plus-square"></i>
											Pesan
										</button>
									
								</div>
								</form>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					
					
				</div>
			</div>
		</div>
	</section>

 <?php                   // Memulai session
include 'footer.php';                     // Panggil koneksi ke database



?>

