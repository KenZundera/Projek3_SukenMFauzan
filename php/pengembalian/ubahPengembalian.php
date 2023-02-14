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

if(isset($_POST['action']) && $_POST['action'] == 'Kembalikan') {
    $idPengembalian = $_POST['idPengembalian'];
    $idDetailBuku = $_POST['idDetailBuku'];

    $query = "UPDATE detailbuku SET status='Ada' WHERE idDetailBuku=$idDetailBuku";
    $hasil = $db->runSQL($query);

    $tanggal = date('Y-m-d');

    $query = "UPDATE detailpeminjaman SET tanggalKembali='$tanggal' WHERE idDetailPeminjaman=$idPengembalian";
    $hasil = $db->runSQL($query);

    echo mysqli_affected_rows($db->conn);
}


if(isset($_POST['action']) && $_POST['action'] == 'Sudah Kembali') {
    $idPengembalian = $_POST['idPengembalian'];
    $idDetailBuku = $_POST['idDetailBuku'];

    $query = "UPDATE detailbuku SET status='Dipinjam' WHERE idDetailBuku=$idDetailBuku";
    $hasil = $db->runSQL($query);

    $tanggal = date('0000-00-00');

    $query = "UPDATE detailpeminjaman SET tanggalKembali='$tanggal' WHERE idDetailPeminjaman=$idPengembalian";
    $hasil = $db->runSQL($query);

    echo mysqli_affected_rows($db->conn);
}
?>