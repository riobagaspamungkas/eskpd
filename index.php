<?php
session_start();
if(($_SESSION['eskpd']) == 'pegawai' OR ($_SESSION['eskpd']) == 'kepala_cabang'){
	header("Location: pegawai/");
}elseif (($_SESSION['eskpd']) == 'admin') {
	header("Location: admin/");
}else{
	header ("Location:login.php");
}