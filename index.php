<?php
/**
 * The main template file
 *
 * @package AlmCampCustom
 */

get_header();
?>
<main class="site-container site-content" role="main">
    <?php if ( have_posts() ) : ?>
        <div class="post-list">
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'card' ); ?> >
                        <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'almcampcustom-featured' ); ?>
                        </a>
                    <?php endif; ?>
                    <header class="entry-header">
                        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                        <div class="post-meta">
                            <?php echo sprintf( esc_html__( 'Publicado el %s', 'almcampcustom' ), get_the_date() ); ?>
                        </div>
                    </header>
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
        <div class="pagination">
            <?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
        </div>
    <?php else : ?>
        <section class="no-results not-found card">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'No hay entradas aún', 'almcampcustom' ); ?></h1>
            </header>
            <div class="page-content">
                <p><?php esc_html_e( 'Vuelve pronto para ver más contenido.', 'almcampcustom' ); ?></p>
            </div>
        </section>
    <?php endif; ?>
</main>
<?php
get_footer();
