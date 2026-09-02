<?php
/**
 * Navigation support for the Vocabulary design system.
 *
 * Vocabulary's CSS and JS expect an explicit `button.expand` sibling after the
 * link of every menu item that has children (vocabulary.js only generates those
 * buttons automatically for the sidebar menu, not for the header or footer), and
 * expect presentational classes such as `donate` or `fa-bluesky` to sit on the
 * `<a>` rather than the `<li>`. Both are handled here so editors can manage the
 * menus from Appearance > Menus instead of the theme hardcoding them.
 */

/**
 * Menu locations whose markup is adjusted for Vocabulary.
 */
function vocab_nav_locations() {
    return array( 'primary-menu', 'footer-menu', 'social-menu' );
}

/**
 * Presentational classes that belong on the anchor, not the list item.
 *
 * Anything prefixed `fa-` (Font Awesome icon names used by Vocabulary's
 * `icon-replace` / `icon-attach` helpers) is relocated as well.
 */
function vocab_nav_anchor_classes() {
    return array( 'donate', 'attention', 'icon-replace', 'icon-attach' );
}

/**
 * Split a menu item's CSS classes into the ones bound for the anchor and the
 * ones that stay on the list item.
 *
 * @param array $classes Class names.
 * @return array {
 *     @type array $anchor Classes to move onto the `<a>`.
 *     @type array $item   Classes that remain on the `<li>`.
 * }
 */
function vocab_nav_split_classes( $classes ) {
    $anchor    = array();
    $item      = array();
    $allowlist = vocab_nav_anchor_classes();

    foreach ( (array) $classes as $class ) {
        if ( in_array( $class, $allowlist, true ) || 0 === strpos( $class, 'fa-' ) ) {
            $anchor[] = $class;
        } else {
            $item[] = $class;
        }
    }

    return array(
        'anchor' => $anchor,
        'item'   => $item,
    );
}

/**
 * Whether the classes of this menu item should be relocated to its anchor.
 *
 * @param object|null $args wp_nav_menu() arguments.
 */
function vocab_nav_is_vocabulary_menu( $args ) {
    return isset( $args->theme_location )
        && in_array( $args->theme_location, vocab_nav_locations(), true );
}

// Strip the presentational classes from the <li>.
add_filter(
    'nav_menu_css_class',
    function ( $classes, $menu_item, $args = null ) {
        if ( ! vocab_nav_is_vocabulary_menu( $args ) ) {
            return $classes;
        }

        $split = vocab_nav_split_classes( $classes );

        return $split['item'];
    },
    10,
    3
);

// ...and add them to the <a> instead.
add_filter(
    'nav_menu_link_attributes',
    function ( $atts, $menu_item, $args = null ) {
        if ( ! vocab_nav_is_vocabulary_menu( $args ) ) {
            return $atts;
        }

        $split = vocab_nav_split_classes( isset( $menu_item->classes ) ? $menu_item->classes : array() );

        if ( ! empty( $split['anchor'] ) ) {
            $existing      = isset( $atts['class'] ) ? explode( ' ', $atts['class'] ) : array();
            $atts['class'] = implode( ' ', array_filter( array_unique( array_merge( $existing, $split['anchor'] ) ) ) );
        }

        return $atts;
    },
    10,
    3
);

/**
 * Nav menu walker that inserts Vocabulary's submenu toggle button.
 */
class Vocabulary_Nav_Walker extends Walker_Nav_Menu {

    /**
     * Emit `button.expand` immediately before a submenu.
     *
     * start_lvl() runs directly after the parent item's anchor and before its
     * `</li>`, so the button lands as a sibling of the anchor -- the structure
     * vocabulary.js toggles via `expander.parentElement.querySelector('ul')`.
     *
     * @param string $output Menu markup, by reference.
     * @param int    $depth  Current depth.
     * @param mixed  $args   wp_nav_menu() arguments.
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent  = str_repeat( "\t", $depth );
        $output .= sprintf(
            "\n%s<button class=\"expand icon-replace fa-angle-down\">%s</button>\n",
            $indent,
            esc_html__( 'Expand', 'vocabulary' )
        );

        parent::start_lvl( $output, $depth, $args );
    }
}

/**
 * Render one of the theme's menus with Vocabulary's expected markup.
 *
 * Outputs nothing at all when no menu is assigned to the location, so an
 * unconfigured site degrades to no navigation rather than to wp_page_menu()'s
 * unstyled page list.
 *
 * @param string $location       Registered menu location.
 * @param string $container      Wrapping element, or '' for none.
 * @param string $container_class Class for the wrapping element.
 * @param string $aria_label     Accessible name for the wrapping element.
 */
function vocab_nav_menu( $location, $container = '', $container_class = '', $aria_label = '' ) {
    if ( ! has_nav_menu( $location ) ) {
        return;
    }

    wp_nav_menu(
        array(
            'theme_location'  => $location,
            'container'       => $container ? $container : false,
            'container_class' => $container_class,
            'container_aria_label' => $aria_label,
            'depth'           => 0,
            'fallback_cb'     => false,
            'walker'          => new Vocabulary_Nav_Walker(),
        )
    );
}
