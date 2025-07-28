<?php include 'header.php'; ?>

<?php
$sliderDosya = 'data.json';
$urunlerDosya = 'urunler.json';

$sliderlar = json_decode(@file_get_contents($sliderDosya), true) ?? [];

$urunler = json_decode(@file_get_contents($urunlerDosya), true) ?? [];
?>

<div class="slider-wrapper">
  <?php foreach ($sliderlar as $index => $img): ?>
    <img src="<?= htmlspecialchars($img) ?>" alt="Slider Fotoğrafı" class="slider-img <?= $index === 0 ? 'active' : '' ?>">
  <?php endforeach; ?>
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
    <?php foreach ($urunler as $img): ?>
      <img src="<?= htmlspecialchars($img) ?>" alt="Ürün Fotoğrafı">
    <?php endforeach; ?>
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

  const track = document.querySelector(".urunler-track");
  const leftBtn = document.querySelector(".urun-btn.left");
  const rightBtn = document.querySelector(".urun-btn.right");
  const itemWidth = track.querySelector("img").offsetWidth + 10;
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
    const maxIndex = track.children.length - 4;
    if (currentIndex < maxIndex) {
      currentIndex++;
      updateSlide();
    }
  });
});
</script>
