<?php
include '../dbconfig.php';

// menangkap data yang di kirim dari form
if(isset($_POST['update_pegawai'])){
	// menangkap data yang di kirim dari form
	$n = $_POST['get_npp'];
	$npp = $_POST['npp'];
	$hak_akses = $_POST['hak_akses'];
	$nama_pegawai = $_POST['nama_pegawai'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$pangkat = $_POST['pangkat'];
	$jabatan = $_POST['jabatan'];
	$konseptor = $_POST['konseptor'];

	// eksekusi
	$sql = "update pegawai set npp='$npp',hak_akses='$hak_akses', nama_pegawai='$nama_pegawai', jenis_kelamin='$jenis_kelamin', pangkat='$pangkat', jabatan='$jabatan', konseptor='$konseptor' where npp='$n'";
	mysqli_query($connect,$sql);

	header("location:data_pegawai.php");
}

if(isset($_POST['update_password'])){
	// menangkap data yang di kirim dari form
	$n = $_POST['get_npp'];
	$get_old = $_POST['get_password'];
	$old = md5($_POST['password_lama']);
	$new = md5($_POST['password_baru']);
	$confirm_new = md5($_POST['konf_password_baru']);

	if($get_old == $old){
		if ($new == $confirm_new) {
			$sql = "update pegawai set password='$new' where npp='$n'";
			mysqli_query($connect,$sql);
			header("location:data_pegawai.php");
		}else{
			echo "<script>alert('Password baru anda tidak match, silahkan coba lagi!');history.go(-1);</script>";
		}
	}else{
		echo "<script>alert('Password lama anda salah, silahkan coba lagi!');history.go(-1);</script>";
	}
}