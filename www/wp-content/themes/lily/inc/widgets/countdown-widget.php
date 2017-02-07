<?php
/**
 * ThemeChills Countdown Widget
 *
 * @since 1.0.0
 */

/**
 * Register the Countdown Timer widget
 */
function chills_countdown_widget() {
	register_widget( 'chills_countdown_widget' );
}
add_action( 'widgets_init', 'chills_countdown_widget' );

/**
 * Countdown Timer widget class
 */
class chills_countdown_widget extends WP_Widget {

	function chills_countdown_widget() {

		$widget_ops = array(
			'classname'   => 'chills-countdown-widget',
			'description' => __( 'Display countdown timer.', 'chills' )
		);
		$control_ops = array(
			'width'   => 200,
			'height'  => 350,
			'id_base' => 'chills-countdown-widget'
		);
		parent::__construct( 'chills-countdown-widget', __( 'ThemeChills Countdown Timer', 'chills' ), $widget_ops, $control_ops );
	}

	/**
	 * Displays the widget content
	 */
	function widget( $args, $instance ) {

		$chills_target_date	= isset($instance['chills_target_date']) ? ( $instance['chills_target_date'] ) : '';
		$chills_finish_message = isset($instance['chills_finish_message']) ? ( $instance['chills_finish_message'] ) : '';
		$chills_section_description = isset($instance['chills_section_description']) ? $instance['chills_section_description'] : ''; ?>
			
		<?php echo $args['before_widget']; ?>
		
		<div class="callout">
			<p class="callout-text">
				<script>
					TargetDate		= "<?php echo $chills_target_date ?>";
					<?php //Don't run the countdown timer with customizer preview ?>
					<?php if (isset( $_POST['wp_customize'] ) ) : ?>
					CountActive 	= false;
					<?php else : ?>
					CountActive 	= true;
					<?php endif; ?>
					BackColor 		= "transparent";
					ForeColor 		= "inherit";
					CountStepper 	= -1;
					LeadingZero 	= false;
					DisplayFormat 	= "<?php echo $chills_section_description ?>";
					FinishMessage 	= "<?php echo $chills_finish_message ?>";
				</script>
				<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/lib/countdown.min.js"></script>
			</p>
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

		$new_instance['chills_target_date']	= $new_instance['chills_target_date'];
		$new_instance['chills_finish_message'] = $new_instance['chills_finish_message'];
		$new_instance['chills_section_description'] = $new_instance['chills_section_description'];
		
		return $new_instance;
	}

	/**
	 * Displays the widget settings form
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		$defaults = array(
			'chills_target_date' => '12/31/2015 4:00 PM',
			'chills_finish_message' => 'The Knot has been tied... thanks for stopping by though!',
			'chills_section_description' => 'Happy to announce we have set a date. We will be getting married in <strong>%%D%% days</strong>, <strong>%%H%% hours</strong>, <strong>%%M%% minutes</strong>, <strong>%%S%% seconds</strong>',
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'chills_target_date' ); ?>"><?php _e( 'Wedding Date:', 'chills' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'chills_target_date' ); ?>" name="<?php echo $this->get_field_name( 'chills_target_date' ); ?>" type="text" value="<?php if( isset( $instance['chills_target_date'] ) ) echo $instance['chills_target_date']; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'chills_finish_message' ); ?>"><?php _e( 'Final Message:', 'chills' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'chills_finish_message' ); ?>" name="<?php echo $this->get_field_name( 'chills_finish_message' ); ?>" type="text" value="<?php if( isset( $instance['chills_finish_message'] ) ) echo $instance['chills_finish_message']; ?>" />
			</label>
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'chills_section_description' ); ?>"><?php _e('Message:', 'chills'); ?>
				<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'chills_section_description' ); ?>" name="<?php echo $this->get_field_name( 'chills_section_description' ); ?>"><?php if( isset( $instance['chills_section_description'] ) ) echo $instance['chills_section_description']; ?></textarea>
			</label>
		</p>

	<?php
	}
}