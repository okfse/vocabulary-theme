<?php
/**
 * Shortcodes that render licence information from inc/licenses.php.
 *
 * The educational pages (symboler och förkortningar, så märker du ditt verk,
 * så använder du CC-material, vanliga frågor) need to show the licences and
 * their elements. Writing that into page content as prose would guarantee it
 * drifts from the licence table the moment anything changes, so the pages embed
 * these shortcodes instead and the table stays the single source of truth.
 */

/**
 * [cc-license-elements]
 *
 * The four licence elements with their Swedish names and what each requires.
 */
function vocab_shortcode_license_elements( $atts = array() ) {
    $out = '<dl class="conditions-definitions license-elements">';

    foreach ( vocab_license_elements() as $code => $element ) {
        $out .= '<div>';
        $out .= sprintf(
            '<dt class="icon-attach %s">%s</dt>',
            esc_attr( $element['icon'] ),
            esc_html( $code )
        );
        $out .= '<dd><strong>' . esc_html( $element['name'] ) . '</strong> &mdash; ' . esc_html( $element['description'] );

        if ( $element['note'] ) {
            $out .= ' <em>' . esc_html( $element['note'] ) . '</em>';
        }

        $out .= '</dd></div>';
    }

    return $out . '</dl>';
}
add_shortcode( 'cc-license-elements', 'vocab_shortcode_license_elements' );

/**
 * [cc-licenses] or [cc-licenses type="public-domain"]
 *
 * The six licences, the two public-domain tools, or both.
 *
 * @param array $atts {
 *     @type string $type 'licenses' (default), 'public-domain' or 'all'.
 * }
 */
function vocab_shortcode_licenses( $atts = array() ) {
    $atts = shortcode_atts( array( 'type' => 'licenses' ), (array) $atts, 'cc-licenses' );

    switch ( $atts['type'] ) {
        case 'public-domain':
            $slugs = array( 'cc0', 'pdm' );
            break;
        case 'all':
            $slugs = array_merge( vocab_license_slugs(), array( 'cc0', 'pdm' ) );
            break;
        default:
            $slugs = vocab_license_slugs();
    }

    ob_start();
    echo '<article class="licenses"><ul>';

    foreach ( $slugs as $slug ) {
        get_template_part( 'content-partials/license', 'card', array( 'slug' => $slug ) );
    }

    echo '</ul></article>';

    return ob_get_clean();
}
add_shortcode( 'cc-licenses', 'vocab_shortcode_licenses' );

/**
 * [cc-license slug="cc-by"]
 *
 * One licence card.
 *
 * @param array $atts {
 *     @type string $slug Licence slug, see vocab_licenses().
 * }
 */
function vocab_shortcode_license( $atts = array() ) {
    $atts = shortcode_atts( array( 'slug' => '' ), (array) $atts, 'cc-license' );

    if ( ! vocab_license( $atts['slug'] ) ) {
        return '';
    }

    ob_start();
    echo '<article class="licenses"><ul>';
    get_template_part( 'content-partials/license', 'card', array( 'slug' => $atts['slug'] ) );
    echo '</ul></article>';

    return ob_get_clean();
}
add_shortcode( 'cc-license', 'vocab_shortcode_license' );

/**
 * [cc-license-chooser]
 *
 * Link to Creative Commons' Swedish licence chooser.
 */
function vocab_shortcode_license_chooser( $atts = array() ) {
    return sprintf(
        '<p><a class="more" href="%s">%s</a></p>',
        esc_url( vocab_license_chooser_url() ),
        esc_html__( 'Open the license chooser', 'vocabulary' )
    );
}
add_shortcode( 'cc-license-chooser', 'vocab_shortcode_license_chooser' );

/**
 * [cc-license-attribution]
 *
 * The CC BY 4.0 credit that pages reusing Creative Commons' wording need.
 */
function vocab_shortcode_license_attribution( $atts = array() ) {
    return '<p class="attribution">' . vocab_license_attribution() . '</p>';
}
add_shortcode( 'cc-license-attribution', 'vocab_shortcode_license_attribution' );

/**
 * [cc-no-legal-advice]
 *
 * The legal-advice notice, for pages that discuss the licences directly. The
 * footer carries a site-wide disclaimer already; on these pages it belongs in
 * the body as well, next to the material it qualifies.
 */
function vocab_shortcode_no_legal_advice( $atts = array() ) {
    return sprintf(
        '<aside class="attention low-importance no-legal-advice"><div><p>%s</p></div></aside>',
        esc_html__( 'This page explains the Creative Commons licenses in general terms. It is not legal advice, and it does not replace the license text itself. If you need advice about a specific case, consult a lawyer.', 'vocabulary' )
    );
}
add_shortcode( 'cc-no-legal-advice', 'vocab_shortcode_no_legal_advice' );
