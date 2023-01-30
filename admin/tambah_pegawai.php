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
<script language="JavaScript">
    function disableEnterKey(e){
        var keycode;
        if (window.event) {
            keycode = window.event.keyCode;
        }else{
            key = e.witch;
        }
        if (window.event.keyCode == 13 ) {
            return false;
        }else{
            return true;
        }
    }
</script>
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
				<li class="active">Data Pegawai</li>
                <li class="active">Tambah Pegawai</li>
			</ol>
		</div><!--/.row-->

		<div class="col-sm-9 col-sm-offset-1 col-lg-10 col-lg-offset-1 main">
            <h3>Tambah Data Pegawai</h3>
            <form class="form-horizontal"  method="post" action="t_pegawai.php" onkeypress="return disableEnterKey(event)">
                <div class="form-group">
                    <label for="npp" class="col-lg-3 control-label">Nomor NPP:</label>
                    <div class="col-lg-8">
                        <input name="npp" class="form-control" type="text" value="" placeholder="Masukkan nomor NPP" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-lg-3 control-label">Password:</label>
                    <div class="col-lg-8">
                        <input name="password" class="form-control" type="password" value="" placeholder="Masukkan password" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="hak_akses" class="col-lg-3 control-label">Status:</label>
                    <div class="col-lg-8">
                        <select name="hak_akses" class="form-control" required="">
                            <option value="">Silahkan pilih</option>
                            <option value="admin">Admin</option>
                            <option value="pegawai">Pegawai</option>
                            <option value="kepala_cabang">Kepala Cabang</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_pegawai" class="col-lg-3 control-label">Nama Pegawai:</label>
                    <div class="col-lg-8">
                        <input name="nama_pegawai" class="form-control" type="text" value="" placeholder="Masukkan nama pegawai" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pengkat" class="col-lg-3 control-label">Pangkat:</label>
                    <div class="col-lg-8">
                        <input name="pangkat" class="form-control" type="text" value="" placeholder="Masukkan pangkat" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="jabatan" class="col-lg-3 control-label">Jabatan:</label>
                    <div class="col-lg-8">
                        <input name="jabatan" class="form-control" type="text" value="" placeholder="Masukkan jabatan" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin" class="col-lg-3 control-label">Jenis Kelamin:</label>
                    <div class="col-lg-8">
                        <select name="pejabat" class="form-control" required="">
                            <option value="">Silahkan pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="konseptor" class="col-lg-3 control-label">Konseptor:</label>
                    <div class="col-lg-8">
                        <input name="konseptor" class="form-control" type="text" value="" placeholder="Masukkan konseptor">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input type="submit" name="kirim" class="btn btn-primary">
                        <a href="data_pegawai.php" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</a>
                    </div>
                </div>
            </form>
			<div class="col-sm-12">
				<br/><br/>
				<p class="back-link">Modified by &copy; Rio Bagas Pamungkas</a></p>
			</div>
		</div><!--/.row-->
	</div><!--/.main-->
	
	<script src="../assets/js/jquery-1.11.1.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/chart.min.js"></script>
	<script src="../assets/js/chart-data.js"></script>
	<script src="../assets/js/easypiechart.js"></script>
	<script src="../assets/js/easypiechart-data.js"></script>
	<script src="../assets/js/bootstrap-datepicker.js"></script>
	<script src="../assets/js/custom.js"></script>
	<script type="text/javascript">
        $(function () {
            $('#tanggal').datepicker();
        });
    </script>
</body>
</html>