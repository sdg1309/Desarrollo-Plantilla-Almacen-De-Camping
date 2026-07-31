<?php
/**
 * Single product image
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

$gallery_ids = array();

if ( has_post_thumbnail() ) {
    $gallery_ids[] = get_post_thumbnail_id();
}

$gallery_ids = array_merge( $gallery_ids, $product->get_gallery_image_ids() );
?>

<section class="alm-single-product__media" aria-label="<?php esc_attr_e( 'Imagenes del producto', 'almcampcustom' ); ?>">
    <div class="alm-single-product__gallery" data-product-gallery tabindex="0">
        <div class="alm-single-product__image">
            <?php if ( ! empty( $gallery_ids ) ) : ?>
                <?php foreach ( $gallery_ids as $index => $attachment_id ) : ?>
                    <figure class="alm-single-product__slide<?php echo 0 === $index ? ' is-active' : ''; ?>" data-gallery-slide>
                        <?php echo wp_kses_post( wp_get_attachment_image( $attachment_id, 'woocommerce_single' ) ); ?>
                    </figure>
                <?php endforeach; ?>
            <?php else : ?>
                <figure class="alm-single-product__slide is-active" data-gallery-slide>
                    <?php echo wp_kses_post( wc_placeholder_img( 'woocommerce_single' ) ); ?>
                </figure>
            <?php endif; ?>
        </div>

        <?php if ( 1 < count( $gallery_ids ) ) : ?>
            <button class="alm-single-product__gallery-button alm-single-product__gallery-button--prev" type="button" data-gallery-prev aria-label="<?php esc_attr_e( 'Imagen anterior', 'almcampcustom' ); ?>">
                &lsaquo;
            </button>
            <button class="alm-single-product__gallery-button alm-single-product__gallery-button--next" type="button" data-gallery-next aria-label="<?php esc_attr_e( 'Imagen siguiente', 'almcampcustom' ); ?>">
                &rsaquo;
            </button>

            <div class="alm-single-product__gallery-dots" aria-label="<?php esc_attr_e( 'Guias de imagenes', 'almcampcustom' ); ?>">
                <?php foreach ( $gallery_ids as $index => $attachment_id ) : ?>
                    <button class="alm-single-product__gallery-dot<?php echo 0 === $index ? ' is-active' : ''; ?>" type="button" data-gallery-dot="<?php echo esc_attr( $index ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Ver imagen %d', 'almcampcustom' ), $index + 1 ) ); ?>"></button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
