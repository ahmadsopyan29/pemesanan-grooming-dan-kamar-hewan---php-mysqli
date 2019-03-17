<?php
include 'navbar.php';
include 'fungsi/cek_login_public.php';

?>


    <!-- Awal Konten Utama -->
    
		<div class="container">
			<div class="row">
				
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2> Konfirmasi Pembayaran</h2>
						<form action="konfirmasi_proses.php" method="post" enctype="multipart/form-data" required>
							<input type="number" name="id_transaksi" placeholder="ID Transaksi" required />
							<input type="text" name="nama_pengirim" placeholder="Nama Pengirim" required/>
							<input type="text" name="nama_bank" placeholder="Nama Bank" required/>
							<input type="number" name="nomor_rek_pengirim" placeholder="Nomor Rekening Pengirim" required/>
							<input type="number" name="jumlah_transfer" placeholder="Jumlah Transfer" required/>
							<label> Upload Bukti Transfer</label>
							
							
                      		<input type="file" name="img" id="img" onchange="tampilkanPreview(this,'preview')" required/>
                      		<label>Preview Gambar</label><br>
                      		<img id="preview" src="" alt="" width="35%"/>
                    

							<?php
							include "fungsi/imgpreview.php";
							?>
							
							<button type="submit" name="konfirmasi" class="btn btn-default"> Konfirmasi</button>
						</form>

					</div><!--/login form-->
				</div>
				
			</div>
		</div>
	

    

      <?php include 'footer.php'; ?>
      