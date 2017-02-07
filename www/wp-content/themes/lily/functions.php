<?php
/**
 * Lily functions and definitions
 *
 * @package Lily
 */

@ini_set( 'upload_max_size' , '64M' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 760; /* pixels */
}

if ( ! function_exists( 'lily_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lily_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Lily, use a find and replace
	 * to change 'lily' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'lily', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Register new image sizes for Post Thumbnails
	add_image_size( 'owl-carousel-image', 800, 530 ); // Photo Image for Owl Carousel
	add_image_size( 'grid-media-image', 600 );
	add_image_size( 'timeline-image', 75, 75 );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
     * Add styles to post editor (editor-style.css)
     */
	add_editor_style();	

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'lily' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'lily_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // lily_setup
add_action( 'after_setup_theme', 'lily_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lily_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lily_content_width', 640 );
}
add_action( 'after_setup_theme', 'lily_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function lily_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar' , 'lily' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Widgets in this area will be shown on posts and pages which use a sidebar.' , 'lily' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</side>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage' , 'lily' ),
		'id'            => 'homepage',
		'description'   => esc_html__( 'Widgets in this area will be shown on the homepage.' , 'lily' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Post or Page Widgets', 'lily' ),
		'id'            => 'call-to-action',
		'description'   => esc_html__( 'Widgets in this area will be shown across all single posts and pages after the main content and before the comments area.' , 'lily' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


}
add_action( 'widgets_init', 'lily_widgets_init' );

/**
 * Register Roboto font for Lily.
 *
 * @return string
 */
function lily_font_url() {

	$font_url = '';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Roboto, translate this to 'off'. Do not translate into your own language.
	 */

	$roboto = _x( 'on', 'Roboto font: on or off', 'lily' );

	if ( 'off' !== $roboto || 'off' !== $oswald ) {
	    
	    $subsets = 'latin,latin-ext';
        $protocol = is_ssl() ? 'https' : 'http';

	    $query_args = array(
	            'family' => 'Roboto:100,300,400,500',
	            'subset' => $subsets,
	    );
	    
	    $font_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
    }

    return $font_url;
}


/**
 * Enqueue scripts and styles.
 */
function lily_scripts() {

	// Add Roboto font, used in the main stylesheet.
	wp_enqueue_style( 'lily-fonts', lily_font_url(), array(), null );

	// Main stylesheet
	wp_enqueue_style( 'lily-style', get_stylesheet_uri() );
	wp_enqueue_style( 'lily-font-awesome-css', get_template_directory_uri() . "/inc/fontawesome/font-awesome.min.css", array(), '4.3.0', 'screen' );
	wp_enqueue_style( 'lily-own-carousel-css', get_template_directory_uri() . "/css/owl.carousel.css", array(), '', 'screen' );

	// Scripts
	if ( !is_admin() ) { wp_enqueue_script( 'masonry' ); }
	wp_enqueue_script( 'lily-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'lily-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'lily-fitvid-js', get_template_directory_uri() . '/js/lib/jquery.fitvids.js', array( 'jquery' ), '1.1', true );
	wp_enqueue_script( 'lily-modernizr-js', get_template_directory_uri() . '/js/lib/modernizr.custom.js', array(), '', true );
	wp_enqueue_script( 'lily-own-carousel-js', get_template_directory_uri() . '/js/lib/owl.carousel.min.js', array(), '', true );
	wp_enqueue_script( 'lily-imagesloaded-js', get_template_directory_uri() . '/js/lib/imagesloaded.js', array(), '', true );
	wp_enqueue_script( 'lily-classie-js', get_template_directory_uri() . '/js/lib/classie.js', array(), '', true );
	wp_enqueue_script( 'lily-hoverIntent-js', get_template_directory_uri() . '/js/lib/jquery.hoverIntent.js', array(), '', true );
	
	// Only run script on pages where it is required
	if ( is_home() || is_archive() ) {
		wp_enqueue_script( 'lily-animonscroll-js', get_template_directory_uri() . '/js/lib/AnimOnScroll.js', array(), '', true );
	}

	// Only run Slideshow on homepage and if set to true 
	if ( esc_attr( get_theme_mod( 'lily_slideshow_on', true ) ) == 1 ) { 
		
		if ( is_page_template( 'homepage.php' ) ) {
			wp_enqueue_script( 'lily-slideshow-js', get_template_directory_uri() . '/js/lily-slideshow.js', array(), '', true );
			wp_localize_script('lily-slideshow-js', 'lily_slideshow_js_vars', array(
					'slideshow_fade_time' => esc_attr( get_theme_mod( 'lily_slideshow_time', '8' ) ),
				)
			);
		}

	}

	/**
	 * Enqueue Lily's javascript
	 */
	wp_enqueue_script( 'lily-js', get_template_directory_uri() . '/js/lily.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lily_scripts' );

/**
 * Custom comment output.
 */
function lily_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class( 'clearfix' ); ?> id="li-comment-<?php comment_ID() ?>">

	<div class="comment-block" id="comment-<?php comment_ID(); ?>">

		<div class="comment-author vcard">
			<div class="vcard-wrap">
				<?php echo get_avatar( $comment->comment_author_email, 75 ); ?>
			</div>
		</div>

		<div class="comment-wrap">
			<div class="comment-info">
				<?php printf( __( '<cite class="comment-cite">%s</cite>', 'lily' ), get_comment_author_link() ) ?>				
				<a class="comment-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( __( '%1$s at %2$s', 'lily' ), get_comment_date(), get_comment_time() ) ?></a><?php edit_comment_link( __( '(Edit)', 'lily' ), '  ', '' ) ?>
			</div>

			<div class="comment-content">
				<?php comment_text() ?>
				<p class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
				</p>
			</div>

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'lily' ) ?></em>
			<?php endif; ?>
		</div>
	</div>
<?php
}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Load the Lily theme widgets
 */

require get_template_directory() . '/inc/widgets/events-widget.php';
require get_template_directory() . '/inc/widgets/profiles-widget.php';
require get_template_directory() . '/inc/widgets/photos-widget.php';
require get_template_directory() . '/inc/widgets/callout-widget.php';
require get_template_directory() . '/inc/widgets/instagram-widget.php';
require get_template_directory() . '/inc/widgets/countdown-widget.php';
require get_template_directory() . '/inc/widgets/map-widget.php';
require get_template_directory() . '/inc/widgets/text-widget.php';

/**
 * Load TGM Plugin Activation library.
 */

require get_template_directory() . '/tgm-plugin-activation.php';

/**
 * Enable Subtitles on profile custom post type.
 */

function lily_add_subtitles_support() {
    add_post_type_support( 'profile', 'subtitles' );
    //add_post_type_support( 'event', 'subtitles' );
}
add_action( 'init', 'lily_add_subtitles_support' );

/**
 * Disable Subtitles in archive views.
 */
function lily_mod_supported_views() {
    // Ditch subtitles in archives.
    if ( is_archive() || is_home() ) {
        return false;
    }
} 
// end function lily_mod_supported_views
add_filter( 'subtitle_view_supported', 'lily_mod_supported_views' );


/**
 * Removing Default Subtitle Support from Posts and Pages
 */

function lily_remove_subtitles_support() {
    remove_post_type_support( 'post', 'subtitles' );
    remove_post_type_support( 'page', 'subtitles' );
}
add_action( 'init', 'lily_remove_subtitles_support' );


?>