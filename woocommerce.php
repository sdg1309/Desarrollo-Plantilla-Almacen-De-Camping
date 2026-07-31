<?php
/**
 * WooCommerce support template
 *
 * @package AlmCampCustom
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>
<main class="site-container site-content" role="main">
    <?php
    if ( function_exists( 'woocommerce_content' ) ) {
        woocommerce_content();
    }
    ?>
</main>
<?php
get_footer();
