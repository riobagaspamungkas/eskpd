<?php
include '../dbconfig.php';

// menangkap data yang di kirim dari form
if(isset($_POST['kirim'])){
	// menangkap data yang di kirim dari form
	$no_skpd = $_POST['no_skpd'];
	$waktu = $_POST['waktu'];
	$id_kantor = $_POST['id_kantor'];
	$numbnpp = count($_POST["npp"]);
	$maksud_perjalanan = $_POST['maksud_perjalanan'];
	$id_kendaraan = $_POST['id_kendaraan'];
	$tempat_berangkat = $_POST['tempat_berangkat'];
	$tempat_tujuan = $_POST['tempat_tujuan'];
	$lama_perjalanan = $_POST['lama_perjalanan'];
	$tgl_berangkat = $_POST['tgl_berangkat'];
	$tgl_kembali = $_POST['tgl_kembali'];
	$numbpengikut = count($_POST['pengikut']);
	$pembebanan_anggaran = $_POST['pembebanan_anggaran'];
	$strwaktu = strtotime($waktu);

	if ($numbnpp >= 0) {
		$ceknpp = '';
		$ceknull = '';
		$ceknumbnpp = 0;
		for ($i=0; $i < 5 ; $i++) { 
			if (trim($_POST["npp"][$i] != '')) {
				$ceknumbnpp += 1;
				$getnpp = $_POST["npp"][$i];
				$ceknpp .= $getnpp ."', '";
			}else{
				$null = 'NULL';
				$ceknull .= $null .", ";
			}
		}
		$ceknpp = substr($ceknpp,0,-4);
		if ($ceknumbnpp == 5) {
			$ceknpp = "'".$ceknpp."'";
		}else {
			$ceknpp = "'".$ceknpp."',";
		}
		$ceknull = substr($ceknull,0,-2);
	}
	$pegawai = "".$ceknpp ."".$ceknull;

	if ($numbpengikut == 1) {
		if (trim($_POST["pengikut"][0] != '')) {
			$k = 5;
		}else{
			$k = 4;
		}
	}elseif ($numbpengikut > 1) {
		$k = 5;
	}
	if ($numbpengikut >= 0) {
		$ceknumb = '';
		$cekkosong = '';
		$ceknumbpengikut = 0;
		for ($j=0; $j < $k ; $j++) { 
			if (trim($_POST["pengikut"][$j] != '')) {
				$ceknumbpengikut += 1;
				$getpengikut = $_POST["pengikut"][$j];
				$cekpengikut .= $getpengikut ."', '";
			}else{
				$kosong = '';
				$cekkosong .= $kosong ." '',";
			}
		}
		$cekpengikut = substr($cekpengikut,0,-4);
		if ($ceknumbpengikut == 5) {
			$cekpengikut = "'".$cekpengikut."'";
		}else {
			$cekpengikut = "'".$cekpengikut."',";
		}
		$cekkosong = substr($cekkosong,0,-1);
	}
	$pengikut = "".$cekpengikut ."".$cekkosong;

	// eksekusi
	$sql = "insert into skpd (no_skpd, id_kantor, maksud_perjalanan, id_kendaraan, tempat_berangkat, tempat_tujuan, lama_perjalanan, tgl_berangkat, tgl_kembali, pengikut1, pengikut2, pengikut3, pengikut4, pengikut5, pembebanan_anggaran, waktu, npp1, npp2, npp3, npp4, npp5) values('$no_skpd','$id_kantor','$maksud_perjalanan','$id_kendaraan','$tempat_berangkat','$tempat_tujuan','$lama_perjalanan','$tgl_berangkat','$tgl_kembali',$pengikut,'$pembebanan_anggaran','$waktu',$pegawai)";
	mysqli_query($connect,$sql);

	header("location:data.php");
}