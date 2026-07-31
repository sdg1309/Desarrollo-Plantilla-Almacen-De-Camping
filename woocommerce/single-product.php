<?php
/**
 * Single product
 *
 * Override de template WooCommerce en theme folder.
 *
 * @package AlmCampCustom
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>
<main class="site-container site-content single-product-main" role="main">
    <?php
    while ( have_posts() ) :
        the_post();

        global $product;

        $product = wc_get_product( get_the_ID() );

        if ( ! $product ) {
            continue;
        }

        if ( function_exists( 'woocommerce_output_all_notices' ) ) {
            woocommerce_output_all_notices();
        }

        do_action( 'woocommerce_before_single_product' );

        if ( post_password_required() ) {
            echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            continue;
        }
        ?>

        <article id="product-<?php the_ID(); ?>" <?php wc_product_class( 'alm-single-product', $product ); ?>>
            <div class="alm-single-product__layout">
                <div class="alm-single-product__media-column">
                    <?php wc_get_template( 'single-product/product-image.php' ); ?>
                </div>

                <div class="alm-single-product__summary-column">
                    <?php wc_get_template( 'single-product/product-summary.php' ); ?>
                </div>
            </div>

            <div class="alm-single-product__details">
                <?php woocommerce_output_product_data_tabs(); ?>
            </div>

            <?php woocommerce_output_related_products(); ?>
        </article>

        <?php do_action( 'woocommerce_after_single_product' ); ?>

    <?php endwhile; ?>
</main>
<?php
get_footer();
