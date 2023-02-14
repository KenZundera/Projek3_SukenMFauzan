<?php
session_start();
require_once '../dbcontroller.php';
$db = new DBConnection();

if($_SESSION['level'] != 'Admin') {
    echo "<script>
    alert('Anda bukan admin!');
    document.location.href = '../home/index.php';
    </script>";
    exit;
}

// Jika session login tidak ada maka kembali ke halaman login
if (!isset($_SESSION['login'])) {
    header('location: login.php');
    exit();
}

if (isset($_POST['tambah'])) {        
    $_SESSION['login'] = true;
    if ($db->tambahBuku($_POST) > 0) {
        echo "<script>
        alert('data berhasil ditambah');
        document.location.href = 'buku.php';
        </script>";
    } else {
        echo "<script>
        alert('data gagal ditambah');
                    // document.location.href = 'index.php';
        </script>";
        var_dump($_POST);
        var_dump($_FILES);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Buku</title>

    <!-- Link Favicon -->
    <link rel="shortcut icon" href="../../assets/icon/favicon.png" type="image/x-icon">

    <!-- Link Bootstrap -->
    <link rel="stylesheet" href="../../assets/bootstrap-5.3.0/css/bootstrap.min.css">

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

    .form-select {
        color:  #000 !important ;
    }

</style>
</head>
<body data-bs-theme="dark">
    <div class="container-fluid mb-5">
        <div class="col-6 offset-md-3 shadow rounded mt-5 p-3">
          <center><h1>Halaman Peminjaman Buku</h1></center>
          <hr>
          <div class="row">
            <div class="col-8 offset-md-2">
                <form class="row g-3" method="post" action="" enctype="multipart/form-data">

                    <div class="col-md-12">
                     <label for="idkategori" class="form-label">Kategori</label>
                     <select name="idkategori" id="idkategori" class="form-select">
                        <option disabled selected>Pilih Kategori</option>
                        <?php
                        $show = $db->getALL("SELECT * FROM kategori");
                        foreach ($show as $data) { 
                            ?>
                            <option value="<?= $data['idkategori']; ?>"><?= $data['kategori']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="judulBuku" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" name="judulBuku" id="judulBuku" required placeholder="Masukkan Judul Buku ..">
                </div>

                <div class="col-md-12">
                    <label for="pengarang" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" name="pengarang" id="pengarang" required placeholder="Masukkan Pengarang ..">
                </div>
                <div class="col-md-12">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" name="penerbit" id="penerbit" required placeholder="Masukkan Penerbit ..">
                </div>
                <div class="col-md-12">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" name="deskripsi" id="deskripsi" required placeholder="Masukkan Deskripsi ..">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="gambarBuku" class="form-label">Gambar Buku</label>
                    <img src="#" alt="Preview Gambar" id="preview" style="display: none;" width="75">
                    <input type="file" class="form-control" name="gambarBuku" id="gambarBuku">
                </div>
                <div class="col-6 offset-md-4">
                    <a href="buku.php" class="btn btn-danger">Kembali</a>
                    <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


<script>
    document.getElementById("gambarBuku").onchange = function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById("preview").src = e.target.result;
            document.getElementById("preview").style.display = "block";
        };

        reader.readAsDataURL(this.files[0]);
    }

        // document.querySelector('#gambarBuku'). addEventListener("change", function() {
        //     if (this.files.length > 0 ) {
        //         document.querySelector("label[for='gambarBuku']").innerHTML = this.files[0].name;
        //     }
        // });
</script>
</body>
</html>

