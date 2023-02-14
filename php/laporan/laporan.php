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

$bukuseluruh = $db->rowCOUNT("SELECT judulBuku FROM buku");

$bukupinjam = $db->rowCOUNT("SELECT judulBuku FROM buku INNER JOIN detailbuku ON 
    buku.idBuku = detailbuku.idBuku WHERE status='Dipinjam'");

$bukutersedia = $db->rowCOUNT("SELECT judulBuku FROM buku INNER JOIN detailbuku ON 
    buku.idBuku=detailbuku.idBuku WHERE status='Ada'");

$limabuku = $db->getALL("SELECT judulBuku, COUNT(*) AS dipinjam FROM peminjaman 
    INNER JOIN detailpeminjaman ON peminjaman.idPeminjaman=detailpeminjaman.idPeminjaman 
    INNER JOIN detailbuku ON detailpeminjaman.idDetailBuku=detailbuku.idDetailBuku 
    INNER JOIN buku ON detailbuku.idBuku=buku.idBuku 
    WHERE NOT tanggalkembali = '0000-00-00'
    GROUP BY judulBuku ORDER BY COUNT(*) DESC LIMIT 5");

$limaanggota = $db->getALL("SELECT namaAnggota, COUNT(*) AS pinjam FROM anggota 
    INNER JOIN peminjaman ON anggota.idAnggota=peminjaman.idAnggota 
    GROUP BY namaAnggota ORDER BY COUNT(*) DESC LIMIT 5
    ");

$anggota = $db->getALL("SELECT namaAnggota, COUNT(*) AS kembali FROM anggota 
    INNER JOIN peminjaman ON anggota.idAnggota = peminjaman.idAnggota
    INNER JOIN detailpeminjaman ON peminjaman.idPeminjaman = detailPeminjaman.idPeminjaman 
    WHERE tanggalkembali ='0000-00-00' 
    GROUP BY namaAnggota ORDER BY COUNT(*) DESC LIMIT 5
    ");
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Halaman Laporan Buku</title>

      <!-- Icon -->
      <link rel="shortcut icon" href="../../assets/icon/favicon.png" type="image/x-icon">

      <!-- Icon -->
      <link rel="shortcut icon" href="../../assets/icon/favicon.png" type="image/x-icon">

      <!-- Link CSS -->
      <link rel="stylesheet" href="../../assets/style/style.css">

      <!-- Bootstrap -->
      <link rel="stylesheet" href="../../assets/bootstrap-5.3.0/css/bootstrap.min.css">
      <head>
        <style>
            .warna {
                background-color: #f8d9fc;
            }

            .warna1 {
                background-color: #fbf0fc;
            }

            .username {
                border: none;
                color: rgb(255, 255, 255);
                padding: 8px 12px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                margin: 8px 2px;
                border-radius: 0.375rem;
            }

            .header-m {
                margin-bottom: 5px;
            }

            .kiri-form {
                float: right;
            }

            table {
                border: none;
            }

            table tr td {
                padding: .5rem;
            }

            table thead tr th {
                background-color: #000;
                color: #fff;
            }

            table tr:nth-child(even) {
                background-color: #212529;
            }

            table tr:nth-child(odd) {
                background-color: #2c3034;
            }

            h1 {
                font-size: 2.25rem;
                margin: .5rem 0 2rem 0;
            }

            .btn {
                padding: .35rem .375rem;
                font-size: .8rem;
            }
        </style>
    </head>
    <body data-bs-theme="dark">
        <div class="container-fluid">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-around py-3 px-5">
            <a href="../home/index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Perpustakaan</span>
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item">
                    <a href="../home/index.php" class="nav-link text-white" aria-current="page">
                        Home
                    </a>
                </li>
                <li>
                    <a href="../buku/buku.php" class="nav-link text-white">
                        Buku
                    </a>
                </li>
                <?php if($_SESSION['level'] == 'Anggota Perpustakaan') {
                    echo '
                    <li>
                    <a href="../peminjaman/riwayatPeminjaman.php" class="nav-link text-white">
                    Riwayat Peminjaman
                    </a>
                    </li>
                    <li>';
                } ?>
                <?php if ($_SESSION['level'] == 'Admin') { 
                    echo '
                    <li>
                    <a href="../kategori/kategori.php" class="nav-link text-white">
                    Kategori
                    </a>
                    </li>
                    
                    <li>
                    <a href="../peminjaman/peminjaman.php" class="nav-link text-white">
                    Peminjaman
                    </a> 
                    </li> 

                    <li>
                    <a href="../pengembalian/pengembalian.php" class="nav-link text-white">
                    Pengembalian
                    </a>
                    </li>

                    <li>
                    <a href="../anggota/anggota.php" class="nav-link text-white">
                    Anggota
                    </a>
                    </li>

                    <li>
                    <a href="../laporan/laporan.php" class="nav-link active">
                    Laporan
                    </a>
                    </li>';
                }?>
            </ul>

            <div class="d-flex col-md-3 text-end align-items-center justify-content-center">
                <!-- <button type="button" class="btn btn-outline-primary me-2">Login</button>
                    <button type="button" class="btn btn-primary">Sign-up</button> -->
                    <div class="dropdown text-end">
                        <a href="#" class="text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../../assets/profil/default-profil.png" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong><?= $_SESSION['username']; ?></strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="../logout.php">Sign out</a></li>
                        </ul>
                    </div>
                </div>

            </header>
        </div>

            <!-- Content -->
            <div class="content p-4">
                <h1 class="text-center">Halaman Laporan Perpustakaan</h1>
                <div class="row mt-4">
                    <ul class="list-group list-group-flush">
                        <div class="row mt-4">
                            <div class="col-md-10 mb-3">
                                <li class="list-group-item rounded-3">Jumlah Judul Keseluruhan : <?= $bukuseluruh ?></li>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="float-left">
                                    <a class="btn btn-outline-success" href="../laporan/export.php?cetak=xls" role="button">Export XLS</a>
                                    <a class="btn btn-outline-danger" href="../laporan/export.php?cetak=pdf" role="button" target="_blank">Export PDF</a>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-10 mb-3">
                                <li class="list-group-item rounded-3">Jumlah Buku Yang Dipinjam : <?= $bukupinjam ?></li>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="float-left">
                                    <a class="btn btn-outline-success" href="../laporan/exportbukupinjam.php?cetak=xls" role="button">Export XLS</a>
                                    <a class="btn btn-outline-danger" href="../laporan/exportbukupinjam.php?cetak=pdf" role="button" target="_blank">Export PDF</a>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-10 mb-3">
                                <li class="list-group-item rounded-3">Jumlah Buku Yang Tersedia : <?= $bukutersedia ?></li>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="float-left">
                                    <a class="btn btn-outline-success" href="../laporan/exportbukutersedia.php?cetak=xls" role="button">Export XLS</a>
                                    <a class="btn btn-outline-danger" href="../laporan/exportbukutersedia.php?cetak=pdf" role="button" target="_blank">Export PDF</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <li class="list-group-item rounded-3">
                            Lima Judul Buku Yang sering Dipinjam:
                            <br>
                            <div class="col-md-2 mb-3 mt-3">
                                <div class="float-left">
                                    <a class="btn btn-outline-success me-2" href="../laporan/bukuseringpinjam.php?cetak=xls" role="button">Export XLS</a>
                                    <a class="btn btn-outline-danger" href="../laporan/bukuseringpinjam.php?cetak=pdf" role="button">Export PDF</a>
                                </div>
                            </div>
                            <table border="0" cellpadding="10" cellspacing="0" class="mt-3">
                                <thead> 
                                    <tr class="warna">
                                        <th>No</th>
                                        <th>Buku</th>
                                        <th>Banyak buku yang dipinjam</th>
                                    </tr>
                                </thead>

                                <?php $no = 1; ?>

                                <?php if (!empty($limabuku)) { ?>
                                    <?php foreach ($limabuku as $data) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data['judulBuku'] ?></td>
                                            <td><?= $data['dipinjam'] ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </table>

                        </li><br>

                        <li class="list-group-item rounded-3 ">
                            Lima Anggota yang Sering Pinjam Buku:
                            <br>
                            <div class="col-md-2 mb-3 mt-3">
                                <div class="float-left">
                                    <a class="btn btn-outline-success me-2" href="../laporan/anggotaseringpinjam.php?cetak=xls" role="button">Export XLS</a>
                                    <a class="btn btn-outline-danger" href="../laporan/anggotaseringpinjam.php?cetak=pdf" role="button" target="_blank">Export PDF</a>
                                </div>
                            </div>
                            <table border="0" cellpadding="10" cellspacing="0" class="mt-3">
                                <thead> 
                                    <tr class="warna">
                                        <th>No</th>
                                        <th>Banyak Anggota yang Pinjam</th>
                                        <th>Buku</th>
                                    </tr>
                                </thead>

                                <?php $no = 1; ?>

                                
                                <?php if (!empty($limaanggota)) { ?>
                                    <?php foreach ($limaanggota as $data) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data['namaAnggota'] ?></td>
                                            <td><?= $data['pinjam'] ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>

                            </table>
                        </li><br>

                        <li class="list-group-item rounded-3">Anggota Yang Belum Mengembalikan Buku
                            <br>
                            <div class="col-md-2 mb-3 mt-3">
                                <div class="float-left">
                                    <a class="btn btn-outline-success me-2" href="../laporan/anggotabelumkembali.php?cetak=xls" role="button">Export XLS</a>
                                    <a class="btn btn-outline-danger" href="../laporan/anggotabelumkembali.php?cetak=pdf" role="button" target="_blank">Export PDF</a>
                                </div>
                            </div>
                            <table border="0" cellpadding="10" cellspacing="0" class="mt-3">
                                <thead> 
                                    <tr class="warna">                                    
                                        <th>No</th>
                                        <th>Banyak Anggota Yang Belum Mengembalikan</th>
                                        <th>Buku</th>
                                    </tr>
                                </thead>

                                <?php $no = 1; ?>

                                <?php if (!empty($anggota)) { ?>
                                    <?php foreach ($anggota as $data) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data['namaAnggota'] ?></td>
                                            <td><?= $data['kembali'] ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>

                            </table>
                        </li>

                    </ul>
                </div>
            </div>
        </main>
    </body>
    </html>