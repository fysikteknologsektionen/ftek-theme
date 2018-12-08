<?php
/**
 * Default template for displaying the sidebar for related posts.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>

<aside class="related-posts">
    <h1><?= __('Related news', 'ftek') ?></h1>
    
    <?php // Fetch related posts by searching title of post
    $args = array(
        'post_type'              => array( 'post' ),
        's'                      => get_the_title(),
        'posts_per_page'         => '5',
    );
    $related_query = new WP_Query( $args ); 

    // Show category news if no posts are found
    if ( !$related_query->have_posts() ) {
        $categories = get_the_category();
        $slug = $categories[0]->slug;
        $args = array(
            'post_type'              => array( 'post' ),
            'category_name'          => $slug,
            'posts_per_page'         => '5',
        );
        $related_query = new WP_Query( $args ); 
    }
    
    $current_ID = get_the_ID();
    $shown_posts = 0;

    if ( $related_query->have_posts() ) {
        while ( $related_query->have_posts() ) {
            $related_query->the_post();
            if ( get_the_ID() !== $current_ID ) {
                $shown_posts++; ?>
            
                <a href="<?=get_permalink()?>">
                <?php get_template_part('article', 'excerpt'); ?>
                </a>
            <?php }
        }
    }
    if ( $shown_posts < 1) {
        echo '<p>'.__('No related news could be found.', 'ftek').'</p>';
    }
    wp_reset_postdata();
    ?>
</aside>