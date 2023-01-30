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
			<li><a href="index.php"><em class="fa fa-home">&nbsp;</em> Beranda</a></li>
			<li><a href="permintaan.php"><em class="fa fa-plus">&nbsp;</em> Permintaan</a></li>
			<li><a href="data_skpd.php"><em class="fa fa-calendar">&nbsp;</em> Data SKPD</a></li>
			<li><a href="data_pegawai.php"><em class="fa fa-users">&nbsp;</em> Data Pegawai</a></li>
			<li><a href="data_kantor.php"><em class="fa fa-hospital-o">&nbsp;</em> Data Kepala Cabang</a></li>
			<li class="active"><a href="data_kendaraan.php"><em class="fa fa-automobile">&nbsp;</em> Kendaraan</a></li>
			<li><a href="../logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Data Kendaraan</li>
			</ol>
		</div><!--/.row-->
		
		<div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default panel-table">
				<div class="panel-heading">
					<div class="row">
						<div class="col col-xs-6">
							<h3 class="panel-title">Data Jenis Kendaraan</h3>
						</div>
						<div class="col-xs-3 col-md-3 col-lg-3">
							<a href="tambah_kendaraan.php" class="btn btn-default"><em class="fa fa-plus"></em> Tambah Jenis Kendaraan</a>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered table-list">
						<thead>
							<tr>
								<th>No</th>
								<th>Jenis Kendaraan</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1;
								include '../dbconfig.php';
								$tampil = mysqli_query($connect, "SELECT * FROM kendaraan order by id_kendaraan desc");
							foreach ($tampil as $row){
								echo "<tr>
								<td>".$no."</td>
								<td>".$row['jenis_kendaraan']."</td> " ?>
								<td align="center">
								<a href="update_kendaraan.php?id_kendaraan=<?php echo $row['id_kendaraan']; ?>" class="btn btn-primary"><em class="fa fa-pencil"></em></a>
								<a data-href="delete_kendaraan.php?id_kendaraan=<?php echo $row['id_kendaraan']; ?>" data-toggle='modal' data-target='#konfirmasi_hapus' class="btn btn-danger"><em class="fa fa-trash"></em></a>
								</td>
								</tr>
							<?php
							$no++;
							}?>
						</tbody>
					</table>
				</div>
				<div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body">
								<b>Anda yakin ingin menghapus data ini ?</b><br><br>
								<a class="btn btn-danger btn-ok"> Hapus</a>
								<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<p class="back-link">Copyright &copy; Rio Bagas Pamungkas</p>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->

	<script src="../assets/js/jquery-1.11.1.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/chart.min.js"></script>
	<script src="../assets/js/chart-data.js"></script>
	<script src="../assets/js/easypiechart.js"></script>
	<script src="../assets/js/easypiechart-data.js"></script>
	<script src="../assets/js/bootstrap-datepicker.js"></script>
	<script src="../assets/js/custom.js"></script>
	<script src="../assets/tables/jquery.dataTables.js"></script>
	<script src="../assets/tables/dataTables.bootstrap.js"></script>
	<script src="../assets/tables/dataTables.bootstrap.css"></script>
	<script>
		$(".table").DataTable();
	</script>
	<script type="text/javascript">
		//Hapus Data
		$(document).ready(function() {
			$('#konfirmasi_hapus').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
			});
		});
	</script>
</body>
</html>