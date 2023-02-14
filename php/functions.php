<?php 
$conn = mysqli_connect('localhost', 'root', '', 'perpustakaan_1');

function query($sql)
{
	global $conn;
	$result = mysqli_query($conn, $sql);

	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}

	return $rows;
}

//==================== AWAL CRUD ======================//
function tambahBuku($data) {
	global $conn;

	$idkategori = htmlspecialchars($data['idkategori']);
	$judulBuku = htmlspecialchars($data['judulBuku']);
	$pengarang = htmlspecialchars($data['pengarang']);
	$penerbit = htmlspecialchars($data['penerbit']);
	$deskripsi = htmlspecialchars($data['deskripsi']);
	$stokBuku = htmlspecialchars($data['stokBuku']);

	$gambar = upload();
	if(!$gambar) {
		return false;
	}

	$sql = "INSERT INTO buku VALUES ('', '$idkategori', '$judulBuku', '$pengarang', '$penerbit', '$deskripsi', '$stokBuku', '$gambar')";

	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}

function ubahBuku($data) {
	global $conn;

	$idBuku = $data['idBuku'];
	$idkategori = htmlspecialchars($data['idkategori']);
	$judulBuku = htmlspecialchars($data['judulBuku']);
	$pengarang = htmlspecialchars($data['pengarang']);
	$penerbit = htmlspecialchars($data['penerbit']);
	$deskripsi = htmlspecialchars($data['deskripsi']);
	$stokBuku = htmlspecialchars($data['stokBuku']);
	$gambarLama = htmlspecialchars($data['gambarLama']);
	
	// cek apakah user pilih gambar baru atau tidak
	if( $_FILES['gambarBuku']['error'] === 4 ) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$sql = "UPDATE buku SET 
	idkategori = '$idkategori',
	judulBuku = '$judulBuku',
	pengarang = '$pengarang',
	penerbit = '$penerbit',
	deskripsi = '$deskripsi',
	stokBuku = '$stokBuku',
	gambarBuku = '$gambar'
	WHERE idBuku = $idBuku";

	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}

function upload() {

	$namaFile = $_FILES['gambarBuku']['name'];
	$ukuranFile = $_FILES['gambarBuku']['size'];
	$error = $_FILES['gambarBuku']['error'];
	$tmpName = $_FILES['gambarBuku']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if( $error === 4 ) {
		echo "<script>
		alert('pilih gambar terlebih dahulu!');
		</script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
		alert('yang anda upload bukan gambar!');
		</script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if( $ukuranFile > 1000000 ) {
		echo "<script>
		alert('ukuran gambar terlalu besar!');
		</script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, '../../assets/img/' . $namaFileBaru);

	return $namaFileBaru;
}

function uploadProfil() {

	$namaFile = $_FILES['gambarProfil']['name'];
	$ukuranFile = $_FILES['gambarProfil']['size'];
	$error = $_FILES['gambarProfil']['error'];
	$tmpName = $_FILES['gambarProfil']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if( $error === 4 ) {
		echo "<script>
		alert('pilih gambar terlebih dahulu!');
		</script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
		alert('yang anda upload bukan gambar!');
		</script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if( $ukuranFile > 1000000 ) {
		echo "<script>
		alert('ukuran gambar terlalu besar!');
		</script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, '../../assets/profil/' . $namaFileBaru);

	return $namaFileBaru;
}

function hapusBuku($idBuku) {
	global $conn;

	mysqli_query($conn, "DELETE FROM buku WHERE idBuku = '$idBuku'");

	return mysqli_affected_rows($conn);
}

function tambahAnggota($data) {
	global $conn;

	$namaAnggota = htmlspecialchars($data['namaAnggota']);
	$username = htmlspecialchars($data['username']);
	$password = htmlspecialchars($data['password']);
	$tempatLahir = htmlspecialchars($data['tempatLahir']);
	$tanggalLahir = htmlspecialchars($data['tanggalLahir']);

	$sql = "INSERT INTO anggota VALUES ('', '$namaAnggota', '$username', '$password', '$tempatLahir', '$tanggalLahir')";

	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}
//==================== AKHIR CRUD ======================//

function cariAnggota($keyword) {
	$query = "SELECT * FROM anggota
	WHERE
	namaAnggota LIKE '%$keyword%' OR
	username LIKE '%$keyword%' OR
	password LIKE '%$keyword' OR
	tempatLahir LIKE '%$keyword%' OR
	tanggalLahir LIKE '%$keyword%'
	";
	return query($query);
}

function cariBuku($keyword) {
	global $conn;

	$query = "SELECT buku.*, kategori.* FROM buku, kategori
	WHERE buku.idKategori = kategori.idKategori AND
	(
		kategori LIKE '%$keyword%' OR
		judulBuku LIKE '%$keyword%' OR
		pengarang LIKE '%$keyword%' OR
		penerbit LIKE '%$keyword%' OR
		deskripsi LIKE '%$keyword%' OR
		stokBuku LIKE '%$keyword%'
		)
	";
	return $conn->query($query);
}

function cariKategori($keyword) {

	$query = "SELECT * FROM kategori WHERE
	kategori LIKE '%$keyword%'
	";
	return query($query);
}


function cek_login() {
	global $conn;

	$username = $_POST['username'];
	$password = $_POST['password'];

	$result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' and password='$password'");

	$cek = mysqli_num_rows($result);

	if($cek > 0) {
		$data = mysqli_fetch_assoc($result);

		if ($data['level'] == 'Admin') {
			$_SESSION['login'] = true;
			$_SESSION['username'] = $data['username'];
			$_SESSION['level'] = $data['level'];
			$data['profil'] == '' ? $_SESSION['profil'] = 'default-profil.png' : $_SESSION['profil'] = $data['profil'];
			header("Location: ../home/index.php");
		} else if ($data['level'] == 'Pustakawan') {
			$_SESSION['login'] = true;
			$_SESSION['username'] = $data['username'];
			$_SESSION['level'] = $data['level'];
			$data['profil'] == '' ? $_SESSION['profil'] = 'default-profil.png' : $_SESSION['profil'] = $data['profil'];
			header("Location: ../home/index.php");
		} 
	} else {
		header("Location: login.php?login=gagal");
	}
}

function cek_login_anggota() {
	global $conn;

	$username = $_POST['username'];
	$password = $_POST['password'];

	$result = mysqli_query($conn, "SELECT * FROM anggota WHERE username = '$username' and password='$password'");

	$cek = mysqli_num_rows($result);

	if($cek > 0) {
		$data = mysqli_fetch_assoc($result);
		$_SESSION['login'] = true;
		$_SESSION['username'] = $data['username'];
		$_SESSION['level'] = 'Anggota Perpustakaan';
		$data['profil'] == '' ? $_SESSION['profil'] = 'default-profil.png' : $_SESSION['profil'] = $data['profil'];
		header("Location: ../home/index.php");
	} else {
		header("Location: login.php?login=gagal");
	}
}

function registrasi($data)
{
	global $conn;

	$nama = htmlspecialchars($data['nama']);
	$username = htmlspecialchars($data['username']);
	$password = mysqli_real_escape_string($conn, $data['password']);
	$kelas = htmlspecialchars($data['kelas']);
	$level = 'Peminjam';
	$tempatLahir = htmlspecialchars($data['tempatLahir']);
	$tanggalLahir = htmlspecialchars($data['tanggalLahir']);
	$jenisKelamin = htmlspecialchars($data['jenisKelamin']);

    // Check if username already exists
	$result = mysqli_query(
		$conn,
		"SELECT username FROM pengguna WHERE username = '$username'"
	);

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
		alert('Username sudah terdaftar!');
		</script>";
		return false;
	}

    // Encrypt password
    // $passwordhash = password_hash($password, PASSWORD_DEFAULT);

    // Add new user to the database
	$query = "INSERT INTO pengguna (nama, username, password, level, kelas, jenisKelamin, tempatLahir, tanggalLahir)
	VALUES ('$nama', '$username', '$password', '$level', '$kelas', '$jenisKelamin', '$tempatLahir', '$tanggalLahir')";
	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);
}

function registrasiAdmin($data)
{
	global $conn;

	$namaAdmin = htmlspecialchars($data['namaAdmin']);
	$username = htmlspecialchars($data['username']);
	$password = mysqli_real_escape_string($conn, $data['password']);
	$level = htmlspecialchars($data['level']);
	$status = htmlspecialchars($data['status']);

	$gambarProfil = uploadProfil();
	if(!$gambarProfil) {
		return false;
	}

    // Check if username already exists
	$result = mysqli_query(
		$conn,
		"SELECT username FROM admin WHERE username = '$username'"
	);

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
		alert('Username sudah terdaftar!');
		</script>";
		return false;
	}

    // Encrypt password
    // $passwordhash = password_hash($password, PASSWORD_DEFAULT);

    // Add new user to the database
	$query = "INSERT INTO admin (namaAdmin, username, password, level, status, profil)
	VALUES ('$namaAdmin', '$username', '$password', '$level', '$status', '$gambarProfil')";
	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);
}

?>