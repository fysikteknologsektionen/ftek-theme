<?php
/**
 * The template is used for displaying the Event List widget if the placeholder option isn't used.
 *
 * You can use this to edit how the output of the event list widget. For the shortcode [eo_events] see shortcode-event-list.php
 *
 * For a list of available functions (outputting dates, venue details etc) see http://wp-event-organiser.com/documentation/function-reference/
 *
 * @package Event Organiser (plug-in)
 * @since 1.7
 */
global $eo_event_loop,$eo_event_loop_args;

//The list ID / classes
$id = ( $eo_event_loop_args['id'] ? 'id="'.$eo_event_loop_args['id'].'"' : '' );
$classes = $eo_event_loop_args['class'];

?>

<?php if( $eo_event_loop->have_posts() ): ?>

	<ul <?php echo $id; ?> class="<?php echo esc_attr($classes);?>" > 

		<?php while( $eo_event_loop->have_posts() ): $eo_event_loop->the_post(); ?>

			<?php 
				//Generate HTML classes for this event
				$eo_event_classes = eo_get_event_classes(); 
			?>

			<li class="<?php echo esc_attr(implode(' ',$eo_event_classes)); ?>" >
			    <a href="<?php the_permalink(); ?>" 
			       title="<?php the_title_attribute(); ?>" >
			    	<?php the_title(); ?></a>
				<time class="relative-time inline-block" datetime="<?php eo_the_start('c') ?>">
                    om ett tag
				</time>
                <div>
    				<?= ftek_event_info() ?>
                </div>
			</li>

		<?php endwhile; ?>

	</ul>
    <?php 
	// Hardcoded to work in both English and Swedish
    $cal_url = get_page_uri( 19 );
    ?>
	<a href="<?= $cal_url ?>" class="more-events-link"><?php _e( "More events &#8594;", "ftek" ) ?></a>
	|
	<a href="#subscribe"><?php _e( "Subscribe", "ftek") ?></a>
<?php elseif( ! empty($eo_event_loop_args['no_events']) ): ?>

	<ul id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($classes);?>" > 
		<li class="eo-no-events" > <?php echo $eo_event_loop_args['no_events']; ?> </li>
	</ul>

<?php endif; ?>

