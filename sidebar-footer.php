<?php
    /**
     * The Footer Sidebar
     *
     */
    if ( ! is_active_sidebar( 'sidebar-2' ) ) {
        return;
    }
?>
<div id="supplementary">
    <div class="container">
        <div id="footer-sidebar" class="footer-sidebar widget-area" role="complementary">
            <?php dynamic_sidebar( 'sidebar-2' ); ?>
        </div><!-- #footer-sidebar -->
    </div>
</div><!-- #supplementary -->
