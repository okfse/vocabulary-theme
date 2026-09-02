<?php get_header('', array( 'body-classes' => 'default-page') ); ?>

<main>

<header>

<h1><?php esc_html_e( 'Page not found', 'vocabulary' ); ?></h1>

</header>

<div class="content">

    <p><?php esc_html_e( 'Sorry, we could not find the page you were looking for.', 'vocabulary' ); ?></p>

    <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to the front page', 'vocabulary' ); ?></a></p>

</div>

</main>

<?php get_footer(); ?>
