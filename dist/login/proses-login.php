<?php
 
session_start();
 
$koneksi = mysqli_connect("localhost","root","","earthquake");

if(mysqli_connect_errno()){
	echo "Koneksi database gagal: " . mysqli_connect_errno();
}
 
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$pass = $_POST['pass'];
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from akun where username='$username' and pass='$pass'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
 
 echo "check";

if($cek > 0){
	$_SESSION['username'] = $username;
	$_SESSION['level'] = $level;
	$_SESSION['status'] = "login";
	header("location:../index.php");
}else{
	header("location:login.php?pesan=gagal");
}
 
?>