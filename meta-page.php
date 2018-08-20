<?php
/**
 * Template for displaying the meta sidebar in pages.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>

<?php $menu = ftek_page_menu($post); ?>
<?php if($menu) : ?>

<aside class="side-meta">
    <?php
    $parent_ID = $post->post_parent;
    $is_parent = true;
    if ( !$parent_ID ) {
        $parent_ID = $post->ID;
    } 
    ?>
    <h1><a href="<?= get_permalink($parent_ID) ?>"><?= get_the_title($parent_ID) ?></a></h1>
    <section class="entry-menu">
        <h2><?= __('Related pages', 'ftek') ?></h2>
        <?= $menu ?>
    </section>
</aside>

<?php endif; ?>