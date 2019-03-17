<?php 
if(isset($_SESSION['id_customer']))
{
	$id_customer = $_SESSION['id_customer'];

	$cari 	= "SELECT * FROM transaksi_grooming WHERE id_customer = '$id_customer' AND status = 1 ORDER BY id_transaksi_grooming DESC";
	$query 	= mysqli_query($conn,$cari);
	$hasil 	= mysqli_fetch_array($query);
	if($hasil > 0)
	{
		$faktur = $hasil['id_transaksi_grooming'];
	}
}
?>