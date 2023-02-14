<?php 
session_start();
require_once '../dbcontroller.php';
$db = new DBConnection();

$jumlahdataperhalaman = 10;
$totaldata = $db->rowCOUNT("SELECT * FROM peminjaman");
$jumlahhalaman = ceil($totaldata / $jumlahdataperhalaman);
if (isset($_GET['halaman'])) {
    $halamanberapa = $_GET['halaman'];
} else {
    $halamanberapa = 1;
}

$halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;

// deskripsikan bisa pakai keduanya. (halaman dan tidak ada)
$awaldata = $jumlahdataperhalaman * $halamanberapa - $jumlahdataperhalaman;

$Previous = $halaman - 1;
$Next = $halaman + 1;

$halamanawal =
$halaman > 1 ? $halaman * $jumlahdataperhalaman - $jumlahdataperhalaman : 0;

$query = "SELECT anggota.namaAnggota, peminjaman.idPeminjaman, peminjaman.tanggalPinjam, detailpeminjaman.tanggalKembali, buku.judulBuku, buku.gambarBuku, admin.namaAdmin, detailpeminjaman.idDetailPeminjaman as idPengembalian, detailbuku.idDetailBuku
FROM peminjaman
LEFT JOIN anggota ON peminjaman.idAnggota = anggota.idAnggota
LEFT JOIN detailpeminjaman ON peminjaman.idPeminjaman = detailpeminjaman.idPeminjaman
LEFT JOIN detailbuku ON detailpeminjaman.idDetailBuku = detailbuku.idDetailBuku
LEFT JOIN buku ON detailbuku.idBuku = buku.idBuku
LEFT JOIN admin ON peminjaman.idAdmin = admin.idAdmin
WHERE detailpeminjaman.tanggalKembali IS NOT NULL
ORDER BY tanggalPinjam DESC LIMIT $awaldata, $jumlahdataperhalaman";

$pengembalian = $db->getALL($query) or die($conn->error);
    // tombol cari ditekan
if(isset($_POST["cari"])) {
    $pengembalian = $db->cariPengembalian($_POST["keyword"]);
}

?>
<table border="0" cellpadding="10" cellspacing="0" id="data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Judul Buku</th>
            <th>Tanggal Kembali</th>
            <th>Nama Admin</th>
            <th>Kembalikan</th>
            <th>Gambar Buku</th>
            <th><center>Aksi</center></th>
        </tr>
    </thead>
    <?php $i = $halamanawal + 1;
    ?>
    <?php foreach( $pengembalian as $data ) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?php if($data['namaAnggota'] == '') {echo 'Anggota tidak terdaftar';} else {echo $data['namaAnggota'];} ?></td>
            <td><?= $data["judulBuku"]; ?></td>
            <td id="tgl" data-tanggal="<?= $data['tanggalKembali']; ?>"> <?php
            if ($data['tanggalKembali'] == '0000-00-00') {
                echo "Belum Kembali";
            } else {
                echo $data['tanggalKembali'];
            } ?> </td>
            <td><?= $data['namaAdmin']; ?></td>
            <td id="buttonKembali"><?php if ($data['tanggalKembali'] == '0000-00-00') { ?>
                <button type='button' class='btn btn-outline-danger id-detail kembalikan' data-iddetailbuku="<?= $data['idDetailBuku']; ?>" data-idpengembalian="<?= $data['idPengembalian']; ?>">Kembalikan</button>
            <?php } else { ?>
                <button type='button' class='btn btn-outline-success id-detail sudah-kembali' data-iddetailbuku="<?= $data['idDetailBuku']; ?>" data-idpengembalian="<?= $data['idPengembalian']; ?>">Sudah Kembali</button>
                <?php } ?> </td>
                <td><img src="../../assets/img/<?php if($data["gambarBuku"] == '') {echo 'default-book.png';}else{echo $data['gambarBuku'];} ?>" width="100" onclick="viewImage(<?=$i?>)"></td>
                <td>
                    <center>
                        <a href="edit.php?id=<?= $data["idPengembalian"]; ?>"><i class="fa-sharp fa-solid fa-edit tbl-edit"></i></a>
                        <a href="hapus.php?id=<?= $data["idPengembalian"]; ?>" onclick="return confirm('yakin?');"><i class="fa-sharp fa-solid fa-trash tbl-hapus"></i></a>
                    </center>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

    </table>