<?php   
ob_start();
session_start();
require '../functions.php';

if(isset($_POST['login'])) {
  if(cek_login($_POST)){
    "<script>
    alert('Login Berhasil');
    </script>";
  } else {
    "<script>
    alert('Login Gagal');
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!-- Icon -->
  <link rel="shortcut icon" href="../../assets/icon/favicon.png" type="image/x-icon">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="../../assets/bootstrap-5.3.0/css/bootstrap.min.css">

  <!-- Link Font Awesome -->
  <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../../assets/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="../../assets/fontawesome/css/solid.min.css">

  <style> 
      body {
        overflow-x: hidden;
      }

      input {
        color:  #000;
      }

      .abu-login {
        background-color: #202020;
      }

      .form-control {
        color:  #000 !important ;
      }
  </style>
</head>
<body data-bs-theme="dark">
  <div class="row"><br> </div>
  <div class="row"><br> </div>
  <div class="container-fluid">
    <div class="col-6 offset-md-3 rounded mt-5 p-3  abu-login">
      <div class="d-flex justify-content-between align-items-center"><a href="../admin/login.php" style="color: white;"><i class="fa-sharp fa-solid fa-caret-left"></i></a><h1>Halaman Login Pustakawan</h1><a href="../anggota/login.php" style="color: white;"><i class="fa-sharp fa-solid fa-caret-right"></i></a></div>
      <hr>
      <div class="row">
        <div class="col-8 offset-md-2">
          <form class="row g-3" method="post" action="">
            <div class="col-md-12 mb-3 mt-4">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username ..">
            </div>
            <div class="col-md-12 mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password ..">
            </div>
            <div class="col-12 text-center ">
              <button type="submit" name="login" class="btn btn-primary">Sign in</button>
            </div>

            <div class="col-12 text-center">
              <p>Belum punya akun? <a href="registrasi.php">Registrasi</a> </p>
            </div>
          </form>
        </div>
      </div>

    </div>
    
  </div>
</body>
</html>