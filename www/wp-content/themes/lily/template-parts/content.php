<?php
/**
 * Template part for displaying posts.
 *
 * @package Lily
 */

?>

<li>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'grid-item-article' ); ?>>
		<?php //Grab the featured image ?>
		<?php if ( '' != get_the_post_thumbnail() ) { ?>
			<div class="post-featured-image">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="grid-media">
					<?php the_post_thumbnail( 'grid-media-image' ); ?>
					<div class="grid-block">
						<div class="grid-block-text-container">
				    		<span>Continue reading &rarr;</span>
				    	</div>
				  	</div>
				</a>
			</div>
		<?php } ?>

		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			
			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
				<?php lily_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>

		</header><!-- .entry-header -->

	</article><!-- #post-## -->
</li>