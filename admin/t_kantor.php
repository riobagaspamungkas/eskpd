<?php
include '../dbconfig.php';

// menangkap data yang di kirim dari form
if(isset($_POST['kirim'])){
	// menangkap data yang di kirim dari form
	$nama_kantor = $_POST['nama_kantor'];
	$singkatan = $_POST['singkatan'];
	$npp = $_POST['npp'];

	// eksekusi
	$sql = "insert into kantor values('', '$nama_kantor', '$singkatan', '$npp')";
	mysqli_query($connect,$sql);

	header("location:data_kantor.php");
}