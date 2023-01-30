<?php
include '../dbconfig.php';
$id_kendaraan = $_GET['id_kendaraan'];
mysqli_query($connect, "DELETE FROM kendaraan WHERE id_kendaraan='$id_kendaraan'");

header("location:data_kendaraan.php");