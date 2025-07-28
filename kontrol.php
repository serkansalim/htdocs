<?php
session_start();

// Sabit kullanıcı adı ve şifre (örnek için, gerçek projede veritabanı kullan)
$dogru_kullanici = "admin";
$dogru_sifre = "00000";

// Formdan gelen
$kullanici = $_POST['kullanici'] ?? '';
$sifre = $_POST['sifre'] ?? '';

if ($kullanici === $dogru_kullanici && $sifre === $dogru_sifre) {
    $_SESSION['kullanici'] = $kullanici;
    header("Location: panel.php");
    exit();
} else {
    echo "Hatalı kullanıcı adı veya şifre. <a href='login.php'>Tekrar dene</a>";
}
