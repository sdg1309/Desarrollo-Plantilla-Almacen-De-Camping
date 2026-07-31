<?php
/**
 * AlmCampCustom functions and definitions.
 *
 * @package AlmCampCustom
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'after_setup_theme', 'almcampcustom_setup' );
function almcampcustom_setup() {
    load_theme_textdomain( 'almcampcustom', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 300,
        'single_image_width'    => 600,
        'product_grid'          => array(
            'default_columns' => 3,
            'default_rows'    => 4,
            'min_columns'     => 1,
            'max_columns'     => 4,
            'min_rows'        => 1,
            'max_rows'        => 6,
        ),
    ) );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    add_image_size( 'almcampcustom-featured', 1200, 675, true );

    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'almcampcustom' ),
        'footer'  => esc_html__( 'Footer Menu', 'almcampcustom' ),
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'almcampcustom' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Widget area for the sidebar.', 'almcampcustom' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}

add_action( 'wp_enqueue_scripts', 'almcampcustom_scripts' );
function almcampcustom_scripts() {
    /**  coneccion con los css */
    // style.css se deja para la metadata del tema.
    wp_enqueue_style(
        'alm-theme-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );

    // general.css es el archivo compilado desde assets/scss/main.scss.
    wp_enqueue_style(
        'alm-general-style',
        get_template_directory_uri() . '/assets/css/general.css',
        array('alm-theme-style'),
        filemtime(get_template_directory() . '/assets/css/general.css')
    );

    /**  coneccion con las fuentes */
    wp_enqueue_style( 'almcampcustom-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', array(), null );
    wp_enqueue_style( 'almcampcustom-fontsawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), null );

    /**  coneccion con los js */
    wp_enqueue_script(
        'almcampcustom-navigation',
        get_template_directory_uri() . '/assets/js/navigation.js',
        array(),
        filemtime( get_template_directory() . '/assets/js/navigation.js' ),
        true
    );

    wp_enqueue_script(
        'almcampcustom-home-carousels',
        get_template_directory_uri() . '/assets/js/home-carousels.js',
        array(),
        filemtime( get_template_directory() . '/assets/js/home-carousels.js' ),
        true
    );

    if ( function_exists( 'is_product' ) && is_product() ) {
        wp_enqueue_script(
            'almcampcustom-product-gallery',
            get_template_directory_uri() . '/assets/js/product-gallery.js',
            array(),
            filemtime( get_template_directory() . '/assets/js/product-gallery.js' ),
            true
        );

    }
}

add_filter( 'body_class', 'almcampcustom_body_classes' );
function almcampcustom_body_classes( $classes ) {
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }
    if ( ! is_singular() ) {
        $classes[] = 'almcampcustom-not-singular';
    }
    return $classes;
}

add_filter( 'excerpt_more', 'almcampcustom_excerpt_more' );
function almcampcustom_excerpt_more( $more ) {
    return ' &hellip;';
}

add_action( 'wp_nav_menu_args', 'almcampcustom_menu_fallback' );
function almcampcustom_menu_fallback( $args ) {
    if ( ! isset( $args['menu'] ) && 'primary' === $args['theme_location'] ) {
        $args['fallback_cb'] = 'wp_page_menu';
    }
    return $args;
}

function theme_enqueue_search_ajax_script() {
  wp_enqueue_script(
    'theme-search-ajax',
    get_template_directory_uri() . '/assets/js/search-ajax.js',
    array(),
    '1.0.0',
    true
  );

  wp_localize_script(
    'theme-search-ajax',
    'themeSearchAjax',
    array(
      'ajax_url' => admin_url( 'admin-ajax.php' ),
      'nonce'    => wp_create_nonce( 'theme_search_nonce' ),
    )
  );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_search_ajax_script' );

function theme_ajax_product_search() {
  check_ajax_referer( 'theme_search_nonce', 'nonce' );

  $search = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';

  if ( strlen( $search ) < 2 ) {
    wp_send_json_error();
  }

  $visibility_terms = wc_get_product_visibility_term_ids();

  $products_query = new WP_Query( array(
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'posts_per_page' => 5,
    's'              => $search,
    'tax_query'      => array(
      array(
        'taxonomy' => 'product_visibility',
        'field'    => 'term_taxonomy_id',
        'terms'    => array( $visibility_terms['exclude-from-search'] ),
        'operator' => 'NOT IN',
      ),
    ),
  ) );

  $products = array();

  if ( $products_query->have_posts() ) {
    while ( $products_query->have_posts() ) {
      $products_query->the_post();

      $product = wc_get_product( get_the_ID() );

      if ( ! $product ) {
        continue;
      }

      $products[] = array(
        'name'  => get_the_title(),
        'url'   => get_permalink(),
        'image' => get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ?: wc_placeholder_img_src(),
        'price' => $product->get_price_html(),
      );
    }

    wp_reset_postdata();
  }

  $category_terms = get_terms( array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => true,
    'number'     => 4,
    'name__like' => $search,
  ) );

  $categories = array();

  if ( ! empty( $category_terms ) && ! is_wp_error( $category_terms ) ) {
    foreach ( $category_terms as $category ) {
      $categories[] = array(
        'name' => $category->name,
        'url'  => get_term_link( $category ),
      );
    }
  }

  $search_url = add_query_arg(
    array(
      's'         => $search,
      'post_type' => 'product',
    ),
    home_url( '/' )
  );

  wp_send_json_success( array(
    'products'   => $products,
    'categories' => $categories,
    'search_url' => esc_url( $search_url ),
  ) );
}

add_action( 'wp_ajax_theme_ajax_product_search', 'theme_ajax_product_search' );
add_action( 'wp_ajax_nopriv_theme_ajax_product_search', 'theme_ajax_product_search' );

add_action( 'woocommerce_product_query', 'almcampcustom_exclude_featured_from_shop_archive' );
function almcampcustom_exclude_featured_from_shop_archive( $query ) {
  if ( is_admin() || ! $query->is_main_query() || ! is_shop() || ! function_exists( 'wc_get_product_visibility_term_ids' ) ) {
    return;
  }

  $visibility_terms = wc_get_product_visibility_term_ids();

  if ( empty( $visibility_terms['featured'] ) ) {
    return;
  }

  $tax_query   = (array) $query->get( 'tax_query' );
  $tax_query[] = array(
    'taxonomy' => 'product_visibility',
    'field'    => 'term_taxonomy_id',
    'terms'    => array( $visibility_terms['featured'] ),
    'operator' => 'NOT IN',
  );

  $query->set( 'tax_query', $tax_query );
}

add_action( 'woocommerce_product_query', 'almcampcustom_apply_shop_filters' );
function almcampcustom_apply_shop_filters( $query ) {
  if ( is_admin() || ! $query->is_main_query() ) {
    return;
  }

  if ( ! ( is_shop() || is_product_taxonomy() ) ) {
    return;
  }

  $tax_query = (array) $query->get( 'tax_query' );
  $meta_query = (array) $query->get( 'meta_query' );

  if ( isset( $_GET['product_cat'] ) && '' !== $_GET['product_cat'] ) {
    $tax_query[] = array(
      'taxonomy' => 'product_cat',
      'field'    => 'slug',
      'terms'    => sanitize_text_field( wp_unslash( $_GET['product_cat'] ) ),
    );
  }

  $brand_taxonomy = almcampcustom_get_brand_taxonomy();

  if ( $brand_taxonomy && isset( $_GET['filter_brand'] ) && '' !== $_GET['filter_brand'] ) {
    $tax_query[] = array(
      'taxonomy' => $brand_taxonomy,
      'field'    => 'slug',
      'terms'    => sanitize_text_field( wp_unslash( $_GET['filter_brand'] ) ),
    );
  }

  $min_price = isset( $_GET['min_price'] ) ? floatval( wp_unslash( $_GET['min_price'] ) ) : '';
  $max_price = isset( $_GET['max_price'] ) ? floatval( wp_unslash( $_GET['max_price'] ) ) : '';

  if ( '' !== $min_price || '' !== $max_price ) {
    $price_clause = array(
      'key'     => '_price',
      'value'   => array( $min_price, $max_price ),
      'type'    => 'NUMERIC',
      'compare' => 'BETWEEN',
    );

    if ( '' === $min_price ) {
      $price_clause['value'][0] = 0;
    }

    if ( '' === $max_price ) {
      $price_clause['value'][1] = PHP_INT_MAX;
    }

    $meta_query[] = $price_clause;
  }

  if ( ! empty( $tax_query ) ) {
    $query->set( 'tax_query', $tax_query );
  }

  if ( ! empty( $meta_query ) ) {
    $query->set( 'meta_query', $meta_query );
  }
}

function almcampcustom_is_product_archive() {
  if ( is_admin() || is_singular( 'product' ) ) {
    return false;
  }

  if ( is_shop() || is_post_type_archive( 'product' ) || is_product_taxonomy() ) {
    return true;
  }

  if ( is_tax( array( 'product_cat', 'product_tag' ) ) ) {
    return true;
  }

  $brand_taxonomy = almcampcustom_get_brand_taxonomy();

  if ( $brand_taxonomy && is_tax( $brand_taxonomy ) ) {
    return true;
  }

  return false;
}

function almcampcustom_render_shop_filters() {
  if ( ! almcampcustom_is_product_archive() ) {
    return;
  }

  $current_category = isset( $_GET['product_cat'] ) ? sanitize_text_field( wp_unslash( $_GET['product_cat'] ) ) : '';
  $current_brand = isset( $_GET['filter_brand'] ) ? sanitize_text_field( wp_unslash( $_GET['filter_brand'] ) ) : '';
  $min_price = isset( $_GET['min_price'] ) ? sanitize_text_field( wp_unslash( $_GET['min_price'] ) ) : '';
  $max_price = isset( $_GET['max_price'] ) ? sanitize_text_field( wp_unslash( $_GET['max_price'] ) ) : '';
  $brand_taxonomy = almcampcustom_get_brand_taxonomy();

  $categories = get_terms( array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => true,
    'orderby'    => 'name',
    'parent'     => 0,
    'number'     => 15,
  ) );

  $brands = array();

  if ( $brand_taxonomy ) {
    $brands = get_terms( array(
      'taxonomy'   => $brand_taxonomy,
      'hide_empty' => true,
      'orderby'    => 'name',
      'number'     => 20,
    ) );
  }

  $has_filters = ! empty( $current_category ) || ! empty( $current_brand ) || ! empty( $min_price ) || ! empty( $max_price );
  ?>
  <form class="alm-shop-filters" method="get" action="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
    <?php if ( isset( $_GET['s'] ) ) : ?>
      <input type="hidden" name="s" value="<?php echo esc_attr( sanitize_text_field( wp_unslash( $_GET['s'] ) ) ); ?>">
    <?php endif; ?>

    <?php if ( isset( $_GET['post_type'] ) ) : ?>
      <input type="hidden" name="post_type" value="<?php echo esc_attr( sanitize_text_field( wp_unslash( $_GET['post_type'] ) ) ); ?>">
    <?php endif; ?>

    <div class="alm-shop-filters__row">
      <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
        <label class="alm-shop-filters__field">
          <span><?php esc_html_e( 'Categoría', 'almcampcustom' ); ?></span>
          <select name="product_cat">
            <option value=""><?php esc_html_e( 'Todas', 'almcampcustom' ); ?></option>
            <?php foreach ( $categories as $category ) : ?>
              <option value="<?php echo esc_attr( $category->slug ); ?>" <?php selected( $current_category, $category->slug ); ?>>
                <?php echo esc_html( $category->name ); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </label>
      <?php endif; ?>

      <?php if ( $brand_taxonomy && ! empty( $brands ) && ! is_wp_error( $brands ) ) : ?>
        <label class="alm-shop-filters__field">
          <span><?php esc_html_e( 'Marca', 'almcampcustom' ); ?></span>
          <select name="filter_brand">
            <option value=""><?php esc_html_e( 'Todas', 'almcampcustom' ); ?></option>
            <?php foreach ( $brands as $brand ) : ?>
              <option value="<?php echo esc_attr( $brand->slug ); ?>" <?php selected( $current_brand, $brand->slug ); ?>>
                <?php echo esc_html( $brand->name ); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </label>
      <?php endif; ?>

      <label class="alm-shop-filters__field alm-shop-filters__field--price">
        <span><?php esc_html_e( 'Precio', 'almcampcustom' ); ?></span>
        <div class="alm-shop-filters__price">
          <input type="number" name="min_price" min="0" step="1" placeholder="Min" value="<?php echo esc_attr( $min_price ); ?>">
          <span>—</span>
          <input type="number" name="max_price" min="0" step="1" placeholder="Max" value="<?php echo esc_attr( $max_price ); ?>">
        </div>
      </label>

      <div class="alm-shop-filters__actions">
        <button type="submit"><?php esc_html_e( 'Aplicar', 'almcampcustom' ); ?></button>
        <?php if ( $has_filters ) : ?>
          <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'Limpiar', 'almcampcustom' ); ?></a>
        <?php endif; ?>
      </div>
    </div>
  </form>
  <?php
}

function almcampcustom_get_brand_taxonomy() {
  $brand_taxonomies = array(
    'product_brand',
    'pwb-brand',
    'yith_product_brand',
    'pa_marca',
    'pa_brand',
  );

  foreach ( $brand_taxonomies as $taxonomy ) {
    if ( taxonomy_exists( $taxonomy ) ) {
      return $taxonomy;
    }
  }

  return '';
}

function almcampcustom_get_brand_image_url( $term_id ) {
  $image_meta_keys = array(
    'thumbnail_id',
    'brand_thumbnail_id',
    'pwb_brand_image',
    'product_brand_thumbnail_id',
    'image',
    'logo',
  );

  foreach ( $image_meta_keys as $meta_key ) {
    $meta_value = get_term_meta( $term_id, $meta_key, true );

    if ( empty( $meta_value ) ) {
      continue;
    }

    if ( is_numeric( $meta_value ) ) {
      $image_url = wp_get_attachment_image_url( absint( $meta_value ), 'medium' );

      if ( $image_url ) {
        return $image_url;
      }
    }

    if ( is_string( $meta_value ) && filter_var( $meta_value, FILTER_VALIDATE_URL ) ) {
      return $meta_value;
    }
  }

  return '';
}

add_action( 'wp_enqueue_scripts', function() {
	if ( is_product() ) {
		wp_enqueue_script(
			'theme-variation-price',
			get_stylesheet_directory_uri() . '/assets/js/variation-price.js',
			array( 'jquery', 'wc-add-to-cart-variation' ),
			'1.0.0',
			true
		);
	}
});