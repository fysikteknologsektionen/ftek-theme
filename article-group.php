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
    
    <?php get_template_part('entry', 'header'); ?>
    
    <div class="entry-main">

        <div class="entry-content">
            <?php 
                if (function_exists('wp_get_terms_meta') && $category) {     
                    /* Logo */
                    $logo = wp_get_terms_meta($category->cat_ID, 'logo' , true);
                    if ($logo) { ?>
                        <a class="group-logo-content" href="<?=$logo?>"><img src="<?=$logo?>" alt="logo" /></a>
                    <?php }
                } ?>
            <?php the_content(); ?>
        </div>

        <?php get_template_part('meta', 'group'); ?>

    </div>

	<footer>
		<?= ftek_entry_meta() ?>
	</footer>
</article>