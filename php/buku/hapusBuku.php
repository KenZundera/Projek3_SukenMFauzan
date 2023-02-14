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

$idBuku = $_GET['idBuku'];

$data = $db->getALL("SELECT * FROM buku WHERE idBuku = $idBuku")[0];

$gambarBuku = $data["gambarBuku"];

function hapusGambar($gambarBuku) {
    if ($gambarBuku != "") {
        unlink("../../assets/img/" . $gambarBuku);
    }
}

if ($db->hapusBuku($idBuku) > 0) {
    hapusGambar($gambarBuku);
    echo "<script>
                alert('data berhasil dihapus!');
                document.location.href = 'buku.php';
            </script>";
} else {
    echo "<script>
                alert('data gagal dihapus!');
                // document.location.href = 'buku.php';
            </script>";
}

return mysqli_affected_rows($db->conn);
?>
