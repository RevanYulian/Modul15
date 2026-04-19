<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Proteksi halaman
    exit();
}

include "koneksi.php";
$query = "SELECT * FROM tb_siswa";
$hasil = mysqli_query($koneksi, $query);
$jum = mysqli_num_rows($hasil);
?>
<html>
<head><title>Tampil Data Siswa</title></head>
<body>
    <h2>Data Biodata Siswa RPL</h2>
    <p>Selamat Datang, <b><?php echo $_SESSION['username']; ?></b> | <a href="logout.php">Logout</a></p>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr bgcolor="#eee">
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th colspan="3">Action</th>
        </tr>
        <?php 
        $no = 1;
        while ($data = mysqli_fetch_array($hasil)) { 
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nis']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['kelas']; ?></td>
            <td><a href="detail.php?nis=<?php echo $data['nis']; ?>">Detail</a></td>
            <td><a href="form_update.php?nis=<?php echo $data['nis']; ?>">Edit</a></td>
            <td><a href="delete.php?nis=<?php echo $data['nis']; ?>" onclick="return confirm('Yakin hapus?')">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <b>Banyak Data: <?php echo $jum; ?></b> | <a href="insert.php">Tambah Data</a>
</body>
</html>