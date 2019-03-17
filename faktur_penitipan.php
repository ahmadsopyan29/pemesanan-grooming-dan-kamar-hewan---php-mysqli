<?php 
include "fungsi/cek_session_public.php"; 
include "fungsi/cek_login_public.php"; 

$cari  = "SELECT * FROM transaksi_penitipan WHERE id_customer = '$sesen_id_customer' AND status = 0 ORDER BY id_transaksi_penitipan DESC";
$query = mysqli_query($conn,$cari);
$hasil = mysqli_fetch_array($query);

if($hasil > 0)
{
	$faktur_penitipan = $hasil['id_transaksi_penitipan'];
}
	else
	{
		$query 	= "INSERT INTO transaksi_penitipan (id_customer,tanggal,status) VALUES ('$sesen_id_customer',now(),'0')";
		$result = mysqli_query($conn,$query);

		$cari 	= "SELECT * FROM transaksi_penitipan ORDER BY id_transaksi_penitipan DESC";
		$query 	= mysqli_query($conn,$cari);
		$hasil 	= mysqli_fetch_array($query);
		
		if ($hasil > 0)
		{
			$faktur_penitipan = $hasil['id_transaksi_penitipan'];
		}
}
?>