<?php   
ob_start();
session_start();
require_once 'dbcontroller.php';
$db = new DBConnection();

if(isset($_POST['login'])) {
  if(cek_login($_POST)){
    echo "<script>
    alert('Login Berhasil');
    </script>";
  } else {
    echo "<script>
    alert('Login Gagal');
    </script>";
    var_dump($_POST);
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
  <link rel="shortcut icon" href="assets/icon/favicon.png" type="image/x-icon">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="../assets/bootstrap-5.3.0/css/bootstrap.min.css">
</head>
<body data-bs-theme="dark">
  <div class="container-fluid">
    <div class="col-6 offset-md-3 shadow rounded mt-5 p-3">
      <center><h1>Halaman Login ADMIN</h1></center>
      <hr>
      <div class="row">
        <div class="col-8 offset-md-2">
          <form class="row g-3" method="post" action="">
            <div class="col-md-6">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="username">
            </div>
            <div class="col-md-6">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="col-6 offset-md-4">
              <button type="submit" name="login" class="btn btn-primary">Sign in</button>
            </div>
          </form>
        </div>
      </div>

    </div>
    
  </div>
</body>
</html>