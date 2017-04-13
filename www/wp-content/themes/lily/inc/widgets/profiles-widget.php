<?php
/**
 * ThemeChills Profile Widget
 *
 * @since 1.0.0
 */

/**
 * Register the Profiles widget
 */
function chills_profiles_widget() {
	register_widget( 'chills_profiles_widget' );
}
add_action( 'widgets_init', 'chills_profiles_widget' );

/**
 * Profiles widget class
 */
class chills_profiles_widget extends WP_Widget {

	public function chills_profiles_widget() {

		$widget_ops = array(
			'classname'   => 'chills-profiles-widget',
			'description' => __( 'Display your profiles.', 'enchanted' )
		);
		
		$control_ops = array(
			'width'   => 200,
			'height'  => 350,
			'id_base' => 'chills-profiles-widget'
		);
		
		parent::__construct( 'chills-profiles-widget', __( 'ThemeChills Profiles', 'enchanted' ), $widget_ops, $control_ops );
	}

	/**
	 * Displays the widget content
	 */
	public function widget( $args, $instance ) {

		$section_title = isset( $instance['section_title'] ) ? esc_attr( $instance['section_title'] ) : '';
		$section_desc = isset( $instance['section_desc'] ) ? esc_attr( $instance['section_desc'] ) : ''; 
		$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];

		// Grab string input and return as an array
		$exclude_ids = explode("," , $exclude);
		
		?>

		<?php echo $args['before_widget']; ?>	
		
		<?php wp_enqueue_script( 'lily-animonscroll-js', get_template_directory_uri() . '/js/lib/AnimOnScroll.js', array(), '', true ); ?>

		<div class="row">
			<?php if ( $section_title != '' ) : ?>
				<h2 class="widget-title"><?php echo $section_title; ?></h2>
				<span class="widget-divider"></span>
			<?php endif; ?>

			<?php if ( $section_desc != '' ) : ?>
				<p><?php echo $section_desc; ?></p>
			<?php endif; ?>
		</div>

		<?php 
		 	
		    // Define the Profile query
		    $the_profile_args = array(
		        'post_status' => 'publish',
		        'post_type' => 'profile',
		        'post__not_in' => $exclude_ids,
		    );
		    
		    $the_profile_query = new WP_Query( $the_profile_args );
			
		?>

		<ul class="grid effect-8" id="grid">
			<?php while ( $the_profile_query->have_posts() ) : $the_profile_query->the_post(); ?>
				<li>
					<!--<a href="<?php //the_permalink(); ?>" class="grid-media"> -->
						<?php the_post_thumbnail( 'the_cast' ); ?>
						<div class="grid-block">
							<div class="grid-block-text-container">
					    		<h2 class="grid-block-entry-title"><?php the_title(); ?></h2>
					    		<?php if ( function_exists( 'the_subtitle' ) ) : ?>
					    			<span class="grid-block-entry-subtitle"><?php the_subtitle(); ?></span>
					    		<?php endif; ?>
					    	</div>
					  	</div>
					<!-- </a> -->
				</li>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</ul>

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

		$instance['section_title'] = strip_tags($new_instance['section_title']);
		$instance['section_desc'] = strip_tags($new_instance['section_desc']);
		$instance['exclude'] = strip_tags( $new_instance['exclude'] );

		return $instance;

	}

	/**
	 * Displays the widget settings form
	 *
	 * @since 1.0.0
	 */
	public function form( $instance ) {
		
		//Defaults
		$defaults = array(
			'section_title' => '',
			'section_desc'  => '',
			'exclude'		=> '',
		);

		$add_class = isset( $instance['add_class'] ) ? (bool) $instance['add_class'] : false;

		$instance = wp_parse_args( (array) $instance, $defaults );


	?>

			<p>
				<label for="<?php echo $this->get_field_id('section_title'); ?>"><?php _e( 'Section Title:', 'enchanted' ); ?>
					<input class="widefat" id="<?php echo $this->get_field_id( 'section_title' ); ?>" name="<?php echo $this->get_field_name('section_title'); ?>" type="text" value="<?php if( isset( $instance['section_title'] ) ) echo $instance['section_title']; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('section_desc'); ?>"><?php _e( 'Section Description:', 'enchanted' ); ?>
					<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'section_desc' ); ?>" name="<?php echo $this->get_field_name( 'section_desc' ); ?>"><?php if( isset( $instance['section_desc'] ) ) echo $instance['section_desc']; ?></textarea>
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e( 'Exclude:', 'enchanted' ); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('exclude'); ?>" name="<?php echo $this->get_field_name('exclude'); ?>" type="text" value="<?php if( isset( $instance['exclude'] ) ) echo $instance['exclude']; ?>" />
				</label>
				<small><?php _e( 'Profile IDs, separated by commas.', 'enchanted' ); ?></small>
			</p>


			<?php
	}
}

?>