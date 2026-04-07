<?php
session_start();

require_once "../config/Database.php";
require_once "../models/User.php";

$db = (new Database())->connect();
$user = new User($db);

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/
if (isset($_POST['login'])) {

    $data = $user->login($_POST['email'], $_POST['password']);

    if ($data) {

        $_SESSION['user'] = $data;

        // CEK ROLE
        if ($data['role'] === 'admin') {
            header("Location: ../views/admin_dashboard.php");
        } else {
            header("Location: ../views/siswa_dashboard.php");
        }
        exit;

    } else {
        header("Location: ../views/login.php?msg=login_gagal");
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/
if (isset($_POST['register'])) {

    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    if ($user->cekEmail($email)) {
        echo "Email sudah terdaftar!";
        exit;
    }

    if ($user->register($nama, $email, $password)) {
        header("Location: ../views/login.php?msg=register_berhasil");
        exit;
    } else {
        echo "Gagal mendaftar!";
    }
}

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../views/login.php");
    exit;
}