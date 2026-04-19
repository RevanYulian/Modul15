<?php
session_start();

// Proteksi Halaman: Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "koneksi.php";

$nis = $_GET['nis'];
$query = "SELECT * FROM tb_siswa WHERE nis = '$nis'";
$hasil = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($hasil);

// Memecah tanggal lahir (YYYY-MM-DD) menjadi bagian tgl, bln, thn
$split_ttl = explode("-", $data['ttl']);
$thn = $split_ttl[0] ?? "";
$bln = $split_ttl[1] ?? "";
$tgl = $split_ttl[2] ?? "";

// Mengubah string hobi menjadi array untuk pengecekan checkbox
$array_hobi = explode(", ", $data['hobi']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Data Siswa</title>
    <style>
        .container { border: 1px solid black; padding: 20px; width: 550px; margin: 20px auto; font-family: sans-serif; }
        .title { color: #8A2BE2; text-align: center; font-weight: bold; font-size: 1.2em; margin-bottom: 10px; }
        .required { color: red; }
        hr { border: 0; border-top: 1px solid #000; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Update Data Ekstrakurikuler</div>
        <hr>
        <form action="proses_update.php" method="POST">
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td width="120">NIS</td>
                    <td>: <input type="text" name="nis" value="<?php echo $data['nis']; ?>" readonly> <span class="required">*</span></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: <input type="text" name="nama" value="<?php echo $data['nama']; ?>" style="width: 300px;"></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>: 
                        <select name="kelas">
                            <option value="X" <?php if($data['kelas']=="X") echo "selected"; ?>>X</option>
                            <option value="XI" <?php if($data['kelas']=="XI") echo "selected"; ?>>XI</option>
                            <option value="XII" <?php if($data['kelas']=="XII") echo "selected"; ?>>XII</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Tgl Lahir</td>
                    <td>: 
                        <input type="text" name="tgl" size="2" value="<?php echo $tgl; ?>"> / 
                        <input type="text" name="bln" size="10" value="<?php echo $bln; ?>"> / 
                        <input type="text" name="thn" size="4" value="<?php echo $thn; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <textarea name="alamat" cols="40" rows="3"><?php echo $data['alamat']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Kota</td>
                    <td>: <input type="text" name="kota" value="<?php echo $data['kota']; ?>"></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: 
                        <input type="radio" name="jk" value="Laki-Laki" <?php if($data['jk']=="L") echo "checked"; ?>> Laki-Laki
                        <input type="radio" name="jk" value="Perempuan" <?php if($data['jk']=="P") echo "checked"; ?>> Perempuan
                    </td>
                </tr>
                <tr>
                    <td valign="top">Hobby</td>
                    <td>: 
                        <?php 
                        $hobbies = ["Membaca", "Olahraga", "Menyanyi", "Menari", "Traveling"];
                        foreach ($hobbies as $h) {
                            $checked = in_array($h, $array_hobi) ? "checked" : "";
                            echo "<input type='checkbox' name='hobby[]' value='$h' $checked> $h <br>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Pilihan Ekskul</td>
                    <td>: 
                        <select name="ekskul" size="7" style="width: 150px;">
                            <?php 
                            $ekskuls = ["Pramuka", "Basket", "Volly", "Band", "Seni Tari", "Robotic", "Bulu Tangkis"];
                            foreach ($ekskuls as $e) {
                                $selected = ($data['ekskul'] == $e) ? "selected" : "";
                                echo "<option value='$e' $selected>$e</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <br>
                        <input type="submit" name="submit" value="Update Data"> 
                        <a href="tampil.php"><input type="button" value="Batal"></a>
                    </td>
                </tr>
            </table>
            <p class="required" style="font-size: 0.8em; margin-top: 15px;">* NIS bersifat permanen dan tidak dapat diubah.</p>
        </form>
    </div>
</body>
</html>