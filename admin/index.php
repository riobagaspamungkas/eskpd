<?php 
session_start();
include '../dbconfig.php';
$npp = ($_SESSION['id_eskpd']);
isset($_SESSION['id_eskpd']);
if(($_SESSION['eskpd']) !== 'admin'){
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../assets/images/logo.png">
	<title>E-SKPD</title>
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="../assets/css/datepicker3.css" rel="stylesheet">
	<link href="../assets/css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><i><span>E</span></i>-SKPD</a>
				
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="../assets/images/logo.png" class="img-thumbnail" alt="">
			</div>
			<div class="profile-usertitle">
				<?php 
				include '../dbconfig.php';
        		$data = mysqli_query($connect, "SELECT * FROM pegawai WHERE npp = '$npp'");
				while($row = mysqli_fetch_array($data)){
				?>
					<div class="profile-usertitle-name"><?php echo $row['nama_pegawai']; ?></div>
				<?php } ?>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li class="active"><a href="index.php"><em class="fa fa-home">&nbsp;</em> Beranda</a></li>
			<li><a href="permintaan.php"><em class="fa fa-plus">&nbsp;</em> Permintaan</a></li>
			<li><a href="data_skpd.php"><em class="fa fa-calendar">&nbsp;</em> Data SKPD</a></li>
			<li><a href="data_pegawai.php"><em class="fa fa-users">&nbsp;</em> Data Pegawai</a></li>
			<li><a href="data_kantor.php"><em class="fa fa-hospital-o">&nbsp;</em> Data Kepala Cabang</a></li>
			<li><a href="data_kendaraan.php"><em class="fa fa-automobile">&nbsp;</em> Kendaraan</a></li>
			<li><a href="../logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Beranda</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Selamat Datang</h1>
			</div>
		</div><!--/.row-->
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel panel-success bottom-buffer">
				<div class="row">
					<div class="panel-heading">
						<div class="col-xs-12 col-md-12 col-lg-12 col-md-offset-1">
							<strong>Mau Melakukan Pengajuan Surat Keterangan Perjalanan Dinas</strong>
						</div>
					</div>
					<div class="panel-body">
						<div class="col-xs-12 col-md-12 col-lg-12 col-md-offset-3">
							<i><a href="permintaan.php"><em class="btn btn-lg btn-primary"><i class="fa fa-plus"> Tambah Permintaan</em></a></i>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<p class="back-link">Copyright &copy; Rio Bagas Pamungkas</p>
			</div>
		</div>
	</div>	<!--/.main-->
	
	<script src="../assets/js/jquery-1.11.1.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/chart.min.js"></script>
	<script src="../assets/js/chart-data.js"></script>
	<script src="../assets/js/easypiechart.js"></script>
	<script src="../assets/js/easypiechart-data.js"></script>
	<script src="../assets/js/bootstrap-datepicker.js"></script>
	<script src="../assets/js/custom.js"></script>
</body>
</html>