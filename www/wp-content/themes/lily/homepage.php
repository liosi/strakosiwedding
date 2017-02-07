<?php
/**
 * Template Name: Homepage
 *
 * This template displays a widget grid, a featured post
 * section, testimonials and a call-to-action banner.
 * Settings for this template can be found in Appearance ->
 * Customize -> Homepage Settings while viewing this page template.
 *
 * @package Lily
 * @since Lily 1.0
 */
get_header(); ?>

<?php //Display widgets if active ?>
<?php if ( is_active_sidebar( 'homepage' ) ) : ?>

	<?php dynamic_sidebar( 'homepage' ); ?>

<?php endif; ?>
<?php //End Condition ?>

<?php get_footer(); ?>