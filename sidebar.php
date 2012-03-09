<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Vinur
 * @since Vinur 1.0
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php do_action( 'beforeVinuridebar' ); ?>
			<?php if ( ! dynamicVinuridebar( 'sidebar-1' ) ) : ?>

				<aside id="search" class="widget widgetVinurearch">
					<?php getVinurearch_form(); ?>
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
		</div><!-- #secondary .widget-area -->
