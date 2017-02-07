<?php
/**
 * Template Name: Timeline
 *
 * @package Lily
 * @since Lily 1.0
 */
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', 'page' ); ?>
        <?php endwhile; ?>
   		<?php wp_reset_postdata(); ?>

		<?php //Display the event/timeline posts ?>
		<?php get_template_part( 'template-parts/content', 'event' ); ?>

		<?php //Display widgets if active ?>
		<?php if ( is_active_sidebar( 'call-to-action' ) ) : ?>

			<?php dynamic_sidebar( 'call-to-action' ); ?>

		<?php endif; ?>
		<?php //End Condition ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>