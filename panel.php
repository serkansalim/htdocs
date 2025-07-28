<?php
session_start();
if (!isset($_SESSION['kullanici'])) {
    header("Location: login.php");
    exit();
}
$page = $_GET['sayfa'] ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Yönetim Paneli</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      overflow-x: hidden;
    }
    .sidebar {
      min-height: 100vh;
      background: #2c3e50;
      color: white;
    }
    .sidebar a {
      display: block;
      padding: 12px 20px;
      color: white;
      text-decoration: none;
    }
    .sidebar a:hover, .sidebar a.active {
      background: #1abc9c;
    }

    .sidebar img {
      max-width: 100%;
      height: 50px; 
      object-fit: contain;
      display: block;
      margin: 15px auto; 
}
  </style>
</head>
<body>

<div class="row g-0">
  <!-- SOL MENÜ -->
  <div class="col-md-3 col-lg-2 sidebar">
    <img src="img/baybaki.png">
    <a href="?sayfa=dashboard" class="<?= $page === 'dashboard' ? 'active' : '' ?>">📊 Dashboard</a>
    <a href="?sayfa=fotograf" class="<?= $page === 'fotograf' ? 'active' : '' ?>">🖼️ Fotoğraf Ekle</a>
    <a href="?sayfa=urun" class="<?= $page === 'urun' ? 'active' : '' ?>">📦 Ürün Ekle</a>
    <a href="cikis.php" class="d-block text-danger border rounded p-3 m-3 text-center fw-semibold" style="background:#ffe6e6;">
  🚪 Çıkış Yap
</a>
  </div>

  <!-- SAĞ İÇERİK -->
  <div class="col-md-9 col-lg-10 p-4 bg-light">
    <?php
    if ($page === 'fotograf') {
        include 'sayfalar/fotograf.php';
    } elseif ($page === 'urun') {
        include 'sayfalar/urun.php';
    } else {
        echo "<h2>DASHBOARD</h2>";
    }
    ?>
  </div>
</div>

</body>
</html>
