<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/vocabulary/favicon/favicon.ico" sizes="any" />
<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/vocabulary/favicon/favicon.svg" type="image/svg+xml" />
<link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() ); ?>/vocabulary/favicon/manifest.webmanifest" />
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() ); ?>/vocabulary/favicon/apple-touch-icon.png" />

<link rel="stylesheet" media="all" href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.css" />

<?php wp_head(); ?>
</head>

<body class="<?php echo esc_attr( isset( $args['body-classes'] ) ? $args['body-classes'] : '' ); ?>">
<a class="skip-to-content" href="#main-content-marker"><?php esc_html_e( 'Skip to content', 'vocabulary' ); ?></a>

<header>
    <div class="masthead">
        <?php // The mark itself comes from CSS; see vocab_identity_link() and the
              // identity_style / identity_text keys in inc/site-config.php. ?>
        <h1><?php vocab_identity_link(); ?></h1>
        <button class="expand-menu"><?php esc_html_e( 'Menu', 'vocabulary' ); ?></button>

        <?php vocab_nav_menu( 'primary-menu', 'nav', 'primary-menu', __( 'Primary navigation', 'vocabulary' ) ); ?>
    </div>

</header>

<?php
$noticeQuery = new WP_Query(array(
    'post_type' => 'notice',
    'posts_per_page' => 1,
    'meta_key' => 'type',
    'meta_value' => 'top-of-site'
));
?>

<?php if ( $noticeQuery->have_posts() ) : while ( $noticeQuery->have_posts() ) : $noticeQuery->the_post(); ?>
<?php
$importance_level = '';
if ( get_field('importance_level') && get_field('importance_level') != 'default' ) {
    $importance_level = get_field('importance_level');
}
$notice_image = get_field('graphic');
?>

<article class="attention <?php echo esc_attr( $importance_level ); ?>">
<div>

<?php if (get_field('message')) : ?>
<h2><?php the_field('message'); ?></h2>
<?php endif; ?>


<?php the_field('message_rich_text'); ?>

<?php if (get_field('url')) : ?>
<a href="<?php the_field('url'); ?>"><?php the_field('link_text'); ?></a>
<?php endif; ?>
</div>

<?php if ( ! empty( $notice_image['url'] ) ) : ?>
<figure>
    <img src="<?php echo esc_url( $notice_image['url'] ); ?>" alt="<?php echo esc_attr( isset( $notice_image['alt'] ) ? $notice_image['alt'] : '' ); ?>" />
</figure>
<?php endif; ?>
</article>

<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<span id="main-content-marker"></span>

<?php if (get_field('css_dev_hotfixes' )) : ?>
<style>
    <?php the_field('css_dev_hotfixes' ); ?>
</style>
<?php endif; ?>
