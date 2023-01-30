<?php
include '../dbconfig.php';
$id_kantor = $_GET['id_kantor'];
mysqli_query($connect, "DELETE FROM kantor WHERE id_kantor='$id_kantor'");

header("location:data_kantor.php");