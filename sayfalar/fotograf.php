<?php
$success = '';
$error = '';
$dataFile = 'data.json';

// Silme işlemi
if (isset($_GET['sil'])) {
    $silinen = $_GET['sil'];
    $gorseller = json_decode(@file_get_contents($dataFile), true) ?? [];
    $gorseller = array_filter($gorseller, function($gorsel) use ($silinen) {
        return $gorsel !== $silinen;
    });
    file_put_contents($dataFile, json_encode(array_values($gorseller), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

    if (file_exists($silinen)) {
        unlink($silinen); // fiziksel dosyayı sil
        $success = "Fotoğraf silindi.";
    } else {
        $error = "Fotoğraf silinemedi (dosya bulunamadı).";
    }
}

// Yükleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    $dosya_ad = basename($_FILES["foto"]["name"]);
    $hedef_dosya = $upload_dir . time() . "_" . $dosya_ad;

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $hedef_dosya)) {
        $veri = json_decode(@file_get_contents($dataFile), true) ?? [];
        $veri[] = $hedef_dosya;
        file_put_contents($dataFile, json_encode($veri, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        $success = "Fotoğraf başarıyla yüklendi.";
    } else {
        $error = "Fotoğraf yüklenirken hata oluştu.";
    }
}

$gorseller = json_decode(@file_get_contents($dataFile), true) ?? [];
?>

<h3>Fotoğraf Ekle</h3>
<?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="mb-4">
  <input type="file" name="foto" class="form-control mb-2" required>
  <button class="btn btn-primary">Yükle</button>
</form>

<div class="row">
  <?php foreach ($gorseller as $img): ?>
    <div class="col-md-3 mb-3 text-center">
      <img src="<?= $img ?>" class="img-fluid rounded shadow-sm mb-2">
      <a href="?sayfa=fotograf&sil=<?= urlencode($img) ?>" onclick="return confirm('Silmek istediğine emin misin?')" class="btn btn-sm btn-danger">Sil</a>
    </div>
  <?php endforeach; ?>
</div>
