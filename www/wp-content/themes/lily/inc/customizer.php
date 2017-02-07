<?php
/**
 * Lily Theme Customizer
 *
 * @package Lily
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lily_customize_register( $wp_customize ) {

	/**
	 * Sanitizes the checkbox
	 */
	function lily_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}

	/**
	 * Sanitize page drop down
	 */
	function lily_sanitize_integer( $input ) {
		if( is_numeric( $input ) ) {
			return intval( $input );
		}
	}


	/**
	 * Sanitizes Header Hero display button callback
	 */
	function lily_show_button_options( $control ) {
		$option = $control->manager->get_setting( 'lily_customizer_hero_button_link' );

		return $option->value();
	}

	/**
	 * Set defaults
	 */
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->default = '#a8a8a7';

	/**
	 * Rename defaults
	 */
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title, Tagline & Logo', 'lily' );
    
    /**
	 * Remove defaults
	 */
    $wp_customize->remove_control('display_header_text');



	/**
	 * Header Hero Text Section
	 */
	$wp_customize->add_section( 'lily_hero_text_section', array(
		'title'    => __( 'Header Hero Text', 'lily' ),
		'priority' => 60,
	    'description' => 'Add your hero text message.'
	) );

	/**
	 * Header Text Line One
	 */

	$wp_customize->add_setting( 'lily_customizer_hero_text_one', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'lily_customizer_hero_text_one', array(
    	'label'    => __('Text Line One', 'lily'),
		'section'  => 'lily_hero_text_section',
		'settings' => 'lily_customizer_hero_text_one',
		'type'     => 'text',
		'priority' => 1
	) );	

	/**
	 * Header Text Line Two
	 */

	$wp_customize->add_setting( 'lily_customizer_hero_text_two', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'lily_customizer_hero_text_two', array(
    	'label'    => __('Text Line Two', 'lily'),
		'section'  => 'lily_hero_text_section',
		'settings' => 'lily_customizer_hero_text_two',
		'type'     => 'text',
		'priority' => 2
	) );

	/**
	 * Header Text Line Three
	 */

	$wp_customize->add_setting( 'lily_customizer_hero_text_three', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'lily_customizer_hero_text_three', array(
    	'label'    => __('Text Line Three', 'lily'),
		'section'  => 'lily_hero_text_section',
		'settings' => 'lily_customizer_hero_text_three',
		'type'     => 'text',
		'priority' => 3
	) );

	/**
	 * Header Text Line Four
	 */

	$wp_customize->add_setting( 'lily_customizer_hero_text_four', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'lily_customizer_hero_text_four', array(
    	'label'    => __('Text Line Four', 'lily'),
		'section'  => 'lily_hero_text_section',
		'settings' => 'lily_customizer_hero_text_four',
		'type'     => 'text',
		'priority' => 4
	) );

	/**
	 * Homepage Header Button Link
	 */
	$wp_customize->add_setting( 'lily_customizer_hero_button_link', array(
		'default'           => '',
		'sanitize_callback' => 'lily_sanitize_integer',
	) );

	$wp_customize->add_control( 'lily_customizer_hero_button_link', array(
		'type'     => 'dropdown-pages',
		'label'    => 	__( 'Button Link', 'lily' ),
		'settings' => 'lily_customizer_hero_button_link',
		'section'  => 'lily_hero_text_section',
		'priority' => 8
	) );

	/**
	 * Homepage Header Button Text
	 */
	$wp_customize->add_setting( 'lily_customizer_hero_button_text', array(
		'default'           => __( 'Read More', 'lily' ),
		'type'              => 'option',		
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'lily_customizer_hero_button_text', array(
		'label'           => __( 'Button Text', 'lily' ),
		'section'         => 'lily_hero_text_section',
		'settings'        => 'lily_customizer_hero_button_text',
		'type'            => 'text',
		'active_callback' => 'lily_show_button_options',
		'priority'        => 10
	) );


	/**
	 * Logo image uploader setting and control
	 */

	$wp_customize->add_setting( 'lily_customizer_logo', array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lily_customizer_logo', array(
		'label'    => __( 'Site Logo', 'lily' ),
		'section'  => 'title_tagline',
		'settings' => 'lily_customizer_logo'
	) ) );

	// Header Slideshow
	
	$wp_customize->add_setting( 'lily_slideshow_on', array(
    	'default' => 1,
    	'sanitize_callback' => 'lily_sanitize_checkbox',
	));
	$wp_customize->add_control( 'lily_slideshow_on', array(
		'label'    => __('Turn on slideshow', 'lily'),
    	'type' => 'checkbox',
    	'section' => 'header_image',
    	'settings' => 'lily_slideshow_on',
    	'priority' => 2
	));

	// Header Image
	
	$wp_customize->add_setting( 'lily_slideshow_time', array(
		'default' => '8',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'lily_slideshow_time', array(
    	'label'    => __('Slideshow Fade Time (seconds)', 'lily'),
		'section'  => 'header_image',
		'settings' => 'lily_slideshow_time',
		'type'     => 'text',
		'priority' => 3
	) );

	// Add Body Text Color setting and control
	$wp_customize->add_setting( 'lily_customizer_body_text', array(
		'default'           => '#000000',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lily_customizer_body_text', array(
		'label'    => __( 'Body Text Color', 'lily' ),
		'section'  => 'colors',
		'settings' => 'lily_customizer_body_text',
		'priority' => 7
	) ) );

	// Add Accent Color setting and control
	$wp_customize->add_setting( 'lily_customizer_accent', array(
		'default'           => '#b57f9a',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lily_customizer_accent', array(
		'label'    => __( 'Accent Color', 'lily' ),
		'section'  => 'colors',
		'settings' => 'lily_customizer_accent',
		'priority' => 8
	) ) );

	// Add Hover Color setting and control
	$wp_customize->add_setting( 'lily_customizer_hover', array(
		'default'           => '#896075',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lily_customizer_hover', array(
		'label'    => __( 'Hover Color', 'lily' ),
		'section'  => 'colors',
		'settings' => 'lily_customizer_hover',
		'priority' => 9
	) ) );

	/**
	 * Add Alpha Transparency Color settings and control
	 */

    // Add in all the settings with an array
    $set_eternity_theme_option_defaults = array(
        'lily_backgroundcolor_setting'       => '#b57f9a',
        'lily_contentbackground_setting'     => '.90',
    );
    
    // Create the setting
    foreach( $set_eternity_theme_option_defaults as $setting => $value ) {
        $wp_customize->add_setting( $setting , array(
            'default' => $value,
            'sanitize_callback' => 'esc_attr',
        ) ); 
    }

    // Change the color of the background
    $wp_customize->add_setting( 'lily_backgroundcolor_setting', array(
        'default'   => '#b57f9a',
        'control'   => 'select',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'backgroundcolor_control', array(
        'label'     => __('Alpha Transparency Color', 'lily'),
        'section'   => 'colors',
        'settings'  => 'lily_backgroundcolor_setting',
        'priority'  => 10, 
    ) ) );

    // Change the opacity of the background
    $wp_customize->add_control( 'lily_contentbackground_control', array(
        'label'     => __('Alpha Transparency Opacity', 'lily'),
        'section'   => 'colors',
        'settings'  => 'lily_contentbackground_setting',
        'priority'  => 11,
        'type'      => 'select',
        'choices'   => array(
            '1'     => '100',
            '.95'   => '95',
            '.90'   => '90 (Default)',
            '.85'   => '85',
            '.80'   => '80',
            '.75'   => '75',
            '.70'   => '70',
            '.65'   => '65',
            '.60'   => '60',
            '.55'   => '55',
            '.50'   => '50',
            '.45'   => '45',
            '.40'   => '40',
            '.35'   => '35',
            '.30'   => '30',
            '.25'   => '25',
            '.20'   => '20',
            '.15'   => '15',
            '.10'   => '10',
            '.05'   => '5',
            '.00'   => '0',), 
    ) );

	
}
add_action( 'customize_register', 'lily_customize_register' );

/**
 * Add Customizer CSS To Header
 */

function lily_customizer_css() { ?>

	<?php
		
		// Convert Content from Hex to RGB			
	    $hex = str_replace("#", "", esc_attr(get_theme_mod('lily_backgroundcolor_setting') ) );
		
	    if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1)); 
	    }
		else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2)); 
	    } 
	?>

	<style type="text/css">
		body, 
		button, 
		input, 
		select, 
		textarea {
    		color: <?php echo esc_attr( get_theme_mod( 'lily_customizer_body_text', '#000000' ) ); ?>;
		}
		a,
		a:visited,
		.timeline:before, 
		.timeline:after {
  			color: <?php echo esc_attr( get_theme_mod( 'lily_customizer_accent', '#b57f9a' ) ); ?>;
		}
		a:hover,
		.main-navigation li a:hover, 
		.main-navigation .current-menu-item a {
			color: <?php echo esc_attr( get_theme_mod( 'lily_customizer_hover', '#896075' ) ); ?>;;
		}
		input[type="submit"] {
			background-color: <?php echo esc_attr( get_theme_mod( 'lily_customizer_accent', '#b57f9a' ) ); ?>;
		}
		input[type="submit"]:hover {
			background-color: <?php echo esc_attr( get_theme_mod( 'lily_customizer_hover', '#896075' ) ); ?>;
		}
		.site-title a {
    		color: <?php echo esc_attr( get_theme_mod( 'lily_customizer_body_text', '#000000' ) ); ?>;
		}
		.site-title a:hover {
			color: <?php echo esc_attr( get_theme_mod( 'lily_customizer_hover', '#896075' ) ); ?>;
		}
		.grid-block {
			background-color: <?php echo esc_attr( get_theme_mod('lily_backgroundcolor_setting') ); ?>;
			background-color: rgba( <?php echo $r ?>, <?php echo $g ?>, <?php echo $b ?>, <?php echo esc_attr( get_theme_mod( 'lily_contentbackground_setting' ) ); ?> );
  		}
  		::-moz-selection {
    		background-color: <?php echo esc_attr( get_theme_mod( 'lily_customizer_accent', '#b57f9a' ) ); ?>;
		}
		::selection {
		    background-color: <?php echo esc_attr( get_theme_mod( 'lily_customizer_accent', '#b57f9a' ) ); ?>;
		}
		.button-alt, 
		.button-alt--large {
		    color: <?php echo esc_attr( get_theme_mod( 'lily_customizer_accent', '#b57f9a' ) ); ?>;
		}
		blockquote {
    		border-color: <?php echo esc_attr( get_theme_mod( 'lily_customizer_accent', '#b57f9a' ) ); ?>;
		}

	</style>
<?php 
}
add_action( 'wp_head', 'lily_customizer_css' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lily_customize_preview_js() {
	wp_enqueue_script( 'lily_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'lily_customize_preview_js' );
