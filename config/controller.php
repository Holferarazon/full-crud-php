<?php

error_reporting(E_ALL);
//fungsi menampilkan

function select($query)
{
    //panggil koneksi database
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// fungsi menambahkan data barang
function create_barang($post)
{
    global $db;

    $nama   = strip_tags($post['nama']);
    $jumlah   = strip_tags($post['jumlah']);
    $harga   = strip_tags($post['harga']);
    $barcode = rand(10000,999999);

    //query tambah data
    $query = "INSERT INTO barang VALUES(null,'$nama','$jumlah','$harga','$barcode', CURRENT_TIMESTAMP())";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi mengubah data barang
function update_barang($post)
{
    global $db;

    $id_barang = strip_tags($post['id_barang']);
    $nama   = strip_tags($post['nama']);
    $jumlah   = strip_tags($post['jumlah']);
    $harga   = strip_tags($post['harga']);

    //query ubah data
    $query = "UPDATE barang SET nama = '$nama', jumlah = '$jumlah', harga = '$harga' WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);  
}

// fungsi menghapus data barang
function delete_barang($id_barang)
{
    global $db;

    //query hapus data barang
    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menambahkan data mahasiswa
function create_mahasiswa($post)
{
    global $db;

    $nama           = strip_tags($post['nama']);
    $prodi          = strip_tags($post['prodi']);
    $jk             = strip_tags($post['jk']);
    $telpon        = strip_tags($post['telpon']);
    $alamat         =$post['alamat'];
    $email          = strip_tags($post['email']);
    $foto        = upload_file();

     // check upload foto
     if (!$foto) {
        return false;
     }
    //query tambah data
    $query = "INSERT INTO mahasiswa VALUES(null,'$nama','$prodi','$jk','$telpon', '$alamat', $email','$foto')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi mengganti data mahasiswa
function update_mahasiswa($post)
{
    global $db;

    $id_mahasiswa = strip_tags($post['id_mahasiswa']);
    $nama           = strip_tags($post['nama']);
    $prodi          = strip_tags($post['prodi']);
    $jk             = strip_tags($post['jk']);
    $telpon        = strip_tags($post['telpon']);
    $alamat         =$post['alamat'];
    $email          = strip_tags($post['email']);
    $fotolama           = upload_file();

    // check upload foto baru atau tidak
    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotolama;
     }else{
         $foto = upload_file();
     }

    //query ubah data
    $query = "UPDATE mahasiswa SET nama = '$nama', prodi = '$prodi', jk = '$jk', telpon = '$telpon', alamat = '$alamat', email = '$email', foto = '$foto' WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi mengupload file
function upload_file()
{
    $namaFile   = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];
    $tmpName    = $_FILES['foto']['tmp_name'];

    // check file yang diupload
    $extensifileValid = ['jpg', 'jpeg', 'png', 'jfif'];
    $extensifile      = explode('.', $namaFile);
    $extensifile      = strtolower(end($extensifile));

    // check format/extensi file
    if (!in_array($extensifile, $extensifileValid)) {
        // pesan gagal
        echo"<script>
                alert('Format File Tidak Valid');
                document.location.href = 'tambah-mahasiswa.php';
            </script>";
        die();
    }

    // check ukuran file 20 MB
    if ($ukuranFile > 20480000) {
        // pesan gagal
         echo"<script>
                alert('Ukuran File Max 2 MB');
                document.location.href = 'tambah-mahasiswa.php';
            </script>";
         die();
    }

    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    // pindahkan ke folder local
    move_uploaded_file($tmpName, 'asset/img/'. $namaFileBaru);
    return $namaFileBaru;
}
// fungsi menghapus data mahasiswa
function delete_mahasiswa($id_mahasiswa)
{
    global $db;
    
    //Ambil Foto sesuai data yang dipilih
    $foto = select("SELECT FROM mahasiswa WHERE  id_mahasiswa = $id_mahasiswa")[0];
    unlink("asset/img/". $foto['foto']);

    //query hapus data mahasiswa
    $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function create_akun($post){
    global $db;

    $nama = strip_tags($post["nama"]);
    $username = strip_tags($post["username"]);
    $email = strip_tags($post["email"]);
    $password = strip_tags($post["password"]);
    $level = strip_tags($post["level"]);

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Query tambah data
    $query = "INSERT INTO akun (nama, username, email, password, level) VALUES ('$nama', '$username', '$email', '$password', '$level')";

    // Eksekusi query dan cek kesalahan
    if (mysqli_query($db, $query)) {
        return mysqli_affected_rows($db);
    } else {
        // Menampilkan pesan kesalahan jika query gagal
        echo "Error: " . mysqli_error($db);
        return 0;
    }
}

// fungsi menghapus data akun
function delete_akun($id_akun)
{
    global $db;

    //query hapus data akun
    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function update_akun($post){
    global $db;

    $id_akun = isset($post['id_akun']) ? strip_tags($post['id_akun']) : '';
    $nama = isset($post["nama"]) ? strip_tags($post["nama"]) : '';
    $username = isset($post["username"]) ? strip_tags($post["username"]) : '';
    $email = isset($post["email"]) ? strip_tags($post["email"]) : '';
    $password = isset($post["password"]) ? strip_tags($post["password"]) : '';
    $level = isset($post["level"]) ? strip_tags($post["level"]) : '';

    if (empty($id_akun) || empty($nama) || empty($username) || empty($email) || empty($password) || empty($level)) {
        return false; // atau tampilkan pesan error
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query tambah data
    $query = "UPDATE akun SET nama = '$nama', username = '$username', email = '$email', password = '$password', level = '$level' WHERE id_akun = $id_akun";

    // Debug query
    echo $query;

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
