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

    <section class="course-contact">
        <h2>Saknas något?</h2>
        Kontakta <a href="mailto:snf@ftek.se" target="_blank" rel="noopener">SNF</a></li>
    </section>

    <section class="course-contact">
        <h2>Är du examinator?</h2>
        Vill du inte att dina tentor ligger här? Maila då <a href="mailto:snf@ftek.se" target="_blank" rel="noopener">SNF</a> så tar vi ner dem.
    </section>
</aside>
