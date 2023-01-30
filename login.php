<?php 
session_start();
include 'dbconfig.php';
if(isset($_SESSION['id_eskpd'])){
    if ($_SESSION['eskpd'] == 'admin') {
        header("Location:".$url.'/admin');
    }elseif ($_SESSION['eskpd'] !== 'admin') {
        header("Location:".$url.'/pegawai');
    }
    exit();
}
if(isset($_POST['tombollogin'])){
    $npp = $_POST['npp'];
    $password = $_POST['password'];
    $login = mysqli_query($connect, "SELECT * FROM pegawai WHERE npp='$npp' AND password=MD5('$password') LIMIT 1");
    if (mysqli_num_rows($login) > 0){
            $login_user = mysqli_fetch_array($login);
            $id_user = $login_user['npp'];
            $nama = $login_user['hak_akses'];
            $_SESSION['eskpd'] = $nama;
            $_SESSION['id_eskpd'] = $id_user;
            if ($nama == 'admin') {
                header("Location:".$url.'/admin');
            }elseif ($nama == 'pegawai') {
                header("Location:".$url.'/pegawai');
            }elseif ($nama == 'kepala_cabang') {
                header("Location:".$url.'/pegawai');
            }
        }
    else {
            echo "<script>alert('Username atau Password yang dimasukkan salah')</script>";
        }
}
?>
<html>
<head>
    <link rel="icon" type="image/png" href="assets/images/logo.png">
    <title>SKPD - Login</title>
    <link rel="stylesheet" href="assets-login/css/style.css">
</head>
<body>
    <div class="konten">
        <div class="kepala">
            <h2 class="judul">Sign In</h2>
        </div>
        <div class="artikel">
            <form id="login" method="post">
                <div class="grup">
                    <label for="email">Username</label>
                    <input type="text" name="npp" autofocus="" required="" placeholder="Masukkan NPP Anda">
                </div>
                <div class="grup">
                    <label for="password">Password</label>
                    <input type="password" name="password" required="" placeholder="Masukkan password Anda">
                </div>
                <div class="grup">
                    <input type="submit" name="tombollogin" value="Sign In">
                </div>
            </form>
        </div>
    </div>
</body>
</html>