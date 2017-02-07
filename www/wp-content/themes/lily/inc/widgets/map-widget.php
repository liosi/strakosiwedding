<?php
/**
 * ThemeChils Map Widget
 *
 * @since 1.0.0
 */

/**
 * Register the Map widget
 */
function chills_map_widget() {
	register_widget( 'chills_map_widget' );
}
add_action( 'widgets_init', 'chills_map_widget' );

/**
 * Map widget class
 */
class chills_map_widget extends WP_Widget {

	public function chills_map_widget() {

		$widget_ops = array(
			'classname'   => 'chills-map-widget',
			'description' => __( 'Display your map.', 'chills' )
		);
		
		$control_ops = array(
			'width'   => 200,
			'height'  => 350,
			'id_base' => 'chills-map-widget'
		);
		
		parent::__construct( 'chills-map-widget', __( 'ThemeChills Map', 'chills' ), $widget_ops, $control_ops );
	}

	/**
	 * Displays the widget content
	 */
	public function widget( $args, $instance ) {
		
		$chills_callout_map_title = isset($instance['chills_callout_map_title']) ? ( $instance['chills_callout_map_title'] ) : '';
		$chills_callout_map_description = apply_filters( 'widget_text', empty( $instance['chills_callout_map_description'] ) ? '' : $instance['chills_callout_map_description'], $instance );
		$chills_callout_map = apply_filters( 'widget_text', empty( $instance['chills_callout_map'] ) ? '' : $instance['chills_callout_map'], $instance );

	?>

		<?php echo $args['before_widget']; ?>	
		
		<div class="row">
			<h2 class="widget-title"><?php echo $chills_callout_map_title ?></h2>
			<span class="widget-divider"></span>
			<p><?php echo $chills_callout_map_description ?></p>
		</div>
		<div class="callout-map">
			<?php echo $chills_callout_map ?>
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

		$instance['chills_callout_map_title'] = strip_tags($new_instance['chills_callout_map_title']);
	
		if ( current_user_can('unfiltered_html') )
			$instance['chills_callout_map_description'] = $new_instance['chills_callout_map_description'];
		else
			$instance['chills_callout_map_description'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['chills_callout_map_description']) ) );

		if ( current_user_can('unfiltered_html') )
			$instance['chills_callout_map'] = $new_instance['chills_callout_map'];
		else
			$instance['chills_callout_map'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['chills_callout_map']) ) );
		return $instance;
	}

	/**
	 * Displays the widget settings form
	 *
	 * @since 1.0.0
	 */
	public function form( $instance ) {
		
		$defaults = array(
			'chills_callout_map_title' => '',
			'chills_callout_map_description' => '',
			'chills_callout_map' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	
		$chills_callout_map_title = strip_tags($instance['chills_callout_map_title']);
		$chills_callout_map_description = esc_textarea($instance['chills_callout_map_description']);
		$chills_callout_map = esc_textarea($instance['chills_callout_map']);

	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'chills_callout_map_title' ); ?>"><?php _e( 'Title:', 'chills' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'chills_callout_map_title' ); ?>" name="<?php echo $this->get_field_name( 'chills_callout_map_title' ); ?>" type="text" value="<?php if( isset( $instance['chills_callout_map_title'] ) ) echo $instance['chills_callout_map_title']; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('chills_callout_map_description'); ?>"><?php _e( 'Description:', 'chills' ); ?>
				<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'chills_callout_map_description' ); ?>" name="<?php echo $this->get_field_name( 'chills_callout_map_description' ); ?>"><?php echo $chills_callout_map_description; ?></textarea>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('chills_callout_map'); ?>"><?php _e( 'Embed or Shortcode:', 'chills' ); ?>
				<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'chills_callout_map' ); ?>" name="<?php echo $this->get_field_name( 'chills_callout_map' ); ?>"><?php echo $chills_callout_map; ?></textarea>
			</label>
			<small>Use this area to add an embed code or a shortcode.</small>
		</p>

	<?php
	}
}

?>