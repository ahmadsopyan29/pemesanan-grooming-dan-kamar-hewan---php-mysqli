<?php                   // Memulai session
include 'navbar.php';                     // Panggil koneksi ke database
?>
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Status Order</li>
				</ol>
			</div>
			<h3> Grooming</h3>
			<div class="table-responsive cart_info">
			
	<form method="post" id="form1" action="">
		<?php
		// Panggil data faktur
		include 'faktur.php';
		// Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
		$cek_invoice = 	mysqli_query($conn,"SELECT * 
										FROM transaksi_grooming
										
										WHERE id_customer = '$sesen_id_customer'
										AND status = 1 ");
		if(mysqli_num_rows($cek_invoice) == 0)
		{echo "<center><h4> Anda Belum Melakukan Transaksi</h4></center>";}
		else
		{
			echo "
			<table class='table table-condensed'>
					<thead>
						<tr class='cart_menu'>
							<td class='image'> No </td>
							<td class='image'> Id Transaksi</td>
							<td class='image'> tanggal</td>
							<td class='image'> Status</td>
							<td class='image'></td>
							
						</tr>
					</thead>
			";
			$i = 1;

			while($data_keranjang = mysqli_fetch_array($cek_invoice))
			{
				
				

				echo "
				<tbody>
						<tr>
							<td class='image'> $i</td>
							
							
							<td class='image'>
								<p>$data_keranjang[id_transaksi_grooming]</p>
							</td>
							<td class='image'>
								<p>$data_keranjang[tanggal]</p>
							</td>
							<td class='image'>
								<p>$data_keranjang[status_order]</p>
							</td>
							<td align='center'>	
								<a href='transaksi_selesai_grooming_detail.php?id_transaksi_grooming=$data_keranjang[id_transaksi_grooming]'>
									<button name='update' type='button' class='btn btn-fefault cart cart_wishlist' aria-label='Left Align' title='Update'>
											<span class='glyphicon glyphicon-search' aria-hidden='true'> Detail</span>
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


			";
			

		
			
	}
	?>
	
	</form>
					</div>
				</div>
			</section>		 
	
	<section id="cart_items">
		<div class="container">
			
			<h3> Penitipan</h3>
			<div class="table-responsive cart_info">
			
	<form method="post" id="form1" action="">
		<?php
		// Panggil data faktur
		include 'faktur_penitipan.php';
		// Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
		$cek_invoice = 	mysqli_query($conn,"SELECT * 
										FROM transaksi_penitipan
										
										WHERE id_customer = '$sesen_id_customer'
										AND status = 1 ");
		if(mysqli_num_rows($cek_invoice) == 0)
		{echo "<center><h4> Anda Belum Melakukan Transaksi</h4></center>";}
		else
		{
			echo "
			<table class='table table-condensed'>
					<thead>
						<tr class='cart_menu'>
							<td class='image'> No </td>
							<td class='image'> Id Transaksi</td>
							<td class='image'> tanggal</td>
							<td class='image'> Status</td>
							<td class='image'></td>
							
						</tr>
					</thead>
			";
			$i = 1;

			while($data_keranjang = mysqli_fetch_array($cek_invoice))
			{
				
				

				echo "
				<tbody>
						<tr>
							<td class='image'> $i</td>
							
							
							<td class='image'>
								<p>$data_keranjang[id_transaksi_penitipan]</p>
							</td>
							<td class='image'>
								<p>$data_keranjang[tanggal]</p>
							</td>
							<td class='image'>
								<p>$data_keranjang[status_order]</p>
							</td>
							<td align='center'>	
								<a href='transaksi_selesai_penitipan_detail.php?id_transaksi_penitipan=$data_keranjang[id_transaksi_penitipan]'>
									<button name='update' type='button' class='btn btn-fefault cart cart_wishlist' aria-label='Left Align' title='Update'>
											<span class='glyphicon glyphicon-search' aria-hidden='true'> Detail</span>
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


			";
			

		
			
	}
	?>
	
	</form>
					</div>
				</div>
			</section><br><br>	

 <?php                   // Memulai session
include 'footer.php';                     // Panggil koneksi ke database



?>

