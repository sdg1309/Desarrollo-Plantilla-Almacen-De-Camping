<?php
/**
 * Página de entrada / Home
 *
 * @package AlmacenDeCamping
 */

get_header();
?>

<main id="primary" class="site-main home-page">

  <!-- HERO PRINCIPAL -->
  <section class="home-hero">
    <div class="site-container home-hero__inner">
      <div class="home-hero__content">
        <span class="home-hero__eyebrow">Pesca, camping y aventura</span>

        <h1>Somos Almacén de Camping</h1>

        <p>
          Aquí empiezan las mejores pescas. Encuentra artículos especializados
          para pesca, camping, outdoor, náutica y aventura.
        </p>

        <div class="home-hero__actions">
          <a class="home-btn home-btn--primary" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
            Comprar ahora
          </a>

          <a class="home-btn home-btn--secondary" href="#categorias">
            Ver categorías
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- CATEGORÍAS -->
  <section id="categorias" class="home-section">
    <div class="site-container">

      <header class="home-section__header">
        <span class="home-section__eyebrow">Explora nuestra tienda</span>
        <h2>Productos por categoría</h2>
        <p>
          Encuentra fácilmente lo que necesitas para tu próxima salida,
          pesca o aventura al aire libre.
        </p>
      </header>
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

          <div class="home-category-grid">

            <?php foreach ( $category_slugs as $category_slug ) : ?>

              <?php
              $term = get_term_by( 'slug', $category_slug, 'product_cat' );

              if ( ! $term || is_wp_error( $term ) ) {
                continue;
              }

              $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );

              $image_url = $thumbnail_id
                ? wp_get_attachment_image_url( $thumbnail_id, 'large' )
                : get_template_directory_uri() . '/assets/images/category-placeholder.jpg';

              $category_link = get_term_link( $term );

              if ( is_wp_error( $category_link ) ) {
                continue;
              }
              ?>

              <a class="home-category-card" href="<?php echo esc_url( $category_link ); ?>">
                <div class="home-category-card__image">
                  <img
                    src="<?php echo esc_url( $image_url ); ?>"
                    alt="<?php echo esc_attr( $term->name ); ?>"
                    loading="lazy"
                  >
                </div>

                <div class="home-category-card__content">
                  <h3><?php echo esc_html( $term->name ); ?></h3>

                  <?php if ( ! empty( $term->description ) ) : ?>
                    <p><?php echo esc_html( $term->description ); ?></p>
                  <?php else : ?>
                    <p>Ver productos de esta categoría.</p>
                  <?php endif; ?>
                </div>
              </a>

            <?php endforeach; ?>

        </div>
    </div>
  </section>

  <!-- PRODUCTOS DESTACADOS -->
  <section class="home-section home-section--light">
    <div class="site-container">

      <header class="home-section__header">
        <span class="home-section__eyebrow">Recomendados</span>
        <h2>Productos destacados</h2>
        <p>
          Una selección de productos para pesca, camping y aventura.
        </p>
      </header>

      <?php if ( class_exists( 'WooCommerce' ) && function_exists( 'wc_get_product_visibility_term_ids' ) ) : ?>

        <?php
        $visibility_terms  = wc_get_product_visibility_term_ids();
        $featured_term_id  = ! empty( $visibility_terms['featured'] ) ? absint( $visibility_terms['featured'] ) : 0;
        $featured_products = new WP_Query( array(
          'post_type'      => 'product',
          'post_status'    => 'publish',
          'posts_per_page' => -1,
          'orderby'        => 'rand',
          'no_found_rows'  => true,
          'tax_query'      => array(
            array(
              'taxonomy' => 'product_visibility',
              'field'    => 'term_taxonomy_id',
              'terms'    => array( $featured_term_id ),
            ),
          ),
        ) );
        ?>

        <?php if ( $featured_products->have_posts() ) : ?>

          <div class="home-featured-carousel" data-featured-carousel>
            <button class="home-carousel-button home-carousel-button--prev" type="button" data-carousel-prev aria-label="Productos anteriores">
              <span aria-hidden="true">&lsaquo;</span>
            </button>

            <div class="home-featured-carousel__viewport">
              <div class="woocommerce home-featured-products">
                <ul class="products home-featured-carousel__track" data-carousel-track>

                  <?php while ( $featured_products->have_posts() ) : ?>
                    <?php
                    $featured_products->the_post();

                    global $product;
                    $product = wc_get_product( get_the_ID() );

                    if ( ! $product ) {
                      continue;
                    }

                    wc_get_template_part( 'content', 'product' );
                    ?>
                  <?php endwhile; ?>

                </ul>
              </div>
            </div>

            <button class="home-carousel-button home-carousel-button--next" type="button" data-carousel-next aria-label="Siguientes productos">
              <span aria-hidden="true">&rsaquo;</span>
            </button>
          </div>

        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

      <?php else : ?>

        <div class="home-products-placeholder">
          <article class="home-product-card">
            <div class="home-product-card__image"></div>
            <h3>Producto destacado</h3>
            <span>$0</span>
          </article>

          <article class="home-product-card">
            <div class="home-product-card__image"></div>
            <h3>Producto destacado</h3>
            <span>$0</span>
          </article>

          <article class="home-product-card">
            <div class="home-product-card__image"></div>
            <h3>Producto destacado</h3>
            <span>$0</span>
          </article>

          <article class="home-product-card">
            <div class="home-product-card__image"></div>
            <h3>Producto destacado</h3>
            <span>$0</span>
          </article>
        </div>

      <?php endif; ?>

      <div class="home-section__center">
        <a class="home-btn home-btn--primary" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
          Ver tienda completa
        </a>
      </div>

    </div>
  </section>

  <?php
  $brand_taxonomy = function_exists( 'almcampcustom_get_brand_taxonomy' ) ? almcampcustom_get_brand_taxonomy() : '';
  $brand_terms    = $brand_taxonomy ? get_terms( array(
    'taxonomy'   => $brand_taxonomy,
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
  ) ) : array();
  ?>

  <?php if ( ! empty( $brand_terms ) && ! is_wp_error( $brand_terms ) ) : ?>

    <!-- MARCAS -->
    <section class="home-section home-brands-section">
      <div class="site-container">

        <header class="home-section__header">
          <span class="home-section__eyebrow">Aliados y fabricantes</span>
          <h2>Nuestras marcas</h2>
          <p>
            Trabajamos con marcas pensadas para pesca, camping y aventura.
          </p>
        </header>

      </div>

      <div class="home-brands-marquee" aria-label="Nuestras marcas">
        <div class="home-brands-marquee__track">
          <?php for ( $brand_repeat = 0; $brand_repeat < 2; $brand_repeat++ ) : ?>
            <?php foreach ( $brand_terms as $brand_term ) : ?>
              <?php
              $brand_link = get_term_link( $brand_term );

              if ( is_wp_error( $brand_link ) ) {
                continue;
              }

              $brand_image_url = function_exists( 'almcampcustom_get_brand_image_url' ) ? almcampcustom_get_brand_image_url( $brand_term->term_id ) : '';
              ?>

              <a class="home-brand-card" href="<?php echo esc_url( $brand_link ); ?>">
                <?php if ( $brand_image_url ) : ?>
                  <img
                    class="home-brand-image"
                    src="<?php echo esc_url( $brand_image_url ); ?>"
                    alt="<?php echo esc_attr( $brand_term->name ); ?>"
                    loading="lazy"
                  >
                <?php else : ?>
                  <span><?php echo esc_html( $brand_term->name ); ?></span>
                <?php endif; ?>
              </a>
            <?php endforeach; ?>
          <?php endfor; ?>
        </div>
      </div>
    </section>

  <?php endif; ?>

  <!-- BLOQUE INFORMATIVO -->
  <section class="home-info">
    <div class="site-container home-info__grid">

      <div class="home-info__content">
        <span class="home-section__eyebrow">Experiencia y variedad</span>

        <h2>Accesorios y productos para la pesca</h2>

        <p>
          Contamos con artículos especializados para pesca, camping y actividades
          al aire libre. Nuestro objetivo es ayudarte a encontrar productos
          confiables para cada salida.
        </p>

        <a class="home-btn home-btn--secondary" href="<?php echo esc_url( home_url( '/quienes-somos/' ) ); ?>">
          Conocer más
        </a>
      </div>

      <div class="home-info__box">
        <h3>Encuentra en nuestra tienda</h3>

        <ul>
          <li>Cañas y carretes</li>
          <li>Señuelos y accesorios</li>
          <li>Equipos de camping</li>
          <li>Vestuario outdoor</li>
        </ul>
      </div>

    </div>
  </section>

</main>

<?php
get_footer();
