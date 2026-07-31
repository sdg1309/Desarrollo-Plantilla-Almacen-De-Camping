<?php
/**
 * Product archive
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
<div class="woocommerce-shop-wrap">
    <main class="site-container site-content shop-main" role="main">

    <aside class="shop-sidebar" role="complementary">
        <div class="widget widget_text">
            <h2 class="widget-title">Filtros</h2>
            <p>Próximamente podrás filtrar por categoría, marca y precio desde aquí.</p>
        </div>
    </aside>
        <header class="shop-archive-header">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                <h1 class="woocommerce-products-header__title page-title">
                    <?php woocommerce_page_title(); ?>
                </h1>
            <?php endif; ?>

            <?php do_action( 'woocommerce_archive_description' ); ?>
        </header>

        <?php
        if ( function_exists( 'woocommerce_output_all_notices' ) ) {
            woocommerce_output_all_notices();
        }

        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
        ?>

        <?php if ( woocommerce_product_loop() ) : ?>

            <div class="shop-loop-tools">
                <?php do_action( 'woocommerce_before_shop_loop' ); ?>
            </div>

            <?php woocommerce_product_loop_start(); ?>

            <?php while ( have_posts() ) : ?>
                <?php
                the_post();

                $product = wc_get_product( get_the_ID() );

                if ( ! $product ) {
                    continue;
                }

                wc_get_template_part( 'content', 'product' );
                ?>
            <?php endwhile; ?>

            <?php woocommerce_product_loop_end(); ?>

            <?php do_action( 'woocommerce_after_shop_loop' ); ?>

        <?php else : ?>

            <?php do_action( 'woocommerce_no_products_found' ); ?>

        <?php endif; ?>
    </main>
</div>
<?php
get_footer();
