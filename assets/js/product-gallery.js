(function () {
  const galleries = document.querySelectorAll('[data-product-gallery]');

  galleries.forEach((gallery) => {
    const slides = Array.from(gallery.querySelectorAll('[data-gallery-slide]'));
    const dots = Array.from(gallery.querySelectorAll('[data-gallery-dot]'));
    const prev = gallery.querySelector('[data-gallery-prev]');
    const next = gallery.querySelector('[data-gallery-next]');
    let activeIndex = 0;

    if (slides.length <= 1) {
      return;
    }

    const showSlide = (index) => {
      activeIndex = (index + slides.length) % slides.length;

      slides.forEach((slide, slideIndex) => {
        slide.classList.toggle('is-active', slideIndex === activeIndex);
      });

      dots.forEach((dot, dotIndex) => {
        dot.classList.toggle('is-active', dotIndex === activeIndex);
        dot.setAttribute('aria-current', dotIndex === activeIndex ? 'true' : 'false');
      });
    };

    if (prev) {
      prev.addEventListener('click', () => showSlide(activeIndex - 1));
    }

    if (next) {
      next.addEventListener('click', () => showSlide(activeIndex + 1));
    }

    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => showSlide(index));
    });

    gallery.addEventListener('keydown', (event) => {
      if (event.key === 'ArrowLeft') {
        showSlide(activeIndex - 1);
      }

      if (event.key === 'ArrowRight') {
        showSlide(activeIndex + 1);
      }
    });

    showSlide(0);
  });
})();
