<?php
/**
 * Footer template
 *
 * @package AlmCampCustom
 */
?>
<footer class="site-footer">
    <div class="site-container footer-inner">
        <div class="footer-grid">
            <div class="footer-col footer-about">
                <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
                    <div class="footer-logo"><?php the_custom_logo(); ?></div>
                <?php else : ?>
                    <a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                <?php endif; ?>
                <p class="footer-description">Somos una empresa con amplia experiencia en la importación y comercialización de artículos para la pesca y para las actividades al aire libre.</p>
            </div>

            <div class="footer-col footer-clients">
                <h3><?php esc_html_e( 'Para clientes', 'almcampcustom' ); ?></h3>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/quienes-somos/' ) )?>"><?php esc_html_e( 'Quienes somos', 'almcampcustom' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/politica-de-devoluciones-y-reembolsos/' ) )?>"><?php esc_html_e( 'Terminos Y Condiciones', 'almcampcustom' ); ?></a></li>
                    <li><a href="<?php echo esc_url( ( function_exists( 'wc_get_account_endpoint_url' ) ) ? wc_get_account_endpoint_url( 'orders' ) : '#orders' ); ?>"><?php esc_html_e( 'Pedidos', 'almcampcustom' ); ?></a></li>
                    <li><a href="<?php echo esc_url( ( function_exists( 'wc_get_page_id' ) && wc_get_page_id( 'myaccount' ) ) ? get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) : home_url( '/mi-cuenta' ) ); ?>"><?php esc_html_e( 'Detalles de la cuenta', 'almcampcustom' ); ?></a></li>
                    <li><a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Contraseña perdida', 'almcampcustom' ); ?></a></li>
                </ul>
            </div>

            <div class="footer-col footer-links">
                <h3><?php esc_html_e( 'Links', 'almcampcustom' ); ?></h3>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Inicio', 'almcampcustom' ); ?></a></li>
                    <?php if ( function_exists( 'wc_get_cart_url' ) ) : ?>
                        <li><a href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php esc_html_e( 'Carrito', 'almcampcustom' ); ?></a></li>
                        <li><a href="<?php echo esc_url( wc_get_checkout_url() ); ?>"><?php esc_html_e( 'Finalizar compra', 'almcampcustom' ); ?></a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo esc_url( ( function_exists( 'wc_get_page_id' ) && wc_get_page_id( 'myaccount' ) ) ? get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) : home_url( '/mi-cuenta' ) ); ?>"><?php esc_html_e( 'Mi cuenta', 'almcampcustom' ); ?></a></li>
                    <li><a href="<?php echo esc_url( ( function_exists( 'wc_get_page_id' ) && wc_get_page_id( 'shop' ) ) ? get_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/tienda' ) ); ?>"><?php esc_html_e( 'Tienda', 'almcampcustom' ); ?></a></li>
                </ul>
            </div>

            <div class="footer-col footer-contact">
                <h3><?php esc_html_e( 'Información de contacto', 'almcampcustom' ); ?></h3>
                <ul class="contact-list">
                    <li  class="footer-info-list__item">
                        <i class="fa fa-map-marker fa-lg footer-icon"></i>
                        <div>
                            <strong><?php esc_html_e( 'Dirección:', 'almcampcustom' ); ?></strong>
                            <div> 
                                Carrera 78 No. 45E-75 Medellín, Colombia
                            </div>
                        </div>
                    </li>
                    <li  class="footer-info-list__item">
                        <i class="fa fa-phone-square fa-lg footer-icon" aria-hidden="true"></i>
                        <div>                        
                            <strong><?php esc_html_e( 'Teléfono:', 'almcampcustom' ); ?></strong>
                            <div>+57 604 411 47 59</div>
                        </div>
                    </li>
                    <li  class="footer-info-list__item">
                        <i class="fa fa-mobile fa-lg footer-icon" aria-hidden="true"></i>
                        <div>                        
                            <strong><?php esc_html_e( 'Móvil:', 'almcampcustom' ); ?></strong>
                            <div>+57 310 470 41 68</div>
                        </div>
                    </li>
                    <li class="footer-info-list__item">
                        <i class="fa fa-envelope fa-lg footer-icon" aria-hidden="true"></i>
                        <div>
                            <strong><?php esc_html_e( 'Correo electrónico:', 'almcampcustom' ); ?></strong>
                            <div><a href="mailto:infopw@almacendecamping.com">infopw@almacendecamping.com</a></div>
                        </div>
                    </li>

                    <li class="footer-info-list__item">
                        <i class="fa fa-facebook-official fa-lg footer-icon" aria-hidden="true"></i>
                        <a href="https://www.facebook.com/almacendecamping">
                            <strong><?php esc_html_e( 'Nuestro facebook', 'almcampcustom' ); ?></strong>
                        </a>
                    </li>

                    <li class="footer-info-list__item">
                        <i class="fa fa-instagram fa-lg footer-icon" aria-hidden="true"></i>
                        <a href="https://www.instagram.com/almacendecamping/">
                            <strong><?php esc_html_e( 'Nuestro Instagram', 'almcampcustom' ); ?></strong>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p><?php echo '&copy; ' . esc_html( date_i18n( 'Y' ) ) . ' - ' . esc_html( get_bloginfo( 'name' ) ); ?>. <?php esc_html_e( 'Todos los derechos reservados', 'almcampcustom' ); ?></p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
