<?php include 'header.php'; ?>
<?php require_once 'db.php'; ?>

<div style="padding: 20px; max-width: 900px; margin: auto; font-family: sans-serif;">
  <h2 style="text-align: center; margin-bottom: 20px;">İletişim</h2>

  <?php
  $sorgu = $conn->query("SELECT baslik, bilgi FROM iletisim_bilgileri");

  $gosterilenler = [];
  while ($satir = $sorgu->fetch_assoc()):
    if (in_array($satir['baslik'], $gosterilenler)) continue;
    $gosterilenler[] = $satir['baslik'];

    $baslik = htmlspecialchars($satir['baslik']);
    $bilgi = htmlspecialchars($satir['bilgi']);
  ?>
    <div style="margin-bottom: 15px;">
      <strong><?= $baslik ?>:</strong>
      <p style="margin: 5px 0;">
        <?php if (strtolower($baslik) === 'telefon'): ?>
          <?php
            // Telefon numarasını temizle
            $rakamlar = preg_replace('/\D+/', '', $bilgi); // Sadece sayılar

            // Eğer başta 90 varsa sil
            if (substr($rakamlar, 0, 2) === '90') {
              $rakamlar = substr($rakamlar, 2);
            }

            // Eğer başta 0 varsa sil
            if (substr($rakamlar, 0, 1) === '0') {
              $rakamlar = substr($rakamlar, 1);
            }

            // Tel href için formatla
            $telHref = 'tel:+90' . $rakamlar;

            // Ekranda gösterilecek hali (boşluklu orijinal hali)
            $gorunen = $bilgi;
          ?>
          <a href="<?= $telHref ?>"><?= $gorunen ?></a>
        <?php else: ?>
          <?= nl2br($bilgi) ?>
        <?php endif; ?>
      </p>
    </div>
  <?php endwhile; ?>
</div>

<?php include 'footer.php'; ?>
