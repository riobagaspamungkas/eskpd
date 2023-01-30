<?php
include '../dbconfig.php';

// menangkap data yang di kirim dari form
if(isset($_POST['update'])){
	// menangkap data yang di kirim dari form
	$id = $_POST['get_id_kantor'];
	$nama_kantor = $_POST['nama_kantor'];
	$singkatan = $_POST['singkatan'];
	$npp = $_POST['npp'];

	// eksekusi
	$sql = "update kantor set nama_kantor='$nama_kantor', singkatan='$singkatan', knpp='$npp' where id_kantor='$id'";
	mysqli_query($connect,$sql);

	header("location:data_kantor.php");
}