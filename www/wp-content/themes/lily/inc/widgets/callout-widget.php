<?php
/**
 * ThemeChills Callout Widget
 *
 * @since 1.0.0
 */

/**
 * Register the Callout widget
 */
function chills_callout_widget() {
	register_widget( 'chills_callout_widget' );
}
add_action( 'widgets_init', 'chills_callout_widget' );

/**
 * Callout widget class
 */
class chills_callout_widget extends WP_Widget {

	public function chills_callout_widget() {

		$widget_ops = array(
			'classname'   => 'chills-callout-widget',
			'description' => __( 'Display your callout.', 'lily' )
		);
		
		$control_ops = array(
			'width'   => 200,
			'height'  => 350,
			'id_base' => 'chills-callout-widget'
		);
		
		parent::__construct( 'chills-callout-widget', __( 'ThemeChills Callout', 'lily' ), $widget_ops, $control_ops );
	}

	/**
	 * Displays the widget content
	 */
	public function widget( $args, $instance ) {
		
		$callout_text = apply_filters( 'widget_text', empty( $instance['callout_text'] ) ? '' : $instance['callout_text'], $instance );

	?>

		<?php echo $args['before_widget']; ?>	
			
		<div class="callout">
			<p class="callout-text"><?php echo $callout_text ?></p>
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
		
		if ( current_user_can('unfiltered_html') )
			$instance['callout_text'] =  $new_instance['callout_text'];
		else
			$instance['callout_text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['callout_text']) ) ); // wp_filter_post_kses() expects slashed
		return $instance;
	}

	/**
	 * Displays the widget settings form
	 *
	 * @since 1.0.0
	 */
	public function form( $instance ) {
		
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'callout_text' => '' ) );
		$callout_text = esc_textarea($instance['callout_text']);

	?>

		<p>
			<label for="<?php echo $this->get_field_id('callout_text'); ?>"><?php _e( 'Callout Text:', 'lily' ); ?>
				<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'callout_text' ); ?>" name="<?php echo $this->get_field_name( 'callout_text' ); ?>"><?php echo $callout_text; ?></textarea>
			</label>
		</p>

	<?php
	}
}

?>