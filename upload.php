<?php
session_start();
if (!isset($_SESSION['kullanici'])) {
    header('Location: login.php');
    exit();
}
require_once 'db.php';

$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $dosyaAd = basename($_FILES['foto']['name']);
    $hedef = $uploadDir . time() . '_' . $dosyaAd;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $hedef)) {
        $stmt = $conn->prepare('INSERT INTO gorseller (dosya_yolu, uploaded_at) VALUES (?, NOW())');
        $stmt->bind_param('s', $hedef);
        $stmt->execute();
        $stmt->close();
        $success = 'Fotoğraf başarıyla yüklendi.';
    } else {
        $success = 'Dosya yüklenirken bir hata oluştu.';
    }
}

$result = $conn->query('SELECT dosya_yolu FROM gorseller ORDER BY uploaded_at DESC');
$gorseller = [];
while ($row = $result->fetch_assoc()) {
    $gorseller[] = $row['dosya_yolu'];
}
?>
