<?php
/**
 * Cart
 *
 * Override de template WooCommerce en theme folder.
 *
 * @package AlmCampCustom
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wc_get_template( 'cart/cart.php' );
