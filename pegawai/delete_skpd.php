<?php
include '../dbconfig.php';
$hapus = $_GET['hapus'];
$waktu = date('Y-m-d H:i:s',$hapus);
mysqli_query($connect, "DELETE FROM skpd WHERE waktu='$waktu'");

header("location:data.php");