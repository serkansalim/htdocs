<?php
session_start();
if (isset($_SESSION['kullanici'])) {
    header("Location: panel.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h4 class="text-center mb-4">Giriş Yap</h4>
        <form action="kontrol.php" method="post">
            <div class="mb-3">
                <label for="kullanici" class="form-label">Kullanıcı Adı</label>
                <input type="text" name="kullanici" id="kullanici" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="sifre" class="form-label">Şifre</label>
                <input type="password" name="sifre" id="sifre" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Giriş</button>
        </form>
    </div>
</div>

</body>
</html>
