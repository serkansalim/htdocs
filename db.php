<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'site_veritabani';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Veritabanı bağlantı hatası: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>
