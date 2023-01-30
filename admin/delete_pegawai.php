<?php
include '../dbconfig.php';
$npp = $_GET['npp'];
mysqli_query($connect, "DELETE FROM pegawai WHERE npp='$npp'");

header("location:data_pegawai.php");