<?php
/**
 * Per-site details rendered in the footer.
 *
 * Upstream hardcodes Creative Commons' own postal address, email, newsletter
 * link and site-licence notice into footer.php. Collecting them here means a
 * chapter site edits one file instead of the templates, which keeps merges from
 * upstream mechanical.
 *
 * Every value can also be overridden from a child theme or plugin via the
 * `vocab_site_config` filter. Empty values are simply not rendered, so an
 * unconfigured site shows no placeholder text.
 */

/**
 * Site-specific footer details.
 *
 * @return array
 */
function vocab_site_config() {
    $config = array(
        // Masthead and footer identity.
        //
        // 'product' uses Vocabulary's product lockup: the compact CC lettermark
        // followed by `identity_text` typeset in CC Accidenz Commons, lowercase.
        // That is the form the Chapter Logo Policy allows without an approved
        // chapter mark, because the CC circle stays in its original style.
        // 'logomark' uses the full unmodified Creative Commons wordmark, which
        // is what creativecommons.org itself shows.
        'identity_style'  => 'product',
        // Text of the lockup. Kept short because the lockup letterspaces
        // tightly. Empty falls back to the site title.
        'identity_text'   => 'cc sverige',

        // Required of every CC Global Network chapter site: a prominent notice
        // that the site does not give legal advice. Rendered on every page.
        // Empty removes it -- do not empty it on a live chapter site.
        'legal_disclaimer' => 'Denna webbplats ger inte juridisk rådgivning.',

        // Postal address, one array entry per rendered line.
        'address'         => array(
            'Creative Commons Sverige',
            'c/o Open Knowledge Sweden',
        ),
        // Public contact address.
        'email'           => 'info@creativecommons.se',
        // Newsletter sign-up URL, or '' to hide the subscribe block.
        'newsletter_url'  => '',
        // Path or URL to the page describing the site's content licence.
        'license_url'     => '/policys/',
        // Anchor on that page, if any.
        'license_anchor'  => '#license',
        // URL of the licence the site's content is under.
        'license_deed'    => 'https://creativecommons.org/licenses/by/4.0/deed.sv',
        // Vocabulary icon ids for the licence badge in the footer.
        'license_icons'   => array( 'cc-logo', 'cc-by' ),
        // Fallback header photo used when a page sets no header graphic.
        // Upstream hotlinked an image from creativecommons.org here; leave this
        // empty to render only Vocabulary's decorative shapes.
        'default_header_image'   => '',
        'default_header_alt'     => '',
        // Caption HTML shown under the fallback header photo.
        'default_header_caption' => '',
    );

    /**
     * Filter the site-specific footer details.
     *
     * @param array $config Configuration values.
     */
    return apply_filters( 'vocab_site_config', $config );
}

/**
 * Read one site configuration value.
 *
 * @param string $key     Configuration key.
 * @param mixed  $default Value to return when the key is unset or empty.
 * @return mixed
 */
function vocab_site( $key, $default = '' ) {
    $config = vocab_site_config();

    if ( ! isset( $config[ $key ] ) || '' === $config[ $key ] || array() === $config[ $key ] ) {
        return $default;
    }

    return $config[ $key ];
}

/**
 * Render the site identity link (masthead or footer logo).
 *
 * Vocabulary draws the mark from CSS: `.identity-logo` masks the full CC
 * wordmark, and `.identity-logo.product` masks the compact lettermark and
 * typesets the link text beside it. The link text is therefore both the visible
 * lockup text and the accessible name, so it is not overridden with a differing
 * aria-label (WCAG 2.5.3, Label in Name).
 *
 * @param string $extra_class Additional class names for the anchor.
 */
function vocab_identity_link( $extra_class = '' ) {
    $classes = array( 'identity-logo' );

    if ( 'product' === vocab_site( 'identity_style', 'logomark' ) ) {
        $classes[] = 'product';
    }

    if ( $extra_class ) {
        $classes[] = $extra_class;
    }

    printf(
        '<a class="%s" href="%s">%s</a>',
        esc_attr( implode( ' ', $classes ) ),
        esc_url( home_url( '/' ) ),
        esc_html( vocab_site( 'identity_text', get_bloginfo( 'name' ) ) )
    );
}
