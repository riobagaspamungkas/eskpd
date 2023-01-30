<?php
session_start();
unset($_SESSION['eskpd']);
unset($_SESSION['id_eskpd']);
header('location:login.php');