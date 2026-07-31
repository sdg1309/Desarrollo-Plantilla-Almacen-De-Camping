<?php
/**
 * Single product Price
 *
 * Override de template WooCommerce en theme folder.
 *
 * @package AlmCampCustom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$price_html = $product->get_price_html();

?>



<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"
   data-original-price="<?php echo esc_attr( $price_html ) ?>"
>
  <?php echo wp_kses_post($price_html); ?>
</p>
