<?php
    /**
     * The header for our theme.
     *
     * Displays all of the <head> section and everything up till <div id="content">
     *
     * @package WoBootstrap
     */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">
            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wobootstrap' ); ?></a>
            <header id="masthead" class="site-header" role="banner">
                <nav class="navbar navbar-static-top navbar-default">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">Brand</a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <?php
                            wp_nav_menu( array(
                                 'menu'              => 'primary',
                                 'theme_location'    => 'primary',
                                 'depth'             => 2,
                                 'container'         => 'div',
                                 'container_class'   => 'collapse navbar-collapse',
                                 'container_id'      => 'bs-example-navbar-collapse-1',
                                 'menu_class'        => 'nav navbar-nav',
                                 'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                 'walker'            => new wp_bootstrap_navwalker())
                            );
                        ?>
                    </div><!-- /.container -->
                </nav>
            </header><!-- #masthead -->
            <div id="content" class="site-content">
