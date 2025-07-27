<?php include 'header.php'; ?>

<div class="slider-wrapper">
  <img src="img/baybaki1.jpg" alt="Fotoğraf 1" class="slider-img active">
  <img src="img/baybaki2.jpg" alt="Fotoğraf 2" class="slider-img">

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
    <img src="img/baybaki11.jpg">
    <img src="img/baybaki3.jpg">
    <img src="img/baybaki4.jpg">
    <img src="img/baybaki7.jpg">
    <img src="img/baybaki6.jpg">
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
    const itemWidth = track.querySelector("img").offsetWidth + 10; // + gap
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
      const maxIndex = track.children.length - 4; // 4 ürün görünür
      if (currentIndex < maxIndex) {
        currentIndex++;
        updateSlide();
      }
    });
  });

</script>

