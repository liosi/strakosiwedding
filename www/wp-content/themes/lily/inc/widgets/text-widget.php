<?php
/**
 * ThemeChills Text Widget
 *
 * @since 1.0.0
 */

/**
 * Register the Map widget
 */
function chills_text_widget() {
	register_widget( 'chills_text_widget' );
}
add_action( 'widgets_init', 'chills_text_widget' );

/**
 * Map widget class
 */
class chills_text_widget extends WP_Widget {

	public function chills_text_widget() {

		$widget_ops = array(
			'classname'   => 'chills-text-widget',
			'description' => __( 'Display your text, shortcode or anything else.', 'chills' )
		);
		
		$control_ops = array(
			'width'   => 200,
			'height'  => 350,
			'id_base' => 'chills-text-widget'
		);
		
		parent::__construct( 'chills-text-widget', __( 'ThemeChills Text', 'chills' ), $widget_ops, $control_ops );
	}

	/**
	 * Displays the widget content
	 */
	public function widget( $args, $instance ) {
		
		$chills_section_title = isset($instance['chills_section_title']) ? ( $instance['chills_section_title'] ) : '';
		$chills_section_description = apply_filters( 'widget_text', empty( $instance['chills_section_description'] ) ? '' : $instance['chills_section_description'], $instance );
		$chills_section_content = apply_filters( 'widget_text', empty( $instance['chills_section_content'] ) ? '' : $instance['chills_section_content'], $instance );

	?>

		<?php echo $args['before_widget']; ?>	
		
		<div class="row">
			<h2 class="widget-title"><?php echo $chills_section_title ?></h2>
			<span class="widget-divider"></span>
			<p><?php echo $chills_section_description ?></p>
			<?php echo $chills_section_content ?>
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
			'chills_section_title' => '',
			'chills_section_description' => '',
			'chills_section_content' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	
		$chills_section_title = strip_tags($instance['chills_section_title']);
		$chills_section_description = esc_textarea($instance['chills_section_description']);
		$chills_section_content = esc_textarea($instance['chills_section_content']);

	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'chills_section_title' ); ?>"><?php _e( 'Title:', 'chills' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'chills_section_title' ); ?>" name="<?php echo $this->get_field_name( 'chills_section_title' ); ?>" type="text" value="<?php if( isset( $instance['chills_section_title'] ) ) echo $instance['chills_section_title']; ?>" />
			</label>
			<small>Add your section title.</small>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('chills_section_description'); ?>"><?php _e( 'Description:', 'chills' ); ?>
				<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id( 'chills_section_description' ); ?>" name="<?php echo $this->get_field_name( 'chills_section_description' ); ?>"><?php echo $chills_section_description; ?></textarea>
			</label>
			<small>Use this textarea to add the description below your section title.</small>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('chills_section_content'); ?>"><?php _e( 'Content:', 'chills' ); ?>
				<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id( 'chills_section_content' ); ?>" name="<?php echo $this->get_field_name( 'chills_section_content' ); ?>"><?php echo $chills_section_content; ?></textarea>
			</label>
			<small>Use this textarea to add an embed code, shortcode or anything else.</small>
		</p>

	<?php
	}
}

?>