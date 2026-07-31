<?php
/**
 * Header template
 *
 * @package AlmCampCustom
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<header class="site-header custom-header">


  <!-- Barra superior -->
  <div class="header-top">
    <div class="header-container header-top__inner">

      <form
        role="search"
        class="header-search woocommerce-product-search" 
        action="<?php echo esc_url( home_url( '/' ) ); ?>" 
        method="get"
      >
        <label class="screen-reader-text" for="header-search-input">
          Buscar productos
        </label>

        <input
          type="search"
          id="header-search-input"
          class="search-field"
          name="s"
          placeholder="Buscar productos"
          value="<?php echo esc_attr( get_search_query() ); ?>"
        >

        <input type="hidden" name="post_type" value="product">

        <button type="submit">
          Buscar
        </button>

        <div class="header-search__results" id="header-search-results"></div>
      </form>

      <nav class="header-links" aria-label="Enlaces rápidos">
        <div class="header-links__inner">
          <div class="vl"></div>
          <a href="<?php echo esc_url( home_url( '/foro-de-pescadores/' ) ); ?>">Blog</a>
          <div class="vl"></div>
          <a href="<?php echo esc_url( home_url( '/politica-de-devoluciones-y-reembolsos/' ) ); ?>">Nuestros términos y condiciones</a>
          <div class="vl"></div>
          <a href="<?php echo esc_url( home_url( '/quienes-somos/' ) ); ?>">Quiénes somos</a>
        </div>

      </nav>

    </div>
  </div>

  <!-- Header principal -->
  <div class="header-main">
    <div class="header-container header-main__inner">

      <button
        class="header-menu-toggle"
        type="button"
        aria-controls="header-nav-toggle"
        aria-expanded="false"
      >
        <span class="header-menu-toggle__icon" aria-hidden="true"></span>
        <span class="screen-reader-text"><?php esc_html_e( 'Abrir menu', 'almcampcustom' ); ?></span>
      </button>

      <div class="site-header-left">
          <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
              <div class="site-logo"><?php the_custom_logo(); ?></div>
          <?php endif; ?>
      </div>

      <nav class="header-nav" aria-label="Menú principal">
        <?php
          $category_slugs = array(
            'carreteles',
            'canas-y-combos',
            'senuelos',
            'camping',
            'accesorios',
            'terminales',
            'vestuario',
          );
        ?>

        <div class="header-nav__toggle" id="header-nav-toggle">
          <?php foreach ( $category_slugs as $category_slug ) : ?>

          <?php
          $term = get_term_by( 'slug', $category_slug, 'product_cat' );

          if ( ! $term || is_wp_error( $term ) ) {
            continue;
          }

          $subcategories = get_terms( array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
            'parent'     => $term->term_id,
          ) );
          ?>

          <div class="dropdown">
              <a class="dropbtn" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
                <?php echo esc_html( $term->name ); ?>
                <i class="fa fa-caret-down"></i>
              </a>

            <?php if ( ! empty( $subcategories ) && ! is_wp_error( $subcategories ) ) : ?>
              <div class="dropdown-content">

                <?php foreach ( $subcategories as $subcategory ) : ?>
                  <a href="<?php echo esc_url( get_term_link( $subcategory ) ); ?>">
                    <?php echo esc_html( $subcategory->name ); ?>
                  </a>
                <?php endforeach; ?>

              </div>
            <?php endif; ?>

          </div>
          <?php endforeach; ?>     

        </div>
      </nav>

      <div class="site-tools">
        <?php
        $account_url = class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'myaccount' ) : wp_login_url();
        ?>

        <?php if ( function_exists( 'is_user_logged_in' ) && is_user_logged_in() ) : ?>
          <a class="account-link" href="<?php echo esc_url( $account_url ); ?>">
            <?php esc_html_e( 'Mi cuenta', 'almcampcustom' ); ?>
          </a>
		  
		 	<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			  <a class="cart-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
				<span class="cart-count"><?php echo esc_html( WC()->cart ? WC()->cart->get_cart_contents_count() : 0 ); ?></span>
				<?php esc_html_e( 'Carrito', 'almcampcustom' ); ?>
			  </a>
        	<?php endif; ?>
          
        <?php  else : ?>
          <a class="account-link" href="<?php echo esc_url( $account_url ); ?>">
            <?php esc_html_e( 'Iniciar Sesión', 'almcampcustom' ); ?>
          </a>
        <?php endif; ?>
      </div>

    </div>
  </div>
</header>
