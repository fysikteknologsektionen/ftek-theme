<?php
/**
 * Template for displaying the meta sidebar in course pages.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>

<aside class="side-meta course-meta">
    <?php $links = course_pretty_links();
            $representatives = course_pretty_representatives(); ?>

    <?php if ($links) : ?>
    <section class="course-links">
        <h2><?= __('Links', 'ftek')?></h2>
        <?= $links ?>
    </section>
    <?php endif; ?>

    <?php if ($representatives) : ?>
    <section class="course-representatives">
        <h2><?= __('Course representatives', 'ftek') ?></h2>
        <?= $representatives ?>
    </section>
    <?php endif; ?>
</aside>