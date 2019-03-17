<?php session_start();
include "config.php";
include "faktur_penitipan.php";
include "fungsi/base_url.php";
include "fungsi/cek_session_public.php";
include "fungsi/cek_login_public.php";

$cek    = "SELECT * FROM transaksi_penitipan WHERE id_customer = '$sesen_id_customer' AND status = '0' ";
$hasil  = mysqli_query($conn,$cek);
$data   = mysqli_fetch_array($hasil);

$n      = $_POST['n2'];

if(isset($_POST['update']))
{
  if(mysqli_num_rows($hasil) == 0)
  {
    echo "<script>alert('Transaksi tidak ditemukan');location.replace('$base_url')</script>";
  }
    $faktur_penitipan = $data['id_transaksi_penitipan'];

    for ($i=1; $i<=$n; $i++)
    {
      $id_paket_penitipan  = $_POST['id'.$i];

      $cari2        = "SELECT * FROM paket_penitipan WHERE id_paket_penitipan = '$id_paket_penitipan' ";
      $hasil2       = mysqli_query($conn,$cari2);
      $data2        = mysqli_fetch_array($hasil2);

      $harga = $data2['harga'];
      

      if(mysqli_num_rows($hasil2) > 0)
      {
        $jmlhewanubah  = $_POST['jumlah_hewan'.$i];
        $jmlhariubah  = $_POST['jumlah_hari'.$i];
        
        $totubah  = ($jmlhewanubah * $harga) * $jmlhariubah;

        
            $query = "UPDATE transaksi_penitipan_detail SET jumlah_hewan        = '$jmlhewanubah',
                                                            jumlah_hari       = '$jmlhariubah',
                                                  
                                                  subtotal      = '$totubah'
                                            WHERE id_transaksi_penitipan   = '$faktur_penitipan'
                                            AND   id_customer      = '$sesen_id_customer'
                                            AND   id_paket_penitipan     = '$id_paket_penitipan' ";

            if(mysqli_query($conn, $query))
            {
              header("location:keranjang.php");
            }
            else
            {
              echo "Error updating record: " . mysqli_error($conn);
            }
        }
        else
        {
          echo "<script>alert('Barang yang ingin Anda beli tidak ditemukan');location.replace('index.php')</script>";
        }
      }
    
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya!');location.replace('keranjang.php')</script>";
  }
?>
