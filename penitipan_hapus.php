<?php 

session_start();                    // Memulai session
include 'config.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include "faktur_penitipan.php"; 



 

$cek		= "SELECT * FROM transaksi_penitipan WHERE id_customer = '$sesen_id_customer' AND status ='0'";
$hasil 	= mysqli_query($conn,$cek);
$data 	= mysqli_fetch_array($hasil);

if(mysqli_num_rows($hasil) == 0)
{
	echo "<script>alert('Data tidak ditemukan');location.replace('keranjang.php')</script>";
}
else
{
	$faktur_penitipan		= $data['id_transaksi_penitipan'];
	$id_trans_penitipan_detail 	= $_GET['id_trans_penitipan_detail'];

	$query = "DELETE FROM transaksi_penitipan_detail WHERE id_transaksi_penitipan = '$faktur_penitipan' AND id_trans_penitipan_detail = '$id_trans_penitipan_detail' ";
	
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