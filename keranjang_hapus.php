<?php 

session_start();                    // Memulai session
include 'config.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include "faktur.php"; 



 

$cek		= "SELECT * FROM transaksi_grooming WHERE id_customer = '$sesen_id_customer' AND status ='0'";
$hasil 	= mysqli_query($conn,$cek);
$data 	= mysqli_fetch_array($hasil);

if(mysqli_num_rows($hasil) == 0)
{
	echo "<script>alert('Data tidak ditemukan');location.replace('keranjang.php')</script>";
}
else
{
	$faktur 		= $data['id_transaksi_grooming'];
	$id_paket_grooming 	= $_GET['id_paket_grooming'];

	$query = "DELETE FROM transaksi_grooming_detail WHERE id_transaksi_grooming = '$faktur' AND id_paket_grooming = '$id_paket_grooming' ";
	
	if(mysqli_query($conn, $query)) 
  {
  	echo "<script>alert('Barang berhasil dihapus');location.replace('keranjang.php')</script>";
  }  
  	else
  	{
  		echo "Error updating record: " . mysqli_error($conn);
  	}
}
?>