<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #cfe9ff, #e6f4ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: white;
            padding: 40px;
            width: 350px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2b6cb0;
        }

        .login-box input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #cbd5e0;
            outline: none;
        }

        .login-box button {
            width: 100%;
            padding: 10px;
            background: #63b3ed;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .success-msg { color: green; text-align: center; }
        .error-msg { color: red; text-align: center; }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>

    <?php
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == 'register_berhasil') {
            echo "<p class='success-msg'>Registrasi berhasil! Silakan login.</p>";
        } elseif ($_GET['msg'] == 'login_gagal') {
            echo "<p class='error-msg'>Email atau password salah!</p>";
        }
    }
    ?>

    <form method="POST" action="../controllers/AuthControllers.php">
        <input type="email" name="email" placeholder="Masukkan Email" required>
        <input type="password" name="password" placeholder="Masukkan Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
</div>

</body>
</html>