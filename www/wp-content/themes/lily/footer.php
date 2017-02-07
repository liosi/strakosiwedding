<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Lily
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php printf( esc_html__( '&copy; '. date("Y") .' %1$s - A wedding WordPress theme -  Handcrafted by love', 'lily' ), 'Lily', '<a href="http://themechills.com" rel="designer">ThemeChills</a>' ); ?>
			<span class="sep"> + </span>
			<?php printf( esc_html__( '%2$s', 'lily' ), 'lily', '<a href="http://themechills.com" rel="designer">ThemeChills</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>