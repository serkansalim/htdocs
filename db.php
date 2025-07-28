<?php
$host = 'localhost';
$user = 'db_kullanici';
$pass = 'db_sifre';
$db   = 'veritabani_adi';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Veritabanı bağlantı hatası: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>
