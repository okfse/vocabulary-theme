<?php
/**
 * One licence in the licences listing.
 *
 * Markup matches what vocabulary.css styles under `.licenses-page .license`:
 * an `article.license` with an `h3` heading, an `img.badge`, the summary, and a
 * `dl.conditions-definitions` of `div > dt + dd` pairs.
 *
 * @param array $args {
 *     @type string $slug    Licence slug, see vocab_licenses().
 *     @type string $title   Heading text. Defaults to the licence's Swedish name.
 *     @type string $summary Summary HTML. Defaults to the licence's own summary.
 * }
 */

$slug    = isset( $args['slug'] ) ? $args['slug'] : '';
$license = vocab_license( $slug );

if ( ! $license ) {
    return;
}

$title    = ! empty( $args['title'] ) ? $args['title'] : $license['name'];
$summary  = ! empty( $args['summary'] ) ? $args['summary'] : wpautop( $license['summary'] );
$elements = vocab_license_elements();
?>

<li>
    <article class="license">
        <h3><a href="<?php echo esc_url( $license['deed'] ); ?>"><?php echo esc_html( $title ); ?></a></h3>

        <img src="<?php echo esc_url( vocab_license_badge_url( $slug ) ); ?>" alt="<?php echo esc_attr( $license['abbr'] ); ?>" class="badge" />

        <?php echo wp_kses_post( $summary ); ?>

        <?php if ( $license['elements'] ) : ?>
        <dl class="conditions-definitions">
            <?php foreach ( $license['elements'] as $code ) : ?>
            <?php if ( isset( $elements[ $code ] ) ) : ?>
            <div>
                <dt class="icon-attach <?php echo esc_attr( $elements[ $code ]['icon'] ); ?>"><?php echo esc_html( $code ); ?></dt>
                <dd>
                    <?php echo esc_html( $elements[ $code ]['description'] ); ?>
                    <?php if ( $elements[ $code ]['note'] ) : ?>
                    <em><?php echo esc_html( $elements[ $code ]['note'] ); ?></em>
                    <?php endif; ?>
                </dd>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </dl>
        <?php endif; ?>

        <p class="license-links">
            <a href="<?php echo esc_url( $license['deed'] ); ?>"><?php esc_html_e( 'Read the deed', 'vocabulary' ); ?></a>
            <?php if ( $license['legalcode'] ) : ?>
            <a href="<?php echo esc_url( $license['legalcode'] ); ?>"><?php esc_html_e( 'Read the legal code', 'vocabulary' ); ?></a>
            <?php endif; ?>
        </p>
    </article>
</li>
