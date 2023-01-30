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
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <title>E-SKPD</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/datepicker3.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

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
            value='';
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
                    <span class="icon-bar"></span>
                </button>
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
        <li class="active"><a href="permintaan.php"><em class="fa fa-plus">&nbsp;</em> Permintaan</a></li>
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
                <li class="active">Permintaan </li>
            </ol>
        </div><!--/.row-->

        <div class="col-sm-8 col-sm-offset-1 col-lg-10 col-lg-offset-1 main">
            <h3>Permintaan Pengajuan Perjalanan Dinas</h3>
            <form class="form-horizontal"  method="post" action="tambah_skpd.php" onkeypress="return disableEnterKey(event)">
                <div class="form-group">
                    <label for="no_skpd" class="col-lg-3 control-label">Nomor SKPD:</label>
                    <div class="col-lg-8">
                        <input name="no_skpd" class="form-control" type="text" value="" placeholder="Masukkan nomor SKPD" required="">
                        <input name="waktu" type="hidden" value="<?php echo date('Y-m-d H:i:s') ?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="id_kantor" class="col-lg-3 control-label">Pejabat yang memberikan perintah:</label>
                    <div class="col-lg-8">
                        <select name="id_kantor" class="form-control" required="">
                            <option value="">Silahkan pilih</option>
                            <?php 
                            $q = mysqli_query($connect, 'SELECT * FROM kantor k JOIN pegawai p ON k.knpp = p.npp ORDER BY id_kantor asc');
                            foreach ($q as $p) {
                                echo "<option value=$p[id_kantor]>$p[nama_kantor] / $p[nama_pegawai]</option>";
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="table-responsive form-group">
                    <label for="npp1" class="col-lg-3 control-label">Pegawai yang diperintah:</label>
                    <div class="col-lg-8">
                        <table class="table table-bordered" id="field">
                            <tr>
                            <td>
                                <select name="npp[]" class="form-control name_list" required="">
                                    <option value="">Silahkan pilih pegawai</option>
                                    <?php 
                                    $q = mysqli_query($connect, 'SELECT * FROM pegawai WHERE hak_akses = "pegawai" OR hak_akses = "kepala_cabang" ORDER BY npp asc');
                                    foreach ($q as $p) {
                                        echo "<option value=$p[npp]>$p[npp] / $p[nama_pegawai] / $p[pangkat] / $p[jabatan]</option>";
                                    } ?>
                                </select>
                            </td>
                            <td><button type="button" name="tmb" id="tmb" class="btn btn-success">+</button></td>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label for="maksud_perjalanan" class="col-lg-3 control-label">Maksud perjalanan dinas:</label>
                    <div class="col-lg-8">
                        <input name="maksud_perjalanan" class="form-control" type="text" value="" placeholder="Masukkan maksud perjalanan dinas" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="id_kendaraan" class="col-lg-3 control-label">Kendaraan yang digunakan:</label>
                    <div class="col-lg-8">
                        <select name="id_kendaraan" class="form-control" required="">
                            <option value="">Silahkan pilih jenis kendaraan</option>
                            <?php 
                            $q = mysqli_query($connect, 'SELECT * FROM kendaraan ORDER BY id_kendaraan asc');
                            foreach ($q as $p) {
                                echo "<option value=$p[id_kendaraan]>$p[jenis_kendaraan]</option>";
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tempat_berangkat" class="col-lg-3 control-label">Tempat berangkat:</label>
                    <div class="col-lg-8">
                        <input name="tempat_berangkat" class="form-control" type="text" value="Tanjungpinang" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tempat_tujuan" class="col-lg-3 control-label">Tempat tujuan:</label>
                    <div class="col-lg-8">
                        <input name="tempat_tujuan" class="form-control" type="text" value="" placeholder="Masukkan tempat tujuan" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lama_perjalanan" class="col-lg-3 control-label">Lama perjalanan dinas:</label>
                    <div class="col-lg-8">
                        <input name="lama_perjalanan" class="form-control" type="number" value="" placeholder="Masukkan lama perjalanan" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tgl_berangkat" class="col-lg-3 control-label">Tanggal berangkat:</label>
                    <div class="col-lg-8">
                        <input name="tgl_berangkat" class="form-control" type="date" value="" placeholder="Masukkan tanggal berangkat" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tgl_kembali" class="col-lg-3 control-label">Tanggal kembali:</label>
                    <div class="col-lg-8">
                        <input name="tgl_kembali" id="idtxt" class="form-control" type="date" value="" placeholder="Masukkan tanggal kembali" required="">
                    </div>
                    <div class="col-lg-0">
                        <input type="checkbox" id="idhck">
                    </div>
                </div>
                <div class="table-responsive form-group">
                    <label for="pengikut1" class="col-lg-3 control-label">Pengikut:</label>
                    <div class="col-lg-8">
                        <table class="table table-bordered" id="dynamic_field">
                            <tr>
                            <td><input type="text" name="pengikut[]" placeholder="Masukkan pengikut" class="form-control name_list" /></td>
                            <td><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <?php 
                        $strwaktu = strtotime(date('Y-m-d H:i:s'));
                        ?>
                        <input type="submit" name="kirim" class="btn btn-primary" onclick="window.open('new_tab.php?getwaktu=<?php echo $strwaktu ?>')">
                    </div>
                </div>
            </form>
            <div class="col-sm-12">
                <br/><br/>
                <p class="back-link">Copyright &copy; Rio Bagas Pamungkas</a></p>
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

<script>
    $(document).ready(function(){
        var j=1;
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

<script>
    $(document).ready(function(){
    var i = 100;
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