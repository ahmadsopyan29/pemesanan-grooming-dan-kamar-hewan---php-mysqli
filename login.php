<?php session_start();
include 'config.php';
include 'fungsi/base_url.php';

// jika tombol submit ditekan
if(isset($_POST['submit']))
{
  $errors     = array();
  $username   = mysqli_real_escape_string($conn, $_POST['username']);
  $pass       = mysqli_real_escape_string($conn, $_POST['password']);

  if (empty($username) && empty($pass))
  {
    echo "<script language='javascript'>alert('Isikan USERNAME dan PASSWORD'); history.go(-1)</script>";
  }
  elseif (empty($username))
  {
    echo "<script language='javascript'>alert('Isikan USERNAME'); history.go(-1)</script>";
  }
  elseif (empty($pass))
  {
    echo "<script language='javascript'>alert('Isikan PASSWORD'); history.go(-1)</script>";
  }

  // cek data ke db
  $sql    = "SELECT * FROM tb_customer WHERE username = '$username' AND password = '$pass' ";
  $result = mysqli_query($conn, $sql);
  $data   = mysqli_fetch_array($result);

  if (mysqli_num_rows($result) == 0)
  {
  	echo "<script>alert('Username / Password Yang Anda Masukkan Salah!');history.go(-1)</script>";
  }
  
		else
		{
	    
	      if(empty($errors))
	      {
	        $_SESSION['id_customer']= $data['id_customer'];
	        $_SESSION['username']   = $data['username'];
	        $_SESSION['nama_lengkap']       = $data['nama_lengkap'];
	        $_SESSION['alamat']  = $data['alamat'];
	        $_SESSION['email']       = $data['email'];
	        $_SESSION['telepon']   = $data['telepon'];

	        echo "<script language='javascript'>alert('Anda berhasil Login'); location.replace('$base_url')</script>";
	      }
	    
	      else
	      {
	        echo "<script>alert('PASSWORD SALAH!');history.go(-1)</script>";
	      }
	  }
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombolnya!');location.replace('$base_url')</script>";
  }
?>
