<?php
/**
 * The 2.5 Sverige ports, as an archive.
 *
 * The old chapter site led with the 2.5 Sverige suite, a jurisdiction port
 * launched in December 2005. Those licences remain in force for works already
 * published under them, but Creative Commons recommends 4.0 International for
 * new work, and there is deliberately no 4.0 Sweden port -- 4.0 is
 * jurisdiction-neutral and has official Swedish translations.
 *
 * This section keeps the ports discoverable without presenting them as the
 * default (ROADMAP.md sections 7.5 and 8).
 */
?>

<section class="license-ports">
    <h2><?php esc_html_e( 'Older Swedish ports (2.5 Sverige)', 'vocabulary' ); ?></h2>

    <p><?php esc_html_e( 'The 2.5 Sverige licenses are still valid for works already published under them. For new work, use 4.0 International: it is jurisdiction-neutral, it has official Swedish translations of both the deed and the legal code, and there is no 4.0 Sweden port.', 'vocabulary' ); ?></p>

    <ul class="ports">
        <?php foreach ( vocab_license_slugs() as $slug ) : ?>
        <?php $license = vocab_license( $slug ); ?>
        <?php if ( $license && $license['port_25'] ) : ?>
        <li>
            <a href="<?php echo esc_url( $license['port_25'] ); ?>">
                <?php
                printf(
                    /* translators: %s: license abbreviation, e.g. CC BY-SA. */
                    esc_html__( '%s 2.5 Sverige', 'vocabulary' ),
                    esc_html( str_replace( ' 4.0', '', $license['abbr'] ) )
                );
                ?>
            </a>
        </li>
        <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</section>
