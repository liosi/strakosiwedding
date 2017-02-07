<?php
/**
 * Template part for displaying single posts.
 *
 * @package Lily
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>

	<header class="entry-header">
		<div class="entry-meta">
			<?php lily_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php //Grab the featured image ?>
	<?php if ( '' != get_the_post_thumbnail() ) { ?>
		<div class="post-featured-image">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lily' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="template-tags">
			<?php lily_entry_footer(); ?>
		</div>
		<div class="post-navigation">
			<?php lily_post_nav(); ?>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->