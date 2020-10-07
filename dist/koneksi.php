<?php

	$koneksi = mysqli_connect("localhost","root","","earthquake");

	if(mysqli_connect_errno()){
		echo "Koneksi database gagal: " . mysqli_connect_errno();
	}
?>