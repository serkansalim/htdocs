<?php
//session_start();
require_once __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $bilgi = $_POST['bilgi'];

    $stmt = $conn->prepare("UPDATE iletisim_bilgileri SET bilgi = ? WHERE id = ?");
    $stmt->bind_param('si', $bilgi, $id);
    $stmt->execute();
    $stmt->close();

    echo "<div class='alert alert-success'>Bilgi güncellendi.</div>";
}

// İletişim bilgilerini çek
$result = $conn->query("SELECT id, baslik, bilgi FROM iletisim_bilgileri");
?>

<h2>İletişim Bilgilerini Düzenle</h2>
<?php 
$gosterilenler = [];
while ($row = $result->fetch_assoc()): 
  if (in_array($row['baslik'], $gosterilenler)) continue;
  $gosterilenler[] = $row['baslik'];
?>
  <form method="POST" style="margin-bottom: 20px;">
    <label><strong><?= htmlspecialchars($row['baslik']) ?>:</strong></label><br>
    <textarea name="bilgi" rows="3" style="width: 100%;"><?= htmlspecialchars($row['bilgi']) ?></textarea><br>
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <button type="submit" class="btn btn-primary mt-2">Güncelle</button>
  </form>
<?php endwhile; ?>


