<?php
/**
 * The two public-domain tools.
 *
 * CC0 and the Public Domain Mark are not licences, so Creative Commons lists
 * them apart from the six. Same card markup, no condition rows.
 */
?>

<section class="public-domain-tools">
    <h2><?php esc_html_e( 'Public domain tools', 'vocabulary' ); ?></h2>

    <p><?php esc_html_e( 'CC0 and the Public Domain Mark are not licenses. CC0 is used by a creator to place their own work in the public domain; the Public Domain Mark labels a work that is already free of known copyright restrictions.', 'vocabulary' ); ?></p>

    <ul>
        <?php foreach ( array( 'cc0', 'pdm' ) as $slug ) : ?>
        <?php get_template_part( 'content-partials/license', 'card', array( 'slug' => $slug ) ); ?>
        <?php endforeach; ?>
    </ul>
</section>
