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

<span id="main-content-marker"></span>
