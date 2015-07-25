<?php
    /**
     * Template part for displaying posts.
     *
     * @package WoBootstrap
     */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( is_single( get_the_ID() ) ) : // If viewing a single post. ?>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages(); ?>
    </div><!-- .entry-content -->
    <footer class="entry-footer">
        <?php wobootstrap_entry_footer(); ?>
    </footer><!-- .entry-footer -->
    <?php else : // If not viewing a single post. ?>

    <div class="entry-content">
        <?php the_content(); ?>
    </div><!-- .entry-content -->
    <footer class="entry-footer">
        <?php wobootstrap_entry_footer(); ?>
    </footer><!-- .entry-footer -->
    <?php endif; // End single post check. ?>

</article><!-- #post-## -->
