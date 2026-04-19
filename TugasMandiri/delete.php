<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
include "koneksi.php";

$nis = $_GET['nis'];
$query = "DELETE FROM tb_siswa WHERE nis = '$nis'";
mysqli_query($koneksi, $query);

header("Location: tampil.php");
?>