<?php
/**
 * Creative Commons licence data.
 *
 * One source of truth for the six 4.0 licences and the two public-domain
 * tools: abbreviations, Swedish names, deed and legal-code URLs in Swedish,
 * badge artwork, and the licence elements each one carries.
 *
 * Used by the licences page template, the media credit fields, and anything
 * else that needs to name or link a licence. Previously page_licenses.php
 * hardcoded all of this six times over, with English condition text and deed
 * URLs that did not point at the Swedish translations.
 *
 * Canonical URLs stay on creativecommons.org: the chapter explains and links
 * the legal tools, it does not re-host them (ROADMAP.md section 7.1).
 *
 * License and element names are the official English names; the Swedish forms
 * (Erkännande, DelaLika, IckeKommersiell, IngaBearbetningar) come from the
 * translation catalogue, so the msgids stay language-neutral source strings.
 *
 * Wording adapted from "The CC Licenses" and "Share your work" on
 * creativecommons.org, CC BY 4.0, translated into Swedish. Pages that show it
 * should carry the attribution line from vocab_license_attribution().
 */

/**
 * The licence elements (BY, NC, ND, SA).
 *
 * `icon` is a Vocabulary icon class. Note NonCommercial uses `cc-nc` even
 * though the sprite also carries a `cc-nc-eu` symbol: library-vars.css defines
 * no `--cc-nc-eu` custom property, so `cc-nc-eu` would not resolve as an icon
 * class. The euro variant is used for the badge artwork instead, where it
 * exists as a real file -- see vocab_license_badge_url().
 *
 * @return array
 */
function vocab_license_elements() {
    return array(
        'BY' => array(
            'name'        => __( 'Attribution', 'vocabulary' ),
            'icon'        => 'cc-by',
            'description' => __( 'Credit must be given to you, the creator.', 'vocabulary' ),
            'note'        => '',
        ),
        'SA' => array(
            'name'        => __( 'ShareAlike', 'vocabulary' ),
            'icon'        => 'cc-sa',
            'description' => __( 'Adaptations must be shared under the same terms.', 'vocabulary' ),
            'note'        => '',
        ),
        'NC' => array(
            'name'        => __( 'NonCommercial', 'vocabulary' ),
            'icon'        => 'cc-nc',
            'description' => __( 'Only noncommercial use of your work is permitted.', 'vocabulary' ),
            'note'        => __( 'Noncommercial means not primarily intended for or directed towards commercial advantage or monetary compensation.', 'vocabulary' ),
        ),
        'ND' => array(
            'name'        => __( 'NoDerivatives', 'vocabulary' ),
            'icon'        => 'cc-nd',
            'description' => __( 'No derivatives or adaptations of your work are permitted.', 'vocabulary' ),
            'note'        => '',
        ),
    );
}

/**
 * The licences and public-domain tools, most permissive first.
 *
 * Order follows Creative Commons' own presentation on
 * creativecommons.org/share-your-work/cclicenses/.
 *
 * Keys are the slugs already stored by the `license_N_type` field on the
 * licences page and by the media credit fields, so they must not be renamed.
 *
 * @return array
 */
function vocab_licenses() {
    $base   = 'https://creativecommons.org/licenses/';
    $public = 'https://creativecommons.org/publicdomain/';

    $licenses = array(
        'cc-by'       => array(
            'abbr'      => 'CC BY 4.0',
            'name'      => __( 'Attribution 4.0 International', 'vocabulary' ),
            'elements'  => array( 'BY' ),
            'deed'      => $base . 'by/4.0/deed.sv',
            'legalcode' => $base . 'by/4.0/legalcode.sv',
            'port_25'   => $base . 'by/2.5/se/',
            'badge'     => 'by',
            'summary'   => __( 'Lets others distribute, remix, adapt and build upon your work, including commercially, as long as you are credited. The most permissive of the CC licenses.', 'vocabulary' ),
        ),
        'cc-by-sa'    => array(
            'abbr'      => 'CC BY-SA 4.0',
            'name'      => __( 'Attribution-ShareAlike 4.0 International', 'vocabulary' ),
            'elements'  => array( 'BY', 'SA' ),
            'deed'      => $base . 'by-sa/4.0/deed.sv',
            'legalcode' => $base . 'by-sa/4.0/legalcode.sv',
            'port_25'   => $base . 'by-sa/2.5/se/',
            'badge'     => 'by_sa',
            'summary'   => __( 'Lets others remix, adapt and build upon your work, including commercially, as long as you are credited and their adaptations are licensed on the same terms.', 'vocabulary' ),
        ),
        'cc-by-nc'    => array(
            'abbr'      => 'CC BY-NC 4.0',
            'name'      => __( 'Attribution-NonCommercial 4.0 International', 'vocabulary' ),
            'elements'  => array( 'BY', 'NC' ),
            'deed'      => $base . 'by-nc/4.0/deed.sv',
            'legalcode' => $base . 'by-nc/4.0/legalcode.sv',
            'port_25'   => $base . 'by-nc/2.5/se/',
            'badge'     => 'by_nc',
            'summary'   => __( 'Lets others remix, adapt and build upon your work for noncommercial purposes, as long as you are credited.', 'vocabulary' ),
        ),
        'cc-by-nc-sa' => array(
            'abbr'      => 'CC BY-NC-SA 4.0',
            'name'      => __( 'Attribution-NonCommercial-ShareAlike 4.0 International', 'vocabulary' ),
            'elements'  => array( 'BY', 'NC', 'SA' ),
            'deed'      => $base . 'by-nc-sa/4.0/deed.sv',
            'legalcode' => $base . 'by-nc-sa/4.0/legalcode.sv',
            'port_25'   => $base . 'by-nc-sa/2.5/se/',
            'badge'     => 'by_nc_sa',
            'summary'   => __( 'Lets others remix, adapt and build upon your work for noncommercial purposes, as long as you are credited and their adaptations are licensed on the same terms.', 'vocabulary' ),
        ),
        'cc-by-nd'    => array(
            'abbr'      => 'CC BY-ND 4.0',
            'name'      => __( 'Attribution-NoDerivatives 4.0 International', 'vocabulary' ),
            'elements'  => array( 'BY', 'ND' ),
            'deed'      => $base . 'by-nd/4.0/deed.sv',
            'legalcode' => $base . 'by-nd/4.0/legalcode.sv',
            'port_25'   => $base . 'by-nd/2.5/se/',
            'badge'     => 'by_nd',
            'summary'   => __( 'Lets others reuse your work for any purpose, including commercially, but only in unadapted form and with credit to you.', 'vocabulary' ),
        ),
        'cc-by-nc-nd' => array(
            'abbr'      => 'CC BY-NC-ND 4.0',
            'name'      => __( 'Attribution-NonCommercial-NoDerivatives 4.0 International', 'vocabulary' ),
            'elements'  => array( 'BY', 'NC', 'ND' ),
            'deed'      => $base . 'by-nc-nd/4.0/deed.sv',
            'legalcode' => $base . 'by-nc-nd/4.0/legalcode.sv',
            'port_25'   => $base . 'by-nc-nd/2.5/se/',
            'badge'     => 'by_nc_nd',
            'summary'   => __( 'Lets others download and share your work for noncommercial purposes, in unadapted form and with credit to you. The most restrictive of the CC licenses.', 'vocabulary' ),
        ),
        'cc0'         => array(
            'abbr'      => 'CC0 1.0',
            'name'      => __( 'CC0 1.0 Universal', 'vocabulary' ),
            'elements'  => array(),
            'deed'      => $public . 'zero/1.0/deed.sv',
            'legalcode' => $public . 'zero/1.0/legalcode.sv',
            'port_25'   => '',
            'badge'     => 'cc_zero',
            'summary'   => __( 'Waives copyright and related rights as far as the law allows, dedicating the work to the public domain. Not a license but a dedication.', 'vocabulary' ),
        ),
        'pdm'         => array(
            'abbr'      => 'PDM 1.0',
            'name'      => __( 'Public Domain Mark 1.0', 'vocabulary' ),
            'elements'  => array(),
            'deed'      => $public . 'mark/1.0/deed.sv',
            'legalcode' => '',
            'port_25'   => '',
            'badge'     => 'publicdomain',
            'summary'   => __( 'Marks a work that is already free of known copyright restrictions. Used to label existing public-domain works, not to license your own.', 'vocabulary' ),
        ),
    );

    /**
     * Filter the licence table.
     *
     * @param array $licenses Slug => licence record.
     */
    return apply_filters( 'vocab_licenses', $licenses );
}

/**
 * The six licences, in the order Creative Commons presents them.
 *
 * @return array Slugs.
 */
function vocab_license_slugs() {
    return array( 'cc-by', 'cc-by-sa', 'cc-by-nc', 'cc-by-nc-sa', 'cc-by-nd', 'cc-by-nc-nd' );
}

/**
 * Look up one licence.
 *
 * @param string $slug Licence slug.
 * @return array|null Licence record, or null when the slug is unknown.
 */
function vocab_license( $slug ) {
    $licenses = vocab_licenses();

    return isset( $licenses[ $slug ] ) ? $licenses[ $slug ] : null;
}

/**
 * URL of a licence badge image.
 *
 * NonCommercial badges exist in a euro variant, which is the right artwork for
 * a Swedish audience (ROADMAP.md section 7.2). Only the `big` set ships one, so
 * the euro file is used when it is actually present and the standard badge is
 * the fallback -- if upstream adds small euro badges this picks them up with no
 * change here.
 *
 * @param string $slug Licence slug.
 * @param string $size 'big' or 'small'.
 * @return string Badge URL, or '' when the licence is unknown.
 */
function vocab_license_badge_url( $slug, $size = 'big' ) {
    $license = vocab_license( $slug );

    if ( ! $license ) {
        return '';
    }

    $size = in_array( $size, array( 'big', 'small' ), true ) ? $size : 'big';
    $dir  = '/vocabulary/svg/cc/license_badges/' . $size . '/';
    $file = $license['badge'] . '.svg';

    if ( in_array( 'NC', $license['elements'], true ) ) {
        $euro = $license['badge'] . '.eu.svg';

        if ( file_exists( get_template_directory() . $dir . $euro ) ) {
            $file = $euro;
        }
    }

    return get_template_directory_uri() . $dir . $file;
}

/**
 * Attribution line for pages that reuse Creative Commons' own wording.
 *
 * Required by the licences of the source material and by ROADMAP.md section
 * 7.2, which asks that adapted HQ prose say so and mark the changes.
 *
 * @return string HTML.
 */
function vocab_license_attribution() {
    return sprintf(
        /* translators: 1: link to the source page, 2: link to the CC BY 4.0 deed. */
        esc_html__( 'License descriptions adapted from %1$s by Creative Commons, %2$s. Changes: translated into Swedish and shortened.', 'vocabulary' ),
        sprintf(
            '<a href="https://creativecommons.org/share-your-work/cclicenses/">%s</a>',
            esc_html__( 'The CC Licenses', 'vocabulary' )
        ),
        sprintf(
            '<a href="%s">CC BY 4.0</a>',
            esc_url( 'https://creativecommons.org/licenses/by/4.0/deed.sv' )
        )
    );
}

/**
 * URL of Creative Commons' licence chooser, in Swedish.
 *
 * The theme ships a copy of the chooser under chooser/, but it is dormant: the
 * chapter links the canonical tool rather than running its own (ROADMAP.md
 * section 10).
 *
 * @return string
 */
function vocab_license_chooser_url() {
    return 'https://creativecommons.org/choose/?lang=sv';
}
