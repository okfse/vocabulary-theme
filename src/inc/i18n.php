<?php
/**
 * Internationalisation.
 *
 * Translations live in the theme's own languages/ directory and are compiled to
 * .mo files at release time, so they ship inside the theme zip. Which catalogue
 * loads is decided by the site language in Settings > General.
 */

add_action(
    'after_setup_theme',
    function () {
        load_theme_textdomain( 'vocabulary', get_template_directory() . '/languages' );
    }
);

/**
 * Format a post's date using the site's locale and date format.
 *
 * Several templates printed dates with raw date()/the_time() calls and
 * hardcoded English formats, which ignores both the site's timezone and its
 * locale. Use this instead so Swedish month and weekday names render.
 *
 * @param int|WP_Post|null $post   Post to read the date from. Defaults to the current post.
 * @param string           $format Optional date format. Defaults to the site setting.
 * @return string Localised date.
 */
function vocab_the_date( $post = null, $format = '' ) {
    $post = get_post( $post );

    if ( ! $post ) {
        return '';
    }

    if ( '' === $format ) {
        $format = get_option( 'date_format' );
    }

    return (string) get_the_date( $format, $post );
}

/**
 * Format an arbitrary date string (for example an ACF `event_date` field) using
 * the site's locale.
 *
 * @param string $value  Date string parseable by strtotime(), or an Ymd value.
 * @param string $format Optional date format. Defaults to the site setting.
 * @return string Localised date, or '' when the value cannot be parsed.
 */
function vocab_format_date( $value, $format = '' ) {
    if ( empty( $value ) ) {
        return '';
    }

    $timestamp = strtotime( (string) $value );

    if ( false === $timestamp ) {
        return '';
    }

    if ( '' === $format ) {
        $format = get_option( 'date_format' );
    }

    return date_i18n( $format, $timestamp );
}
