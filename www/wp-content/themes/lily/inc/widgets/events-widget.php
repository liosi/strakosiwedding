<?php
/**
 * ThemeChills Event Widget
 *
 * @since 1.0.0
 */

/**
 * Register the Events widget
 */
function chills_events_widget() {
	register_widget( 'chills_events_widget' );
}
add_action( 'widgets_init', 'chills_events_widget' );

/**
 * Adds Events widget.
 */
class chills_events_widget extends WP_Widget {

	function chills_events_widget() {

		$widget_ops = array(
			'classname'   => 'chills-events-widget',
			'description' => __( 'Display your events.', 'chills' )
			);
		$control_ops = array(
			'width'   => 200,
			'height'  => 350,
			'id_base' => 'chills-events-widget'
			);
		parent::__construct( 'chills-events-widget', __( 'ThemeChills Events', 'chills' ), $widget_ops, $control_ops );
	}

	/**
	 * Displays the widget content
	 */
	function widget( $args, $instance ) {

		$chills_section_title = isset($instance['chills_section_title']) ? esc_attr( $instance['chills_section_title'] ) : '';
		$chills_section_desc = isset($instance['chills_section_desc']) ? esc_attr($instance['chills_section_desc'] ) : ''; ?>

		<?php echo $args['before_widget']; ?>
		
		<div class="row">
			<h2 class="widget-title"><?php if ( $chills_section_title != '' ) : echo $chills_section_title; endif; ?></h2>
			<span class="widget-divider"></span>
			<p><?php if ( $chills_section_desc != '' ) : echo $chills_section_desc; endif; ?></p>
			<?php get_template_part( 'template-parts/content', 'event' ); ?>
		</div>

		<?php echo $args['after_widget']; ?>
		<?php

	}

	/**
	 * Update the instance
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$new_instance['chills_section_title'] = $new_instance['chills_section_title'];
		$new_instance['chills_section_desc']  = $new_instance['chills_section_desc'];
		
		return $new_instance;
	}

	/**
	 * Displays the widget settings form
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		$defaults = array(
			'chills_section_title' => '',
			'chills_section_desc' => '',
			);

			$instance = wp_parse_args( (array) $instance, $defaults ); ?>

			<p>
				<label for="<?php echo $this->get_field_id( 'chills_section_title' ); ?>"><?php _e( 'Title:', 'chills' ); ?>
					<input class="widefat" id="<?php echo $this->get_field_id( 'chills_section_title' ); ?>" name="<?php echo $this->get_field_name( 'chills_section_title' ); ?>" type="text" value="<?php if( isset( $instance['chills_section_title'] ) ) echo $instance['chills_section_title']; ?>" />
				</label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'chills_section_desc' ); ?>"><?php _e( 'Description:', 'chills' ); ?>
					<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id( 'chills_section_desc' ); ?>" name="<?php echo $this->get_field_name( 'chills_section_desc' ); ?>"><?php if( isset( $instance['chills_section_desc'] ) ) echo $instance['chills_section_desc']; ?></textarea>
				</label>
			</p>

			<?php
		}
	}