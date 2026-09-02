<?php
/**
 * Link out to Creative Commons' licence chooser.
 *
 * The theme carries a copy of the chooser under chooser/, but it is dormant:
 * the canonical tool is maintained by Creative Commons and is available in
 * Swedish, so the chapter links it rather than running a fork that would drift
 * (ROADMAP.md section 7.1).
 */
?>

<section class="choose-license">
    <h2><?php esc_html_e( 'Choose a license', 'vocabulary' ); ?></h2>

    <p><?php esc_html_e( 'Creative Commons\' own license chooser walks you through the questions and gives you the license text and badge to publish with your work. It is available in Swedish.', 'vocabulary' ); ?></p>

    <p>
        <a class="more" href="<?php echo esc_url( vocab_license_chooser_url() ); ?>">
            <?php esc_html_e( 'Open the license chooser', 'vocabulary' ); ?>
        </a>
    </p>
</section>
