<?php
/**
 * Template Name: Föreningssida
 *
 * @package ftek
 * @since ftek 2.0
 */
?>

<?php get_header(); ?>


<main role="main">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'article', 'group' ); ?>
        <?php endwhile; ?>
        <?php else : ?>
            <?php get_template_part( 'article', 'none' ); ?>
        <?php endif; ?>

</main>

<?php get_footer(); ?>