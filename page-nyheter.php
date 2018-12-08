<?php
/**
 * The template for displaying the news page.
 *
 * @package ftek
 * @since ftek 2.0
 */

/* Parse queries */

// Post types

$post_types = array('post'=>__('Posts', 'ftek'),'event'=>__('Events', 'eventorganiser'));
$all_post_types = array('post','event');
$post_types_active = isset($_GET['post_types']) && $_GET['post_types'] != array('post','event');
if ( $post_types_active ) {
    $types = $_GET['post_types'];
} else {
    $types = array();
}

// Categories

$categories = get_categories();
// Sort alpabetically
usort($categories, function($a, $b) {
    return strcmp(__($a->name), __($b->name));
});
$all_categories = array_map(function($o) { return $o->slug; }, $categories);
$category_active = isset($_GET['category']) && $_GET['category'] != $all_categories;
if ( $category_active ) {
    $cat = $_GET['category'];
} else {
    $cat = array();
}


get_header();?>
	<main role="main" class="news-page">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title">
                    <a href="<?= $_SERVER['REQUEST_URI'] ?>"><?php the_title(); ?></a>
                </h1>
            </header>
            <div id="filter-box">
                <input id="filter-checkbox" type="checkbox" /><label id="filter-button" for="filter-checkbox" <?= ( $post_types_active || $category_active ) ? 'class="filter-active"' : null; ?>>Filter</label>
                <form id="news-filter" method="get" <?= ( $post_types_active || $category_active ) ? 'class="filter-active"' : null; ?>>
                    <fieldset id="post-types" <?= $post_types_active ? 'class="filter-active"' : null; ?>>
                        <legend><?= __('Types', 'ftek') ?></legend>
                        <?php
                            /* Check checkboxes if in query */
                            foreach ($post_types as $type=>$name) { ?>
                                <label><input type="checkbox" name="post_types[]" <?= in_array($type, $types) ? 'checked' : null ?> value="<?= $type ?>" /><?= $name ?></label>
                            <?php } ?>
                    </fieldset>
                    <fieldset id="categories" <?= $category_active ? 'class="filter-active"' : null; ?>>
                        <legend><?= __('Categories') ?></legend>
                        <?php
                            /* Check checkboxes if in query */
                            foreach ($categories as $category) { ?>
                                <label><input type="checkbox" name="category[]" <?= in_array($category->slug, $cat) ? 'checked' : null ?> value="<?= $category->slug ?>" /><?= __($category->name) ?></label>
                            <?php } ?>
                    </fieldset>
                    <div id="submit-buttons">
                        <input type="submit" name="submit" value="<?= __('Filter', 'ftek') ?>"/>
                        <a href="<?= get_permalink() ?>" class="button"><?= __('Reset','ftek') ?></a>
                    </div>
                </form>
            </div>
            <?php 
            // Show info bar if filter is active
            if ($types == array('event') && !$category_active) {
                echo '<p class="info-bar"><span>' . 
                __('You are only viewing events. Would you like to ', 'ftek') . 
                '<a href="/kalender" title="' . 
                __('Go to calendar view', 'ftek') . '">' . 
                __('go to the calendar', 'ftek') . 
                '</a>?</span><button class="close-button" >×</button></p>';
            }
            if ( $category_active ) {
                echo '<p class="info-bar"><span>' . 
                __('Showing news from', 'ftek') . ' ';
                $first_item = true;
                foreach ($categories as $category) {
                    if ( in_array($category->slug, $cat) ) { // Is current category a category of the post?
                        echo ($first_item) ? '' : ', ';
                        $first_item = false;
                        $page = get_page_by_path( $category->slug, OBJECT );
                        if ( isset( $page ) ) {
                            echo '<a href="/'.$category->slug.'">';
                            echo esc_html( __($category->name) );
                            echo '</a>';
                        } else {
                            echo esc_html( __($category->name) );
                        }
                    }
                }
                echo '.</span><button class="close-button" >×</button></p>';
            } elseif ($_GET['yearnum'] || $_GET['monthnum'] || $_GET['daynum']) {
                echo '<p class="info-bar"><span>' . 
                __('Showing news from', 'ftek') . ' ';
                $date_str = '';
                if ((int) $_GET['daynum'] !== 0) {
                    $date_str .= ' '.strip_tags($_GET['daynum']);
                }
                if ((int) $_GET['monthnum'] !== 0) {
                    $dateObj   = DateTime::createFromFormat('!m', $_GET['monthnum']);
                    $date_str .= ' '.__($dateObj->format('F'));
                }
                if ((int) $_GET['yearnum'] !== 0) {
                    $date_str .= ' '.$_GET['yearnum'];
                }
                echo $date_str;
                echo '.</span><button class="close-button" >×</button></p>';
            } ?>
            <div class="entry-main">
                <div class="entry-content">
                    <?php get_template_part( 'news', 'none' ); ?>
                </div>
            </div>
        </article>

	</main>
<?php get_footer(); ?>
