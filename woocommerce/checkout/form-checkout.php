<?php
/**
 * Checkout form
 *
 * Override de template WooCommerce en theme folder.
 *
 * @package AlmCampCustom
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wc_get_template( 'checkout/form-checkout.php' );
