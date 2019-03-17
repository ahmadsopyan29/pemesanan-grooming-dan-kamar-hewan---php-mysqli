<?php                   // Memulai session
include 'navbar.php';                     // Panggil koneksi ke database
?>
<?php

// Memanggil data dari tabel produk diurutkan dengan id_produk secara DESC dan dibatasi sesuai $start dan $per_halaman
$id_paket_grooming= mysqli_real_escape_string($conn,$_GET['id_paket_grooming']);
$data     = mysqli_query($conn, "SELECT * FROM paket_grooming WHERE id_paket_grooming='$id_paket_grooming' ");
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
								<form method="post" action="pesan_grooming.php?id_paket_grooming=<?php echo $row['id_paket_grooming']; ?>">
									<p style="float:"><strong> Tanggal &nbsp;&nbsp;: &nbsp;</strong>
									<input type="date" name="tanggal"  id="tanggal" style="width:250px;border:1px solid #e3e3e3;border-radius:2px" required>
									</p>
									<br>
									<p style=""><strong> Jam  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;</strong>
										<select name="id_jadwal" id="jam" style="width:250px;border:1px solid #e3e3e3;border-radius:2px" required>
											<option value="">--Pilih Jam--</option>
											
											<?php
											$prov = "SELECT * FROM jadwal_grooming ORDER BY jam_mulai";
											$result = mysqli_query($conn, $prov);
											if (mysqli_num_rows($result) > 0)
											{
											while ($data = mysqli_fetch_array($result))
											{
												echo "<option value='$data[id_jadwal]'>$data[jam_mulai] sampai $data[jam_selesai]</option>\n";
											}
											}
											else
											{
												echo "Belum ada data";
											}
											?>
										
										</select>
									</p>
									<br>
									<p style=""><strong> Petugas &nbsp;&nbsp;: &nbsp;</strong>
										<select name="id_petugas" id="jam" style="width:250px;border:1px solid #e3e3e3;border-radius:2px" required>
											<option value="">--Pilih Petugas--</option>
											
											<?php
											$pet = "SELECT * FROM tb_petugas ORDER BY id_petugas";
											$result = mysqli_query($conn, $pet);
											if (mysqli_num_rows($result) > 0)
											{
											while ($data = mysqli_fetch_array($result))
											{
												echo "<option value='$data[id_petugas]'> $data[nama_petugas]</option>\n";
											}
											}
											else
											{
												echo "Belum ada data";
											}
											?>
										
										</select>
									</p>
									<br>
									<p style=""><strong> Nama Hewan &nbsp;&nbsp;: &nbsp;</strong>
										<input type="text" name="nama_hewan" style="width:200px;border:1px solid #e3e3e3;border-radius:2px"/>
									</p>
								
								<div style="float:left;margin-top:20px;">
									
										<button type="submit" name="pesan_grooming" class="btn btn-fefault cart cart_wishlist">
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

