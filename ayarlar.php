<?php
session_start();
if (!isset($_SESSION['kullanici'])) {
    header("Location: login.php");
    exit();
}

if (!file_exists("data.json")) {
    file_put_contents("data.json", json_encode([]));
}

$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $dosyaAd = basename($_FILES["foto"]["name"]);
    $hedefDosya = $uploadDir . time() . "_" . $dosyaAd;

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $hedefDosya)) {
        $veri = json_decode(file_get_contents("data.json"), true);
        $veri[] = $hedefDosya;
        file_put_contents("data.json", json_encode($veri, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        $success = "Fotoğraf başarıyla yüklendi.";
    }
}

$gorseller = json_decode(file_get_contents("data.json"), true);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Fotoğraf Ayarları</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">
<div class="container">
    <h3 class="mb-4">Anasayfa Fotoğraf Ekle</h3>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="mb-4">
        <input type="file" name="foto" class="form-control mb-2" accept="image/*" required>
        <button type="submit" class="btn btn-primary">Yükle</button>
        <a href="panel.php" class="btn btn-secondary float-end">Panele Dön</a>
    </form>

    <h5>Mevcut Fotoğraflar</h5>
    <div class="row">
        <?php foreach ($gorseller as $img): ?>
            <div class="col-md-3 mb-3">
                <img src="<?= $img ?>" class="img-fluid rounded shadow-sm">
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
