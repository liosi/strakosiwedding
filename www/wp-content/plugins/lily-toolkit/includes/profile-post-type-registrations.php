<?php
/**
 * Profile Post Type
 *
 * @package   Profile_Post_Type
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package Profile_Post_Type
 */
class Profile_Post_Type_Registrations {

	public $post_type = 'profile';

	public $taxonomies = array( 'profile-category' );

	public function init() {
		// Add the profile post type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Profile_Post_Type_Registrations::register_post_type()
	 * @uses Profile_Post_Type_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Profiles', 'chills-profile-post-type' ),
			'singular_name'      => __( 'Profile', 'chills-profile-post-type' ),
			'add_new'            => __( 'Add Profile', 'chills-profile-post-type' ),
			'add_new_item'       => __( 'Add Profile', 'chills-profile-post-type' ),
			'edit_item'          => __( 'Edit Profile', 'chills-profile-post-type' ),
			'new_item'           => __( 'New Profile', 'chills-profile-post-type' ),
			'view_item'          => __( 'View Profile', 'chills-profile-post-type' ),
			'search_items'       => __( 'Search Profile', 'chills-profile-post-type' ),
			'not_found'          => __( 'No profiles found', 'chills-profile-post-type' ),
			'not_found_in_trash' => __( 'No profiles in the trash', 'chills-profile-post-type' ),
		);

		$supports = array(
			'title',
			'revisions',
			'editor',
			'thumbnail',
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'profile', ), // Permalinks format
			'menu_position'   => 29,
			'menu_icon'       => 'dashicons-admin-users',
		);

		$args = apply_filters( 'profile_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Profile Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Profile Categories', 'chills-profile-post-type' ),
			'singular_name'              => __( 'Profile Category', 'chills-profile-post-type' ),
			'menu_name'                  => __( 'Profile Categories', 'chills-profile-post-type' ),
			'edit_item'                  => __( 'Edit Profile Category', 'chills-profile-post-type' ),
			'update_item'                => __( 'Update Profile Category', 'chills-profile-post-type' ),
			'add_new_item'               => __( 'Add New Profile Category', 'chills-profile-post-type' ),
			'new_item_name'              => __( 'New Profile Category Name', 'chills-profile-post-type' ),
			'parent_item'                => __( 'Parent Profile Category', 'chills-profile-post-type' ),
			'parent_item_colon'          => __( 'Parent Profile Category:', 'chills-profile-post-type' ),
			'all_items'                  => __( 'All Profile Categories', 'chills-profile-post-type' ),
			'search_items'               => __( 'Search Profile Categories', 'chills-profile-post-type' ),
			'popular_items'              => __( 'Popular Profile Categories', 'chills-profile-post-type' ),
			'separate_items_with_commas' => __( 'Separate profile categories with commas', 'chills-profile-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove profile categories', 'chills-profile-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used profile categories', 'chills-profile-post-type' ),
			'not_found'                  => __( 'No profile categories found.', 'chills-profile-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'profile-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'profile_post_type_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}