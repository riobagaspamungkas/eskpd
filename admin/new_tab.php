<?php
include '../dbconfig.php';
$getwaktu = $_GET['getwaktu'];
$waktu = date('Y-m-d H:i:s',$getwaktu);
$strwaktu = strtotime($waktu);

header("refresh:1;url=cetak.php?cetak=$strwaktu" );