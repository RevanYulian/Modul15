<?php
session_start();
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Validasi login statis (Tanpa Database)
    if ($user == "admin" && $pass == "12345") {
        $_SESSION['username'] = $user; // Membuat session
        header("Location: tampil.php"); // Masuk ke halaman biodata
        exit();
    } else {
        echo "<script>alert('Username atau Password Salah!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login System</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f4f4f4; }
        .login-card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h2 { color: #8A2BE2; text-align: center; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>LOGIN ADMIN</h2>
        <form method="POST">
            <table cellpadding="5">
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="login">Login</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>