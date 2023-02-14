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

if(isset($_POST['tambah'])) {
  if($db->tambahPeminjaman($_POST) > 0 ){
    echo "<script>
    alert('Tambah data peminjaman berhasil!');
    document.location.href= 'peminjaman.php';
    </script>";
} else {
    echo "<script>
    alert('Tambah data peminjaman Gagal!');
    // document.location.href= 'peminjaman.php';
    </script>";
    var_dump($_POST);
    var_dump($db->tambahPeminjaman($_POST));
}
}

$admin = $db->getALL("SELECT * FROM admin ORDER BY namaAdmin ASC");
$anggota = $db->getALL("SELECT * FROM anggota ORDER BY namaAnggota ASC");
// $buku = $db->getALL("SELECT DISTINCT buku.idBuku, buku.judulBuku, buku.deskripsi
//     FROM buku
//     INNER JOIN detailbuku ON buku.idBuku = detailbuku.idBuku
//     WHERE detailbuku.status = 'Ada'");
$buku = $db->getALL("SELECT DISTINCT buku.idBuku, buku.judulBuku, buku.deskripsi, detailbuku.idDetailBuku
    FROM detailbuku
    INNER JOIN buku ON detailbuku.idBuku = buku.idBuku
    WHERE detailbuku.status = 'Ada'
    GROUP BY buku.idBuku DESC;
    ");

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Halaman Peminjaman Buku</title>

      <!-- Icon -->
      <link rel="shortcut icon" href="../../assets/icon/favicon.png" type="image/x-icon">

      <!-- Bootstrap -->
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
  <div class="container-fluid">
    <div class="col-6 offset-md-3 shadow rounded mt-5 p-3">
      <center><h1>Halaman Peminjaman Buku</h1></center>
      <hr>
      <div class="row">
        <div class="col-8 offset-md-2">
            <form class="row g-3" method="post" action="">

                <div class="col-md-12">
                  <label for="idAdmin" class="form-label">Nama Admin</label>
                  <select name="idAdmin" id="idAdmin" class="form-select">
                    <option disabled selected>Pilih Admin</option>
                    <?php foreach ($admin as $data) : ?>
                       <option value="<?= $data['idAdmin'] ?>"><?= $data['namaAdmin'] ?></option>
                   <?php endforeach ?>
               </select>
           </div>

           <div class="col-md-12">
             <label for="idAnggota">Anggota</label><br>
             <select name="idAnggota" id="idAnggota" class="form-select">
                <option disabled selected>Pilih Anggota</option>
                <?php foreach ($anggota as $data) : ?>
                    <option value="<?php echo $data['idAnggota'] ?>"><?php echo $data['namaAnggota'] ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="col-md-12">
            <label for="judulBuku">Judul Buku</label><br>
            <select name="judulBuku" id="judulBuku" class="chzn-select form-select">
                <option disabled selected>Pilih Buku</option>
                <?php foreach ($buku as $data) : ?>
                    <option value="<?= $data['idDetailBuku'] ?>">
                        <?= $data['judulBuku'] .
                        " - " .
                        $data['deskripsi']; ?>
                    </option>
                <?php endforeach ?>
            </select>       
        </div>

        <div class="col-md-12">
            <label for="tanggalPinjam">Tanggal Peminjam</label>
            <input class="form-control mb-3" type="date" name="tanggalPinjam" placeholder="Masukkan Tanggal"/>
        </div>

        <div class="col-6 offset-md-4">
            <a href="peminjaman.php" class="btn btn-danger">Kembali</a>
            <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
        </div>
    </form>
</div>
</div>

</div>

</div>

<script src="../../assets/js/jquery-3.6.1.min.js"></script>
<script src="../../assets/js/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="../../assets/style/chosen.css">

<script type="text/javascript">
     $(function() {
          $(".chzn-select").chosen();
     });
 </script>
</body>
</html>