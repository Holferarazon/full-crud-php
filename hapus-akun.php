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

// menerima id_barang yang dipilih pengguna
$id_akun = (int)$_GET['id_akun'];

if (delete_akun($id_akun) > 0){
    echo"<script>
            alert('data akun berhasil dihapus');
            document.location.href = 'crud-modal.php';
          </script>";
} else  {
    echo"<script>
            alert('data akun gagal dihapus');
            document.location.href = 'crud-modal.php';
         </script>";
}
