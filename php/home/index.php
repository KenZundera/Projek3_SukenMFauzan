<?php
session_start();
require_once '../dbcontroller.php';
$db = new DBConnection();

$bukuseluruh = $db->rowCOUNT("SELECT judulBuku FROM buku");

$bukupinjam = $db->rowCOUNT("SELECT judulBuku FROM buku INNER JOIN detailbuku ON 
	buku.idBuku = detailbuku.idBuku WHERE status='Dipinjam'");

$bukutersedia = $db->rowCOUNT("SELECT judulBuku FROM buku INNER JOIN detailbuku ON 
	buku.idBuku=detailbuku.idBuku WHERE status='Ada'");

$limabuku = $db->getITEM("SELECT judulBuku, COUNT(*) AS dipinjam FROM peminjaman 
	INNER JOIN detailpeminjaman ON peminjaman.idPeminjaman=detailpeminjaman.idPeminjaman 
	INNER JOIN detailbuku ON detailpeminjaman.idDetailBuku=detailbuku.idDetailBuku 
	INNER JOIN buku ON detailbuku.idBuku=buku.idBuku 
	WHERE NOT tanggalkembali = '0000-00-00'
	GROUP BY judulBuku ORDER BY COUNT(*) DESC LIMIT 1");

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
		<title>Halaman <?= $_SESSION['level']; ?></title>

		<!-- Icon -->
		<link rel="shortcut icon" href="../../assets/icon/favicon.png" type="image/x-icon">

		<!-- Link CSS -->
		<link rel="stylesheet" href="../../assets/style/style.css">

		<link rel="stylesheet" href="../../assets/bootstrap-5.3.0/css/bootstrap.min.css">


		<!-- Link Font Awesome -->
		<link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
		<link rel="stylesheet" href="../../assets/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="../../assets/fontawesome/css/solid.min.css">

		<style>
			.content {
				min-height: 90vh !important;
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
						<a href="../home/index.php" class="nav-link active" aria-current="page">
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
						<a href="../laporan/laporan.php" class="nav-link text-white">
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
		<div class="content">
			<h4 class="text-center mt-1">Halaman <?= $_SESSION['level']; ?></h4>
			<hr class="mb-4">
			<h3 class="text-center">Selamat Datang <?= $_SESSION['level']; ?> <?= $_SESSION['username']; ?>!</h3>

			<div class="row mt-2">
				<div class="col-md-4 d-flex justify-content-center">
					<div class="card border-light mb-3 mt-5 w-75">
						<div class="card-header text-center">Perpustakaan Online</div>
						<div class="card-body text-light">
							<h5 class="card-title text-center">Judul Buku</h5>
							<h4 class="card-title text-center"><?= $bukuseluruh; ?></h4>
						</div>
					</div>
				</div>
				<div class="col-md-4 d-flex justify-content-center">
					<div class="card border-light mb-3 mt-5 w-75">
						<div class="card-header text-center">Perpustakaan Online</div>
						<div class="card-body text-light">
							<h5 class="card-title text-center">Stok Buku</h5>
							<h4 class="card-title text-center"><?= $bukutersedia; ?></h4>
						</div>
					</div>
				</div>
				<div class="col-md-4 d-flex justify-content-center">
					<div class="card border-light mb-3 mt-5 w-75">
						<div class="card-header text-center">Perpustakaan Online</div>
						<div class="card-body text-light">
							<h5 class="card-title text-center">Buku di Pinjam</h5>
							<h4 class="card-title text-center"><?= $bukupinjam; ?></h4>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8 offset-md-2 d-flex justify-content-center">
					<div class="card border-light mb-3 mt-5 w-75">
						<div class="card-header text-center">Perpustakaan Online</div>
						<div class="card-body text-light">
							<h5 class="card-title text-center">Buku Terpopuler</h5>
							<h4 class="card-title text-center"><?= $limabuku['judulBuku']; ?></h4>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="../../assets/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
	</body>
	</html>