<?php
session_start();

include 'config/app.php';

//check apakah tombol login ditekan 
if(isset($_POST['login']))
{
    //ambil input username dan password
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    //check username
    $result = mysqli_query($db, "SELECT * FROM akun WHERE username = '$username'");

    //jika ada usernya
    if(mysqli_num_rows($result) == 1 ){
    //check passwordnya
    $hasil = mysqli_fetch_assoc($result);
  

      if(password_verify($password, $hasil['password'])){
          // set session
          $_SESSION['login']      = true;
          $_SESSION['id_akun']    = $hasil['id_akun'];
          $_SESSION['nama']   = $hasil['nama'];
          $_SESSION['username'] = $hasil['username'];
          $_SESSION['email'] = $hasil['email'];
          $_SESSION['level'] = $hasil['level'];

          //jika login benar pindah ke index php
          header("Location: index.php");
          exit;

          
      }
    }
//jika tidak ada usernya/login salah
$error = true;
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Signin Template · Bootstrap v5.0</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
        crossorigin="anonymous">
  <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
  <meta name="theme-color" content="#7952b3">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <link href="asset/css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
<main class="form-signin">
  <form action="" method="POST">
    <img class="mb-4" src="asset/img/p3k.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Admin Login</h1>

    <?php if (isset($error)) : ?>
    <div class="alert alert-danger">
      Login failed! Please check your username and password.
    </div>
    <?php endif; ?>

    <div class="form-floating">
      <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" name="login" type="submit">Login</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</main>
</body>
</html>
