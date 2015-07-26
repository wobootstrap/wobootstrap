<?php
    /**
     * Template part for displaying posts.
     *
     * @package WoBootstrap
     */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php echo ( $gallery = wobootstrap_gallery_grabber() ); ?>
    <div class="entry-wrap">
        <?php if ( is_single( get_the_ID() ) ) : // If viewing a single post. ?>
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
        <div class="entry-content">
            <?php the_content(); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <footer class="entry-footer">
            <?php wobootstrap_entry_footer(); ?>
        </footer><!-- .entry-footer -->
        <?php else : // If not viewing a single post. ?>
        <header class="entry-header">
            <?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
        </header><!-- .entry-header -->
        <?php if ( has_excerpt() ) : // If the post has an excerpt. ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
        <?php elseif ( empty( $gallery ) ) : // Else, if the post does not have audio. ?>
        <div class="entry-content">
            <?php the_content(); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <?php endif; // End excerpt/audio checks. ?>
        <footer class="entry-footer">
            <?php wobootstrap_entry_footer(); ?>
        </footer><!-- .entry-footer -->
        <?php endif; // End single post check. ?>
    </div>
</article><!-- #post-## -->
