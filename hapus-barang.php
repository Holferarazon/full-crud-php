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
?>
<?php
include 'config/app.php';

// menerima di_barang yang dipilih pengguna
$id_barang = (int)$_GET['id_barang'];

if (delete_barang($id_barang) > 0){
    echo"<script>
            alert('data barang berhasil dihapus');
            document.location.href = 'index.php';
          </script>";
} else  {
    echo"<script>
            alert('data barang gagal dihapus');
            document.location.href = 'index.php';
         </script>";
}