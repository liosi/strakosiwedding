<?php
/**
 * The template for displaying all single posts.
 *
 * @package Lily
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
	
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php //Display widgets if active ?>
			<?php if ( is_active_sidebar( 'call-to-action' ) ) : ?>

				<?php dynamic_sidebar( 'call-to-action' ); ?>

			<?php else: ?>

				<hr>

			<?php endif; ?>
			<?php //End Condition ?>
					
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) : ?>
					<div class="row">
						<?php comments_template(); ?>
					</div>
			<?php endif; ?>			

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>