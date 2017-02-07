<?php
/**
 * The template part for displaying the event meta information
 *
 * @package Lily
 */
?>

<?php 

    // Define the query
    $args = array(
        'post_status'	=> array( 'publish', 'pending', 'draft', 'future' ),
        'post_type'		=> 'event',
        'orderby' 		=> 'date',
        'order' 		=> 'ASC',
    );
    
    $the_events_query = new WP_Query( $args );

?>

<div class="row">
	<div class="timeline">
	    <ul> 
			<?php while ( $the_events_query->have_posts() ) : $the_events_query->the_post(); ?> 
				<li>
				  	<div class="timeline-date">
						<span class="entry-meta"><?php echo get_the_date(); ?></span>
					</div>
					<div class="timeline-content-container">
						<?php //Grab the featured image ?>
						<?php if ( '' != get_the_post_thumbnail() ) { ?>
				        	<figure class="timeline-content-featured-image">
								<?php the_post_thumbnail( 'timeline-image' ); ?>
				            </figure><!-- .timeline-content-featured-image -->
						<?php } ?>					
				        <div class="timeline-content-info">
				        	<?php the_title( '<h4>', '</h4>' ); ?>
				        	<?php the_content(); ?>
				        	<?php edit_post_link('Edit'); ?>
				        </div><!-- .timeline-content-info -->
				    </div><!-- .timeline-content-container -->
				</li>
	        <?php endwhile; ?>
		</ul>
	</div><!-- .timline -->
</div><!-- .row -->
<?php wp_reset_postdata(); ?>