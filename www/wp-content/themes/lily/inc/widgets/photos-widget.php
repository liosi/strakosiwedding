<?php
/**
 * ThemeChills Photos Widget
 *
 * @since 1.0.0
 */

/**
 * Register the Photos widget
 */
function chills_photos_widget() {
	register_widget( 'chills_photos_widget' );
}
add_action( 'widgets_init', 'chills_photos_widget' );

/**
 * Photos widget class
 */
class chills_photos_widget extends WP_Widget {

	public function chills_photos_widget() {

		$widget_ops = array(
			'classname'   => 'chills-photos-widget',
			'description' => __( 'Display your photos.', 'lily' )
		);
		
		$control_ops = array(
			'width'   => 200,
			'height'  => 350,
			'id_base' => 'chills-photos-widget'
		);
		
		parent::__construct( 'chills-photos-widget', __( 'ThemeChills Photos', 'lily' ), $widget_ops, $control_ops );
	}

	/**
	 * Displays the widget content
	 */
	public function widget( $args, $instance ) {

		$section_title = isset( $instance['section_title'] ) ? esc_attr( $instance['section_title'] ) : '';
		$section_desc = isset( $instance['section_desc'] ) ? esc_attr( $instance['section_desc'] ) : ''; 
		$signatures = isset( $instance['signatures'] ) ? esc_attr( $instance['signatures'] ) : ''; 
		$section_button = isset( $instance['section_button'] ) ? esc_attr( $instance['section_button'] ) : ''; 
		$section_button_url = isset( $instance['section_button_url'] ) ? esc_attr( $instance['section_button_url'] ) : ''; 
		$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];

		// Grab string input and return as an array
		$exclude_ids = explode("," , $exclude);
		
		?>

		<?php echo $args['before_widget']; ?>

		<section class="row">
			<?php if ( $section_title != '' ) : ?>
				<h2 class="widget-title"><?php echo $section_title; ?></h2>
				<span class="widget-divider"></span>
			<?php endif; ?>

			<?php if ( $section_desc != '' ) : ?>
				<p><?php echo $section_desc; ?></p>
			<?php endif; ?>
			
			<?php if ( $signatures != '' ) : ?>
				<img src="<?php echo $signatures; ?>" alt="<?php echo $section_title; ?>">
			<?php endif; ?>
		</section>

		<?php 
		 	
		    // Define the Photos query
		    $the_photos_args = array(
		        'post_status' => 'publish',
		        'post_type' => 'photo',
				'posts_per_page' => -1,
		        'post__not_in' => $exclude_ids,
		    );
		    
		    $the_photos_query = new WP_Query( $the_photos_args );
			
		?>

		<?php // START .owl-carousel ?>
		<div class="owl-carousel loop">
			<?php while ( $the_photos_query->have_posts() ) : $the_photos_query->the_post(); ?>
				<div class="owl-carousel-item">
					<?php the_post_thumbnail( 'our_past' ); ?>
				</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
		<?php // END .owl-carousel ?>
		
		<?php if( $section_button != '' ) : ?>
			<div class="row">
				<a href="<?php echo $section_button_url; ?>" class="button-alt"><?php echo $section_button; ?></a>
			</div>
		<?php endif; ?>

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
		$instance['signatures'] = strip_tags($new_instance['signatures']);
		$instance['section_button'] = strip_tags($new_instance['section_button']);
		$instance['section_button_url'] = strip_tags($new_instance['section_button_url']);
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
			'section_desc' => '',
			'signatures' => '',
			'section_button' => '',
			'section_button_url' => '',
			'exclude'		=> '',
		);

		$add_class = isset( $instance['add_class'] ) ? (bool) $instance['add_class'] : false;

		$instance = wp_parse_args( (array) $instance, $defaults );


	?>

			<p>
				<label for="<?php echo $this->get_field_id('section_title'); ?>"><?php _e( 'Section Title:', 'lily' ); ?>
					<input class="widefat" id="<?php echo $this->get_field_id( 'section_title' ); ?>" name="<?php echo $this->get_field_name('section_title'); ?>" type="text" value="<?php if( isset( $instance['section_title'] ) ) echo $instance['section_title']; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('section_desc'); ?>"><?php _e( 'Section Description:', 'lily' ); ?>
					<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'section_desc' ); ?>" name="<?php echo $this->get_field_name( 'section_desc' ); ?>"><?php if( isset( $instance['section_desc'] ) ) echo $instance['section_desc']; ?></textarea>
				</label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('signatures'); ?>"><?php _e( 'Signatures:', 'lily' ); ?>
					<input class="widefat" id="<?php echo $this->get_field_id( 'signatures' ); ?>" name="<?php echo $this->get_field_name('signatures'); ?>" type="text" value="<?php if( isset( $instance['signatures'] ) ) echo $instance['signatures']; ?>" />
				</label>
				<small><?php _e( 'Add the path to your signatures image.', 'lily' ); ?></small>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('section_button'); ?>"><?php _e( 'Button Text:', 'lily' ); ?>
					<input class="widefat" id="<?php echo $this->get_field_id( 'section_button' ); ?>" name="<?php echo $this->get_field_name('section_button'); ?>" type="text" value="<?php if( isset( $instance['section_button'] ) ) echo $instance['section_button']; ?>" />
				</label>
				<small><?php _e( 'Add a button to this section.', 'lily' ); ?></small>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('section_button_url'); ?>"><?php _e( 'Button URL:', 'lily' ); ?>
					<input class="widefat" id="<?php echo $this->get_field_id( 'section_button_url' ); ?>" name="<?php echo $this->get_field_name('section_button_url'); ?>" type="text" value="<?php if( isset( $instance['section_button_url'] ) ) echo $instance['section_button_url']; ?>" />
				</label>
				<small><?php _e( 'Add the destination URL.', 'lily' ); ?></small>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e( 'Exclude:', 'lily' ); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('exclude'); ?>" name="<?php echo $this->get_field_name('exclude'); ?>" type="text" value="<?php if( isset( $instance['exclude'] ) ) echo $instance['exclude']; ?>" />
				</label>
				<small><?php _e( 'Photo IDs, separated by commas.', 'lily' ); ?></small>
			</p>


			<?php
	}
}

?>