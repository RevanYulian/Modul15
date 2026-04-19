<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
include "koneksi.php";

if (isset($_POST['submit'])) {
    $nis    = $_POST['nis'];
    $nama   = $_POST['nama'];
    $kelas  = $_POST['kelas'];
    $ttl    = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tgl'];
    $alamat = $_POST['alamat'];
    $kota   = $_POST['kota'];
    $jk     = ($_POST['jk'] == "Laki-Laki") ? "L" : "P";
    $hobi   = isset($_POST['hobby']) ? implode(", ", $_POST['hobby']) : "";
    $ekskul = $_POST['ekskul'];

    $query = "INSERT INTO tb_siswa VALUES ('$nis', '$nama', '$kelas', '$ttl', '$alamat', '$kota', '$jk', '$hobi', '$ekskul')";
    $hasil = mysqli_query($koneksi, $query);

    if ($hasil) {
        echo "<script>alert('Data Tersimpan'); window.location='tampil.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Tambah Data</title></head>
<body>
    <form action="" method="POST">
        <input type="submit" name="submit" value="Kirim">
        <a href="tampil.php">Kembali</a>
    </form>
</body>
</html>