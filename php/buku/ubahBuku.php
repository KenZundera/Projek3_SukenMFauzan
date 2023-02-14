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

if(isset($_POST['action']) && $_POST['action'] == 'minus') {
    $book_id = $_POST['book_id'];
    // $stokBaru = $_POST['stokBuku'] - 1;
    $select = $db->rowCOUNT("SELECT * FROM detailbuku WHERE idBuku = $book_id");

    if ($select < 0) {
        return false;
    } else {
        // $query = "UPDATE buku SET stokBuku = $stokBaru WHERE idBuku = $book_id";
        // $result = $db->runSQl($query);
    $query = "SELECT DISTINCT detailbuku.idDetailBuku, buku.idBuku, buku.judulBuku, buku.idkategori, buku.pengarang, buku.penerbit, buku.deskripsi FROM buku                   
    INNER JOIN kategori ON buku.idkategori=kategori.idkategori                  
    LEFT JOIN detailbuku ON buku.idBuku=detailbuku.idBuku WHERE status='Ada' AND detailbuku.idBuku= $book_id ORDER BY detailbuku.idDetailBuku DESC LIMIT 1";
    $idDihapus  = $db->getITEM($query);
    $query = "DELETE FROM detailbuku WHERE idDetailBuku=" . $idDihapus['idDetailBuku'];
    $result = $db->runSQL($query);

    return $result;
    }
    if ($result > 0) {
        echo mysqli_affected_rows($db->conn);
        echo $idDihapus['idDetailBuku'];
    } else {
        echo "Update failed";
    }
}


if(isset($_POST['action']) && $_POST['action'] == 'add') {
    $book_id = $_POST['book_id'];
    $select = $db->rowCOUNT("SELECT * FROM detailbuku WHERE idBuku = $book_id");


    if ($select < 0) {
        return false;
    } else {
        // $query = "UPDATE buku SET stokBuku = $stokBaru WHERE idBuku = $book_id";
        // $result = $db->runSQl($query);
    $query = "INSERT INTO detailbuku VALUES ('', $book_id,'Ada')";
    $result = $db->runSQL($query);
    return $result;
    }
    if ($result > 0) {
        echo mysqli_affected_rows($db->conn);
    } else {
        echo "Update failed";
    }
}

// Jika session login tidak ada maka kembali ke halaman login
if (!isset($_SESSION['login'])) {
    header('location: login.php');
    exit();
}

$idBuku = $_GET['idBuku'];

$buku = $db->getALL("SELECT * FROM buku WHERE idBuku = $idBuku")[0];

if (isset($_POST['ubah'])) {
    $_SESSION['login'] = true;
    if ($db->ubahBuku($_POST) > 0) {
        echo "<script>
        alert('data berhasil diubah');
        document.location.href = 'buku.php';
        </script>";
    } else {
        echo "<script>
        alert('data gagal diubah');
                    // document.location.href = 'buku.php';
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
    <title>Halaman Ubah Buku</title>

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

                <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="idBuku" id="idBuku" required value="<?= $buku[
                        'idBuku'
                        ] ?>" hidden>
                        <input type="text" name="gambarLama" value="<?= $buku["gambarBuku"]; ?>" hidden>
                        <div class="col-md-12">
                            <label for="idkategori" class="form-label">Kategori</label>
                            <select name="idkategori" id="idkategori" class="form-select">
                                <?php
                                $showKategori = $db->getALL("SELECT * FROM kategori");
                                foreach($showKategori as $dataKategori ) :
                                    ?>
                                    <!-- make dropdown select for UPDATE idKategori -->
                                    <option value="<?= $dataKategori['idkategori']; ?>" <?php if($buku['idKategori'] == $dataKategori['idkategori']){echo "SELECTED";} ?>><?= $dataKategori['kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="judulBuku" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" name="judulBuku" id="judulBuku" value="<?= $buku['judulBuku']; ?>" required placeholder="Masukkan Judul Buku ..">
                        </div>

                        <div class="col-md-12">
                            <label for="pengarang" class="form-label">Pengarang</label>
                            <input type="text" class="form-control" name="pengarang" id="pengarang" value="<?= $buku['pengarang']; ?>" required placeholder="Masukkan Pengarang ..">
                        </div>
                        <div class="col-md-12">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" id="penerbit" value="<?= $buku['penerbit']; ?>" required placeholder="Masukkan Penerbit ..">
                        </div>
                        <div class="col-md-12">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" name="deskripsi" id="deskripsi" value="<?= $buku['deskripsi']; ?>" required placeholder="Masukkan Deskripsi ..">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="gambarBuku" class="form-label">Gambar Buku</label><br>
                            <img src="../../assets/img/<?= $buku['gambarBuku']; ?>" alt="Preview Gambar" id="preview" width="40" class="mb-1">
                            <input type="file" class="form-control" name="gambarBuku" id="gambarBuku" value="<?= $buku['gambarBuku']; ?>">
                        </div>
                        <div class="col-6 offset-md-4">
                            <a href="buku.php" class="btn btn-danger">Kembali</a>
                            <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
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
</script>
</body>
</html>

