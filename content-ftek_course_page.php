<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
                <?php the_title(); ?>
            </a>
		</h1>
        <div class="course-time">
            <?php 
            $infos = array(course_code(),
                           course_credit(),
                           course_pretty_classes(),
                           'LP ' . course_pretty_study_periods());
            echo join( " | ", array_filter($infos) ); ?>
        </div>
	</header>
	

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<?php else : ?>
    <div class="course-meta">
        <?php
        $links = course_pretty_links();
        $representatives = course_pretty_representatives();
        if ($links) :
        ?>
        <h2><?= __('Links', 'ftek')?></h2>
        <div class="course-links">
            <?= $links ?>
        </div>
        <?php
        endif;
        if ($representatives) :
        ?>
        <div class="course-representatives">
            <h2><?= __('Course representatives', 'ftek') ?></h2>
            <?= $representatives ?>
        </div>
        <?php
        endif;
        ?>
    </div>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ftek' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ftek' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
        <?php 
        $vbl = course_vbl(); 
        if ($vbl) :
        ?>
        <h2>Veckobladeriet</h2>
        <div class="course-vbl">
            <?= $vbl ?>
        </div>
        <?php endif; ?>
	</div>
        
	<?php endif; ?>
	<?php if (get_post_type( $post ) == 'post'): ?>
		<footer class="entry-meta">
			<?php ftek_entry_meta(); ?>
		</footer>
	<?php endif; ?>
</article>
