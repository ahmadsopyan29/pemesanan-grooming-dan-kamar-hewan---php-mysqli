<?php session_start();
include "config.php";
include "faktur.php";
include "fungsi/base_url.php";
include "fungsi/cek_session_public.php";
include "fungsi/cek_login_public.php";

$cek    = "SELECT * FROM transaksi_grooming WHERE id_customer = '$sesen_id_customer' AND status = '0' ";
$hasil  = mysqli_query($conn,$cek);
$data   = mysqli_fetch_array($hasil);

$n      = $_POST['n'];

if(isset($_POST['update']))
{
  if(mysqli_num_rows($hasil) == 0)
  {
    echo "<script>alert('Transaksi tidak ditemukan');location.replace('$base_url')</script>";
  }
    $faktur = $data['id_transaksi_grooming'];

    for ($i=1; $i<=$n; $i++)
    {
      $id_paket_grooming  = $_POST['id'.$i];

      $cari2        = "SELECT * FROM paket_grooming WHERE id_paket_grooming = '$id_paket_grooming' ";
      $hasil2       = mysqli_query($conn,$cari2);
      $data2        = mysqli_fetch_array($hasil2);

      $harga = $data2['harga'];
      

      if(mysqli_num_rows($hasil2) > 0)
      {
        $jmlubah  = $_POST['jumlah'.$i];
        
        $totubah  = $jmlubah * $harga;

        
            $query = "UPDATE transaksi_grooming_detail SET jumlah        = '$jmlubah',
                                                  
                                                  subtotal      = '$totubah'
                                            WHERE id_transaksi_grooming   = '$faktur'
                                            AND   id_customer      = '$sesen_id_customer'
                                            AND   id_paket_grooming     = '$id_paket_grooming' ";

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
