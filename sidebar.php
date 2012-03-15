<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Vinur
 * @since Vinur 1.0
 */
?>
<section id="sidebar">
    <?php do_action( 'before_sidebar' ); ?>
	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
        
        <aside id="search" class="widget widget_search">
            <h3 class="widget-title">Search</h3>
			<?php get_search_form(); ?>
		</aside>

		<aside id="archives" class="widget">
			<h1 class="widget-title"><?php _e( 'Archives', 'vinur' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h1 class="widget-title"><?php _e( 'Meta', 'vinur' ); ?></h1>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
		</aside>

	<?php endif; // end sidebar widget area ?>
</section>
