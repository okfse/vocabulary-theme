<?php /* Template Name: Page - Licenses */ ?>

<?php get_header('', array( 'body-classes' => 'licenses-page') ); ?>

<main>

<header>

<div>
<h1><?php the_title(); ?></h1>
</div>

    <?php $image = get_field('header_graphic'); ?>
    <?php if ( ! empty( $image['url'] ) ) : ?>
<figure>
    <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( isset( $image['alt'] ) ? $image['alt'] : '' ); ?>" />

    <?php if ( ! empty( $image['caption'] ) ) : ?>
    <figcaption>
        <p><?php echo wp_kses_post( $image['caption'] ); ?></p>
    </figcaption>
    <?php endif; ?>
</figure>
    <?php endif; ?>
</header>

<article class="topic-summary about"> <!-- TODO: merge with prior article? -->
    <div class="description">
        <!-- <h2>The commons belongs to us all</h2> -->
        <?php the_field('subhead_intro'); ?>
    </div>

        <?php $image = get_field('subhead_graphic'); ?>
        <?php if ( ! empty( $image['url'] ) ) : ?>
    <figure>
        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( isset( $image['alt'] ) ? $image['alt'] : '' ); ?>" />

        <?php if ( ! empty( $image['caption'] ) ) : ?>
        <figcaption>
            <p><?php echo wp_kses_post( $image['caption'] ); ?></p>
        </figcaption>
        <?php endif; ?>
    </figure>
        <?php endif; ?>
</article>


<article class="topic-summary focus-area"> <!-- TODO: merge with prior article? -->
    <div class="description">
        <h2><?php the_field('introductory_section_title'); ?></h2>
        <?php the_field('introductory_section_content'); ?>

        <a href="<?php the_field('introductory_section_link_url'); ?>"><?php the_field('introductory_section_link_text'); ?></a>

    </div>

        <?php $image = get_field('introductory_section_graphic'); ?>
        <?php if ( ! empty( $image['url'] ) ) : ?>
    <figure>
        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( isset( $image['alt'] ) ? $image['alt'] : '' ); ?>" />

        <?php if ( ! empty( $image['caption'] ) ) : ?>
        <figcaption>
            <p><?php echo wp_kses_post( $image['caption'] ); ?></p>
        </figcaption>
        <?php endif; ?>
    </figure>
        <?php endif; ?>
</article>


<article class="topic-summary highlight orgs">
    <div class="description">
        <h2><?php the_field('orgs_section_title'); ?></h2>
        <?php the_field('orgs_section_content'); ?>
    </div>

</article>

<article class="topic-summary focus-area"> <!-- TODO: merge with prior article? -->
    <div class="description">
        <h2><?php the_field('why_section_title'); ?></h2>
        <?php the_field('why_section_content'); ?>

    </div>

        <?php $image = get_field('why_section_graphic'); ?>
        <?php if ( ! empty( $image['url'] ) ) : ?>
    <figure>
        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( isset( $image['alt'] ) ? $image['alt'] : '' ); ?>" />

        <?php if ( ! empty( $image['caption'] ) ) : ?>
        <figcaption>
            <p><?php echo wp_kses_post( $image['caption'] ); ?></p>
        </figcaption>
        <?php endif; ?>
    </figure>
        <?php endif; ?>

    <footer class="supporting">

        <div>
        <h3><?php the_field('reasonings_list_1_title'); ?></h3>
        <?php the_field('reasonings_list_1_content'); ?>
        </div>

        <div>
        <h3><?php the_field('reasonings_list_2_title'); ?></h3>
        <?php the_field('reasonings_list_2_content'); ?>
        </div>
    </footer>
</article>




<!-- <article class="topic-summary focus-area">
    <div class="description">
        <h2>More Than a Legal Tool</h2>
        <p>CC licenses do more than function legally—they express values.
The CC icons, now recognized around the world, represent openness, collaboration, and participation. For example, the CC logo is so ubiquitous it is part of the permanent design collection at The Museum of Modern Art in New York.</p>
    </div>

    <figure>



        <figcaption>
            <p>attribution details here</p>

        </figcaption>
    </figure>
</article> -->


<article class="licenses">
    <h2><?php the_field('licenses_listing_title'); ?></h2>
    <?php the_field('licenses_listing_introduction'); ?>

    <?php
    // The six licence slots each have a `license_N_type` select. Upstream never
    // read it -- the badge, deed URL and condition rows were hardcoded per slot,
    // in English, pointing at the English deeds. Now each slot renders from
    // inc/licenses.php, so an editor reordering the selects reorders the page,
    // and an empty slot falls back to Creative Commons' own ordering.
    $defaults = vocab_license_slugs();
    $cards    = array();
    $seen     = array();

    for ( $slot = 1; $slot <= 6; $slot++ ) {
        $slug = (string) get_field( 'license_' . $slot . '_type' );

        if ( ! $slug || ! vocab_license( $slug ) ) {
            $slug = isset( $defaults[ $slot - 1 ] ) ? $defaults[ $slot - 1 ] : '';
        }

        // Keep the slot alongside the slug: the title and summary overrides are
        // per slot, so they must not be read by position in the output.
        if ( $slug && ! in_array( $slug, $seen, true ) ) {
            $seen[]  = $slug;
            $cards[] = array( 'slug' => $slug, 'slot' => $slot );
        }
    }
    ?>

    <ul>
        <?php foreach ( $cards as $card ) : ?>
        <?php
        get_template_part( 'content-partials/license', 'card', array(
            'slug'    => $card['slug'],
            'title'   => (string) get_field( 'license_' . $card['slot'] . '_title' ),
            'summary' => (string) get_field( 'license_' . $card['slot'] . '_summary' ),
        ) );
        ?>
        <?php endforeach; ?>
    </ul>

    <?php the_content(); ?>

    <?php get_template_part( 'content-partials/license', 'public-domain' ); ?>

    <?php get_template_part( 'content-partials/license', 'chooser' ); ?>

    <?php if ( vocab_site( 'licenses_show_25_archive' ) ) : ?>
    <?php get_template_part( 'content-partials/license', 'ports-25' ); ?>
    <?php endif; ?>

    <p class="attribution"><?php echo wp_kses_post( vocab_license_attribution() ); ?></p>

    <footer>
        <a href="<?php the_field('more_url'); ?>" class="more"><?php the_field('more_text'); ?></a>
    </footer>
</article>




<?php if (get_field('more_links_display')) : ?>
<aside class="more-links">
    <nav>
        <h2><?php esc_html_e( 'More Links', 'vocabulary' ); ?></h2>
        <?php the_field('more_links_content'); ?>
    </nav>
</aside>
<?php endif; ?>

<?php get_template_part( 'content-partials/bottom', 'newsletter_promo', '' ); ?>

</main>

<?php get_footer(); ?>
