<?php
/**
 * Single product meta
 *
 * Override de template WooCommerce en theme folder.
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

$sku        = $product->get_sku();
$categories = wc_get_product_category_list( $product->get_id(), ' / ' );
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

<ul class="product_meta alm-single-product__product-meta">
    <?php if ( wc_product_sku_enabled() && $sku ) : ?>
        <li class="alm-single-product__meta-row sku_wrapper">
            <span class="alm-single-product__meta-label">
                <?php esc_html_e( 'SKU:', 'almcampcustom' ); ?>
            </span>
            <span class="alm-single-product__meta-value sku">
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
        <li class="alm-single-product__meta-row posted_in">
            <span class="alm-single-product__meta-label">
                <?php esc_html_e( 'Categoria:', 'almcampcustom' ); ?>
            </span>
            <span class="alm-single-product__meta-value">
                <?php echo wp_kses_post( $categories ); ?>
            </span>
        </li>
    <?php endif; ?>

    <?php if ( $tags ) : ?>
        <li class="alm-single-product__meta-row tagged_as">
            <span class="alm-single-product__meta-label">
                <?php esc_html_e( 'Etiquetas:', 'almcampcustom' ); ?>
            </span>
            <span class="alm-single-product__meta-value">
                <?php echo wp_kses_post( $tags ); ?>
            </span>
        </li>
    <?php endif; ?>
</ul>
