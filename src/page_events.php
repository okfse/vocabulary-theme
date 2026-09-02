<?php /* Template Name: Index - Events */ ?>

<?php get_header('', array( 'body-classes' => 'events-index') ); ?>

<main>

<header>

<div>
<h1><?php the_title(); ?></h1>
</div>

<figure>
    <?php $image = get_field('header_graphic'); ?>
    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

    <figcaption>
        <p><?php echo $image['caption']; ?></p>

    </figcaption>
</figure>
</header>

<article class="topic-summary about"> <!-- TODO: merge with prior article? -->
    <div class="description">
        <!-- <h2>The commons belongs to us all</h2> -->
        <?php the_field('subhead_title'); ?>
        <?php the_field('subhead_intro'); ?>
    </div>

    <figure>
        <?php $image = get_field('subhead_graphic'); ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

        <figcaption>
            <p><?php echo $image['caption']; ?></p>

        </figcaption>
    </figure>
</article>

<article class="events">
    <h2><?php esc_html_e( 'Upcoming Events', 'vocabulary' ); ?></h2>
    <ul>

    <?php

    $today = current_time('Ymd');
	$falloff = wp_date('Ymd', strtotime("+12 months"));

    $query = new WP_Query(array(
        'post_type' => 'event',
        'posts_per_page' => 12,
        'meta_key' => 'event_date',
		'meta_compare' => 'BETWEEN',
        'meta_type' => 'numeric',
		'meta_value' => array($today, $falloff),
		'orderby' => 'meta_value_num',
		'order' => 'ASC'
        //'paged' => $paged,
    ));
    ?>

    <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

    <?php

    $event_date = vocab_format_date( get_field('event_date') );

    ?>

        <li>
            <article class="event">

                <div class="description">
                <h3><?php the_title(); ?></h3>
                <h4><?php echo esc_html( $event_date ); ?></h4>
                <span class="time"><?php the_field('event_time_start'); ?> - <?php the_field('event_time_end'); ?> <?php the_field('event_timezone'); ?></span>
                <span class="location"><?php the_field('event_location'); ?></span>

                <p><?php echo wp_trim_words($excerpt, 50); ?></p>

                <a href="<?php echo the_permalink(); ?>"><?php esc_html_e( 'See Event Details', 'vocabulary' ); ?></a>
                </div>

                <figure>

                    <img src="<?php echo get_the_post_thumbnail_url( $post_id, 'large' ); ?>" alt="<?php echo get_post_meta ( get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true ); ?>" />


                    <!-- <svg class="shape1">
                        <use href="../../../../pidgin/svg/blob3.svg"></use>
                    </svg> -->

                    <figcaption>
                        <!-- <p>attribution details here</p> -->
                         <p><?php echo get_the_post_thumbnail_caption( $post_id ); ?></p>

                    </figcaption>
                </figure>

            </article>
        </li>

        <?php endwhile; ?>
        <?php endif; ?>

    </ul>

    <footer>
        <a class="more" href="/events-archive"><?php esc_html_e( 'more events', 'vocabulary' ); ?></a>
    </footer>


</article>

<article class="events">
    <h2>Recent Events</h2>
    <ul>

    <?php

    $today = current_time('Ymd');

    $query = new WP_Query(array(
        'post_type' => 'event',
        'posts_per_page' => 4,
        'meta_key' => 'event_date',
		'meta_compare' => '<',
        'meta_type' => 'numeric',
		'meta_value' => array($today),
		'orderby' => 'meta_value_num',
		'order' => 'DESC'
        //'paged' => $paged,
    ));
    ?>

    <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

    <?php

    $event_date = vocab_format_date( get_field('event_date') );

    ?>

        <li>
            <article class="event">

                <div class="description">
                <h3><?php the_title(); ?></h3>
                <h4><?php echo esc_html( $event_date ); ?></h4>
                <span class="time"><?php the_field('event_time_start'); ?> - <?php the_field('event_time_end'); ?> <?php the_field('event_timezone'); ?></span>
                <span class="location"><?php the_field('event_location'); ?></span>

                <p><?php echo wp_trim_words($excerpt, 50); ?></p>

                <a href="<?php echo the_permalink(); ?>"><?php esc_html_e( 'See Event Details', 'vocabulary' ); ?></a>
                </div>

                <figure>

                    <img src="<?php echo get_the_post_thumbnail_url( $post_id, 'large' ); ?>" alt="<?php echo get_post_meta ( get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true ); ?>" />


                    <!-- <svg class="shape1">
                        <use href="../../../../pidgin/svg/blob3.svg"></use>
                    </svg> -->

                    <figcaption>
                        <!-- <p>attribution details here</p> -->
                         <p><?php echo get_the_post_thumbnail_caption( $post_id ); ?></p>

                    </figcaption>
                </figure>

            </article>
        </li>

        <?php endwhile; ?>
        <?php endif; ?>

    </ul>

    <footer>
        <a class="more" href="/events-archive/?filtered=past"><?php esc_html_e( 'more events', 'vocabulary' ); ?></a>
    </footer>


</article>

<?php get_template_part( 'content-partials/bottom', 'newsletter_promo', '' ); ?>

</main>

<?php get_footer(); ?>
