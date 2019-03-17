<?php                   // Memulai session
include 'navbar.php';  
include "faktur.php"; 
include "fungsi/cek_login_public.php";
                 // Panggil koneksi ke database
?>
<?php 
if(isset($_POST['pesan_grooming']))
{
  $id_petugas       = $_POST['id_petugas'];
  $id_jadwal       = $_POST['id_jadwal'];
  $nama_hewan       = $_POST['nama_hewan'];
  $tanggal       = mysqli_real_escape_string($conn,$_POST['tanggal']);

  // cek data
  $sql        = "SELECT id_petugas,tanggal,id_jadwal FROM transaksi_grooming_detail WHERE id_petugas = '$id_petugas' AND tanggal='$tanggal' AND id_jadwal='$id_jadwal'";
  $cek_jadwal  = mysqli_query($conn,$sql);
  if(mysqli_num_rows($cek_jadwal) > 0)
  {
    // Alert/ pemberitahuan email yang dipakai telah ada/ tidak
    echo "<script>alert('Jadwal Sudah Di Booking');history.go(-1)</script>";
  }

  else {

$id_paket_grooming = mysqli_real_escape_string($conn,$_GET['id_paket_grooming']);

$cari_paket  = "SELECT * FROM paket_grooming WHERE id_paket_grooming = '$id_paket_grooming' ";
$hasil_paket = mysqli_query($conn, $cari_paket);
$data_paket  = mysqli_fetch_array($hasil_paket);

$id_paket  = $data_paket['id_paket_grooming'];
$nama_paket  = $data_paket['nama_paket'];
$harga  = $data_paket['harga'];




        $query1 = "INSERT INTO transaksi_grooming_detail (id_transaksi_grooming,
                                                id_customer,
                                                id_paket_grooming,
                                                id_jadwal,
                                                
                                                
                                                subtotal,
                                                tanggal,
                                                id_petugas,
                                                nama_hewan)
                                        VALUES ('$faktur',
                                                '$sesen_id_customer',
                                                '$id_paket_grooming',
                                                '$id_jadwal',
                                                
                                                '$harga',
                                                '$tanggal',
                                                '$id_petugas',
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
?>


  
 <?php                   // Memulai session
include 'footer.php';                     // Panggil koneksi ke database
?>

