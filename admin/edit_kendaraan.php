<?php
include '../dbconfig.php';

// menangkap data yang di kirim dari form
if(isset($_POST['update'])){
	// menangkap data yang di kirim dari form
	$id = $_POST['get_id_kendaraan'];
	$jenis_kendaraan = $_POST['jenis_kendaraan'];

	// eksekusi
	$sql = "update kendaraan set jenis_kendaraan='$jenis_kendaraan' where id_kendaraan='$id'";
	mysqli_query($connect,$sql);

	header("location:data_kendaraan.php");
}