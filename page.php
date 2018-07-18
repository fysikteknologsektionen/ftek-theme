<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package ftek
 * @since ftek 0.1
 */


get_header(); ?>
	<main role="main" class="page">
		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
                if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>" class="entry-thumbnail">
						<?php the_post_thumbnail(); ?>
					</a>
				<?php elseif ( has_post_thumbnail($post->post_parent) ): ?>
					<a href="<?php echo get_permalink($post->post_parent); ?>"
                         class="entry-thumbnail">
						<?php echo get_the_post_thumbnail($post->post_parent); ?>
					</a>
				<?php endif; ?>
				<nav id="committee" class="horizontal">
                    <?= committee_menu($post); ?>
				</nav>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; ?>

			<?php ftek_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

	</main>
<?php get_footer(); ?>
