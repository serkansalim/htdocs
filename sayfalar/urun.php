<?php
$mesaj = '';
$urunlerDosyasi = "urunler.json";

// Ürün silme işlemi
if (isset($_GET['sil'])) {
    $silinen = $_GET['sil'];
    $urunler = json_decode(@file_get_contents($urunlerDosyasi), true) ?? [];

    // JSON'dan ürünü kaldır
    $urunler = array_filter($urunler, function ($urun) use ($silinen) {
        return $urun !== $silinen;
    });
    file_put_contents($urunlerDosyasi, json_encode(array_values($urunler), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

    // Fiziksel dosyayı sil
    if (file_exists($silinen)) {
        unlink($silinen);
        $mesaj = "Ürün başarıyla silindi.";
    } else {
        $mesaj = "Ürün JSON'dan silindi, ancak dosya bulunamadı.";
    }
}

// Ürün yükleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $dosyaAd = basename($_FILES["foto"]["name"]);
    $hedefDosya = $uploadDir . time() . "_urun_" . $dosyaAd;

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $hedefDosya)) {
        $urunler = json_decode(@file_get_contents($urunlerDosyasi), true) ?? [];
        $urunler[] = $hedefDosya;
        file_put_contents($urunlerDosyasi, json_encode($urunler, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        $mesaj = "Ürün başarıyla yüklendi.";
    }
}

// Ürünleri listele
$urunler = json_decode(@file_get_contents($urunlerDosyasi), true) ?? [];
?>

<h3>Ürün Ekle</h3>

<?php if ($mesaj): ?>
  <div class="alert alert-info"><?= $mesaj ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="mb-4">
  <input type="file" name="foto" class="form-control mb-2" accept="image/*" required>
  <button type="submit" class="btn btn-success">Yükle</button>
</form>

<div class="row">
  <?php foreach ($urunler as $img): ?>
    <div class="col-md-3 mb-3 text-center">
      <img src="<?= $img ?>" class="img-fluid rounded shadow-sm mb-2">
      <a href="?sayfa=urun&sil=<?= urlencode($img) ?>"
         class="btn btn-sm btn-danger"
         onclick="return confirm('Bu ürünü silmek istediğine emin misin?')">Sil</a>
    </div>
  <?php endforeach; ?>
</div>
