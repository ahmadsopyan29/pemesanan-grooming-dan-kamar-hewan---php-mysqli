<?php session_start();                    // Memulai session
include 'config.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Petshop | drh.Reny</title>
    <link href="<?php echo $base_url ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/css/price-range.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/css/animate.css" rel="stylesheet">
	<link href="<?php echo $base_url ?>assets/css/main.css" rel="stylesheet">
	<link href="<?php echo $base_url ?>assets/css/responsive.css" rel="stylesheet">
	<!--<link rel="stylesheet" href="css/csseasyzoom.css">-->

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?php echo $base_url ?>assetsimages/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $base_url ?>assets/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $base_url ?>assets/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $base_url ?>assets/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $base_url ?>assetsimages/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
	<header id="header">
    


		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href=""><i class="fa fa-envelope"></i> info@webtools.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
    <div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="gambar/logo_kucing.png" width="150"alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
              <li>
                <a href='<?php echo $base_url ?>keranjang.php'>
                  <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span> Pemesanan
                </a>
							</li>
							<li>
                <a href='<?php echo $base_url ?>order.php'>
                  <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span> History Pemesanan
                </a>
              </li>
              <li>
                <a href='<?php echo $base_url ?>konfirmasi.php'>
                  <span class='glyphicon glyphicon-bullhorn' aria-hidden='true'></span> Konfirmasi
                </a>
              </li>
              <?php
                if(!empty($_SESSION['username']) && empty($_SESSION['usertype']))
                {
                  echo "
                  <li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
                      <span class='glyphicon glyphicon-user' aria-hidden='true'></span> Hai, ".$sesen_username." <span class='caret'></span>
                    </a>
                    <ul class='dropdown-menu'>
                      <li>
                        <a href='$base_url"."logout.php'>
                          <span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Logout
                        </a>
                      </li>
                    </ul>
                  </li>";
                }
                  else
                  {
                    echo "<li><a href='$base_url"."register.php'><span class='glyphicon glyphicon-user' aria-hidden='true'></span> Register/ Login</a></li>";
                  }
              ?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="<?php echo $base_url ?>index.php" >Home</a></li>
								<li class="dropdown"><a href="#">Kategori<i class="fa fa-angle-down"></i></a>
                    <ul role="menu" class="sub-menu">
												<li>
													<div class="panel-heading">
														<h4 class="panel-title"><a href="grooming.php"> Grooming</a></h4>
													</div>
												</li>
												<li>
													<div class="panel-heading">
														<h4 class="panel-title"><a href="penitipan_hewan.php"> Penitipan Hewan</a></h4>
													</div>
												</li>
												
											<!--/category-products-->
						        </ul>
                </li> 
                <li><a href="kontak.php">Kontak</a></li>
                <li class="dropdown"><a href="#">Tetang Kami<i class="fa fa-angle-down"></i></a>
                    <ul role="menu" class="sub-menu">
												<li>
													<div class="panel-heading">
														<h4 class="panel-title"><a href="profil.php"> Profil</a></h4>
													</div>
												</li>
												<li>
													<div class="panel-heading">
														<h4 class="panel-title"><a href="ketentuan.php"> Ketentuan Order</a></h4>
													</div>
												</li>
												
											<!--/category-products-->
						        </ul>
                </li> 
								
							</ul>
						</div>


					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
    
  </header>




