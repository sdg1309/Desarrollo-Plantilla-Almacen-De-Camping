<?php
/**
 * Single product summary
 *
 * Override de template WooCommerce in theme folder.
 *
 * @package AlmCampCustom
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;

if ( ! $product ) {
    return;
}

$categories = wc_get_product_category_list( $product->get_id(), ' / ' );
$sku        = $product->get_sku();
$tags       = wc_get_product_tag_list( $product->get_id(), ' / ' );
$brand      = '';

if ( is_wp_error( $categories ) ) {
    $categories = '';
}

if ( is_wp_error( $tags ) ) {
    $tags = '';
}

if ( function_exists( 'almcampcustom_get_brand_taxonomy' ) ) {
    $brand_taxonomy = almcampcustom_get_brand_taxonomy();

    if ( $brand_taxonomy ) {
        $brand = get_the_term_list( $product->get_id(), $brand_taxonomy, '', ' / ', '' );

        if ( is_wp_error( $brand ) ) {
            $brand = '';
        }
    }
}
?>

<section class="entry-summary alm-single-product__summary">
    <div class="entry-summary__status alm-single-product__eyebrow">
        <?php if ( $product->is_on_sale() ) : ?>
            <span class="alm-single-product__badge">
                <?php esc_html_e( 'Oferta', 'almcampcustom' ); ?>
            </span>
        <?php endif; ?>

        <div class="alm-single-product__stock">
            <?php echo wp_kses_post( wc_get_stock_html( $product ) ); ?>
        </div>
    </div>

    <ul class="entry-summary__product-meta alm-single-product__product-meta">
        <?php if ( wc_product_sku_enabled() && $sku ) : ?>
            <li class="alm-single-product__meta-row alm-single-product__sku">
                <span class="alm-single-product__meta-label">
                    <?php esc_html_e( 'SKU:', 'almcampcustom' ); ?>
                </span>
                <span class="alm-single-product__meta-value">
                    <?php echo esc_html( $sku ); ?>
                </span>
            </li>
        <?php endif; ?>

        <?php if ( $brand ) : ?>
            <li class="alm-single-product__meta-row alm-single-product__brand">
                <span class="alm-single-product__meta-label">
                    <?php esc_html_e( 'Marca:', 'almcampcustom' ); ?>
                </span>
                <span class="alm-single-product__meta-value">
                    <?php echo wp_kses_post( $brand ); ?>
                </span>
            </li>
        <?php endif; ?>

        <?php if ( $categories ) : ?>
            <li class="alm-single-product__meta-row alm-single-product__categories">
                <span class="alm-single-product__meta-label">
                    <?php esc_html_e( 'Categoria:', 'almcampcustom' ); ?>
                </span>
                <span class="alm-single-product__meta-value">
                    <?php echo wp_kses_post( $categories ); ?>
                </span>
            </li>
        <?php endif; ?>

        <?php if ( $tags ) : ?>
            <li class="alm-single-product__meta-row alm-single-product__tags">
                <span class="alm-single-product__meta-label">
                    <?php esc_html_e( 'Etiquetas:', 'almcampcustom' ); ?>
                </span>
                <span class="alm-single-product__meta-value">
                    <?php echo wp_kses_post( $tags ); ?>
                </span>
            </li>
        <?php endif; ?>
    </ul>

    <div class="entry-summary__title">
        <h1 class="alm-single-product__title"><?php the_title(); ?></h1>
    </div>

    <?php if ( wc_review_ratings_enabled() ) : ?>
        <div class="entry-summary__rating alm-single-product__rating">
            <?php woocommerce_template_single_rating(); ?>
        </div>
    <?php endif; ?>

    <div class="entry-summary__price alm-single-product__price">
        <?php woocommerce_template_single_price(); ?>
    </div>

    <?php if ( $product->get_short_description() ) : ?>
        <div class="entry-summary__description alm-single-product__excerpt">
            <?php woocommerce_template_single_excerpt(); ?>
        </div>
    <?php endif; ?>

    <div class="entry-summary__cart alm-single-product__cart">
        <?php woocommerce_template_single_add_to_cart(); ?>
    </div>

</section>
