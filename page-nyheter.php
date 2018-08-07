<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package ftek
 * @since ftek 2.0
 */

/* Parse queries */

$post_types = array('post'=>__('Posts', 'ftek'),'event'=>__('Events', 'eventorganiser'));
$all_post_types = array('post','event');
$post_types_active = isset($_GET['post_types']) && $_GET['post_types'] != array('post','event');
if ( $post_types_active ) {
    $types = $_GET['post_types'];
} else {
    $types = array();
}

$categories = get_categories();
function cmp($a, $b) {
    return strcmp(__($a->name), __($b->name));
}
usort($categories, "cmp");
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
            <?php if ($types == array('event') && !$category_active) {
                echo '<p class="info-bar"><span>' . 
                __('You are only viewing events. Would you like to ', 'ftek') . 
                '<a href="/kalender" title="' . 
                __('Go to calendar view', 'ftek') . '">' . 
                __('go to the calendar', 'ftek') . 
                '</a>?</span><button class="close-button" >×</button></p>';
            } ?>
            <?php if ( $category_active ) {
                echo '<p class="info-bar"><span>' . 
                __('Showing news from', 'ftek') . ' ';
                $first_item = true;
                foreach ($categories as $category) {
                    if ( in_array($category->slug, $cat) ) {
                        echo ($first_item) ? '' : ', ';
                        $first_item = false;
                        echo '<a href="/'.$category->slug.'">' . esc_html(__($category->name)) . '</a>';
                    }
                }
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
