<?php
/**
 * WoBootstrap Gallery Grabber - A script for grabbing gallery related to a post.
 *
 * WoBootstrap Gallery Grabber is a script for pulling gallery from the post content. It's an
 * attempt to consolidate the various methods that users have used over the years to 
 * embed gallery into their posts.  This script was written so that theme developers could grab that 
 * gallery and use it in interesting ways within their themes. For example, a theme could get a gallery 
 * and display it on archive pages alongside the post excerpt or pull it out of the content to display 
 * it above the post on single post views.
 *
 * @package    WoBootstrap
 * @subpackage Classes
 * @author     Mithun Biswas <bhoot.biswas@gmail.com>
 * @copyright  Copyright (c) 2015, Mithun Biswas
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Wrapper function for the WoBootstrap_Gallery_Grabber class.  Returns the HTML output for the found gallery.
 *
 * @since  1.0.0
 * @access public
 * @param  array
 * @return string
 */
function wobootstrap_gallery_grabber() {
    $gallery = new WoBootstrap_Gallery_Grabber();
    return $gallery->get_gallery();
}

/**
 * Grabs gallery related to the post.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
class WoBootstrap_Gallery_Grabber {
    /**
     * The HTML version of the gallery to return.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $gallery = '';
    
    /**
     * The original gallery taken from the post content.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $original_gallery = '';
    
    /**
     * The content to search for embedded gallery within.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $content = '';
    
    /**
     * Constructor method.  Sets up the gallery grabber.
     *
     * @since  1.0.0
     * @access public
     * @global object $wp_embed
     * @global int    $content_width
     * @return void
     */
    public function __construct() {
        /* Set the object properties. */
        $this->content = get_post_field( 'post_content', get_the_ID() );
        
        /* Find the gallery related to the post. */
        $this->set_gallery();
    }
    
    /**
     * Basic method for returning the gallery found.
     *
     * @since  1.0.0
     * @access public
     * @return string
     */
    public function get_gallery() {
        return apply_filters( 'wobootstrap_gallery_grabber_gallery', $this->gallery, $this );
    }
    
    /**
     * Tries several methods to find gallery related to the post.  Returns the found gallery.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function set_gallery() {
        /* Find gallery in the post content based on WordPress' gallery-related shortcodes. */
        if ( empty( $this->gallery ) )
            $this->do_shortcode_gallery();
        
        /* If gallery is found, let's run a few things. */
        if ( !empty( $this->gallery ) ) {
            /* Split the gallery from the content. */
            if ( !empty( $this->original_gallery ) )
                add_filter( 'the_content', array(
                     $this,
                    'split_gallery' 
                ), 5 );
        }
    }
    
    /**
     * WordPress has a few shortcodes for handling embedding gallery:  [audio], [video], and [embed].  This 
     * method figures out the shortcode used in the content.  Once it's found, the appropriate method for 
     * the shortcode is executed.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function do_shortcode_gallery() {
        
        /* Finds matches for shortcodes in the content. */
        preg_match_all( '/' . get_shortcode_regex() . '/s', $this->content, $matches, PREG_SET_ORDER );
        
        /* If matches are found, loop through them and check if they match one of WP's gallery shortcodes. */
        if ( !empty( $matches ) ) {
            
            foreach ( $matches as $shortcode ) {
                
                /* Call the method related to the specific shortcode found and break out of the loop. */
                if ( in_array( $shortcode[ 2 ], array(
                     'gallery' 
                ) ) ) {
                    call_user_func( array(
                         $this,
                        "do_gallery_shortcode_gallery" 
                    ), $shortcode );
                    break;
                }
            }
        }
    }
    
    /**
     * Handles the output of the WordPress playlist feature.  This searches for the [playlist] shortcode 
     * if it's used in the content.
     *
     * @since  2.0.0
     * @access public
     * @return void
     */
    public function do_gallery_shortcode_gallery( $shortcode ) {
        $this->original_gallery = array_shift( $shortcode );
        $gallery_images         = get_post_gallery( get_the_ID(), false );
        
        $gallery = '<div id="carousel-' . get_the_ID() . '-generic" class="carousel slide" data-ride="carousel">';
        $gallery .= '<ol class="carousel-indicators">';
        
        for ( $i = 0; $i < count( $gallery_images[ 'src' ] ); $i++ ) {
            if ( $i == 0 ) {
                $gallery .= '<li data-target="#carousel-' . get_the_ID() . '-generic" data-slide-to="' . $i . '" class="active"></li>';
            } else {
                $gallery .= '<li data-target="#carousel-' . get_the_ID() . '-generic" data-slide-to="' . $i . '"></li>';
            }
        }
        
        $gallery .= '</ol>';
        
        $gallery .= '<div class="carousel-inner" role="listbox">';
        
        $i = 0;
        foreach ( $gallery_images[ 'src' ] as $src ) {
            if ( $i == 0 ) {
                $gallery .= '<div class="item active"><img src="' . $src . '" alt="Gallery Image"></div>';
            } else {
                $gallery .= '<div class="item"><img src="' . $src . '" alt="Gallery Image"></div>';
            }
            $i++;
        }
        
        $gallery .= '</div>';
        $gallery .= '<a class="left carousel-control" href="#carousel-' . get_the_ID() . '-generic" role="button" data-slide="prev">';
        $gallery .= '<span class="icon-prev" aria-hidden="true"></span>';
        $gallery .= '<span class="sr-only">Previous</span>';
        $gallery .= '</a>';
        $gallery .= '<a class="right carousel-control" href="#carousel-' . get_the_ID() . '-generic" role="button" data-slide="next">';
        $gallery .= '<span class="icon-next" aria-hidden="true"></span>';
        $gallery .= '<span class="sr-only">Next</span>';
        $gallery .= '</a>';
        $gallery .= '</div>';
        
        $this->gallery = $gallery;
    }
    
    /**
     * Removes the found gallery from the content.  The purpose of this is so that themes can retrieve the 
     * gallery from the content and display it elsewhere on the page based on its design.
     *
     * @since  1.0.0
     * @access public
     * @param  string  $content
     * @return string
     */
    public function split_gallery( $content ) {
        remove_filter( 'the_content', array(
             $this,
            'split_gallery' 
        ), 5 );
        return str_replace( $this->original_gallery, '', $content );
    }
}
