document.addEventListener( 'DOMContentLoaded', function() {
  var carousel = document.querySelector( '[data-featured-carousel]' );

  if ( ! carousel ) {
    return;
  }

  var track = carousel.querySelector( '[data-carousel-track]' );
  var viewport = carousel.querySelector( '.home-featured-carousel__viewport' );
  var previousButton = carousel.querySelector( '[data-carousel-prev]' );
  var nextButton = carousel.querySelector( '[data-carousel-next]' );

  if ( ! track ) {
    return;
  }

  var items = Array.prototype.slice.call( track.children );
  var currentIndex = 0;
  var step = 3;
  var timer = null;

  function getItemWidth() {
    if ( ! items.length ) {
      return 0;
    }

    var itemRect = items[0].getBoundingClientRect();
    var styles = window.getComputedStyle( track );
    var gap = parseFloat( styles.columnGap || styles.gap ) || 0;

    return itemRect.width + gap;
  }

  function getVisibleCount() {
    var itemWidth = getItemWidth();

    if ( ! itemWidth ) {
      return 1;
    }

    return Math.max( 1, Math.round( ( viewport || carousel ).offsetWidth / itemWidth ) );
  }

  function updateCarousel() {
    track.style.transform = 'translateX(-' + currentIndex * getItemWidth() + 'px)';
  }

  function moveCarousel( direction ) {
    var maxIndex = Math.max( 0, items.length - getVisibleCount() );

    if ( ! maxIndex ) {
      currentIndex = 0;
      updateCarousel();
      return;
    }

    currentIndex += direction * step;

    if ( currentIndex > maxIndex ) {
      currentIndex = 0;
    }

    if ( currentIndex < 0 ) {
      currentIndex = Math.max( 0, maxIndex - ( maxIndex % step ) );
    }

    updateCarousel();
  }

  function restartTimer() {
    window.clearInterval( timer );
    timer = window.setInterval( function() {
      moveCarousel( 1 );
    }, 4500 );
  }

  if ( previousButton ) {
    previousButton.addEventListener( 'click', function() {
      moveCarousel( -1 );
      restartTimer();
    } );
  }

  if ( nextButton ) {
    nextButton.addEventListener( 'click', function() {
      moveCarousel( 1 );
      restartTimer();
    } );
  }

  window.addEventListener( 'resize', updateCarousel );

  updateCarousel();
  restartTimer();
} );
