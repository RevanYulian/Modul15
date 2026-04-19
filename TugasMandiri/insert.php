<?php
session_start();

// Proteksi Halaman: Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "koneksi.php";

if (isset($_POST['submit'])) {
    $nis    = $_POST['nis'];
    $nama   = $_POST['nama'];
    $kelas  = $_POST['kelas'];
    
    // Menggabungkan tgl, bln, thn menjadi format YYYY-MM-DD
    $ttl    = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tgl'];
    
    $alamat = $_POST['alamat'];
    $kota   = $_POST['kota'];
    
    // Konversi Jenis Kelamin ke format database (L/P)
    $jk     = ($_POST['jk'] == "Laki-Laki") ? "L" : "P";
    
    // Menggabungkan array hobby menjadi string
    $hobi   = isset($_POST['hobby']) ? implode(", ", $_POST['hobby']) : "";
    
    $ekskul = $_POST['ekskul'];

    // Perbaikan Query: Sebutkan nama kolom agar tidak tertukar
    $query = "INSERT INTO tb_siswa (nis, nama, kelas, ttl, alamat, kota, jk, hobi, ekskul) 
              VALUES ('$nis', '$nama', '$kelas', '$ttl', '$alamat', '$kota', '$jk', '$hobi', '$ekskul')";
    
    $hasil = mysqli_query($koneksi, $query);

    if ($hasil) {
        echo "<script>alert('Data Berhasil Disimpan'); window.location='tampil.php';</script>";
    } else {
        echo "Gagal menyimpan: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Ekstrakurikuler</title>
    <style>
        .container { border: 1px solid black; padding: 20px; width: 550px; margin: 20px auto; font-family: sans-serif; }
        .title { color: #8A2BE2; text-align: center; font-weight: bold; font-size: 1.2em; margin-bottom: 10px; }
        .required { color: red; }
        hr { border: 0; border-top: 1px solid #000; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Pendaftaran Ekstrakurikuler</div>
        <hr>
        <form action="" method="POST">
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td width="120">NIS</td>
                    <td>: <input type="text" name="nis" required> <span class="required">*</span></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: <input type="text" name="nama" style="width: 300px;"></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>: 
                        <select name="kelas">
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Tgl Lahir</td>
                    <td>: 
                        <input type="text" name="tgl" size="2" placeholder="DD"> / 
                        <input type="text" name="bln" size="10" placeholder="MM"> / 
                        <input type="text" name="thn" size="4" placeholder="YYYY">
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <textarea name="alamat" cols="40" rows="3"></textarea></td>
                </tr>
                <tr>
                    <td>Kota</td>
                    <td>: <input type="text" name="kota"></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: 
                        <input type="radio" name="jk" value="Laki-Laki"> Laki-Laki
                        <input type="radio" name="jk" value="Perempuan"> Perempuan
                    </td>
                </tr>
                <tr>
                    <td valign="top">Hobby</td>
                    <td>: 
                        <input type="checkbox" name="hobby[]" value="Membaca"> Membaca <br>
                        <input type="checkbox" name="hobby[]" value="Olahraga"> Olahraga <br>
                        <input type="checkbox" name="hobby[]" value="Menyanyi"> Menyanyi <br>
                        <input type="checkbox" name="hobby[]" value="Menari"> Menari <br>
                        <input type="checkbox" name="hobby[]" value="Traveling"> Traveling
                    </td>
                </tr>
                <tr>
                    <td valign="top">Pilihan Ekskul</td>
                    <td>: 
                        <select name="ekskul" size="7" style="width: 150px;">
                            <option value="Pramuka">Pramuka</option>
                            <option value="Basket">Basket</option>
                            <option value="Volly">Volly</option>
                            <option value="Band">Band</option>
                            <option value="Seni Tari">Seni Tari</option>
                            <option value="Robotic">Robotic</option>
                            <option value="Bulu Tangkis">Bulu Tangkis</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <br>
                        <input type="submit" name="submit" value="Kirim"> 
                        <input type="reset" value="Cancel">
                        <a href="tampil.php"><button type="button">Kembali</button></a>
                    </td>
                </tr>
            </table>
            <p class="required" style="font-size: 0.8em; margin-top: 15px;">* Harus Di isi</p>
        </form>
    </div>
</body>
</html>