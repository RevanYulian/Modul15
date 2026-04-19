<?php
session_start();

// Proteksi Halaman: Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "koneksi.php";

// Mengambil NIS dari URL
$nis = $_GET['nis'];
$query = "SELECT * FROM tb_siswa WHERE nis = '$nis'";
$hasil = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($hasil);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Data Siswa</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .card { border: 1px solid #ccc; padding: 20px; width: 400px; border-radius: 8px; }
        h3 { color: #8A2BE2; }
    </style>
</head>
<body>
    <h3>Detail Biodata Siswa</h3>
    <div class="card">
        <table cellpadding="5">
            <tr><td><b>NIS</b></td><td>:</td><td><?php echo $data['nis'];?></td></tr>
            <tr><td><b>Nama</b></td><td>:</td><td><?php echo $data['nama']; ?></td></tr>
            <tr><td><b>Kelas</b></td><td>:</td><td><?php echo $data['kelas']; ?></td></tr>
            <tr><td><b>Tgl Lahir</b></td><td>:</td><td><?php echo $data['ttl']; ?></td></tr>
            <tr><td><b>Alamat</b></td><td>:</td><td><?php echo $data['alamat']; ?></td></tr>
            <tr><td><b>Kota</b></td><td>:</td><td><?php echo $data['kota']; ?></td></tr>
            <tr><td><b>Jenis Kelamin</b></td><td>:</td><td><?php echo ($data['jk'] == 'L') ? 'Laki-Laki' : 'Perempuan'; ?></td></tr>
            <tr><td><b>Hobby</b></td><td>:</td><td><?php echo $data['hobi']; ?></td></tr>
            <tr><td><b>Ekskul</b></td><td>:</td><td><?php echo $data['ekskul']; ?></td></tr>
        </table>
    </div>
    <br>
    <a href="tampil.php"> Kembali ke Daftar</a>
</body>
</html>