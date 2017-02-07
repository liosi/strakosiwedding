/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	// Update button text label
	wp.customize( 'lily_customizer_hero_button_text', function( value ) {
		value.bind( function( to ) {
			$( '.button-alt--large' ).text( to );
		} );
	} );

	// Update hero text one
	wp.customize( 'lily_customizer_hero_text_one', function( value ) {
		value.bind( function( to ) {
			$( '.hero-text-panel h2' ).text( to );
		} );
	} );

	// Update hero text two
	wp.customize( 'lily_customizer_hero_text_two', function( value ) {
		value.bind( function( to ) {
			$( '.hero-text-panel h3' ).text( to );
		} );
	} );

	// Update hero text three
	wp.customize( 'lily_customizer_hero_text_three', function( value ) {
		value.bind( function( to ) {
			$( '.hero-text-panel span:first-child' ).text( to );
		} );
	} );

	// Update hero text four
	wp.customize( 'lily_customizer_hero_text_four', function( value ) {
		value.bind( function( to ) {
			$( '.hero-text-panel span:last-child' ).text( to );
		} );
	} );

	// Update body text color
	wp.customize( 'lily_customizer_body_text', function( value ) {
		value.bind( function( to ) {
			$( 'body, button, input, select, textarea, .site-title a' ).css( 'color', to );
		});
	});
	
	// Update accent color
	wp.customize( 'lily_customizer_accent', function( value ) {
		value.bind( function( to ) {
			$( 'a, a:visited, .timeline:before, .timeline:after' ).css( 'color', to );
			$( 'input[type="submit"]' ).css( 'background-color', to );
		});
	});

} )( jQuery );
