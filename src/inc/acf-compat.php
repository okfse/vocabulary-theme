<?php
/**
 * Advanced Custom Fields compatibility.
 *
 * This theme's templates depend on ACF unconditionally: header.php reads
 * `css_dev_hotfixes` on every request, sidebar.php resolves its menu through
 * get_field(), the feed templates read `authorship`, and all custom post types,
 * taxonomies and field groups are defined only by the JSON in inc/acf-json/.
 * With ACF inactive those calls are undefined-function fatals, which surface as
 * "There has been a critical error on this website." on every URL immediately
 * after the theme is activated.
 *
 * ACF is still required for the site to be usable -- see the admin notice below
 * -- but a missing plugin now degrades the output instead of killing it.
 */

/**
 * Load stand-ins for the ACF template functions when ACF is not available.
 *
 * Hooked to template_redirect rather than declared at load time on purpose.
 * Activating a plugin includes its files *after* the theme's functions.php has
 * run, so functions declared here at load time would collide with ACF's own and
 * fatal the moment someone activates the plugin. template_redirect runs only on
 * front-end requests -- including feeds -- and always before a template is
 * loaded, which is the only place these functions are needed.
 */
function vocab_maybe_load_acf_fallbacks() {
    if ( function_exists( 'get_field' ) ) {
        return;
    }

    require_once __DIR__ . '/acf-fallbacks.php';
}
add_action( 'template_redirect', 'vocab_maybe_load_acf_fallbacks', -100 );

/**
 * Tell administrators that ACF is required.
 */
function vocab_acf_admin_notice() {
    if ( class_exists( 'ACF' ) || ! current_user_can( 'install_plugins' ) ) {
        return;
    }

    printf(
        '<div class="notice notice-error"><p><strong>%s</strong> %s</p></div>',
        esc_html__( 'CC Vocabulary Theme:', 'vocabulary' ),
        esc_html__(
            'Advanced Custom Fields (version 6.1 or later) must be installed and activated. Without it none of the theme\'s post types, taxonomies or fields are registered and the site renders incomplete content.',
            'vocabulary'
        )
    );
}
add_action( 'admin_notices', 'vocab_acf_admin_notice' );
