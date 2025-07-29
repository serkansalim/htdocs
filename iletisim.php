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
    $bilgi = $satir['bilgi'];
  ?>
    <div style="margin-bottom: 15px;">
      <strong><?= $baslik ?>:</strong>
      <p style="margin: 5px 0;">
        <?php if (strtolower($baslik) === 'telefon'): ?>
          <?php
            $rakamlar = preg_replace('/\D+/', '', $bilgi);

            if (substr($rakamlar, 0, 2) !== '90') {
              if (substr($rakamlar, 0, 1) === '0') {
                $rakamlar = substr($rakamlar, 1);
              }
              $rakamlar = '90' . $rakamlar;
            }

            $telHref = 'tel:+' . $rakamlar;
          ?>
          <a href="<?= $telHref ?>"><?= htmlspecialchars($bilgi) ?></a>
        <?php else: ?>
          <?= nl2br(htmlspecialchars($bilgi)) ?>
        <?php endif; ?>
      </p>
    </div>
  <?php endwhile; ?>
</div>

<?php include 'footer.php'; ?>
