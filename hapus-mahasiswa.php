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

//menerima id_mahasiswa
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

if(delete_mahasiswa($id_mahasiswa) > 0){
    echo "<script>
        alert('data mahasiswa berhasil dihapus');
        document.location.href = 'mahasiswa.php';   
        </script>
    ";
}else{
    echo "<script>
    alert('data gagal dihapus');
    document.location.href = 'mahasiswa.php';
    </script>";
}

