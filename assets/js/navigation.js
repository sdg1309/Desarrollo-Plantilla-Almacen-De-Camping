document.addEventListener( 'DOMContentLoaded', function() {
  var menuToggle = document.querySelector( '.menu-toggle' );
  var nav = document.querySelector( '.primary-navigation' );
  var headerMenuToggle = document.querySelector( '.header-menu-toggle' );
  var headerNav = document.querySelector( '.header-nav' );

  if ( menuToggle && nav ) {
    menuToggle.addEventListener( 'click', function() {
      nav.classList.toggle( 'active' );
    } );
  }

  if ( headerMenuToggle && headerNav ) {
    var closeHeaderNav = function() {
      headerNav.classList.remove( 'is-open' );
      headerMenuToggle.classList.remove( 'is-open' );
      headerMenuToggle.setAttribute( 'aria-expanded', 'false' );
    };

    headerMenuToggle.addEventListener( 'click', function() {
      var isOpen = headerNav.classList.toggle( 'is-open' );

      headerMenuToggle.classList.toggle( 'is-open', isOpen );
      headerMenuToggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
    } );

    window.addEventListener( 'resize', function() {
      if ( window.innerWidth > 900 ) {
        closeHeaderNav();
      }
    } );
  }
} );
