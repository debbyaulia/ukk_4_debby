<?php
require_once "../config/Database.php";

$db = (new Database())->connect();

$password = password_hash("admin123", PASSWORD_DEFAULT);

$db->query("UPDATE users SET password='$password' WHERE email='wawan@gmail.com'");

echo "Password admin berhasil di-hash!";