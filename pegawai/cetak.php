<?php
include '../dbconfig.php';
require('../assets/fpdf/fpdf.php');

function tgl_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

$pdf = new FPDF('P','mm','A4');
$pdf->SetMargins(15,25,15);
$pdf->AddPage();
$pdf->SetTitle("E-SKPD");

$cetak = $_GET['cetak'];
$waktu = date('Y-m-d H:i:s',$cetak);
$data = mysqli_query($connect, "SELECT * FROM kantor k JOIN skpd s JOIN kendaraan ke JOIN pegawai p ON s.waktu='$waktu' and s.id_kantor = k.id_kantor and s.id_kendaraan = ke.id_kendaraan");
while($row = mysqli_fetch_array($data)){
    $getknpp = $row['knpp'];
    $getidkantor = $row['id_kantor'];
    $cell3 = 105;
    $pdf->SetFont('Arial','',11);
    $count = $pdf->GetStringWidth($row['maksud_perjalanan']);
    $count1 = $cell3;
    $count2 = 2*$cell3;
    $count3 = 3*$cell3;
    if ($count < $cell3) {
        $height_cell = 14;
        $height = 14;
    }elseif($count > $count1 AND $count < $count2){
        $height_cell = 16;
        $height = 8;
    }elseif($count > $count2 AND $count < $count3){
        $height_cell = 24;
        $height = 8;
    }elseif($count > $count3) {
        $height_cell = 32;
        $height = 8;
    }
    $cell1 = 8;
    $cell2 = 62;
    $cell3 = 110;
    
    $pdf->SetY(35);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(180,4,'FM PU 07 02',0,1,'R');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(180,4,'Rev         : 00',0,1,'R');
    $pdf->SetFont('Times','BU',11);
    $pdf->Cell(0,5,'SURAT KETERANGAN PERJALANAN DINAS','0','1','C',false);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(0,5,'Nomor : '.$row['no_skpd'].'/SKPD/II-09/'.date('my'),'0','1','C',false);
    // query cetak
    $pdf->SetX(15);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell1,14,'1.',1,0,'C');
    $pdf->Cell($cell2,14,'Pejabat yang memberikan perintah',1,0,'L');
    $pdf->Cell($cell3,14,$row['nama_kantor'],1,1,'L');
    
    $pdf->SetFont('Arial','',11);
    $h1 = 0;
    $i1 = 0;
    for ($j1=0; $j1 < 5; $j1++) {
        $i1 = $j1 + 1;
        if ($row['npp'.$i1]) {
            $h1 += 1;
        }
    }
    
    $a1 = $cell3;
    $a2 = 2*$cell3;
    $a3 = 3*$cell3;
    $m1 = 0;
    $getheight = 0;
    $alpha = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x ','y','z');
    for ($i=0; $i < $h1; $i++) { 
        $m1 = $i + 1;
        $getnpp = $row['npp'.$m1];
        $sql = "SELECT * FROM pegawai WHERE npp = $getnpp";
        $getpegawai = mysqli_query($connect, $sql);
        while($row1 = mysqli_fetch_array($getpegawai)){
            if ($h1 == 1) {
                ${'print' . $m1} = $row1['nama_pegawai'];
            }elseif ($h1 >1) {
                ${'print' . $m1} = $alpha[$i].". ".$row1['nama_pegawai'];
            }
        }
    }
    for ($i=5; $i > $h1; $i--) { 
        ${'print' . $i} = '';
    }
    if ($h1 == 0) {
        $height_cell1 = 10;
        $height1 = 10;
        $getheight += 10;
    }elseif ($h1 == 1) {
        $height_cell1 = 14;
        $height1 = 14;
        $getheight += 1;
    }elseif ($h1 > 1) {
        $height_cell1 = $h1 * 8;
        $height1 = 8;
        $getheight += $height_cell1;
    }
    
    $start_awal=$pdf->GetX();
    $get_xxx = $pdf->GetX();
    $get_yyy = $pdf->GetY();
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height1,$print1,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height1,$print2,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height1,$print3,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height1,$print4,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height1,$print5,0,'L');
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell1,$height_cell1,'2.',1,'C'); 
    $get_xxx+=$cell1;                           
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell2,$height_cell1,'Nama pegawai yang diperintahkan',1); 
    $get_xxx+=$cell2;                           
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell3,$height_cell1,'',1,0);
    
    $m2 = 0;
    $alpha2 = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
    for ($i=0; $i < $h1; $i++) { 
        $m2 = $i + 1;
        $getnpp2 = $row['npp'.$m2];
        $sql2 = "SELECT * FROM pegawai WHERE npp = $getnpp2";
        $getpegawai2 = mysqli_query($connect, $sql2);
        while($row2 = mysqli_fetch_array($getpegawai2)){
            ${'pangkatnpp' . $m2} = $alpha[$i].". ".$row2['pangkat'].' / '.$row2['npp'];
        }
    }
    for ($i=5; $i > $h1; $i--) { 
        ${'pangkatnpp' . $i} = '';
    }
    if ($h1 == 0) {
        $height_cell2 = 10;
        $height2 = 10;
        $getheight += 10;
    }elseif ($h1 == 1) {
        $height_cell2 = 8;
        $height2 = 8;
        $getheight += $height_cell2;
        $getheight -= 0.5;
    }
    elseif ($h1 > 1) {
        $height_cell2 = $h1 * 8;
        $height2 = 8;
        $getheight += $height_cell2;
        
    }
    
    $start_awal=$pdf->GetX();
    $get_xxx = $pdf->GetX();
    $get_yyy = $pdf->GetY();
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height2,$pangkatnpp1,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height2,$pangkatnpp2,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height2,$pangkatnpp3,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height2,$pangkatnpp4,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height2,$pangkatnpp5,0,'L');
    $get_xxx+=$cell1;                           
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell2,$height_cell2,'a. Pangkat dan Golongan',0); 
    $get_xxx+=$cell2;                           
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell3,$height_cell2,'',0,0);
    
    $m3 = 0;
    $alpha3 = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
    for ($i=0; $i < $h1; $i++) { 
        $m3 = $i + 1;
        $getnpp3 = $row['npp'.$m3];
        $sql3 = "SELECT * FROM pegawai WHERE npp = $getnpp3";
        $getpegawai3 = mysqli_query($connect, $sql3);
        while($row3 = mysqli_fetch_array($getpegawai3)){
            if ($h1 == 1) {
                ${'jabatan' . $m3} = $alpha[$m3].". ".$row3['jabatan'];
            }elseif ($h1 > 1) {
                ${'jabatan' . $m3} = $alpha[$i].". ".$row3['jabatan'];
            }
            
        }
    }
    for ($i=5; $i > $h1; $i--) { 
        ${'jabatan' . $i} = '';
    }
    if ($h1 == 0) {
        $height_cell3 = 10;
        $height3 = 10;
        $getheight += 10;
    }elseif ($h1 == 1) {
        $height_cell3 = 8;
        $height3 = 8;
        $getheight += $height_cell3;
        $getheight -= 0.5;
    }elseif ($h1 > 1) {
        $height_cell3 = $h1 * 8;
        $height3 = 8;
        $getheight += $height_cell3;
    }
    
    $start_awal=$pdf->GetX();
    $get_xxx = $pdf->GetX();
    $get_yyy = $pdf->GetY();
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height3,$jabatan1,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height3,$jabatan2,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height3,$jabatan3,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height3,$jabatan4,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height3,$jabatan5,0,'L'); 
    $get_xxx+=$cell1;                           
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell2,$height_cell3,'b. Jabatan',0); 
    $get_xxx+=$cell2;                           
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell3,$height_cell3,'',0,0);
    
    $pdf->Ln(-$getheight);
    $start_awal=$pdf->GetX();
    $get_xxx = $pdf->GetX();
    $get_yyy = $pdf->GetY();
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell1,$getheight,'3. ',1,'C'); 
    $get_xxx+=$cell1;                           
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell2,$getheight,'',1);
    $get_xxx+=$cell2;                           
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell3,$getheight,'',1,0);
    
    $start_awal=$pdf->GetX();
    $get_xxx = $pdf->GetX();
    $get_yyy = $pdf->GetY();
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height,$row['maksud_perjalanan'],1,'L');
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell1,$height_cell,'4.',1,'C'); 
    $get_xxx+=$cell1;                           
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell2,$height_cell,'Maksud perjalanan dinas',1); 
    $get_xxx+=$cell2;
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->Ln();
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell1,14,'5.',1,0,'C');
    $pdf->Cell($cell2,14,'Kendaraan yang digunakan',1,0,'L');
    $pdf->Cell($cell3,14,$row['jenis_kendaraan'],1,1,'L');
    $getx = 15 + $cell1;
    $pdf->SetX($getx);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell2,16,"",1,0,'');
    $pdf->Cell($cell3,16,"",1,1,'');
    $pdf->SetX($getx);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell2,24,"",1,0,'');
    $pdf->Cell($cell3,24,"",1,1,'');
    $pdf->Ln(-40);
    $pdf->SetX(15);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell1,16,'6.',1,0,'C');
    $pdf->Cell($cell2,8,'a. Tempat berangkat',0,0,'L');
    $pdf->Cell($cell3,8,'a. '.$row['tempat_berangkat'],0,1,'L');
    $pdf->SetX($getx);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell2,8,"b. Tempat tujuan",0,0,'L');
    $pdf->Cell($cell3,8,'b. '.$row['tempat_tujuan'],0,1,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell1,24,'7.',1,0,'C');
    $pdf->Cell($cell2,8,'a. Lama perjalanan dinas',0,0,'L');
    $pdf->Cell($cell3,8,'a. '.$row['lama_perjalanan'].' hari',0,1,'L');
    $pdf->SetX($getx);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell2,8,"b. Tanggal berangkat",0,0,'L');
    $pdf->Cell($cell3,8,'b. '.tgl_indo(date($row['tgl_berangkat'])),0,1,'L');
    if ($row['tgl_kembali'] == 0) {
        $tgl = 'Tidak Kembali';
    }else{
        $tgl = tgl_indo(date($row['tgl_kembali']));
    }
    $pdf->SetX($getx);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell2,8,"c. Tanggal kembali",0,0,'L');
    $pdf->Cell($cell3,8,"c. ".$tgl,0,1,'L');
    // pengikut
    $pdf->SetFont('Arial','',11);
    $h = 0;
    $i = 0;
    for ($j=0; $j < 5; $j++) {
        $i = $j + 1;
        if ($row['pengikut'.$i]) {
            $h += 1;
        }
    }
    
    $a1 = $cell3;
    $a2 = 2*$cell3;
    $a3 = 3*$cell3;
    $m = 0;
    for ($i=0; $i < $h; $i++) { 
        $m = $i + 1;
        ${'print' . $m} = $m.". ".$row['pengikut'.$m];
    }
    for ($i=5; $i > $h; $i--) { 
        ${'print' . $i} = '';
    }
    if ($h == 0) {
        $height_cell1 = 10;
        $height1 = 10;
    }elseif ($h == 1) {
        $height_cell1 = 14;
        $height1 = 14;
    }elseif ($h > 1) {
        $height_cell1 = $h * 8;
        $height1 = 8;
    }
    
    $start_awal = $pdf->GetX();
    $get_xxx = $pdf->GetX();
    $get_yyy = $pdf->GetY();
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height1,$print1,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height1,$print2,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height1,$print3,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height1,$print4,0,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX(15+$cell1+$cell2);
    $pdf->MultiCell($cell3,$height1,$print5,0,'L');
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell1,$height_cell1,'8.',1,'C'); 
    $get_xxx+=$cell1;                           
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell2,$height_cell1,'Pengikut',1); 
    $get_xxx+=$cell2;                           
    $pdf->SetXY($get_xxx, $get_yyy);
    $pdf->MultiCell($cell3,$height_cell1,'',1,0);
    
    $pdf->SetX(15);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell1,16,'9.',1,0,'C');
    $pdf->Cell($cell2,16,"Pembebanan anggaran",1,0,'L');
    $pdf->Cell($cell3,16,'',1,1,'L');
    $pdf->Ln(-16);
    $getxx = 15 + $cell1 + $cell2;
    $pdf->SetX($getxx);
    $pdf->MultiCell($cell3,8,'Kode program  :',0,'L');
    $pdf->SetX($getxx);
    $pdf->MultiCell($cell3,8,'Kode akun       :',0,'L');
    $pdf->Ln(6);
    $pdf->SetLeftMargin(120);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(0,0,"Dikeluarkan di     :  ".$row['tempat_berangkat'],0,0,'L');
    $pdf->Ln(4);
    $pdf->SetFont('Arial','U',11);
    $pdf->Cell(0,0,"Pada tanggal       :  ".tgl_indo(date('Y-m-d')),0,0,'L');
    $pdf->Ln(4);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(0,0,$row['singkatan'],0,0,'L');
    $data = mysqli_query($connect, "SELECT * FROM kantor k JOIN pegawai p ON p.npp = $getknpp AND id_kantor = $getidkantor");
    while($row = mysqli_fetch_array($data)){
        $pdf->Ln(20);
        $pdf->Cell(0,0,$row['nama_pegawai'],0,0,'L');
    }
    $data = mysqli_query($connect, "SELECT * FROM pegawai p JOIN skpd s ON s.waktu='$waktu' AND s.npp1 = p.npp");
    while($row = mysqli_fetch_array($data)){
        $pdf->Ln(15);
        $pdf->SetFont('Times','',6);
        $pdf->SetX(15); 
        $pdf->Cell(0,0,$row['konseptor'],0,0,'L');
    }
    $pdf->Ln(15);
    $pdf->SetX(15);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell1,40,'',1,0,'C');
    $pdf->Cell(80,40,'',1,0,'L');
    $pdf->Cell(80,40,'',1,1,'L');
    $pdf->SetX(15);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell1,40,'',1,0,'C');
    $pdf->Cell(80,40,'',1,0,'L');
    $pdf->Cell(80,40,'',1,1,'L');
    $pdf->SetX(15);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell1,40,'',1,0,'C');
    $pdf->Cell(80,40,'',1,0,'L');
    $pdf->Cell(80,40,'',1,1,'L');
    $pdf->SetX(15);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell1,40,'',1,0,'C');
    $pdf->Cell(80,40,'',1,0,'L');
    $pdf->Cell(80,40,'',1,1,'L');
    $pdf->SetX(15);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell($cell1,40,'',1,0,'C');
    $pdf->Cell(80,40,'',1,0,'L');
    $pdf->Cell(80,40,'',1,1,'L');
    
    $pdf->Ln(-200);
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Tiba di              :',0,0,'L');
    $pdf->Cell(80,5,'Berangkat dari     :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Pada Tanggal   :',0,0,'L');
    $pdf->Cell(80,5,'Ke                        :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Kepala',0,0,'L');
    $pdf->Cell(80,5,'Pada Tanggal       :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'',0,0,'L');
    $pdf->Cell(80,5,'Kepala',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,10,'',0,0,'L');
    $pdf->Cell(80,10,'',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Times','U',11);
    $pdf->Cell(80,5,'(                               )',0,0,'C');
    $pdf->Cell(80,5,'(                                  )',0,1,'C');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Times','',11);
    $pdf->Cell(80,5,'NPP.                       ',0,0,'C');
    $pdf->Cell(80,5,'NPP.                       ',0,1,'C');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Tiba di              :',0,0,'L');
    $pdf->Cell(80,5,'Berangkat dari     :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Pada Tanggal   :',0,0,'L');
    $pdf->Cell(80,5,'Ke                        :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Kepala',0,0,'L');
    $pdf->Cell(80,5,'Pada Tanggal       :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'',0,0,'L');
    $pdf->Cell(80,5,'Kepala',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,10,'',0,0,'L');
    $pdf->Cell(80,10,'',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Times','U',11);
    $pdf->Cell(80,5,'(                               )',0,0,'C');
    $pdf->Cell(80,5,'(                                  )',0,1,'C');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Times','',11);
    $pdf->Cell(80,5,'NPP.                       ',0,0,'C');
    $pdf->Cell(80,5,'NPP.                       ',0,1,'C');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Tiba di              :',0,0,'L');
    $pdf->Cell(80,5,'Berangkat dari     :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Pada Tanggal   :',0,0,'L');
    $pdf->Cell(80,5,'Ke                        :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Kepala',0,0,'L');
    $pdf->Cell(80,5,'Pada Tanggal       :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'',0,0,'L');
    $pdf->Cell(80,5,'Kepala',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,10,'',0,0,'L');
    $pdf->Cell(80,10,'',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Times','U',11);
    $pdf->Cell(80,5,'(                               )',0,0,'C');
    $pdf->Cell(80,5,'(                                  )',0,1,'C');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Times','',11);
    $pdf->Cell(80,5,'NPP.                       ',0,0,'C');
    $pdf->Cell(80,5,'NPP.                       ',0,1,'C');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Tiba di              :',0,0,'L');
    $pdf->Cell(80,5,'Berangkat dari     :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Pada Tanggal   :',0,0,'L');
    $pdf->Cell(80,5,'Ke                        :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Kepala',0,0,'L');
    $pdf->Cell(80,5,'Pada Tanggal       :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'',0,0,'L');
    $pdf->Cell(80,5,'Kepala',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,10,'',0,0,'L');
    $pdf->Cell(80,10,'',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Times','U',11);
    $pdf->Cell(80,5,'(                               )',0,0,'C');
    $pdf->Cell(80,5,'(                                  )',0,1,'C');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Times','',11);
    $pdf->Cell(80,5,'NPP.                       ',0,0,'C');
    $pdf->Cell(80,5,'NPP.                       ',0,1,'C');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Tiba di              :',0,0,'L');
    $pdf->Cell(80,5,'Berangkat dari     :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Pada Tanggal   :',0,0,'L');
    $pdf->Cell(80,5,'Ke                        :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Kepala',0,0,'L');
    $pdf->Cell(80,5,'Pada Tanggal       :',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'',0,0,'L');
    $pdf->Cell(80,5,'Kepala',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,10,'',0,0,'L');
    $pdf->Cell(80,10,'',0,1,'L');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Times','U',11);
    $pdf->Cell(80,5,'(                               )',0,0,'C');
    $pdf->Cell(80,5,'(                                  )',0,1,'C');
    $pdf->SetX(15+$cell1);
    $pdf->SetFont('Times','',11);
    $pdf->Cell(80,5,'NPP.                       ',0,0,'C');
    $pdf->Cell(80,5,'NPP.                       ',0,1,'C');
}
$pdf->Output();
?>