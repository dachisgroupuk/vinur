<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Vinur
 * @since Vinur 1.0
 */

get_header(); ?>
<section id="posts">    
    <?php while ( have_posts() ) : the_post(); ?>

        <?php vinur_content_nav( 'nav-above' ); ?>

        <?php get_template_part( 'content', 'single' ); ?>

        <?php vinur_content_nav( 'nav-below' ); ?>

        <?php
        // If comments are open or we have at least one comment, load up the comment template
        if ( comments_open() || '0' != get_comments_number() ){
            comments_template( '', true );
        }
        ?>

    <?php endwhile; // end of the loop. ?>

</section>   

<?php get_sidebar(); ?>
<?php get_footer(); ?>