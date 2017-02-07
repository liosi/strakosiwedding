<?php
/**
 * Photo Post Type
 *
 * @package   Photo_Post_Type
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package Photo_Post_Type
 */
class Photo_Post_Type_Registrations {

	public $post_type = 'photo';

	public $taxonomies = array( 'photo-category' );

	public function init() {
		// Add the profile post type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Photo_Post_Type_Registrations::register_post_type()
	 * @uses Photo_Post_Type_Registrations::register_taxonomy_category()
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
			'name'               => __( 'Photos', 'chills-photo-post-type' ),
			'singular_name'      => __( 'Photo', 'chills-photo-post-type' ),
			'add_new'            => __( 'Add Photo', 'chills-photo-post-type' ),
			'add_new_item'       => __( 'Add Photo', 'chills-photo-post-type' ),
			'edit_item'          => __( 'Edit Photo', 'chills-photo-post-type' ),
			'new_item'           => __( 'New Photo', 'chills-photo-post-type' ),
			'view_item'          => __( 'View Photo', 'chills-photo-post-type' ),
			'search_items'       => __( 'Search Photo', 'chills-photo-post-type' ),
			'not_found'          => __( 'No galleries found', 'chills-photo-post-type' ),
			'not_found_in_trash' => __( 'No galleries in the trash', 'chills-photo-post-type' ),
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
			'rewrite'         => array( 'slug' => 'photo', ), // Permalinks format
			'menu_position'   => 29,
			'menu_icon'       => 'dashicons-camera',
		);

		$args = apply_filters( 'photo_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Photo Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Photo Categories', 'chills-photo-post-type' ),
			'singular_name'              => __( 'Photo Category', 'chills-photo-post-type' ),
			'menu_name'                  => __( 'Photo Categories', 'chills-photo-post-type' ),
			'edit_item'                  => __( 'Edit Photo Category', 'chills-photo-post-type' ),
			'update_item'                => __( 'Update Photo Category', 'chills-photo-post-type' ),
			'add_new_item'               => __( 'Add New Photo Category', 'chills-photo-post-type' ),
			'new_item_name'              => __( 'New Photo Category Name', 'chills-photo-post-type' ),
			'parent_item'                => __( 'Parent Photo Category', 'chills-photo-post-type' ),
			'parent_item_colon'          => __( 'Parent Photo Category:', 'chills-photo-post-type' ),
			'all_items'                  => __( 'All Photo Categories', 'chills-photo-post-type' ),
			'search_items'               => __( 'Search Photo Categories', 'chills-photo-post-type' ),
			'popular_items'              => __( 'Popular Photo Categories', 'chills-photo-post-type' ),
			'separate_items_with_commas' => __( 'Separate photo categories with commas', 'chills-photo-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove photo categories', 'chills-photo-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used photo categories', 'chills-photo-post-type' ),
			'not_found'                  => __( 'No photo categories found.', 'chills-photo-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'photo-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'photo_post_type_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}