<?php                   // Memulai session
include 'navbar.php';  
include "faktur_penitipan.php"; 
include "fungsi/cek_login_public.php";
                 // Panggil koneksi ke database
?>
<?php 
if(isset($_POST['konfirmasi']))
{
  $id_transaksi       = $_POST['id_transaksi'];
  $nama_pengirim       = $_POST['nama_pengirim'];
  $nama_bank       = $_POST['nama_bank'];
  $nomor_rek_pengirim      = $_POST['nomor_rek_pengirim'];
  $jumlah_transfer      = $_POST['jumlah_transfer'];

  $allowed_ext  = array('jpg', 'jpeg', 'png', 'gif');
  $file_name    = $_FILES['img']['name']; // File adalah name dari tombol input pada form
  
  $tmp = explode('.', $file_name);
	$file_ext = end($tmp);
  $file_tmp     = $_FILES['img']['tmp_name'];
  $lokasi       = 'gambar/'.$file_name.'';
  $gambar = $file_name;
  

  if(in_array($file_ext, $allowed_ext) === true)
  {
	move_uploaded_file($file_tmp, $lokasi);
	// Proses insert data dari form ke db
	$sql = "INSERT INTO konfirmasi_pembayaran (id_transaksi,
								nama_pengirim,
								nama_bank,
								no_rek_pengirim,
								jumlah_transfer, 

								gambar,
								
								
								id_customer)
						VALUES ('$id_transaksi',
								'$nama_pengirim',
								'$nama_bank',
								'$nomor_rek_pengirim',
								'$jumlah_transfer',
								'$gambar  ',
								
								
								'$sesen_id_customer')";
	if(mysqli_query($conn, $sql))
	{
	  echo "<script>alert('Konfirmasi Pembayaran Telah Terkirim');location.replace('index.php')</script>";
	}
	  else
	  {
		echo "Error updating record: " . mysqli_error($conn);
	  }
  }
} 
else{
echo "<script>alert('Barang yang ingin Anda beli tidak ada');location.replace('$base_url')</script>";}
?>


  
 <?php                   // Memulai session
include 'footer.php';                     // Panggil koneksi ke database
?>

