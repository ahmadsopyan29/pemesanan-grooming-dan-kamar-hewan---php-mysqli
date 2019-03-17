<?php                   // Memulai session
include 'navbar.php';                     // Panggil koneksi ke database
?>
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<h3> Grooming</h3>
			<div class="table-responsive cart_info">
			
	<form method="post" id="form1" action="keranjang_update.php">
		<?php
		// Panggil data faktur
		include 'faktur.php';
		// Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
		$cek_invoice = 	mysqli_query($conn,"SELECT *
										FROM transaksi_grooming_detail
										LEFT JOIN transaksi_grooming ON transaksi_grooming.id_transaksi_grooming = transaksi_grooming_detail.id_transaksi_grooming
										LEFT JOIN paket_grooming ON paket_grooming.id_paket_grooming = transaksi_grooming_detail.id_paket_grooming
										LEFT JOIN jadwal_grooming ON transaksi_grooming_detail.id_jadwal = jadwal_grooming.id_jadwal
										LEFT JOIN tb_petugas ON transaksi_grooming_detail.id_petugas = tb_petugas.id_petugas
										WHERE transaksi_grooming.id_transaksi_grooming = '$faktur'
										AND transaksi_grooming.id_customer = '$sesen_id_customer'
										AND transaksi_grooming.status = 0");
		if(mysqli_num_rows($cek_invoice) == 0)
		{echo "<center><h4>Keranjang belanja anda masih kosong</h4></center>";}
		else
		{
			echo "
			<table class='table table-condensed'>
					<thead>
						<tr class='cart_menu'>
							<td> No </td>
							<td class='image' align='center'>Item</td>
							<td class='description' align='center'></td>
							<td class='price' align='center'>Harga</td>
							<td class='quantity' align='center'>Tanggal</td>
							<td class='quantity' align='center'>Jam</td>
							<td class='quantity' align='center'>Petugas</td>
							<td align='center'> Subtotal</td>
							<td class='total' align='center'></td>
							
						</tr>
					</thead>
			";
			$i = 1;

			while($data_keranjang = mysqli_fetch_array($cek_invoice))
			{
				
				$subtotal 		= number_format($data_keranjang['subtotal'], 0, ',', '.');
				$harga 		= number_format($data_keranjang['harga'], 0, ',', '.');

				echo "
				<tbody>
						<tr>
							<td> $i</td>
							
							<td class='cart_product'>
								<a href=''><img src='gambar/$data_keranjang[gambar]' width='70' alt=''></a>
							</td>
							<td class='cart_description'>
								<h4><a href=''>$data_keranjang[nama_paket]</a></h4>
								<p>$data_keranjang[deskripsi]</p>
							</td>
							<td class='cart_price'>
								<p>$harga</p>
							</td>
							<td data-title='Aksi' align='center'>
								
							<p>$data_keranjang[tanggal]</p>
								
							</td>
							<td data-title='Aksi' align='center'>
								
							<p>$data_keranjang[jam_mulai] - 
							<br> $data_keranjang[jam_selesai]</p>
								
							</td>
							<td data-title='Aksi' align='center'>
								
							<p>$data_keranjang[nama_petugas]</p>
								
							</td>
							
							
							<td class='cart_total'>
								<p class='cart_total_price'>$subtotal,-</p>
							</td>
							<td data-title='Aksi' align='center'>
								
								<a href='keranjang_hapus.php?id_trans_grooming_detail=$data_keranjang[id_trans_grooming_detail]'>
									<button name='hapus' type='button' class='btn btn-fefault cart cart_wishlist' aria-label='Left Align' title='Hapus' OnClick=\"return confirm('Apakah Anda yakin?');\">
											<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
											</button>
								</a>
							</td>
							
						</tr>

						
					</tbody>
				";
			$i++;
		}


		$no = $i-1;
		echo "<input type='hidden' name='n' value='$no' />";
		echo "</table>
		</div>


			</form>
					</div>
				</div>
			</section>";

		echo " <section id='cart_items'>
		<div class='container'>
			
			<div class='table-responsive cart_info'>";
			$cek = 	mysqli_query($conn,"SELECT sum(subtotal) as grandtotal
										FROM transaksi_grooming_detail
										LEFT JOIN transaksi_grooming ON transaksi_grooming.id_transaksi_grooming = transaksi_grooming_detail.id_transaksi_grooming
										LEFT JOIN paket_grooming ON paket_grooming.id_paket_grooming = transaksi_grooming_detail.id_paket_grooming
										WHERE transaksi_grooming.id_transaksi_grooming = '$faktur'
										AND transaksi_grooming.id_customer = '$sesen_id_customer'
										AND transaksi_grooming.status = 0");
			$data = mysqli_fetch_array($cek);
			$grand_total 		= number_format($data['grandtotal'], 0, ',', '.');
		echo "<form action='checkout.php' method='post' >
		<table class='table table-condensed'>
			<thead>
				<tr class='cart_menu'>
					<td></td>
					<td align='center' width='300'>Total</td>
					<td  align='center'> </td>
					
					<td  width='350'></td>
				</tr>
			</thead>
			<tbody>
				<tr>
				<td></td>
					<td width='100' align='center'>
						
						
							
					<p class='cart_total_price'>$grand_total</p>	
						
					</td>
					<td align='center'>
						
					</td>
					<td align='center' >
								
								<button name='checkout' type='submit' class='btn btn-fefault cart cart_wishlist' aria-label='Left Align' title='Hapus' OnClick=\'return confirm('Apakah Anda yakin?');\'>
								Checkout
									</button>
									<a href='index.php'>
									<button name='hapus' type='button' class='btn btn-fefault cart cart_wishlist' aria-label='Left Align' title='Hapus' OnClick=\'return confirm('Apakah Anda yakin?');\'>
								Lanjut Belanja
									</button></a>
					</td>
				</tr>

				
			</tbody>
		
";

			
	}
	?>
	
			</table>
		</form>
	</div>
	</div>
</section>
<br><br><br>
<section id="cart_items">
		<div class="container">
		<h3> Penitipan Hewan</h3>
			<div class="table-responsive cart_info">
	<form method="post" action="penitipan_update.php">
		<?php
		// Panggil data faktur
		include 'faktur_penitipan.php';
		// Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
		$cek_invoice = 	mysqli_query($conn,"SELECT *
										FROM transaksi_penitipan_detail
										LEFT JOIN transaksi_penitipan ON transaksi_penitipan.id_transaksi_penitipan = transaksi_penitipan_detail.id_transaksi_penitipan
										LEFT JOIN paket_penitipan ON paket_penitipan.id_paket_penitipan = transaksi_penitipan_detail.id_paket_penitipan
										LEFT JOIN tb_kandang ON transaksi_penitipan_detail.id_kandang = tb_kandang.id_kandang
										WHERE transaksi_penitipan.id_transaksi_penitipan = '$faktur_penitipan'
										AND transaksi_penitipan.id_customer = '$sesen_id_customer'
										AND transaksi_penitipan.status = 0");
		if(mysqli_num_rows($cek_invoice) == 0)
		{echo "<center><h4>Keranjang belanja anda masih kosong</h4></center>";}
		else
		{
			echo "
			<table class='table table-condensed'>
					<thead>
						<tr class='cart_menu'>
							<td> No </td>
							<td class='image'>Item</td>
							
							<td class='price'>Harga</td>
							
							<td>Tanggal Masuk</td>
							<td>Tanggal Keluar</td>
							<td>Jumlah Hari</td>
							<td> Nama Hewan</td>
							<td> Nomor Kandang</td>
							<td> Subtotal</td>
							<td class='total'></td>
							
						</tr>
					</thead>
			";
			$n = 1;

			while($data_keranjang = mysqli_fetch_array($cek_invoice))
			{
				
				$subtotal 		= number_format($data_keranjang['subtotal'], 0, ',', '.');
				$harga 		= number_format($data_keranjang['harga'], 0, ',', '.');

				echo "
				<tbody>
						<tr>
							<td> $n</td>
							
							
							<td class='cart_description'>
								<h4><a href=''>$data_keranjang[nama_paket]</a></h4>
								<p>$data_keranjang[deskripsi]</p>
							</td>
							<td class='cart_price'>
								<p>$harga</p>
							</td>
							<td align='center'>	
							<p>$data_keranjang[tanggal_masuk]</p>	
							</td>
							<td align='center'>	
							<p>$data_keranjang[tanggal_keluar]</p>	
							</td>
							<td align='center'>	
							<p>$data_keranjang[jumlah_hari]</p>
							</td>
							<td align='center'>	
							<p>$data_keranjang[nama_hewan]</p>
							</td>
							<td align='center'>	
							<p>$data_keranjang[id_kandang]</p>
							</td>
							<td class='cart_total'>
								<p class='cart_total_price'>$subtotal,-</p>
							</td>
							<td data-title='Aksi' align='center'>
								
								<a href='penitipan_hapus.php?id_trans_penitipan_detail=$data_keranjang[id_trans_penitipan_detail]'>
									<button name='hapus' type='button' class='btn btn-fefault cart cart_wishlist' aria-label='Left Align' title='Hapus' OnClick=\"return confirm('Apakah Anda yakin?');\">
											<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
											</button>
								</a>
							</td>
							
						</tr>

						
					</tbody>
				";
			$n++;
		}


		$nomor = $n-1;
		echo "<input type='hidden' name='n2' value='$nomor' />";
		echo "</table>
		</div>


			</form>
					</div>
				</div>
			</section>";

		echo " <section id='cart_items'>
		<div class='container'>
			
			<div class='table-responsive cart_info'>";
			$cek = 	mysqli_query($conn,"SELECT sum(subtotal) as grandtotal
										FROM transaksi_penitipan_detail
										LEFT JOIN transaksi_penitipan ON transaksi_penitipan.id_transaksi_penitipan = transaksi_penitipan_detail.id_transaksi_penitipan
										LEFT JOIN paket_penitipan ON paket_penitipan.id_paket_penitipan = transaksi_penitipan_detail.id_paket_penitipan
										WHERE transaksi_penitipan.id_transaksi_penitipan = '$faktur_penitipan'
										AND transaksi_penitipan.id_customer = '$sesen_id_customer'
										AND transaksi_penitipan.status = 0");
			$data = mysqli_fetch_array($cek);
			$grand_total		= number_format($data['grandtotal'], 0, ',', '.');
		echo "<form action='checkout.php' method='post' >
		<table class='table table-condensed'>
			<thead>
				<tr class='cart_menu'>
					<td></td>
					<td align='center' width='300'>Total</td>
					<td  align='center'></td>
					
					<td  width='350'></td>
				</tr>
			</thead>
			<tbody>
				<tr>
				<td></td>
					<td width='100' align='center'>
						
						
							
					<p class='cart_total_price'>$grand_total</p>	
						
					</td>
					<td align='center'>
						
					</td>
					<td align='center' >
								
								<button name='checkout_penitipan' type='submit' class='btn btn-fefault cart cart_wishlist' aria-label='Left Align' title='Checkout' OnClick=\'return confirm('Apakah Anda yakin?');\'>
								Checkout
									</button>
									<a href='index.php'>
									<button name='hapus' type='button' class='btn btn-fefault cart cart_wishlist' aria-label='Left Align' title='Home' OnClick=\'return confirm('Apakah Anda yakin?');\'>
								Lanjut Belanja
									</button></a>
					</td>
				</tr>

				
			</tbody>
		
";

			
	}
	?>
	
			</table>
		</form>
	</div>
	</div>
</section>
	
		 
	

 <?php                   // Memulai session
include 'footer.php';                     // Panggil koneksi ke database



?>

