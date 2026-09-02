<?php /* Template Name: Startsida */ ?>

<?php
/*
 * Chapter home page (ROADMAP.md Phase 3).
 *
 * Deliberately chapter-sized -- an introduction, what the chapter offers, and
 * the latest news -- rather than Creative Commons HQ's twenty-year narrative in
 * the retired page_home.php.
 *
 * Uses field groups that already apply to pages, so it needs no ACF
 * configuration of its own:
 *
 *   lead_in_copy       Page Opening
 *   highlights,        Overview Page Settings, whose location rules were
 *   highlights_lead_in extended to cover this template too; the loop below
 *                      follows page_overview.php
 */
?>

<?php get_header('', array( 'body-classes' => 'default-page start-page') ); ?>

<main>

<?php while ( have_posts() ) : the_post(); ?>

<header>

<h1><?php the_title(); ?></h1>

<?php if ( get_field('lead_in_copy') ) : ?>
<p><?php the_field('lead_in_copy'); ?></p>
<?php endif; ?>

</header>

<div class="content">

    <?php the_content(); ?>

    <?php the_field('highlights_lead_in'); ?>

    <?php
    // ACF returns post objects here, but the ACF-less fallback in
    // inc/acf-compat.php returns raw meta, and a hand-edited value can be
    // anything at all -- so resolve each entry to a post and drop what does not
    // resolve, rather than trusting the shape.
    $highlights = array();

    foreach ( (array) get_field('highlights') as $highlight ) {
        $highlight = get_post( is_object( $highlight ) ? $highlight : (int) $highlight );

        if ( $highlight ) {
            $highlights[] = $highlight;
        }
    }
    ?>

    <?php if ( $highlights ) : ?>
    <article class="links highlight">
        <ul>
            <?php foreach ( $highlights as $highlight ) : ?>
            <li>
                <article class="link">
                    <h3><a href="<?php echo esc_url( get_permalink( $highlight ) ); ?>"><?php echo esc_html( get_the_title( $highlight ) ); ?></a></h3>
                    <p><?php echo esc_html( wp_trim_words( get_the_excerpt( $highlight ), 12 ) ); ?></p>
                </article>
            </li>
            <?php endforeach; ?>
        </ul>
    </article>
    <?php endif; ?>

</div>

<?php endwhile; // end of the loop. ?>

<?php
$news = new WP_Query( array(
    'post_type'           => 'post',
    'posts_per_page'      => 4,
    'ignore_sticky_posts' => true,
) );

// Link on to whichever page is set as the posts page, rather than a hardcoded
// path; falls back to the front page when Settings > Reading has none.
$posts_page = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/' );
?>

<?php if ( $news->have_posts() ) : ?>
<article class="posts">
<h2><?php esc_html_e( 'Latest news', 'vocabulary' ); ?></h2>

<ul>
<?php while ( $news->have_posts() ) : $news->the_post(); ?>
    <li>
    <article class="post">
        <header>
            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <span class="pub-date"><?php echo esc_html( vocab_the_date() ); ?></span>
            <span class="categories"><?php the_category(', '); ?></span>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
        <figure>
            <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>" alt="<?php echo esc_attr( get_post_meta( get_post_thumbnail_id( get_the_ID() ), '_wp_attachment_image_alt', true ) ); ?>" />
        </figure>
        <?php endif; ?>

        <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
    </article>
    </li>
<?php endwhile; ?>
</ul>

<footer>
    <a class="more" href="<?php echo esc_url( $posts_page ); ?>"><?php esc_html_e( 'more posts', 'vocabulary' ); ?></a>
</footer>

</article>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

</main>

<?php get_footer(); ?>
