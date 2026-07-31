<?php
/**
 * Sidebar template
 *
 * @package AlmCampCustom
 */
?>
<aside id="secondary" class="sidebar widget-area" role="complementary">
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    <?php else : ?>
        <div class="widget widget_text">
            <h2 class="widget-title"><?php esc_html_e( 'Widget', 'almcampcustom' ); ?></h2>
            <p><?php esc_html_e( 'Agrega widgets en Apariencia > Widgets.', 'almcampcustom' ); ?></p>
        </div>
    <?php endif; ?>
</aside>
