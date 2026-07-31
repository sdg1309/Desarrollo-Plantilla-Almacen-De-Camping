<?php
/**
 * 404 template
 *
 * @package AlmCampCustom
 */

get_header();
?>
<main class="site-container site-content" role="main">
    <section class="error-404 not-found card">

        <div class="site-404">
                <?php
                $asset_logo_path = get_template_directory() . '/assets/img/Logo-ADC-Transparent.png';
                if ( file_exists( $asset_logo_path ) ) : ?>
                    <div class="site-logo-404">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/Logo-ADC-Transparent.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="custom-logo" />
                        </a>
                    </div>
                <?php elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
                    <div class="site-logo-404"><?php the_custom_logo(); ?></div>
                <?php endif; ?>
        </div>
        
        <div class="page-content">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <h1 class="page-title-404"><?php esc_html_e( 'Error 404.', 'almcampcustom' ); ?></h1>
            
                <h2 class="page-title-404"><?php esc_html_e( 'Página no encontrada.', 'almcampcustom' ); ?></h2>
            
                <p class="page-title-404"><?php esc_html_e( 'Lo sentimos, no podemos encontrar lo que buscas. Por favor, intenta con otro enlace.', 'almcampcustom' ); ?></p>
            </a>
        </div>
    </section>
</main>
<?php
get_footer();
