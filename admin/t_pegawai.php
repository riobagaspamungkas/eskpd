<?php
include '../dbconfig.php';

// menangkap data yang di kirim dari form
if(isset($_POST['kirim'])){
	// menangkap data yang di kirim dari form
	$npp = $_POST['npp'];
	$password = md5($_POST['password']);
	$hak_akses = $_POST['hak_akses'];
	$nama_pegawai = $_POST['nama_pegawai'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$pangkat = $_POST['pangkat'];
	$jabatan = $_POST['jabatan'];
	$konseptor = $_POST['konseptor'];

	// eksekusi
	$sql = "insert into pegawai values('$npp', '$password', '$hak_akses', '$nama_pegawai', '$jenis_kelamin', '$pangkat', '$jabatan', '$konseptor')";
	mysqli_query($connect,$sql);

	header("location:data_pegawai.php");
}