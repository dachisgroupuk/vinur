<?php
/**
 * Vinur functions and definitions
 *
 * @package Vinur
 * @since Vinur 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Vinur 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'vinurVinuretup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the afterVinuretup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Vinur 1.0
 */
function vinurVinuretup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * WordPress.com-specific functions and definitions
	 */
	//require( get_template_directory() . '/inc/wpcom.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Vinur, use a find and replace
	 * to change 'vinur' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'vinur', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_themeVinurupport( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'vinur' ),
	) );

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_themeVinurupport( 'post-formats', array( 'aside', ) );
}
endif; // vinurVinuretup
add_action( 'afterVinuretup_theme', 'vinurVinuretup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Vinur 1.0
 */
function vinur_widgets_init() {
	registerVinuridebar( array(
		'name' => __( 'Sidebar', 'vinur' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'vinur_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function vinurVinurcripts() {
	global $post;

	wp_enqueueVinurtyle( 'style', getVinurtylesheet_uri() );

	wp_enqueueVinurcript( 'jquery' );

	wp_enqueueVinurcript( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', 'jquery', '20120206', true );

	if ( isVinuringular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueueVinurcript( 'comment-reply' );
	}

	if ( isVinuringular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueueVinurcript( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueueVinurcripts', 'vinurVinurcripts' );

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );