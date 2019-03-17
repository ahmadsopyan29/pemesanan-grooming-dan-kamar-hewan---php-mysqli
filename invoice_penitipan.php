<?php session_start(); ob_start();
include 'config.php';                     // Panggil koneksi ke database
include 'faktur_selesai_penitipan.php';             // Panggil data faktur yang telah selesai
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include 'fungsi/cek_login_public.php'; 		// Panggil fungsi cek login public
include 'fungsi/tgl_indo.php';            // Panggil fungsi tanggal indonesia

$id_transaksi_penitipan 	 = 	mysqli_real_escape_string($conn,$_GET['id_transaksi_penitipan']);
// Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
$hasil_invoice =  mysqli_query($conn,"SELECT *
                  FROM transaksi_penitipan_detail
                  LEFT JOIN transaksi_penitipan ON transaksi_penitipan.id_transaksi_penitipan = transaksi_penitipan_detail.id_transaksi_penitipan
                  INNER JOIN paket_penitipan ON paket_penitipan.id_paket_penitipan = transaksi_penitipan_detail.id_paket_penitipan
                  
                  INNER JOIN tb_kandang ON tb_kandang.id_kandang = transaksi_penitipan_detail.id_kandang
                  WHERE transaksi_penitipan.id_transaksi_penitipan = '$faktur'
                  AND transaksi_penitipan.id_customer = '$sesen_id_customer'
                  AND transaksi_penitipan.status = 1 ");
if(mysqli_num_rows($hasil_invoice) == 0)
{die ("<script>alert('Invoice yang Anda cari tidak ditemukan');location.replace('$base_url')</script>");}
?>

<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Invoice #<?php echo $id_transaksi_penitipan; ?></title>
    <style type="text/css">
		.tabel2 {
		  width: 100%;
		  border-collapse: collapse;
		  border-spacing: 0;
		}
		.tabel2 tr.odd td {
		    background-color: #f9f9f9;
		}
		.tabel2 th, .tabel2 td {
	    padding: 4px 5px;
	    line-height: 20px;
	    text-align: left;
	    vertical-align: top;
	    border: 1px solid #dddddd;
		}
		</style>
  </head>
  <body>
		<table>
		  <tr>
		    <td>
		      <font style="font-size: 25px; text-align: left"><br/><b> Petshop drh.Reny</b></font><br/>
		      <font style="font-size: 15px; text-align: left">
		        <br/>Jl. Bitung Cisereh No.5 Cikupa - Tangerang
		      </font>
		    </td>
		  </tr>
		</table>

		<hr/>

		<h3 align="center">NO. INVOICE: #<?php echo $id_transaksi_penitipan; ?></h3>

		<table class="tabel2" align="right">
		  <thead>
		    <tr>
		      <td style="text-align: center; background: #ddd"><b>No.</b></td>
		      <td style="text-align: center; background: #ddd"><b>NAMA PAKET</b></td>
		      <td style="text-align: center; background: #ddd"><b>HARGA</b></td>
		      <td style="text-align: center; background: #ddd"><b>MASUK</b></td>
		      <td style="text-align: center; background: #ddd"><b>KELUAR</b></td>
		      <td style="text-align: center; background: #ddd"><b>KANDANG</b></td>
					
					<td style="text-align: center; background: #ddd"><b>NAMA HEWAN</b></td>
		      <td style="text-align: center; background: #ddd"><b>SUBTOTAL</b></td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
        $i   = 1;
        while ($data_invoice = mysqli_fetch_array($hasil_invoice))
        {
        	$harga = number_format($data_invoice['harga'], 0, ',', '.');
        	$subtotal 		= number_format($data_invoice['subtotal'], 0, ',', '.')
        ?>
          <tr>
            <td style='text-align: center; width:20px'><?php echo $i ?></td>
            <td style='text-align: left; width:80px'><?php echo $data_invoice['nama_paket'] ?></td>
            <td style='text-align: center; width:70px'><?php echo $harga.',-' ?></td>
            <td style='text-align: center; width:70px'><?php echo $data_invoice['tanggal_masuk'] ?></td>
            <td style='text-align: center; width:70px'><?php echo $data_invoice['tanggal_keluar'] ?></td>
            <td style='text-align: center; width:60px'><?php echo $data_invoice['nama_kandang'] ?></td>
						<td style='text-align: center; width:50px'><?php echo $data_invoice['nama_hewan'] ?></td>
            <td style='text-align: right; width:80px'><?php echo $subtotal.',-' ?></td>
          </tr>
        <?php $i++; } ?>
		  </tbody>
		</table>

		<hr/>
          <?php 
          $query1        = "SELECT sum(subtotal) AS grandtotal,status_order FROM transaksi_penitipan_detail
					JOIN paket_penitipan ON paket_penitipan.id_paket_penitipan = transaksi_penitipan_detail.id_paket_penitipan
					JOIN transaksi_penitipan ON transaksi_penitipan.id_transaksi_penitipan = transaksi_penitipan_detail.id_transaksi_penitipan
					WHERE transaksi_penitipan_detail.id_transaksi_penitipan = '$faktur'
					AND transaksi_penitipan_detail.id_customer = '$sesen_id_customer'
					AND transaksi_penitipan.status = 1 ";
          $hasil1        = mysqli_query($conn,$query1);
          $data1         = mysqli_fetch_assoc($hasil1);
          $subtotal     = $data1['grandtotal'];
          $grand_total  = $subtotal;
          
          ?>

		<p>Total biaya yang harus Anda bayar adalah sebesar <strong>Rp <?php echo number_format($grand_total, 0, ',', '.').',-'; ?></strong></p>
		<p>Status Order :  <strong><?php echo $data1['status_order']; ?></strong></p>
		<p>Apabila telah melakukan pembayaran, mohon konfirmasi ke halaman berikut: <a href="<?php echo $base_url.'konfirmasi.phhp' ?>">klik disini</a></p>
		<hr/>
		<p>Pembayaran ditujukan ke rekening kami di bawah ini: </p>
		<p> BCA : 081-9829981772</p>
		<hr/>
		<p>Setelah proses verifikasi pembayaran Anda selesai, silahkan datag ke tempat kami sesuai waktu yang sudah anda tentukan.<br/>
		
		</p>
		<hr/>
		<p align="center"><b>Terima Kasih telah berbelanja bersama kami, Petshop drh.Reny</b></p>
		<hr/>
	</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->

<?php
// ob_get_clean = salah 1 fungsi dalam PHP
$content = ob_get_clean();
// Memanggil class HTML2PDF dari direktori html2pdf pada project kita
include 'html2pdf/html2pdf.class.php';
try
{
  // Mengatur invoice dalam format HTML2PDF
  // Keterangan: L = Landscape/ P = Portrait, A4 = ukuran kertas, en = bahasa, false = kode HTML2PDF, UTF-8 = metode pengkodean karakter
  $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(10, 5, 10, 0));
  // Mengatur invoice dalam posisi full page
  $html2pdf->pdf->SetDisplayMode('fullpage');
  // Menuliskan bagian content menjadi format HTML
  $html2pdf->writeHTML($content);
  // Mencetak nama file invoice
  $html2pdf->Output('invoice.pdf');
}
// Kodingan HTML2PDF
catch(HTML2PDF_exception $e)
{
  echo $e;
  exit;
}
?>
