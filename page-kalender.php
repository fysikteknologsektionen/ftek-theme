<?php
/**
 * The template for displaying the calendar page.
 *
 * @package ftek
 * @since ftek 2.0
 */

// Categories
$categories = get_categories();
$all_categories = array_map(function($o) { return $o->slug; }, $categories);
$cat = sanitize_title_with_dashes(isset( $_GET['category'] ) ? $_GET['category'] : '' );
$category = get_category_by_slug($cat);
$category_active = in_array($cat, $all_categories);

// Venues
$venue = sanitize_title_with_dashes( isset( $_GET['place'] ) ? $_GET['place'] : '' ); // $_GET['venue'] will redirect to default EO venue page 
$venue = eo_get_venue_by('slug', $venue);

get_header();?>
	<main role="main" class="calendar-page">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title">
                    <a href="<?= $_SERVER['REQUEST_URI'] ?>"><?php the_title(); ?></a>
                </h1>
            </header>

            <?php 
            if ( $category_active ) {
                echo '<p class="info-bar"><span>';
                echo __('Showing events from', 'ftek') . ' ';
                $page = get_page_by_path( $category->slug, OBJECT );
                if ( isset( $page ) ) {
                    echo '<a href="/'.$category->slug.'">';
                    echo esc_html( __($category->name) );
                    echo '</a>';
                } else {
                    echo esc_html( __($category->name) );
                }
                echo '.</span><button class="close-button" >×</button></p>';
            }
            ?>

            <div class="entry-main">
                <div class="entry-content">
                    
                <?php
                if ($venue) {
                    $header_right = 'month, basicWeek, basicDay, category, venue';
                    $sc_options = array(
                        'tooltip' => 'false',
                        'headerLeft' => 'today, prev, next, goto, title',
                        'headerCenter' => '',
                        'headerRight' => $header_right,
                    );
                    print_eo_calendar($sc_options); 
                } else {
                    print_eo_calendar(); 
                }
                ?>

                <h2>Prenumerera</h2>
                <?= do_shortcode('[ftek_cal_subscription]') ?>
                <p>Vi rekommenderar att du prenumererar i ett kalenderprogram du gillar. Klicka på en kategori för att börja prenumerera!</p>

                </div>
            </div>
        </article>

	</main>
<?php get_footer(); ?>