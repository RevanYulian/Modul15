<?php
session_start();
session_destroy(); // Menghapus session
header("Location: login.php"); // Kembali ke login
exit();
?>