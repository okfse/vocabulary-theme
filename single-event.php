<?php get_header('', array( 'body-classes' => 'event-post') ); ?>

<main>

<?php while ( have_posts() ) : the_post(); ?>

<?php
$event_date = vocab_format_date( get_field('event_date') );
?>

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

<aside class="sidebar">
    <article class="event-meta">
        <h2><?php esc_html_e( 'Date & Time', 'vocabulary' ); ?></h2>
        <p class="date"><?php echo esc_html( $event_date ); ?></p>
        <p class="time"><?php the_field('event_time_start'); ?> - <?php the_field('event_time_end'); ?> <?php the_field('event_timezone'); ?></p>

        <h2><?php esc_html_e( 'Location', 'vocabulary' ); ?></h2>

        <p class="location"><?php the_field('event_location'); ?></p>

        <?php if (get_field('event_registration_url')) : ?>
        <a href="<?php the_field('event_registration_url'); ?>"><?php esc_html_e( 'Register', 'vocabulary' ); ?></a>
        <?php endif; ?>
    </article>
</aside>

<div class="content">
    <h2><?php esc_html_e( 'Event Details', 'vocabulary' ); ?></h2>
    <?php the_content(); ?>

    <?php if(get_field('event_files_download_url')) : ?>
    <a href="<?php the_field('event_files_download_url'); ?>" class="files"><?php esc_html_e( 'Download Event Files', 'vocabulary' ); ?></a>
    <?php endif; ?>


    <?php
        $speaker_listing = get_field('event_speakers');
        if( !empty($speaker_listing) ) :
    ?>

    <article class="speakers">
        <h2><?php esc_html_e( 'Meet the speakers', 'vocabulary' ); ?></h2>
        <ul>
            <?php foreach($speaker_listing as $speaker_person) : ?>
            <?php
                $permalink = get_permalink( $speaker_person->ID );
                $title = get_the_title( $speaker_person->ID );
                $position_title = get_field( 'position_title', $speaker_person->ID );
                $excerpt = get_the_excerpt( $speaker_person->ID );
            ?>
            <li>
                <article class="speaker">
                    <h3><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h3>
                    <h4><?php echo $position_title; ?></h4>
                    <p><?php echo wp_trim_words($excerpt, 50); ?></p>

                    <?php if (get_the_post_thumbnail_caption( $speaker_person->ID )) : ?>
                    <p class="caption">attribution: <?php echo get_the_post_thumbnail_caption( $speaker_person->ID ); ?></p>
                    <?php endif; ?>


                    <figure>
                        <img src="<?php echo get_the_post_thumbnail_url( $speaker_person->ID, 'full' ); ?>" alt="<?php echo get_post_meta ( get_post_thumbnail_id($staff_person->ID), '_wp_attachment_image_alt', true ); ?>" />
                    </figure>

                </article>
            </li>
            <?php endforeach; ?>
        </ul>
    </article>
    <?php endif; ?>
</div>

<footer>

    <a href="/events" class="more"><?php esc_html_e( 'View All Events', 'vocabulary' ); ?></a>

</footer>

<?php get_template_part( 'content-partials/bottom', 'newsletter_promo', '' ); ?>

<?php endwhile; // end of the loop. ?>

</main>

<?php get_footer(); ?>
