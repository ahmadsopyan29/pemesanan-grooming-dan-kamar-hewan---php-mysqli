<?php                   // Memulai session
include 'navbar.php';  
include "faktur_penitipan.php"; 
include "fungsi/cek_login_public.php";
                 // Panggil koneksi ke database
?>
<?php 
if(isset($_POST['pesan_penitipan']))
{
  $id_kandang       = $_POST['id_kandang'];
  $nama_hewan       = $_POST['nama_hewan'];
  $tanggal_masuk      = $_POST['tanggal_masuk'];
  $tanggal_msk           = date('Y-m-d', strtotime($tanggal_masuk));
  $tanggal_keluar      = $_POST['tanggal_keluar'];
  $tanggal_klr           = date('Y-m-d', strtotime($tanggal_keluar));

  $sql_jumlah = "SELECT DATEDIFF('$tanggal_keluar','$tanggal_masuk') AS hari";
  $jumlah_  = mysqli_query($conn,$sql_jumlah);
  $jumlah_hari  = mysqli_fetch_array($jumlah_);
  $jumlah = $jumlah_hari['hari'];

  
  // cek data
  $sql ="SELECT * FROM transaksi_penitipan_detail WHERE id_kandang ='$id_kandang' AND ((tanggal_masuk BETWEEN '$tanggal_msk' AND '$tanggal_klr') OR (tanggal_keluar BETWEEN '$tanggal_msk' AND '$tanggal_klr'));";
  $cek_jadwal  = mysqli_query($conn,$sql);
  if(mysqli_num_rows($cek_jadwal) > 0)
  {
    // Alert/ pemberitahuan email yang dipakai telah ada/ tidak
    echo "<script>alert('Jadwal Sudah Di Booking');history.go(-1)</script>";
  }

  else {
    
    $sql1 ="SELECT * FROM detail_tanggal WHERE id_kandang ='$id_kandang' AND (tanggal BETWEEN '$tanggal_msk' AND '$tanggal_klr');";
    $cek_jadwal1  = mysqli_query($conn,$sql1);
    if(mysqli_num_rows($cek_jadwal1) > 0)
    {
      // Alert/ pemberitahuan email yang dipakai telah ada/ tidak
      echo "<script>alert('Jadwal Sudah Di Booking');history.go(-1)</script>";
    }
  
    else {
    

$id_paket_penitipan = mysqli_real_escape_string($conn,$_GET['id_paket_penitipan']);

$cari_paket  = "SELECT * FROM paket_penitipan WHERE id_paket_penitipan = '$id_paket_penitipan' ";
$hasil_paket = mysqli_query($conn, $cari_paket);
$data_paket  = mysqli_fetch_array($hasil_paket);

$id_paket  = $data_paket['id_paket_penitipan'];
$nama_paket  = $data_paket['nama_paket'];
$harga  = $data_paket['harga'];
$subtotal = $harga * $jumlah;

date_default_timezone_set('UTC');

	// Start date
	$date = $tanggal_masuk;
	// End date
	$end_date = $tanggal_keluar;

	while (strtotime($date) < strtotime($end_date)) {
                
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                $okeh = "$date\n";
                $sql="INSERT INTO detail_tanggal (id_kandang, tanggal) VALUES ('$id_kandang','$okeh')";
                if (mysqli_query($conn, $sql)) {
                        
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
        }



        $query1 = "INSERT INTO transaksi_penitipan_detail (id_transaksi_penitipan,
                                                id_customer,
                                                id_paket_penitipan,
                                                id_kandang,
                                                tanggal_masuk,
                                                tanggal_keluar,
                                                jumlah_hari,
                                                subtotal,
                                                
                                                nama_hewan)
                                        VALUES ('$faktur_penitipan',
                                                '$sesen_id_customer',
                                                '$id_paket_penitipan',
                                                '$id_kandang',
                                                '$tanggal_masuk',
                                                '$tanggal_keluar',
                                                '$jumlah',
                                                '$subtotal',
                                                '$nama_hewan')";

        if(mysqli_query($conn, $query1))
        {
         	 echo "<script language=\"JavaScript\">\n";
						echo "alert('Paket Berhasil DiTambahkan Ke Keranjang!');\n";
						echo "window.location='keranjang.php'";
						echo "</script>";
        }
          else
          {
            echo "Error updating record: " . mysqli_error($conn);
          }
      
        
    

  
    echo "<script>alert('Barang yang ingin Anda beli tidak ada');location.replace('$base_url')</script>";
  }
} 
}else{
echo "<script>alert('Barang yang ingin Anda beli tidak ada');location.replace('$base_url')</script>";}
?>


  
 <?php                   // Memulai session
include 'footer.php';                     // Panggil koneksi ke database
?>

