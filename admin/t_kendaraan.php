<?php
include '../dbconfig.php';

// menangkap data yang di kirim dari form
if(isset($_POST['kirim'])){
	// menangkap data yang di kirim dari form
	$jenis_kendaraan = $_POST['jenis_kendaraan'];

	// eksekusi
	$sql = "insert into kendaraan values('', '$jenis_kendaraan')";
	mysqli_query($connect,$sql);

	header("location:data_kendaraan.php");
}