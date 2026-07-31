<?php
/**
 * 500 template
 *
 * @package AlmCampCustom
 */

get_header();
?>
<main class="site-container site-content" role="main">
    <section class="error-500 server-error card">
        <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Error de servidor', 'almcampcustom' ); ?></h1>
        </header>
        <div class="page-content">
                <p><?php esc_html_e( 'Lo sentimos, hemos encontrado un error con el servidor, porfavor comunicarce con el administrador de la pagina.', 'almcampcustom' ); ?></p>
        </div>
    </section>
</main>
<?php
get_footer();
