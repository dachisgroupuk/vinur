<?php
/**
 * The Header for Vinur.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Vinur
 * @since Vinur 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta name="viewport" content="width=device-width" />
    <title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'vinur' ), max( $paged, $page ) );

	?></title>
    
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/images/touch/h/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/images/touch/m/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/images/touch/l/apple-touch-icon-precomposed.png">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/touch/l/apple-touch-icon.png">
  
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    
    <meta http-equiv="cleartype" content="on">
 
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
    <![endif]-->

    <?php wp_head(); ?>

     <!-- Modernizer <script src="javascripts/libs/modernizr.custom.21747.js"></script> -->
    
  	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/libs/respond.min.js"></script>
	<![endif]-->
    <!--[if IE 6]><script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/libs/DD_belatedPNG_0.0.8a-min.js"></script><![endif]-->

</head>

<body <?php body_class(); ?> role="document">

<div id="site" role="document">
    
    <?php do_action( 'before' ); ?>
    
    <header id="header" role="banner">
      
        <div class="alert-message warning hide" role="alert">
            <a class="close" href="#">&times;</a>
            <p>The old monks of Dunfermline were very fond of them. They had a great porpoise grant from the crown.</p>
        </div>  
        
        <div id="profile">
            <dl class="profile">
                <dt id="nickname">
                    <img src="<?php echo get_stylesheet_directory_uri();?>/images/avatars/Tiny 25px x 25px/Males/Joe.jpg" width="25" height="25" alt="Joe">
                    <a href="" title="nickname">nickname</a>
                </dt>
            </dl>
        </div>
          
        <hgroup>
            <h1 id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
        </hgroup><!-- #hgroup -->
                    
        <div id="access">
            <div class="skip-link"><a class="assistive-text" href="#content" title="Skip to primary content">Skip to primary content</a></div>
            <div class="skip-link"><a class="assistive-text" href="#sidebar" title="Skip to secondary content">Skip to secondary content</a></div>
        </div><!-- #access nav -->
            
        <nav id="navigation" role="navigation">
            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </nav><!-- #main nav -->
		
    </header><!-- #header -->


	<div id="content">