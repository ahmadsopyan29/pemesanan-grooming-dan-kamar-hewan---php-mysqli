<?php
$host 		= "localhost";
$username 	= "root";
$password 	= "";
$dbname 	= "petshop";

// Buat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// cek koneksi
if($conn->connect_error)
{
  die("Connection failed: " . $conn->connect_error);
}
?>
