<?php
/**
 * The template for displaying product content within loops.
 *
 * @package AlmCampCustom
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>

<li <?php wc_product_class( 'product-card', $product ); ?>>

    <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

    <div class="product-card__inner">

        <div class="product-card__image">

            <?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>

            <?php if ( $product->is_on_sale() ) : ?>
                <span class="product-card__badge">
                    Oferta
                </span>
            <?php endif; ?>

        </div>

        <div class="product-card__content">

            <div class="product-card__title">
                <?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
            </div>

            <div class="product-card__price">
                <?php woocommerce_template_loop_price(); ?>
            </div>

        </div>

    </div>

    <?php woocommerce_template_loop_product_link_close(); ?>

</li>
