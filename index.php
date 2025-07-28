<?php include 'header.php'; ?>

<div class="slider-wrapper">
  <?php
  $dataFile = 'data.json';
  $gorseller = json_decode(@file_get_contents($dataFile), true) ?? [];

  if (count($gorseller) === 0) {
      echo '<p>Gösterilecek fotoğraf bulunamadı.</p>';
  } else {
      foreach ($gorseller as $index => $img) {
          // İlk fotoğrafa active class veriyoruz
          $activeClass = ($index === 0) ? 'active' : '';
          echo '<img src="' . htmlspecialchars($img) . '" alt="Fotoğraf" class="slider-img ' . $activeClass . '">';
      }
  }
  ?>
  <button onclick="prevSlide()" class="slider-btn left">◀</button>
  <button onclick="nextSlide()" class="slider-btn right">▶</button>
</div>

<div class="section-heading">
  <div class="line"></div>
  <h2>ÜRÜNLERİMİZ</h2>
  <div class="line"></div>
</div>

<div class="urunler-wrapper">
  <button class="urun-btn left">◀</button>
  <div class="urunler-track">
    <?php
    $urunlerDosyasi = 'urunler.json';
    $urunler = json_decode(@file_get_contents($urunlerDosyasi), true) ?? [];

    if (count($urunler) === 0) {
        echo '<p>Gösterilecek ürün bulunamadı.</p>';
    } else {
        foreach ($urunler as $urun) {
            echo '<img src="' . htmlspecialchars($urun) . '" alt="Ürün">';
        }
    }
    ?>
  </div>
  <button class="urun-btn right">▶</button>
</div>

<?php include 'footer.php'; ?>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    let currentSlide = 0;
    const slides = document.querySelectorAll(".slider-img");
    const prevBtn = document.querySelector(".slider-btn.left");
    const nextBtn = document.querySelector(".slider-btn.right");

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.toggle("active", i === index);
      });
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(currentSlide);
    }

    let slideInterval = setInterval(nextSlide, 10000);

    nextBtn.addEventListener("click", () => {
      clearInterval(slideInterval);
      nextSlide();
      slideInterval = setInterval(nextSlide, 10000);
    });

    prevBtn.addEventListener("click", () => {
      clearInterval(slideInterval);
      prevSlide();
      slideInterval = setInterval(nextSlide, 10000);
    });

    showSlide(currentSlide);
  });

  document.addEventListener("DOMContentLoaded", function () {
    const track = document.querySelector(".urunler-track");
    const leftBtn = document.querySelector(".urun-btn.left");
    const rightBtn = document.querySelector(".urun-btn.right");
    const imgs = track.querySelectorAll("img");
    if(imgs.length === 0) return; // Ürün yoksa işlemi durdur
    const itemWidth = imgs[0].offsetWidth + 10; // 10px boşluk var ise ayarla
    let currentIndex = 0;

    function updateSlide() {
      const offset = currentIndex * itemWidth;
      track.style.transform = `translateX(-${offset}px)`;
    }

    leftBtn.addEventListener("click", () => {
      if (currentIndex > 0) {
        currentIndex--;
        updateSlide();
      }
    });

    rightBtn.addEventListener("click", () => {
      const maxIndex = imgs.length - 4; // 4 ürün görünür diye ayarladım
      if (currentIndex < maxIndex) {
        currentIndex++;
        updateSlide();
      }
    });
  });
</script>
