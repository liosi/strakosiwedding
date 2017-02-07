<?php
/**
 * ThemeChills Instagram Feed Widget
 *
 * @since 1.1.0
 */

/**
 * Register the Instagram Feed widget
 */
function chills_instagram_feed_widget() {
	register_widget( 'chills_instagram_feed_widget' );
}
add_action( 'widgets_init', 'chills_instagram_feed_widget' );

/**
 * Instagram Feed widget class
 */
class chills_instagram_feed_widget extends WP_Widget {

	public function chills_instagram_feed_widget() {

		$widget_ops = array(
			'classname'   => 'chills-instagram-feed-widget',
			'description' => __( 'Display Instagram Feed.', 'lily' ),
			'customize_selective_refresh' => true,
		);
		
		$control_ops = array(
			'width'   => 200,
			'height'  => 350,
			'id_base' => 'chills-instagram-feed-widget'
		);
		
		parent::__construct( 'chills-instagram-feed-widget', __( 'Instagram Feed (ThemeChills)', 'lily' ), $widget_ops, $control_ops );
	}

	/**
	 * Displays the widget content
	 */
	public function widget( $args, $instance ) {
		
		$chills_section_title       = isset($instance['chills_section_title']) ? ( $instance['chills_section_title'] ) : '';
		$chills_section_description = apply_filters( 'widget_text', empty( $instance['chills_section_description'] ) ? '' : $instance['chills_section_description'], $instance );
		$chills_section_content     = apply_filters( 'widget_text', empty( $instance['chills_section_content'] ) ? '' : $instance['chills_section_content'], $instance );

	?>

		<?php echo $args['before_widget']; ?>	
		
		<div class="row">
			<header class="widget-header">
				<h3 class="widget-title"><?php echo $chills_section_title ?></h3>
				<span class="widget-divider"></span>
				<p class="widget-description"><?php echo $chills_section_description ?></p>
			</header>

			<div class="grid-instagram callout">
				<?php echo $chills_section_content ?>
			</div>
		</div>
		
		<?php echo $args['after_widget']; ?>
		<?php

	}

	/**
	 * Update the instance
	 *
	 * @since 1.0.0
	 */

	public function update( $new_instance, $old_instance ) {
	
		$instance = $old_instance;

		$instance['chills_section_title'] = strip_tags($new_instance['chills_section_title']);
	
		if ( current_user_can('unfiltered_html') )
			$instance['chills_section_description'] = $new_instance['chills_section_description'];
		else
			$instance['chills_section_description'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['chills_section_description']) ) );

		if ( current_user_can('unfiltered_html') )
			$instance['chills_section_content'] = $new_instance['chills_section_content'];
		else
			$instance['chills_section_content'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['chills_section_content']) ) );
		return $instance;
	}

	/**
	 * Displays the widget settings form
	 *
	 * @since 1.0.0
	 */
	public function form( $instance ) {
		
		$defaults = array(
			'chills_section_title'       => '',
			'chills_section_description' => '',
			'chills_section_content'     => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	
		$chills_section_title = strip_tags($instance['chills_section_title']);
		$chills_section_description = esc_textarea($instance['chills_section_description']);
		$chills_section_content = strip_tags($instance['chills_section_content']);

	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'chills_section_title' ); ?>"><?php _e( 'Title:', 'lily' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'chills_section_title' ); ?>" name="<?php echo $this->get_field_name( 'chills_section_title' ); ?>" type="text" value="<?php if( isset( $instance['chills_section_title'] ) ) echo $instance['chills_section_title']; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('chills_section_description'); ?>"><?php _e( 'Description:', 'lily' ); ?>
				<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id( 'chills_section_description' ); ?>" name="<?php echo $this->get_field_name( 'chills_section_description' ); ?>"><?php echo $chills_section_description; ?></textarea>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('chills_section_content'); ?>"><?php _e( 'Instagram Feed Shortcode:', 'lily' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'chills_section_content' ); ?>" name="<?php echo $this->get_field_name( 'chills_section_content' ); ?>" type="text" value="<?php if( isset( $instance['chills_section_content'] ) ) echo $instance['chills_section_content']; ?>" />
			</label>
		</p>

	<?php
	}
}

?>