<?php session_start(); 										// Memulai session
include 'config.php'; 										// Memanggil koneksi ke database
include 'faktur.php'; 
include 'faktur_penitipan.php';										// Memanggil faktur
include 'fungsi/base_url.php';  					// Memanggil fungsi base_url
include 'fungsi/cek_session_public.php'; 	// Memanggil fungsi cek_session_public
include 'fungsi/cek_login_public.php';  	// Memanggil fungsi cek_login_public

// Cek faktur pembelian berdasarkan notransaksi, username, dan status

if(isset($_POST['checkout']))
{
  
  
  
	
$cek_faktur 	= mysqli_query($conn,"SELECT transaksi_grooming.id_transaksi_grooming,transaksi_grooming.id_customer,transaksi_grooming.status,
								transaksi_grooming_detail.subtotal FROM transaksi_grooming_detail
								LEFT JOIN transaksi_grooming ON transaksi_grooming.id_transaksi_grooming = transaksi_grooming_detail.id_transaksi_grooming
								WHERE transaksi_grooming.id_transaksi_grooming = '$faktur' AND transaksi_grooming.id_customer = '$sesen_id_customer' 
								AND transaksi_grooming.status = 0 ");
// Jika tidak ditemukan maka akan muncul alert/ pemberitahuan
if(mysqli_num_rows($cek_faktur) == 0)
{
	header("location:keranjang.php");
}
	// Apabila ditemukan maka lanjut proses checkout dengan mengupdate status menjadi 1, tanggal checkout hari itu 
	// berdasarkan notransaksi dan username
	else
	{
		// Proses update
		$query = "UPDATE transaksi_grooming SET status = 1, tanggal = now(),  status_order = 'menunggu pembayaran'
							WHERE id_transaksi_grooming = '$faktur' AND id_customer = '$sesen_id_customer' ";
		// Jika berhasil, maka akan diarahkan ke halaman transaksi selesai
		if(mysqli_query($conn,$query)) 
	  {
	  	header("location:$base_url"."transaksi_selesai_grooming.php");
	  }
	  	// Jika gagal, maka akan muncul alert
	  	else 
	  	{
	  		echo "<script>alert('Mohon maaf, Transaksi gagal. Mohon ulangi kembali');location.replace('keranjang.php')</script>";
	  	} 
	}
}

// Jika gagal, maka akan muncul alert
else 
{
	echo "<script>alert('Mohon maaf, Transaksi gagal. Mohon ulangi kembali');location.replace('keranjang.php')</script>";
} 

if(isset($_POST['checkout_penitipan']))
{
  
  
  
	
$cek_faktur 	= mysqli_query($conn,"SELECT transaksi_penitipan.id_transaksi_penitipan,transaksi_penitipan.id_customer,transaksi_penitipan.status,
								transaksi_penitipan_detail.subtotal FROM transaksi_penitipan_detail
								LEFT JOIN transaksi_penitipan ON transaksi_penitipan.id_transaksi_penitipan = transaksi_penitipan_detail.id_transaksi_penitipan
								WHERE transaksi_penitipan.id_transaksi_penitipan = '$faktur_penitipan' AND transaksi_penitipan.id_customer = '$sesen_id_customer' 
								AND transaksi_penitipan.status = 0 ");
// Jika tidak ditemukan maka akan muncul alert/ pemberitahuan
if(mysqli_num_rows($cek_faktur) == 0)
{
	header("location:keranjang.php");
}
	// Apabila ditemukan maka lanjut proses checkout dengan mengupdate status menjadi 1, tanggal checkout hari itu 
	// berdasarkan notransaksi dan username
	else
	{
		// Proses update
		$query = "UPDATE transaksi_penitipan SET status = 1, tanggal = now(),  status_order = 'menunggu pembayaran'
							WHERE id_transaksi_penitipan = '$faktur_penitipan' AND id_customer = '$sesen_id_customer' ";
		// Jika berhasil, maka akan diarahkan ke halaman transaksi selesai
		if(mysqli_query($conn,$query)) 
	  {
	  	header("location:$base_url"."transaksi_selesai_penitipan.php");
	  }
	  	// Jika gagal, maka akan muncul alert
	  	else 
	  	{
	  		echo "<script>alert('Mohon maaf, Transaksi gagal. Mohon ulangi kembali');location.replace('keranjang.php')</script>";
	  	} 
	}
}

// Jika gagal, maka akan muncul alert
else 
{
	echo "<script>alert('Mohon maaf, Transaksi gagal. Mohon ulangi kembali');location.replace('keranjang.php')</script>";
}

?>