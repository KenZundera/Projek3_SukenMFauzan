<?php
session_start();
require_once 'dbcontroller.php';
$db = new DBConnection();

// ketika tombol register ditekan, proses fungsi registrasi
if (isset($_POST['register'])) {
    if (registrasi($_POST) > 0) {
        setcookie('username', $_POST['username'], time() + 120);
        setcookie('password', $_POST['password'], time() + 120);
        echo "<script>
        alert('user baru berhasil ditambahkan');
        document.location.href = '../index.php';
        </script>";
    } else {
        echo "<script>
        alert('user baru berhasil ditambahkan');
        </script>";

        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi - PWEB</title>

    <!-- Icon -->
    <link rel="shortcut icon" href="assets/icon/favicon.png" type="image/x-icon">

    <!-- Link CSS -->
    <link rel="stylesheet" href="../style.css">

    <style>
        body {
            padding: 1rem;
        }

        form {
            background: #202020;
            box-shadow: inset hoff voff blur #fff;
            margin: 0 auto;
            color: #fff;
            font-size: 1.5 rem;
            padding: 2rem;
            border-radius: 10px;
            width: 450px;
            height: 100% !important;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="registrasi">
        <form action="" method="post">
            <h1>Halaman Registrasi</h1>
            <hr>
            <ul>
                <li>
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" placeholder="Masukkan nama..." autocomplete="off" required autofocus>
                </li>

                <li>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Masukkan username..." autocomplete="off" required autofocus>
                </li>

                <li>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan Password..." autocomplete="off" required>
                </li>

                <li>
                    <label for="kelas">Kelas</label>
                    <select name="kelas" id="kelas">
                        <option value="">Pilih Kelas</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </li>

                <li>
                    <label for="jenisKelamin">Jenis Kelamin</label>
                    <select name="jenisKelamin" id="jenisKelamin">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki laki">Laki laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </li>

                <li>
                    <label for="tempatLahir">Tempat Lahir</label>
                    <input type="text" name="tempatLahir" id="tempatLahir" required placeholder="Masukkan tempat lahir ..">
                </li>

                <li>
                    <label for="tanggalLahir">Tanggal Lahir</label>
                    <input type="date" name="tanggalLahir" id="tanggalLahir" required>
                </li>

                <div class="flex-footer">
                    <div class="footer">
                        <button type="submit" name="register">Registrasi</button>
                    </div>
                </div>
                <div class="flex-footer">
                    <div class="footer">
                        <p>Sudah punya akun? <a href="../index.php">Login</a></p>
                    </div>
                </div>

            </ul>
        </form> 
    </div>


</body>
</html>