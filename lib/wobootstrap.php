<?php
    /* Sets the path to the parent theme directory. */
    define( 'THEME_DIR', get_template_directory() );

    /* Sets the path to the core framework directory. */
	if ( !defined( 'WOBOOTSTRAP_DIR' ) )
		define( 'WOBOOTSTRAP_DIR', trailingslashit( THEME_DIR ) . basename( dirname( __FILE__ ) ) );

    /* Sets the path to the core framework classes directory. */
	define( 'WOBOOTSTRAP_CLASSES', trailingslashit( WOBOOTSTRAP_DIR ) . 'classes' );

    /* Sets the path to the core framework extensions directory. */
    define( 'WOBOOTSTRAP_EXTENSIONS', trailingslashit( WOBOOTSTRAP_DIR ) . 'extensions' );
    
    /**
     * Register Custom Navigation Walker.
     */
    require_once( trailingslashit( WOBOOTSTRAP_CLASSES ) . 'wp_bootstrap_navwalker.php' );

    /**
     * /* Load the media grabber class.
     */
    require_once( trailingslashit( WOBOOTSTRAP_CLASSES ) . 'hybrid-media-grabber.php' );

    /* Load the Get the Image extension if supported. */
	require_once( trailingslashit( WOBOOTSTRAP_EXTENSIONS ) . 'get-the-image.php' );
?>
