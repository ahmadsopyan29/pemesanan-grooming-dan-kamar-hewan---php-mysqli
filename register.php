<?php
include 'navbar.php';
// pengecekan session
if(isset($_SESSION['username']))
{
  // Jika user telah login dan ingin masuk ke halaman ini kembali, maka akan diarahkan ke halaman index/ home
  die ("<script>alert('Anda telah login'); location.replace('$base_url')</script>");
}
?>


    <!-- Awal Konten Utama -->
    <section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<?php include 'login_form.php' ?>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
            <?php include 'register_form.php' ?>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

    

      <?php include 'footer.php'; ?>
      