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
				<li class="active">Data Kantor </li>
				<li class="active">Edit Data Kantor </li>
			</ol>
		</div><!--/.row-->

		<div class="col-sm-9 col-sm-offset-1 col-lg-10 col-lg-offset-1 main">
        
        <h3>Edit Data Kantor</h3>
        <?php 
        include '../dbconfig.php';
        $id_kantor = $_GET['id_kantor'];
        $data = mysqli_query($connect, "SELECT * FROM kantor k JOIN pegawai p ON k.knpp = p.npp AND id_kantor = $id_kantor");
        while($row = mysqli_fetch_array($data)){
        ?>
            <form class="form-horizontal"  method="post" action="edit_kantor.php" onkeypress="return disableEnterKey(event)">
                <div class="form-group">
                    <label for="nama_kantor" class="col-lg-3 control-label">Nama Kantor Cabang:</label>
                    <div class="col-lg-8">
                        <input type="hidden" name="get_id_kantor" value="<?php echo $row['id_kantor']; ?>">
                        <input name="nama_kantor" class="form-control" type="text" value="<?php echo $row['nama_kantor']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="singkatan" class="col-lg-3 control-label">Singkatan Kantor Cabang:</label>
                    <div class="col-lg-8">
                        <input name="singkatan" class="form-control" type="text" value="<?php echo $row['singkatan']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="npp" class="col-lg-3 control-label">Kepala Kantor Cabang:</label>
                    <div class="col-lg-8">
                        <select name="npp" class="form-control">
                            <?php 
                            $a = mysqli_query($connect, 'SELECT * FROM pegawai WHERE hak_akses = "kepala_cabang" ORDER BY npp desc');
                            foreach ($a as $b) {
                                echo "<option value=$b[npp]";
                                if ( $row['npp'] == $b['npp'] ) echo' selected="selected"';
                                echo ">$b[nama_pegawai]</option>";
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input type="submit" name="update" class="btn btn-primary">
                        <a href="data_kantor.php" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</a>
                </div>
            </form>
        <?php } ?>
        </div>
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