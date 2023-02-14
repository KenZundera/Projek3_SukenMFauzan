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

require_once __DIR__ . '../../../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

if ($_GET['cetak'] == 'xls') {
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Anggota Sering Pinjam.xls");

    $sql = "SELECT namaAnggota, COUNT(*) AS pinjam FROM anggota 
    INNER JOIN peminjaman ON anggota.idAnggota=peminjaman.idAnggota 
    GROUP BY namaAnggota ORDER BY COUNT(*) DESC LIMIT 5";
    $row = $db->getAll($sql);
    $no = 1;
    ?>

    <style>
        .w {
            border: solid black;
            padding: 1px;
        }
    </style>

    <table class='w table w-100'>
        <thead class='w table-primary'>
            <tr>
                <th class='w'>No</th>
                <th class='w'>Banyak Anggota yang Pinjam</th>
                <th class='w'>Buku</th>
            </tr>
        </thead>
        <tbody>
            <table class="w">
                <?php foreach ($row as $data) : ?>
                    <tr>
                        <td class='w'><?= $no++ ?></td>
                        <td class='w'><?= $data['namaAnggota'] ?></td>
                        <td class='w'><?= $data['pinjam'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

    <?php } else {
        // header("Content-type: application/pdf");
    // header("Content-Disposition: inline; filename=Jumlah Buku Dipinjam.pdf");

     $sql = "SELECT namaAnggota, COUNT(*) AS pinjam FROM anggota 
     INNER JOIN peminjaman ON anggota.idAnggota=peminjaman.idAnggota 
     GROUP BY namaAnggota ORDER BY COUNT(*) DESC LIMIT 5";
     $row = $db->getAll($sql);
     $no = 1;

     $mpdf->debug = true;
     $html = '<!DOCTYPE html>
     <html lang="en">
     <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Halaman Peminjaman Buku</title>

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

    body {
        background-color: #fff;
        color: #000;
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

    form {
        background-color: #FFFFFF;
    }

    table {
        border: none;
    }

    table tr td {
        padding: .5rem;
        color: #000;
        font-size: .8rem;

    }

    table thead tr th {
        background-color: #C5C5C5;
        color: #000;
        font-size: .8rem;
    }

    table tr:nth-child(even) {
        background-color: #F2F2F2;

    }

    table tr:nth-child(odd) {
        background-color: #E4E4E4;
    }

    h1 {
        font-size: 2.25rem;
        margin: .5rem 0 2rem 0;
        text-align:center;
        color: #000;
        font-weight: bold;
    }

    .btn {
        padding: .35rem .375rem;
        font-size: .8rem;
    }
    </style>
    </head>
    <body>
    <h1 class="text-center">5 Anggota Sering Pinjam</h1>
    <table border="0" cellpadding="10" cellspacing="0" class="mt-3">
    <thead class="w table-primary">
    <tr>
    <th class="w">No</th>
    <th class="w">Banyak Anggota yang Pinjam</th>
    <th class="w">Buku</th>
    </tr>
    </thead>
    <tbody>
    '; foreach ($row as $data) : 
    $html .= '<tr>
    <td> '. $no++ .' </td>
    <td> ' . $data['namaAnggota'] .' </td>
    <td> ' . $data['pinjam'] .' </td>
    </tr>';

endforeach; 

$html .= '
</tbody>
</table>    
</body>
</html>';

$footer = '5 Anggota Sering Pinjam | {PAGENO} | {DATE j-m-Y}';

$mpdf->SetFooter($footer);
$mpdf->WriteHTML($html);
$mpdf->Output('5 Anggota Sering Pinjam.pdf', 'I');
}