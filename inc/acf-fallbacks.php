<?php
/**
 * Inert stand-ins for the ACF template functions.
 *
 * Loaded by inc/acf-compat.php, and only on a front-end request where ACF is
 * genuinely absent. Never include this file directly: declaring these functions
 * unconditionally breaks activating ACF (WordPress includes a plugin's files
 * after the theme's functions.php during activation, so the plugin's own
 * get_field() would collide with this one and fatal).
 */

/**
 * @param string    $selector     Field name.
 * @param int|false $post_id      Post to read from, or false for the current post.
 * @param bool      $format_value Unused; kept for signature compatibility.
 * @return mixed Raw post meta value, or false when empty.
 */
function get_field( $selector, $post_id = false, $format_value = true ) {
    if ( false === $post_id || null === $post_id ) {
        $post_id = get_the_ID();
    }

    if ( ! is_numeric( $post_id ) ) {
        return false;
    }

    $value = get_post_meta( (int) $post_id, $selector, true );

    return '' === $value ? false : $value;
}

/**
 * @param string    $selector     Field name.
 * @param int|false $post_id      Post to read from, or false for the current post.
 * @param bool      $format_value Unused; kept for signature compatibility.
 */
function the_field( $selector, $post_id = false, $format_value = true ) {
    $value = get_field( $selector, $post_id, $format_value );

    if ( is_scalar( $value ) ) {
        echo esc_html( (string) $value );
    }
}

function get_sub_field( $selector, $format_value = true ) {
    return false;
}

function the_sub_field( $selector, $format_value = true ) {
}

function have_rows( $selector, $post_id = false ) {
    return false;
}

function the_row( $format = false ) {
    return false;
}

function get_row_layout() {
    return false;
}
