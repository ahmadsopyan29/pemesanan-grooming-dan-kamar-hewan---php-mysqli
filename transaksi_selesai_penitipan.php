
<?php include 'navbar.php'?>
<?php 
include 'faktur_selesai_penitipan.php';             // Panggil data faktur yang telah selesai
?>
<section id="cart_items">
		<div class="container">
<h4>NO. INVOICE: #<?php echo $faktur ?></h4>

<p align="right">
  <a href='invoice_penitipan.php?id_transaksi_penitipan=<?php echo $faktur ?>'>
    <button type='button' class='btn btn-primary'>
      <span class='glyphicon glyphicon-download' aria-hidden='true'></span> Download Invoice
    </button>
  </a>
</p>

<div id="no-more-tables">
  <?php
  include 'faktur_selesai_penitipan.php';                     // Panggil data faktur
  // Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
  $cek_invoice =  mysqli_query($conn,"SELECT *
                  FROM transaksi_penitipan_detail
                  LEFT JOIN transaksi_penitipan ON transaksi_penitipan.id_transaksi_penitipan = transaksi_penitipan_detail.id_transaksi_penitipan
                  INNER JOIN paket_penitipan ON paket_penitipan.id_paket_penitipan = transaksi_penitipan_detail.id_paket_penitipan
                  
                  INNER JOIN tb_kandang ON tb_kandang.id_kandang = transaksi_penitipan_detail.id_kandang
                  WHERE transaksi_penitipan.id_transaksi_penitipan = '$faktur'
                  AND transaksi_penitipan.id_customer = '$sesen_id_customer'
                  AND transaksi_penitipan.status = 1 ");
  if(mysqli_num_rows($cek_invoice) == 0)
  {echo "<center><h4>Keranjang belanja anda masih kosong</h4></center>";}
  else
  {
    echo "
    <table class='col-md-12 table-bordered table-striped table-condensed cf'>
      <thead class='cf'>
        <tr>
          <td align='center'>No.</td>
          <td align='center'>Nama Paket</td>
          <td align='center'>Harga</td>
          <td align='center'>Tanggal Masuk</td>
          <td align='center'>Tanggal Keluar</td>
          <td align='center'>Nama Kandang</td>
          <td align='center'>Jumlah Hari</td>
          <td align='center'>Nama Hewan</td>
          <td align='center'>Sub Total</td>
        </tr>
      </thead>";

    $no = 1;
    while($data_keranjang = mysqli_fetch_array($cek_invoice))
    {
      $harga = number_format($data_keranjang['harga'], 0, ',', '.');
      $subtotal     = number_format($data_keranjang['subtotal'], 0, ',', '.');

      echo "
      <tbody>
        <tr>
          <td data-title='No.' align='center'>".$no."</td>
          <td data-title='Harga Diskon' align='center'>$data_keranjang[nama_paket]</td>
          <td data-title='Harga Diskon' align='center'>$harga,-</td>
          <td data-title='Harga Diskon' align='center'>$data_keranjang[tanggal_masuk]</td>
          <td data-title='Harga Diskon' align='center'>$data_keranjang[tanggal_keluar]</td>
          <td data-title='Harga Diskon' align='center'>$data_keranjang[nama_kandang]</td>
          <td data-title='Harga Diskon' align='center'>$data_keranjang[jumlah_hari]</td>
          <td data-title='Harga Diskon' align='center'>$data_keranjang[nama_hewan]</td>
          <td data-title='Sub Total' align='center'>$subtotal,-</td>
        </tr>";
      $no++;
    }
  }
  ?>

          <?php 
          $query1        = "SELECT sum(subtotal) AS grandtotal FROM transaksi_penitipan_detail
                          JOIN paket_penitipan ON paket_penitipan.id_paket_penitipan = transaksi_penitipan_detail.id_paket_penitipan
                          JOIN transaksi_penitipan ON transaksi_penitipan.id_transaksi_penitipan = transaksi_penitipan_detail.id_transaksi_penitipan
                          WHERE transaksi_penitipan_detail.id_transaksi_penitipan = '$faktur'
                          AND transaksi_penitipan_detail.id_customer = '$sesen_id_customer'
                          AND transaksi_penitipan.status = 1 ";
          $hasil1        = mysqli_query($conn,$query1);
          $data1         = mysqli_fetch_assoc($hasil1);
          $subtotal     = number_format($data1['grandtotal'], 0, ',', '.');
          $grand_total  = $subtotal;
          
          ?>


       

</table>
</div>
<br>
<hr/>
<br>
<br>
<br>
<p>Total biaya yang harus Anda bayar adalah sebesar <strong>Rp <?php echo $grand_total  ?></strong></p>


<p>Apabila telah melakukan pembayaran, mohon konfirmasi ke halaman berikut: <a href="<?php echo $base_url.'konfirmasi.php' ?>">klik disini</a></p>
<hr/>
<p>Pembayaran ditujukan ke rekening kami di bawah ini: </p>
<p> 0988-999999</p>
<hr/>
<p>Setelah proses verifikasi pembayaran Anda selesai, maka kami memproses transaksi anda
<br>Batas Pembayaran Anda Adalah 2 Jam Sebelum Jadwal</p>

<p>

</p>
<hr/>
<p align="center">Terima kasih telah berbelanja bersama kami Petshop drh.Reny</p>
</div>
</section>
<?php include 'footer.php'; ?>
