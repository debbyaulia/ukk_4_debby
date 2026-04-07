<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register Akun</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #d6ecff, #f0f9ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-box {
            background: white;
            padding: 40px;
            width: 380px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .register-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1e6091;
        }

        .register-box input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #cbd5e0;
            outline: none;
        }

        .register-box input:focus {
            border-color: #5dade2;
            box-shadow: 0 0 5px rgba(93,173,226,0.5);
        }

        .register-box button {
            width: 100%;
            padding: 10px;
            background: #5dade2;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .register-box button:hover {
            background: #3498db;
        }

        .register-box p {
            text-align: center;
            font-size: 14px;
        }

        .register-box a {
            color: #1e6091;
            text-decoration: none;
            font-weight: bold;
        }

        .library-icon {
            text-align: center;
            font-size: 40px;
            margin-bottom: 10px;
        }

        .error-msg {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .success-msg {
            color: green;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="register-box">

    <div class="library-icon">📚</div>
    <h2>Register Akun Perpustakaan</h2>

    <?php
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == 'register_gagal') {
            echo "<p class='error-msg'>Email sudah terdaftar!</p>";
        }
    }
    ?>

    <form method="POST" action="../controllers/AuthControllers.php">
        <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required>
        <input type="email" name="email" placeholder="Masukkan Email" required>
        <input type="password" name="password" placeholder="Masukkan Password" required>

        <button type="submit" name="register">Daftar</button>
    </form>

    <br>
    <p>Sudah punya akun? <a href="login.php">Login disini</a></p>

</div>

</body>
</html>