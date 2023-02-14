<?php 
class DBConnection {
	private $host = 'localhost';
	private $user = 'root';
	private $password = '';
	private $dbname = 'projek3_sukenmfauzan';

	public $conn;

	public function __construct() {
		$this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
	}

	public function query($sql) {
		$result = mysqli_query($this->conn, $sql);

		$rows = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}

		return $rows;
	}

	public function getALL($sql)
	{
		$result = mysqli_query($this->conn, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			$data[] = $row;
		}

		if (!empty($data)) {
			return $data;
		}
	}

	public function getITEM($sql)
	{
		$result = mysqli_query($this->conn, $sql);
		$row = mysqli_fetch_assoc($result);
		return ($row);
	}

	public function rowCOUNT($sql)
	{
		$result = mysqli_query($this->conn, $sql);
		$count = mysqli_num_rows($result);
		return $count;
	}

	public function runSQL($sql)
	{
		$result = mysqli_query($this->conn, $sql);
	}

	public function pesan($text = "")
	{
		echo $text;
	}


	//==================== CRUD Methods ======================//
	public function upload() {

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

	public function uploadProfil() {

		$namaFile = $_FILES['gambarProfil']['name'];
		$ukuranFile = $_FILES['gambarProfil']['size'];
		$error = $_FILES['gambarProfil']['error'];
		$tmpName = $_FILES['gambarProfil']['tmp_name'];

		// cek apakah yang diupload adalah gambar
		$ekstensiGambarValid = ['jpg', 'jpeg', 'png', ''];
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

	public function tambahBuku($data) {
		$idkategori = htmlspecialchars($data['idkategori']);
		$judulBuku = htmlspecialchars($data['judulBuku']);
		$pengarang = htmlspecialchars($data['pengarang']);
		$penerbit = htmlspecialchars($data['penerbit']);
		$deskripsi = htmlspecialchars($data['deskripsi']);

		$gambar = $this->upload();
		if(!$gambar) {
			return false;
		}

		$sql = "INSERT INTO buku VALUES ('', '$idkategori', '$judulBuku', '$pengarang', '$penerbit', '$deskripsi', '$gambar')";

		mysqli_query($this->conn, $sql);

		return mysqli_affected_rows($this->conn);
	}

	public function ubahBuku($data) {
		$idBuku = $data['idBuku'];
		$idkategori = htmlspecialchars($data['idkategori']);
		$judulBuku = htmlspecialchars($data['judulBuku']);
		$pengarang = htmlspecialchars($data['pengarang']);
		$penerbit = htmlspecialchars($data['penerbit']);
		$deskripsi = htmlspecialchars($data['deskripsi']);
		$gambarLama = htmlspecialchars($data['gambarLama']);
		
		// check if user chose a new image
		if($_FILES['gambarBuku']['error'] === 4 ) {
			$gambar = $gambarLama;
		} else {
			$gambar = $this->upload();
		}
		$sql = "UPDATE buku SET 
		idkategori = '$idkategori',
		judulBuku = '$judulBuku',
		pengarang = '$pengarang',
		penerbit = '$penerbit',
		deskripsi = '$deskripsi',
		gambarBuku = '$gambar'
		WHERE idBuku = $idBuku";

		mysqli_query($this->conn, $sql);

		return mysqli_affected_rows($this->conn);
	}

	public function hapusBuku($idBuku) {
		mysqli_query($this->conn, "DELETE FROM detailbuku WHERE idBuku = '$idBuku'");
		mysqli_query($this->conn, "DELETE FROM buku WHERE idBuku = '$idBuku'");

		return mysqli_affected_rows($this->conn);
	}

	public function tambahAnggota($data) {
		$namaAnggota = htmlspecialchars($data['namaAnggota']);
		$username = htmlspecialchars($data['username']);
		$password = htmlspecialchars($data['password']);
		$tempatLahir = htmlspecialchars($data['tempatLahir']);
		$tanggalLahir = htmlspecialchars($data['tanggalLahir']);

		$passwordhash = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO anggota VALUES ('', '$namaAnggota', '$username', '$passwordhash', '$tempatLahir', '$tanggalLahir')";

		mysqli_query($this->conn, $sql);

		return mysqli_affected_rows($this->conn);
	}

	public function ubahAnggota($data) {
		$idAnggota = $data['idAnggota'];
		$namaAnggota = htmlspecialchars($data['namaAnggota']);
		$username = htmlspecialchars($data['username']);
		$tempatLahir = htmlspecialchars($data['tempatLahir']);
		$tanggalLahir = htmlspecialchars($data['tanggalLahir']);

		$password = htmlspecialchars($data['password']);
		if ($password == $data['passwordLama']) {
			$passwordhash = $data['passwordLama'];
		} else {
			$passwordhash = password_hash($password, PASSWORD_DEFAULT);
		}

		$sql = "UPDATE anggota SET 
		namaAnggota = '$namaAnggota',
		username = '$username',
		password = '$passwordhash',
		tempatLahir = '$tempatLahir',
		tanggalLahir = '$tanggalLahir'
		WHERE idAnggota = '$idAnggota'";

		mysqli_query($this->conn, $sql);

		return mysqli_affected_rows($this->conn);
	}

	public function hapusAnggota($idAnggota) {
		mysqli_query($this->conn, "DELETE FROM Anggota WHERE idAnggota = '$idAnggota'");

		return mysqli_affected_rows($this->conn);
	}

	public function tambahKategori($data) {
		$kategori = htmlspecialchars($data['kategori']);

		$sql = "INSERT INTO kategori VALUES ('', '$kategori')";

		mysqli_query($this->conn, $sql);

		return mysqli_affected_rows($this->conn);
	}

	public function ubahKategori($data) {
		$idkategori = $data['idkategori'];
		$kategori = htmlspecialchars($data['kategori']);

		$sql = "UPDATE kategori SET 
		kategori = '$kategori'
		WHERE idkategori = '$idkategori'";

		mysqli_query($this->conn, $sql);

		return mysqli_affected_rows($this->conn);
	}

	public function hapusKategori($idKategori) {
		mysqli_query($this->conn, "DELETE FROM kategori WHERE idkategori = '$idKategori'");

		return mysqli_affected_rows($this->conn);
	}

	public function tambahPeminjaman($data) {
		$idAdmin = htmlspecialchars($data['idAdmin']);
		$idAnggota = htmlspecialchars($data['idAnggota']);
		$judulBuku = htmlspecialchars($data['judulBuku']);
		$tanggalPinjam = htmlspecialchars($data['tanggalPinjam']);

		$sql = "INSERT INTO peminjaman VALUES ('', '$idAdmin', '$idAnggota', '$tanggalPinjam')";
		mysqli_query($this->conn, $sql);
		
		$idpeminjamanterakhir = $this->getITEM("SELECT idPeminjaman FROM peminjaman ORDER BY idPeminjaman DESC LIMIT 1");
		$idterakhir = $idpeminjamanterakhir['idPeminjaman'];
		$sql = "INSERT INTO detailpeminjaman VALUES('', '$idterakhir', '$judulBuku', '')";
		mysqli_query($this->conn, $sql);

		$sql = "UPDATE detailbuku SET status='Dipinjam' WHERE idDetailBuku=$judulBuku AND status='Ada'";
		$this->runSQL($sql);

		return mysqli_affected_rows($this->conn);
	}	

	public function ubahPeminjaman($data) {
		$idPeminjaman = $data['idPeminjaman'];
		$idDetailBuku = $data['idDetailBuku'];
		$idAdmin = htmlspecialchars($data['idAdmin']);
		$idAnggota = htmlspecialchars($data['idAnggota']);
		$judulBuku = htmlspecialchars($data['judulBuku']);
		$tanggalPinjam = htmlspecialchars($data['tanggalPinjam']);

		if ($idDetailBuku != $judulBuku) {
			$this->runSQL("UPDATE detailbuku SET status='Ada' WHERE idDetailBuku=$idDetailBuku AND status='Dipinjam'");
		}

		$this->runSQL("UPDATE peminjaman
			SET idAdmin = '$idAdmin', idAnggota = '$idAnggota', tanggalPinjam= '$tanggalPinjam'
			WHERE idPeminjaman = $idPeminjaman");

		$this->runSQL("UPDATE detailpeminjaman 
			SET idDetailBuku = $judulBuku
			WHERE idpeminjaman = $idPeminjaman");

		$peminjamanBaru = $this->getItem("SELECT idDetailBuku, idAnggota, idAdmin, tanggalPinjam, peminjaman.idPeminjaman
			FROM peminjaman
			INNER JOIN detailpeminjaman ON peminjaman.idPeminjaman = detailpeminjaman.idPeminjaman
			WHERE peminjaman.idPeminjaman = $idPeminjaman");

		$statusBuku = $this->getITEM("SELECT status FROM detailbuku WHERE idDetailBuku = $judulBuku");

		if($statusBuku['status'] == 'Ada') {
			$idDetailBukuBaru = $peminjamanBaru['idDetailBuku'];
			$this->runSQL("UPDATE detailbuku 
				SET status='Dipinjam' 
				WHERE idDetailBuku = $idDetailBukuBaru");
		}

		return mysqli_affected_rows($this->conn);
	}

	public function hapusPengembalian($idPengembalian) {
		mysqli_query($this->conn, "DELETE FROM detailpeminjaman WHERE idDetailPeminjaman = '$idPengembalian'");

		return mysqli_affected_rows($this->conn);
	}	
//==================== AKHIR CRUD ======================//

	public function cariAnggota($keyword) {
		$query = "SELECT * FROM anggota
		WHERE
		namaAnggota LIKE '%$keyword%' OR
		username LIKE '%$keyword%' OR
		password LIKE '%$keyword' OR
		tempatLahir LIKE '%$keyword%' OR
		tanggalLahir LIKE '%$keyword%'
		";
		return $this->query($query);
	}

	public function cariBuku($keyword) {
		$query = "SELECT buku.*, kategori.* FROM buku, kategori
		WHERE buku.idKategori = kategori.idKategori AND
		(
			kategori LIKE '%$keyword%' OR
			judulBuku LIKE '%$keyword%' OR
			pengarang LIKE '%$keyword%' OR
			penerbit LIKE '%$keyword%' OR
			deskripsi LIKE '%$keyword%'
			)
		";
		return $this->conn->query($query);
	}

	public function cariKategori($keyword) {

		$query = "SELECT * FROM kategori WHERE
		kategori LIKE '%$keyword%'
		";
		return $this->query($query);
	}

	public function cariPeminjaman($keyword) {

		$query = "SELECT * FROM kategori WHERE
		kategori LIKE '%$keyword%'
		";
		return $this->query($query);
	}

	public function cariPengembalian($keyword) {
		if ($keyword == 'Belum Kembali') {
			$keyword = '0000-00-00';
			$query = "SELECT anggota.namaAnggota, peminjaman.idPeminjaman, peminjaman.tanggalPinjam, detailpeminjaman.tanggalKembali, buku.judulBuku, buku.gambarBuku, admin.namaAdmin, detailpeminjaman.idDetailPeminjaman as idPengembalian, detailbuku.idDetailBuku
			FROM peminjaman
			LEFT JOIN anggota ON peminjaman.idAnggota = anggota.idAnggota
			LEFT JOIN detailpeminjaman ON peminjaman.idPeminjaman = detailpeminjaman.idPeminjaman
			LEFT JOIN detailbuku ON detailpeminjaman.idDetailBuku = detailbuku.idDetailBuku
			LEFT JOIN buku ON detailbuku.idBuku = buku.idBuku
			LEFT JOIN admin ON peminjaman.idAdmin = admin.idAdmin
			WHERE detailpeminjaman.tanggalKembali IS NOT NULL AND (anggota.namaAnggota LIKE '%$keyword%' OR peminjaman.tanggalPinjam LIKE '%$keyword%' OR detailpeminjaman.tanggalKembali LIKE '%0000-00-00%' OR buku.judulBuku LIKE '%$keyword%' OR buku.gambarBuku LIKE '%$keyword%' OR admin.namaAdmin LIKE '%$keyword%')
			ORDER BY tanggalPinjam DESC 
			";
			return $this->getALL($query);
		}	else {	
			$query = "SELECT anggota.namaAnggota, peminjaman.idPeminjaman, peminjaman.tanggalPinjam, detailpeminjaman.tanggalKembali, buku.judulBuku, buku.gambarBuku, admin.namaAdmin, detailpeminjaman.idDetailPeminjaman as idPengembalian, detailbuku.idDetailBuku
			FROM peminjaman
			LEFT JOIN anggota ON peminjaman.idAnggota = anggota.idAnggota
			LEFT JOIN detailpeminjaman ON peminjaman.idPeminjaman = detailpeminjaman.idPeminjaman
			LEFT JOIN detailbuku ON detailpeminjaman.idDetailBuku = detailbuku.idDetailBuku
			LEFT JOIN buku ON detailbuku.idBuku = buku.idBuku
			LEFT JOIN admin ON peminjaman.idAdmin = admin.idAdmin
			WHERE detailpeminjaman.tanggalKembali IS NOT NULL AND  (anggota.namaAnggota LIKE '%$keyword%' OR peminjaman.tanggalPinjam LIKE '%$keyword%' OR detailpeminjaman.tanggalKembali LIKE '%$keyword%' OR buku.judulBuku LIKE '%$keyword%' OR buku.gambarBuku LIKE '%$keyword%' OR admin.namaAdmin LIKE '%$keyword%') AND detailPeminjaman.tanggalKembali != '0000-00-00'
			ORDER BY tanggalPinjam DESC 
			";
			return $this->getALL($query);
		}
	}


	public function cek_login() {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$result = mysqli_query($this->conn, "SELECT * FROM admin WHERE username = '$username'");

		$cek = mysqli_num_rows($result);

		if($cek === 1) {
			$data = mysqli_fetch_assoc($result);

			if (password_verify($password, $data['password'])) {
				$_SESSION['login'] = true;
				$_SESSION['username'] = $data['username'];
				$_SESSION['level'] = $data['level'];
				$data['profil'] == '' ? $_SESSION['profil'] = 'default-profil.png' : $_SESSION['profil'] = $data['profil'];
				header("Location: ../home/index.php");
			} else {
				header("Location: login.php?login=gagal");
			} 
		} else {
			header("Location: login.php?login=gagal");
		}

	}

	public function cek_login_anggota() {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$result = mysqli_query($this->conn, "SELECT * FROM anggota WHERE username = '$username'");

		$cek = mysqli_num_rows($result);

		if($cek === 1) {
			$data = mysqli_fetch_assoc($result);

			if(password_verify($password, $data['password'])) {

				$_SESSION['login'] = true;
				$_SESSION['username'] = $data['username'];
				$_SESSION['namaAnggota'] = $data['namaAnggota'];
				$_SESSION['level'] = 'Anggota Perpustakaan';
				$data['profil'] == '' ? $_SESSION['profil'] = 'default-profil.png' : $_SESSION['profil'] = $data['profil'];
				header("Location: ../home/index.php");
			} else {
				header("Location: login.php?login=gagal");
			}
		} else {
			header("Location: login.php?login=gagal");
		}
	}

	public function registrasiAdmin($data)
	{
		$namaAdmin = htmlspecialchars($data['namaAdmin']);
		$username = htmlspecialchars($data['username']);
		$password = htmlspecialchars($data['password']);
		$level = htmlspecialchars($data['level']);
		$status = htmlspecialchars($data['status']);

		$gambarProfil = $this->uploadProfil();
		if(!$gambarProfil) {
			return false;
		}

    // Check if username already exists
		$result = mysqli_query(
			$this->conn,
			"SELECT username FROM admin WHERE username = '$username'"
		);

		if (mysqli_fetch_assoc($result)) {
			echo "<script>
			alert('Username sudah terdaftar!');
			</script>";
			return false;
		}

    // Encrypt password
		$passwordhash = password_hash($password, PASSWORD_DEFAULT);

    // Add new user to the database
		$query = "INSERT INTO admin (namaAdmin, username, password, level, status, profil)
		VALUES ('$namaAdmin', '$username', '$passwordhash', '$level', '$status', '$gambarProfil')";
		mysqli_query($this->conn, $query);


		return mysqli_affected_rows($this->conn);
	}
}
?>