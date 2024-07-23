<?php

session_start();
//Membatasi halaman sebelum login
if(!isset($_SESSION["login"])){
    echo "<script>
    alert('anda belum login');
    document.location.href = 'login.php';
    </script>
    ";
    exit;
}
//kosongkan session user login
$_SESSION = [];

session_unset();
session_destroy();
header("Location: login.php");