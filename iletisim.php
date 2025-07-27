<?php include 'header.php'; ?>
<link rel="stylesheet" href="css/iletisim.css">

<div class="iletisim-container">
  <h2>İletişim</h2>

  <p class="intro">Bizimle iletişime geçmekten çekinmeyin. Her türlü öneri, soru ve geri bildirim için buradayız.</p>

  <form class="contact-form" method="post" action="#">
    <input type="text" name="name" placeholder="Adınız Soyadınız" required>
    <input type="email" name="email" placeholder="E-posta Adresiniz" required>
    <textarea name="message" rows="5" placeholder="Mesajınız" required></textarea>
    <button type="submit">Gönder</button>
  </form>
</div>

<?php include 'footer.php'; ?>
