<footer>
    <?php vocab_identity_link(); ?>

    <div class="search">
        <form method="get" class="" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <label class="screen-reader-text" for="s"><?php esc_html_e( 'Search', 'vocabulary' ); ?></label>
            <input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'vocabulary' ); ?>">

            <button class="icon-attach fa-search"><?php esc_html_e( 'Submit', 'vocabulary' ); ?></button>
        </form>
    </div>

    <?php vocab_nav_menu( 'footer-menu', 'nav', 'footer-menu', __( 'Footer menu', 'vocabulary' ) ); ?>

    <div class="contact">
    <h2><?php esc_html_e( 'Contact Us', 'vocabulary' ); ?></h2>
    <?php $address = vocab_site( 'address', array() ); ?>
    <?php if ( ! empty( $address ) ) : ?>
    <p><?php echo wp_kses( implode( '<br />', array_map( 'esc_html', (array) $address ) ), array( 'br' => array() ) ); ?></p>
    <?php endif; ?>
    <?php if ( vocab_site( 'email' ) ) : ?>
    <p><a href="<?php echo esc_url( 'mailto:' . vocab_site( 'email' ) ); ?>"><?php echo esc_html( vocab_site( 'email' ) ); ?></a></p>
    <?php endif; ?>

    <?php vocab_nav_menu( 'social-menu', 'nav', 'social-menu', __( 'Social menu', 'vocabulary' ) ); ?>
    </div>

    <?php if ( vocab_site( 'newsletter_url' ) ) : ?>
    <div class="subscribe">
    <h2><?php esc_html_e( 'Subscribe to our newsletter', 'vocabulary' ); ?></h2>
    <a href="<?php echo esc_url( vocab_site( 'newsletter_url' ) ); ?>"><?php esc_html_e( 'Subscribe', 'vocabulary' ); ?></a>
    </div>
    <?php endif; ?>

    <div class="license">
        <?php if ( vocab_site( 'legal_disclaimer' ) ) : ?>
        <p class="legal-disclaimer"><?php echo esc_html( vocab_site( 'legal_disclaimer' ) ); ?></p>
        <?php endif; ?>

        <?php foreach ( (array) vocab_site( 'license_icons', array() ) as $license_icon ) : ?>
        <svg>
            <use href="<?php echo esc_url( get_template_directory_uri() . '/vocabulary/svg/cc/icons/cc-icons.svg#' . $license_icon ); ?>"></use>
        </svg>
        <?php endforeach; ?>

        <p>
        <?php
        printf(
            /* translators: 1: link to the site's licensing policy, 2: link to the licence deed. */
            esc_html__( 'Except where otherwise %1$s, content on this site is licensed under a %2$s.', 'vocabulary' ),
            sprintf(
                '<a href="%s">%s</a>',
                esc_url( vocab_site( 'license_url', '/' ) . vocab_site( 'license_anchor' ) ),
                esc_html__( 'noted', 'vocabulary' )
            ),
            sprintf(
                '<a href="%s">%s</a>',
                esc_url( vocab_site( 'license_deed', 'https://creativecommons.org/licenses/by/4.0/' ) ),
                esc_html__( 'Creative Commons Attribution 4.0 International license', 'vocabulary' )
            )
        );
        ?>
        <?php
        printf(
            /* translators: %s: link to fontawesome.com. */
            esc_html__( 'Icons by %s.', 'vocabulary' ),
            '<a href="https://fontawesome.com/" target="_blank" rel="noopener">Font Awesome</a>'
        );
        ?>
        </p>

    </div>

    </footer>

    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/vocabulary/js/vocabulary.js"></script>

<?php wp_footer(); ?>
</body>
</html>
