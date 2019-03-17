<?php
include 'config.php';
include 'fungsi/base_url.php';


if(isset($_POST['submit']))
{
  
  $username   = mysqli_real_escape_string($conn,$_POST['username']);
  
  $password   = mysqli_real_escape_string($conn,$_POST['password']);
  $nama_lengkap       = mysqli_real_escape_string($conn,$_POST['nama_lengkap']);
  $telepon    = mysqli_real_escape_string($conn,$_POST['telepon']);
  $alamat     = mysqli_real_escape_string($conn,$_POST['alamat']);
  $email      = mysqli_real_escape_string($conn,$_POST['email']);
  $telepon      = mysqli_real_escape_string($conn,$_POST['telepon']);
 

  // cek data
  $sql        = "SELECT email FROM tb_customer WHERE email = '$email' ";
  $cek_email  = mysqli_query($conn,$sql);
  if(mysqli_num_rows($cek_email) > 0)
  {
    // Alert/ pemberitahuan email yang dipakai telah ada/ tidak
    echo "<script>alert('Email telah terpakai, silahkan gunakan email yang lain!');history.go(-1)</script>";
  }
  else
  {
    if(empty($nama_lengkap))
    {
      echo "<script>alert('Nama harus diisi!');history.go(-1)</script>";
    }
    elseif(empty($username))
    {
      echo "<script>alert('Username harus diisi!');history.go(-1)</script>";
    }
    elseif(empty($email))
    {
      echo "<script>alert('email harus diisi!');history.go(-1)</script>";
    }
    elseif(empty($password))
    {
      echo "<script>alert('password harus diisi!');history.go(-1)</script>";
    }
    elseif(empty($telepon))
    {
      echo "<script>alert('telepon harus diisi!');history.go(-1)</script>";
    }
      
        else
        {
          // Proses insert data customer
          $create = mysqli_query($conn, "INSERT INTO tb_customer (
                                            
                                            username,
                                            password,
                                            nama_lengkap,
                                            alamat,
                                            email,
                                            telepon,
                                            
                                            tanggal_daftar)
                                    VALUES (
                                            '$username',
                                            
                                            '$password',
                                            '$nama_lengkap',
                                            '$alamat',
                                            '$email',
                                            '$telepon',
                                            
                                            now())");

          echo "<script>alert('Registrasi berhasil, silahkan cek email Anda untuk aktivasi.');history.go(-1)</script>";
        }
      }
  }

?>
