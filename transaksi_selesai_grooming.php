
<?php include 'navbar.php'?>
<?php 
include 'faktur_selesai_grooming.php';             // Panggil data faktur yang telah selesai
?>
<section id="cart_items">
		<div class="container">
<h4>NO. INVOICE: #<?php echo $faktur ?></h4>

<p align="right">
  <a href='invoice_grooming.php?id_transaksi_grooming=<?php echo $faktur; ?>'>
    <button type='button' class='btn btn-primary'>
      <span class='glyphicon glyphicon-download' aria-hidden='true'></span> Download Invoice
    </button>
  </a>
</p>

<div id="no-more-tables">
  <?php
  include 'faktur_selesai_grooming.php';                     // Panggil data faktur
  // Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
  $cek_invoice =  mysqli_query($conn,"SELECT *
                  FROM transaksi_grooming_detail
                  LEFT JOIN transaksi_grooming ON transaksi_grooming.id_transaksi_grooming = transaksi_grooming_detail.id_transaksi_grooming
                  INNER JOIN paket_grooming ON paket_grooming.id_paket_grooming = transaksi_grooming_detail.id_paket_grooming
                  INNER JOIN jadwal_grooming ON jadwal_grooming.id_jadwal = transaksi_grooming_detail.id_jadwal
                  INNER JOIN tb_petugas ON tb_petugas.id_petugas = transaksi_grooming_detail.id_petugas
                  WHERE transaksi_grooming.id_transaksi_grooming = '$faktur'
                  AND transaksi_grooming.id_customer = '$sesen_id_customer'
                  AND transaksi_grooming.status = 1 ");
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
          <td align='center'>Tanggal</td>
          <td align='center'>Jam</td>
          <td align='center'>Petugas</td>
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
          <td data-title='Harga Diskon' align='center'>$data_keranjang[tanggal]</td>
          <td data-title='Harga Diskon' align='center'>$data_keranjang[jam_mulai] - $data_keranjang[jam_selesai]</td>
          <td data-title='Harga Diskon' align='center'>$data_keranjang[nama_petugas]</td>
          <td data-title='Sub Total' align='center'>$subtotal,-</td>
        </tr>";
      $no++;
    }
  }
  ?>
</table>
</div>

<hr/>
          <?php 
          $query1        = "SELECT sum(subtotal) AS grandtotal FROM transaksi_grooming_detail
                          JOIN paket_grooming ON paket_grooming.id_paket_grooming = transaksi_grooming_detail.id_paket_grooming
                          JOIN transaksi_grooming ON transaksi_grooming.id_transaksi_grooming = transaksi_grooming_detail.id_transaksi_grooming
                          WHERE transaksi_grooming_detail.id_transaksi_grooming = '$faktur'
                          AND transaksi_grooming_detail.id_customer = '$sesen_id_customer'
                          AND transaksi_grooming.status = 1 ";
          $hasil1        = mysqli_query($conn,$query1);
          $data1         = mysqli_fetch_assoc($hasil1);
          $subtotal     = $data1['grandtotal'];
          $grand_total  = $subtotal;
          
          ?>

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
