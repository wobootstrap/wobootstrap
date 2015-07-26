<?php
    /**
     * Template part for displaying posts.
     *
     * @package WoBootstrap
     */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
        get_the_image( 
            array( 
                'size'         => 'full', 
                'order'        => array( 'featured' ), 
                'link_to_post' => is_singular() ? false : true, 
                'before'       => '<div class="entry-media">', 
                'after'        => '</div>' 
            ) 
        );
    ?>
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
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
        <footer class="entry-footer">
            <?php wobootstrap_entry_footer(); ?>
        </footer><!-- .entry-footer -->
        <?php endif; // End single post check. ?>
    </div>
</article><!-- #post-## -->
