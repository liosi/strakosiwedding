<?php
/**
 * Plugin Name: Lily Toolkit
 * Description: The Lily Toolkit extends functionality to the Lily WordPress Theme. It provides event post type, taxonomy and metaboxes.
 * Version:     1.0
 * Author:      Leo Acosta
 * Author URI:  http://themechills.com
 * Text Domain: lily
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages/
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Required files for registering the post type and taxonomies.
require plugin_dir_path( __FILE__ ) . 'includes/class-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-post-type-registrations.php';

require plugin_dir_path( __FILE__ ) . 'includes/profile-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/profile-post-type-registrations.php';

require plugin_dir_path( __FILE__ ) . 'includes/photo-class-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/photo-class-post-type-registrations.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$post_type_registrations = new Event_Post_Type_Registrations;
$profile_registrations = new Profile_Post_Type_Registrations;
$photo_post_type_registrations = new Photo_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$post_type = new Event_Post_Type( $post_type_registrations );
$profile_post_type = new Profile_Post_Type( $profile_registrations );
$photo_post_type = new Photo_Post_Type( $photo_post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $post_type, 'activate' ) );
register_activation_hook( __FILE__, array( $profile_post_type, 'activate' ) );
register_activation_hook( __FILE__, array( $photo_post_type, 'activate' ) );


// Initialize registrations for post-activation requests.
$post_type_registrations->init();
$profile_registrations->init();
$photo_post_type_registrations->init();

/**
 * Adds styling to the dashboard for the post type and adds event posts
 * to the "At a Glance" metabox.
 */
if ( is_admin() ) {

	// Loads for users viewing the WordPress dashboard
	if ( ! class_exists( 'Dashboard_Glancer' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/class-dashboard-glancer.php';  // WP 3.8
	}

	require plugin_dir_path( __FILE__ ) . 'includes/class-post-type-admin.php';
	require plugin_dir_path( __FILE__ ) . 'includes/profile-post-type-admin.php';
	require plugin_dir_path( __FILE__ ) . 'includes/photo-class-post-type-admin.php';

	$post_type_admin = new Event_Post_Type_Admin( $post_type_registrations );
	$post_type_admin->init();

	$profile_post_type_admin = new Profile_Post_Type_Admin( $profile_registrations );
	$profile_post_type_admin->init();

	$photo_post_type_admin = new Photo_Post_Type_Admin( $photo_post_type_registrations );
	$photo_post_type_admin->init();

}