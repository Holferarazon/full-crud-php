
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
}?>
<?php 

$title = 'Tambah Barang';

include 'layout/header.php';

// check apakah tombol tambah ditekan
if (isset($_POST['tambah'])){
    if (create_barang($_POST) > 0){
        echo"<script>
                alert('data barang berhasil ditambahkan');
                document.location.href = 'index.php';
                </script>";
    } else  {
        echo"<script>
                alert('data barang gagal ditambahkan');
                document.location.href = 'index.php';
                </script>";
    }
}

?>


<div class="container mt-5">
    <h1>Tambah barang</h1>
    <hr>
 
    <form action="" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama barang....." Required>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Barang</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="jumlah barang....."Required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga Barang</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="harga barang....."Required>
        </div>
        
        <button type="submit" name="tambah" class="btn btn-primary" style="float: right;"> <i class="fas fa-plus"></i> Tambah</button>
</form>

</div>

<?php include 'layout/footer.php'; ?>