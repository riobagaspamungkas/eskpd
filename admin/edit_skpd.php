<?php
include '../dbconfig.php';

// menangkap data yang di kirim dari form
if(isset($_POST['update'])){
	// menangkap data yang di kirim dari form
	$no_skpd = $_POST['no_skpd'];
	$waktu = $_POST['get_waktu'];
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
	$sisa = 0;

	if ($numbnpp >= 0) {
		$ceknpp = '';
		$ceknull = '';
		$ceknumbnpp = 0;
		for ($i=0; $i < 5 ; $i++) { 
			$j = $i + 1;
			if (trim($_POST["npp"][$i] != '')) {
				$ceknumbnpp += 1;
				$urutannpp = 'npp'.$ceknumbnpp;
				$getnpp = $_POST["npp"][$i];
				$ceknpp .= $urutannpp ."='". $getnpp."',";
			}
		}
		for ($j=5; $j > $ceknumbnpp; $j--) { 
			$urutansisa = 'npp'.$j;
			$ceknull .= $urutansisa ."= NULL, ";
		}
		$ceknpp = substr($ceknpp,0,-2);
		if ($ceknumbnpp == 5) {
			$ceknpp = $ceknpp."'";
		}else {
			$ceknpp = $ceknpp."',";
		}
		$ceknull = substr($ceknull,0,-2);
	}
	$pegawai = $ceknpp ."".$ceknull;

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
		for ($i=0; $i < $k ; $i++) { 
			if (trim($_POST["pengikut"][$i] != '')) {
				$ceknumbpengikut += 1;
				$urutanpengikut = 'pengikut'.$ceknumbpengikut;
				$getpengikut = $_POST["pengikut"][$i];
				$cekpengikut .= $urutanpengikut ."='".$getpengikut."',";
			}
		}
		for ($j=5; $j > $ceknumbpengikut; $j--) { 
			$urutansisa = 'pengikut'.$j;
			$cekkosong .= $urutansisa ."='', ";
		}
		$cekpengikut = substr($cekpengikut,0,-2);
		if ($ceknumbpengikut == 5) {
			$cekpengikut = $cekpengikut."'";
		}elseif ($ceknumbpengikut == 0) {
			$cekpengikut = "";
		}else {
			$cekpengikut = $cekpengikut."',";
		}
		$cekkosong = substr($cekkosong,0,-2);
	}
	$pengikut = $cekpengikut ."".$cekkosong;

	// eksekusi
	$sql = "update skpd set no_skpd='$no_skpd',id_kantor='$id_kantor', maksud_perjalanan='$maksud_perjalanan', id_kendaraan='$id_kendaraan', tempat_berangkat='$tempat_berangkat', tempat_tujuan='$tempat_tujuan', lama_perjalanan='$lama_perjalanan', tgl_berangkat='$tgl_berangkat', tgl_kembali='$tgl_kembali', $pengikut, pembebanan_anggaran='$pembebanan_anggaran',$pegawai where waktu='$waktu'";
	mysqli_query($connect,$sql);

	header("location:data_skpd.php");
}