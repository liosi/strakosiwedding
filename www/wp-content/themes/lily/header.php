<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Lily
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'lily' ); ?></a>

	<header id="masthead" class="site-header nav-down" role="banner">

		<div class="site-branding">

			<?php $logo = esc_attr( get_theme_mod( 'lily_customizer_logo' ) ); //Get the logo ?>
			<?php if ( ! empty( $logo ) ) : ?>
				
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-logo">
					<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
				</a>

			<?php else : ?>

				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<span class="site-description"><?php bloginfo( 'description' ); ?></span>
		
			<?php endif; ?>
		</div><!-- .site-branding -->

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<div class="menu-control">
				<span></span>
			</div>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 
					'theme_location' => 'primary',
					'menu_id' => 'primary-menu',
					'depth' => 2,
					'container' => false
				) ); ?>
			</nav>
		<?php endif; ?>	

	</header><!-- .site-header -->

	<?php if ( is_page_template( 'homepage.php' ) ) { ?>
		<div class="hero-container">
			<div class="hero-text-panel">
				<?php $get_header_image = get_header_image(); ?>
				<h2><?php echo esc_attr( get_theme_mod( 'lily_customizer_hero_text_one' ) ); ?></h2>
				<h3><?php echo esc_attr( get_theme_mod( 'lily_customizer_hero_text_two' ) ); ?></h3>					
				<h4>
					<span><?php echo esc_attr( get_theme_mod( 'lily_customizer_hero_text_three' ) ); ?></span>
					<span><?php echo esc_attr( get_theme_mod( 'lily_customizer_hero_text_four' ) ); ?></span>
				</h4>
				<?php

					// Get the first CTA button link
					if ( esc_attr( get_theme_mod( 'lily_customizer_hero_button_link' ) ) ) {

						$button_page_id = esc_attr( get_theme_mod( 'lily_customizer_hero_button_link' ) );
						$button_url = get_permalink( $button_page_id );

						if ( get_option( 'lily_customizer_hero_button_text' ) ) {
							
							$button_text = get_option( 'lily_customizer_hero_button_text' );

						} else {

							$button_text = get_the_title( $button_page_id );
						
						} ?>

						<a class="button-alt button-alt--large" href="<?php echo esc_url( $button_url ); ?>" title="<?php echo esc_attr( $button_text ); ?>"><?php echo $button_text; ?></a>
						<?php
					}
				?>
			</div>
			<div id="header-images">
				<?php

					/*
					 * Get the header images uploaded for the current theme.
					 * See https://developer.wordpress.org/reference/functions/get_uploaded_header_images/
					 */

					$header_images = get_uploaded_header_images();
					
					if( $header_images != '' ) {
						if( is_random_header_image() ) {
							shuffle( $header_images ); // Shuffle the array if random header image is set.
						}
						foreach( $header_images as $header_image) {
							echo '<div style="background-image:url('.$header_image['url'].');"></div>';
						}	
					}
				?>
			</div><!--end header-images-->
		</div><!-- .homepage-hero -->
	<?php } ?>

	<div id="content" class="site-content">