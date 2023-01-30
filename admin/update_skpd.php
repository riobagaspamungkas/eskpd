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
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript">
    $(function () {
        $("#idhck").change(function(){
        var st = this.checked;
        if(st){
            $("#idtxt").prop("disabled", true);
        }else{
            $("#idtxt").prop("disabled", false);
        }
        });
    });
</script>
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
                <li class="active">Data SKPD </li>
                <li class="active">Edit Data </li>
            </ol>
        </div><!--/.row-->

        <div class="col-sm-9 col-sm-offset-1 col-lg-10 col-lg-offset-1 main">
            
            <h3>Edit Surat Keterangan Perjalanan Dinas</h3>
            <?php 
            include '../dbconfig.php';
            $edit = $_GET['edit'];
            $waktu = date('Y-m-d H:i:s',$edit);
            $data = mysqli_query($connect, "SELECT * FROM skpd s JOIN pegawai p ON s.npp1 = p.npp AND s.waktu='$waktu'");
            while($row = mysqli_fetch_array($data)){
            ?>
                <form class="form-horizontal"  method="post" action="edit_skpd.php" onkeypress="return disableEnterKey(event)">
                    <div class="form-group">
                        <label for="no_skpd" class="col-lg-3 control-label">Nomor SKPD:</label>
                        <div class="col-lg-8">
                            <input type="hidden" name="get_waktu" value="<?php echo $row['waktu']; ?>">
                            <input name="no_skpd" class="form-control" type="text" value="<?php echo $row['no_skpd']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_kantor" class="col-lg-3 control-label">Pejabat yang memberikan perintah:</label>
                        <div class="col-lg-8" >
                            <select name="id_kantor" class="form-control">
                            <?php 
                            $a = mysqli_query($connect, 'SELECT * FROM kantor ORDER BY id_kantor asc');
                            foreach ($a as $b) {
                                echo "<option value=$b[id_kantor]";
                                if ( $row['id_kantor'] == $b['id_kantor'] ) echo' selected="selected"';
                                echo ">$b[nama_kantor]</option>";
                            } ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="npp" class="col-lg-3 control-label">Pegawai yang diperintah:</label>
                        <div class="col-lg-8">
                            <table class="table table-bordered" id="field">
                                <?php
                                $l = 0;
                                $k = 0;
                                for ($i=0; $i < 5; $i++) {
                                    $k = $i + 1;
                                    if ($row['npp'.$k]) {
                                    $l += 1;
                                    }
                                }
                                $d1 = strlen($row['npp1']);
                                if ($d1 > 0) {
                                    echo "<tr>
                                    <td>";
                                    ?>
                                    <select name="npp[]" class="form-control">
                                    <?php 
                                    $a = mysqli_query($connect, 'SELECT * FROM pegawai WHERE hak_akses = "pegawai" OR hak_akses = "kepala_cabang" ORDER BY npp asc');
                                    foreach ($a as $b) {
                                        echo "<option value=$b[npp]";
                                        if ( $row['npp1'] == $b['npp'] ) echo' selected="selected"';
                                        echo ">$b[npp] / $b[nama_pegawai] / $b[pangkat] / $b[jabatan]</option>";
                                    } ?>
                                    </select>
                                    </td><td><button type='button' name='tmb' id='tmb' class='btn btn-success'>+</button></td>
                                </tr> <?php
                                }
                                for ($j = 2; $j <= $l; $j++) {
                                    $v = $row['npp'.$j];
                                    echo "<tr id='row$j'>
                                    <td>";
                                    ?>
                                    <select name="npp[]" class="form-control">
                                    <?php 
                                    $a = mysqli_query($connect, 'SELECT * FROM pegawai WHERE hak_akses = "pegawai" OR hak_akses = "kepala_cabang" ORDER BY npp asc');
                                    foreach ($a as $b) {
                                        echo "<option value=$b[npp]";
                                        if ( $row['npp'.$j] == $b['npp'] ) echo' selected="selected"';
                                        echo ">$b[npp] / $b[nama_pegawai] / $b[pangkat] / $b[jabatan]</option>";
                                    } ?>
                                    </select>
                                    </td><td><button type='button' name='remove' id='<?php echo $j ?>' class='btn btn-danger btn_remove'>X</button></td></tr>
                                <?php }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="maksud_perjalanan" class="col-lg-3 control-label">Maksud perjalanan dinas:</label>
                        <div class="col-lg-8">
                            <input name="maksud_perjalanan" class="form-control" type="text" value="<?php echo $row['maksud_perjalanan']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_kendaraan" class="col-lg-3 control-label">Kendaraan yang digunakan:</label>
                        <div class="col-lg-8" >
                            <select name="id_kendaraan" class="form-control" value="<?php echo $row['kendaraan']; ?>">
                            <?php 
                            $a = mysqli_query($connect, 'SELECT * FROM kendaraan ORDER BY id_kendaraan asc');
                            foreach ($a as $b) {
                            echo "<option value=$b[id_kendaraan]";
                            if ( $row['id_kendaraan'] == $b['id_kendaraan'] ) echo' selected="selected"';
                            echo ">$b[jenis_kendaraan]</option>";
                            } ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tempat_berangkat" class="col-lg-3 control-label">Tempat berangkat:</label>
                        <div class="col-lg-8">
                            <input name="tempat_berangkat" class="form-control" type="text" value="<?php echo $row['tempat_berangkat']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tempat_tujuan" class="col-lg-3 control-label">Tempat tujuan:</label>
                        <div class="col-lg-8">
                            <input name="tempat_tujuan" class="form-control" type="text" value="<?php echo $row['tempat_tujuan']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lama_perjalanan" class="col-lg-3 control-label">Lama perjalanan dinas:</label>
                        <div class="col-lg-8">
                            <input name="lama_perjalanan" class="form-control" type="number" value="<?php echo $row['lama_perjalanan']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_berangkat" class="col-lg-3 control-label">Tanggal berangkat:</label>
                        <div class="col-lg-8">
                            <input name="tgl_berangkat" class="form-control" type="date" value="<?php echo $row['tgl_berangkat']; ?>">
                        </div>
                    </div>
                    <?php 
                    if ($row['tgl_kembali'] == 0) {
                        $disable = 'disabled';
                        $check = 'checked';
                    }else{
                        $disable = '';
                        $check = '';
                    }
                    ?>
                    <div class="form-group">
                        <label for="tgl_kembali" class="col-lg-3 control-label">Tanggal kembali:</label>
                        <div class="col-lg-8">
                            <input name="tgl_kembali" id="idtxt" class="form-control" type="date" value="<?php echo $row['tgl_kembali']; ?>" <?php echo $disable ?> >
                        </div>
                        <div class="col-lg-0">
                            <input type="checkbox" id="idhck" <?php echo $check ?> >
                        </div>
                    </div>
                    <div class="table-responsive form-group">
                        <label for="pengikut1" class="col-lg-3 control-label">Pengikut:</label>
                        <div class="col-lg-8">
                            <table class="table table-bordered" id="dynamic_field">
                                <?php
                                $c1 = strlen($row['pengikut1']);
                                $h = 0;
                                $m = 0;
                                for ($j=0; $j < 5; $j++) {
                                    $m = $j + 1;
                                    if ($row['pengikut'.$m]) {
                                    $h += 1;
                                    }
                                }
                                if ($c1 == 0) {
                                    echo "<tr>
                                    <td><input type='text' name='pengikut[]' placeholder='Masukkan pengikut' class='form-control name_list' /></td><td><button type='button' name='add' id='add' class='btn btn-success'>+</button></td></tr>";
                                }elseif ($c1 >0) {
                                    echo "<tr>
                                    <td><input type='text' name='pengikut[]' value='$row[pengikut1]' class='form-control name_list' /></td><td><button type='button' name='add' id='add' class='btn btn-success'>+</button></td></tr>";
                                }
                                for ($r = 2; $r <= $h; $r++) {
                                    $v = $row['pengikut'.$r];
                                    $s = 100 + $r ;
                                    echo "<tr id='row$s'>
                                    <td><input type='text' name='pengikut[]' value='$v' class='form-control name_list'></td><td><button type='button' name='remove' id='$s' class='btn btn-danger btn_remove'>X</button></td></tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <input type="submit" name="update" class="btn btn-primary">
                            <a href="data_skpd.php" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</a>
                        </div>
                    </div>
                </form>
            <?php } ?>
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

<?php
$data = mysqli_query($connect, "SELECT * FROM skpd WHERE waktu = '$waktu'");
while($row = mysqli_fetch_array($data)){
?>
    <script>
        $(document).ready(function(){
            var j = <?php echo $l ?>;
            $('#tmb').click(function(){
                j++;
                $('#field').append('<tr id="row'+j+'"><td><select name="npp[]" class="form-control name_list col-lg-5"><option value="">Silahkan pilih pegawai</option> <?php $q = mysqli_query($connect, 'SELECT * FROM pegawai WHERE hak_akses = "pegawai" OR hak_akses = "kepala_cabang" ORDER BY npp asc'); foreach ($q as $p) {echo "<option value=$p[npp]>$p[npp] / $p[nama_pegawai] / $p[pangkat] / $p[jabatan]</option>";}?></select></td><td><button type="button" name="remove" id="'+j+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });
            
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id"); 
                $('#row'+button_id+'').remove();
            });  
        });
    </script>
<?php 
}
$data = mysqli_query($connect, "SELECT * FROM skpd WHERE waktu = '$waktu'");
while($row = mysqli_fetch_array($data)){
?>
    <script>
        $(document).ready(function(){
            var k = 100 + <?php echo $h?>;
            var i = <?php echo $k ?>;
            $('#add').click(function(){
                i++;
                $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="pengikut[]" placeholder="Masukkan pengikut" class="form-control name_list col-lg-5" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });
            
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id"); 
                $('#row'+button_id+'').remove();
            });
        });
    </script>
<?php } ?>