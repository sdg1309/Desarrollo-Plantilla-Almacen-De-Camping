<?php
/**
 * Single post template
 *
 * @package AlmCampCustom
 */

get_header();
?>
<main class="site-container site-content" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'card' ); ?> >
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail( 'almcampcustom-featured' ); ?>
                </div>
            <?php endif; ?>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                <div class="entry-meta">
                    <?php echo sprintf( esc_html__( 'Publicado el %s', 'almcampcustom' ), get_the_date() ); ?>
                </div>
            </header>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>

        <?php if ( comments_open() || get_comments_number() ) : ?>
            <?php comments_template(); ?>
        <?php endif; ?>
    <?php endwhile; ?>
</main>
<?php
get_footer();
