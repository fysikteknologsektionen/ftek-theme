<?php
/**
 * Template for displaying content in group pages (committees, functionaries and societies).
 *
 * @package ftek
 * @since ftek 2.0
 */

$category = get_category_by_slug(get_post_field('post_name'));

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('type-group'); ?>>
	<header class="entry-header">
		<h1 class="entry-title hyphenate <?= has_post_thumbnail() || has_post_thumbnail($post->post_parent) ? 'featured-image"':'' ?>
			<?php if (has_post_thumbnail()) {
				echo 'style="background-image: url(';
				the_post_thumbnail_url('full');
				echo ');';
			} else if (has_post_thumbnail($post->post_parent)) {
				echo 'style="background-image: url(';
				echo wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), 'full' )[0];
				echo ');';
			} ?>
		">
			<a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
		</h1>
	</header>
    
    <div class="entry-main">

        <div class="entry-content">
            <?php 
                if (function_exists('wp_get_terms_meta') && $category) {     
                    /* Logo */
                    $logo = wp_get_terms_meta($category->cat_ID, 'logo' , true);
                    if ( $logo !== '' ) { ?>
                        <a class="group-logo-content" href="<?=$logo?>"><img src="<?=$logo?>" alt="logo" /></a>
                    <?php }
                } ?>
            <?php the_content(); ?>
        </div>

        <aside class="side-meta group-meta">
            <?php
            if (function_exists('wp_get_terms_meta') && $category) {
                
                /* Logo */
                $logo = wp_get_terms_meta($category->cat_ID, 'logo' , true);
                if ( $logo !== '' ) { ?>
                    <section class="group-logo">
                        <a href="<?=$logo?>"><img src="<?=$logo?>" alt="logo" /></a>
                    </section>
                <?php }

                /* News */

                // Get events
                $events = eo_get_events(array(
                    'numberposts'=>3,
                    'event_start_after'=>'today',
                    'event-category' => $category->slug,
                ));

                // Get posts
                $the_query = new WP_Query( array( 'category_name' => $category->slug, 'posts_per_page' => 3 ) ); ?>

                <?php if( $events || $the_query->have_posts() ) : ?>
                <section class="group-news">
                    <h2><?=sprintf(__('%s News', 'ftek'), get_the_title())?></h2>
                    <ul>
                        <?php foreach ($events as $event):
                        $format = ( eo_is_all_day($event->ID) ? get_option('date_format') : get_option('date_format').' '.get_option('time_format') ); ?>
                        <li class="group-news-event">
                        
                            <a href="<?=get_permalink($event->ID)?>">
                                <?=get_the_title($event->ID)?>
                            </a>
                            <br />
                            <time datetime="<?=eo_get_the_start( 'c', $event->ID, $event->occurrence_id )?>">
                                <?=eo_get_the_start( $format, $event->ID, $event->occurrence_id )?>
                            </time>
                        </li>
                        <?php endforeach; ?>

                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <li class="group-news-post" title="<?=substr(get_the_excerpt(),0, 100).'&hellip;'?>">
                            <a href="<?=get_permalink()?>">
                                <?= get_the_title();?>
                            </a>
                            —
                            <time datetime="<?=get_the_date( 'c' )?>">
                                <?=get_the_date( get_option('date_format') )?>
                            </time>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                    <p><a href="/kategori/<?=$category->slug?>"><?=__('More news from','ftek').' '?> <?php the_title() ?> &rarr;</a></p>
                    </section>
                <?php endif; ?>


                <?php 
                /* Contact */
                $contact_email = wp_get_terms_meta($category->cat_ID, 'email' , true);
                $contact_social = wp_get_terms_meta($category->cat_ID, 'social' , true);
                if ( $contact_email !== '' || $contact_social ) { ?>
                    <section class="group-contact">
                        <h2><?= __('Contact', 'ftek')?></h2>
                        <ul>
                            <?php if ($contact_email) : ?>
                            <li><a href="mailto:<?=$contact_email?>" target="_blank"><?=$contact_email?></a></li>
                            <?php endif; ?>
                            <?php if ($contact_social) : ?>
                            <li><a href="<?=$contact_social?>" target="_blank">Facebook</a></li>
                            <?php endif; ?>
                        </ul>
                    </section>
                <?php }

                /* Social */
                $social = array('facebook', 'instagram', 'snapchat');
                $html = '<section class="group-social"><ul>';
                foreach ($social as $s) {
                    $link = wp_get_terms_meta($category->cat_ID, $s , true);
                    if ($link) {
                        $html .= "<li><a href='$link' target='_blank' class='social-button'><img src='".get_stylesheet_directory_uri()."/images/$s.png' alt='$s' /></a></li>";
                    }
                }
                if ($html !== '<section class="group-social"><ul>') {
                    $html .= '</ul></section>';
                    echo $html;
                }

            } else { ?>
                <section>
                    <h2>Info</h2>
                    <p><?=__('No information could be found.', 'ftek')?></p>
                </section>
            <?php }
            ?>
        </aside>

    </div>

	<footer>
		<?php
			$date_updated = get_the_modified_time("c");
			$date_short = date_i18n( get_option('date_format'), strtotime($date_updated));
			$date_long = date_i18n( 'j F, Y', strtotime($date_updated)).' '.date_i18n( get_option('time_format'), strtotime($date_updated));
		?>
		<div class="entry-meta">
			<span class="entry-updated">
				<?=__('Latest updated', 'ftek').' '?>
				<time class="relative-time" datetime="<?=$date_updated?>" title="<?=$date_long?>">
					<?= $date_short ?>
				</time>.
			</span>
		</div>
	</footer>
</article>