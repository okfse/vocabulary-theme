<?php
/**
 * Media credit fields.
 *
 * The Creative Commons Style Guide (2019, p. 9) asks that every image uploaded
 * to WordPress carry a unique title, alternative text, and a caption naming the
 * licence it is published under -- with a link -- and the photographer or
 * designer. Nothing in the theme recorded the licence or the credit, so
 * captions had to be written by hand and were easy to get wrong or omit.
 *
 * This adds the two missing pieces of data to the attachment editor, a helper
 * that assembles the credit line from them, and a nudge when images have no
 * alternative text.
 */

/**
 * Licences offered for uploaded media.
 *
 * Derived from vocab_licenses() in inc/licenses.php so there is one licence
 * table rather than two that can drift, plus an "all rights reserved" entry
 * that is not a Creative Commons tool and so does not belong there.
 *
 * Keys are stored in post meta, so they must not be renamed.
 *
 * @return array Slug => array( label, deed URL ).
 */
function vocab_media_licenses() {
    $licenses = array();

    foreach ( vocab_licenses() as $slug => $license ) {
        $licenses[ $slug ] = array( $license['abbr'], $license['deed'] );
    }

    $licenses['all-rights'] = array( __( 'All rights reserved', 'vocabulary' ), '' );

    /**
     * Filter the licences offered on the attachment editor.
     *
     * @param array $licenses Slug => array( label, deed URL ).
     */
    return apply_filters( 'vocab_media_licenses', $licenses );
}

/**
 * Add the licence and credit fields to the attachment editor.
 *
 * @param array   $fields Attachment fields.
 * @param WP_Post $post   Attachment post.
 * @return array
 */
function vocab_media_attachment_fields( $fields, $post ) {
    $options = '<option value="">' . esc_html__( '&mdash; Select &mdash;', 'vocabulary' ) . '</option>';
    $current = (string) get_post_meta( $post->ID, '_vocab_media_license', true );

    foreach ( vocab_media_licenses() as $slug => $license ) {
        $options .= sprintf(
            '<option value="%s"%s>%s</option>',
            esc_attr( $slug ),
            selected( $current, $slug, false ),
            esc_html( $license[0] )
        );
    }

    $fields['vocab_media_license'] = array(
        'label' => __( 'License', 'vocabulary' ),
        'input' => 'html',
        'html'  => sprintf(
            '<select name="attachments[%d][vocab_media_license]" id="attachments-%d-vocab_media_license">%s</select>',
            $post->ID,
            $post->ID,
            $options
        ),
        'helps' => __( 'The license this image is published under.', 'vocabulary' ),
    );

    $fields['vocab_media_credit'] = array(
        'label' => __( 'Photographer / designer', 'vocabulary' ),
        'input' => 'text',
        'value' => get_post_meta( $post->ID, '_vocab_media_credit', true ),
        'helps' => __( 'Who made the image. Shown in the credit line.', 'vocabulary' ),
    );

    $fields['vocab_media_source'] = array(
        'label' => __( 'Source URL', 'vocabulary' ),
        'input' => 'text',
        'value' => get_post_meta( $post->ID, '_vocab_media_source', true ),
        'helps' => __( 'Where the image came from. Optional; linked from the title in the credit line.', 'vocabulary' ),
    );

    return $fields;
}
add_filter( 'attachment_fields_to_edit', 'vocab_media_attachment_fields', 10, 2 );

/**
 * Persist the licence and credit fields.
 *
 * @param array $post       Attachment post data.
 * @param array $attachment Submitted attachment fields.
 * @return array
 */
function vocab_media_save_attachment_fields( $post, $attachment ) {
    $licenses = vocab_media_licenses();

    if ( isset( $attachment['vocab_media_license'] ) ) {
        $value = sanitize_key( $attachment['vocab_media_license'] );
        if ( '' === $value || isset( $licenses[ $value ] ) ) {
            update_post_meta( $post['ID'], '_vocab_media_license', $value );
        }
    }

    if ( isset( $attachment['vocab_media_credit'] ) ) {
        update_post_meta( $post['ID'], '_vocab_media_credit', sanitize_text_field( $attachment['vocab_media_credit'] ) );
    }

    if ( isset( $attachment['vocab_media_source'] ) ) {
        update_post_meta( $post['ID'], '_vocab_media_source', esc_url_raw( $attachment['vocab_media_source'] ) );
    }

    return $post;
}
add_filter( 'attachment_fields_to_save', 'vocab_media_save_attachment_fields', 10, 2 );

/**
 * Build the credit line for an attachment.
 *
 * Follows the style guide's attribution pattern: title, creator, licence, each
 * linked where a URL is known. Returns '' when there is nothing to credit, so
 * templates can skip the caption entirely.
 *
 * @param int $attachment_id Attachment ID.
 * @return string Credit line HTML, or '' when no licence is recorded.
 */
function vocab_media_credit( $attachment_id ) {
    $attachment_id = (int) $attachment_id;

    if ( ! $attachment_id ) {
        return '';
    }

    $licenses = vocab_media_licenses();
    $slug     = (string) get_post_meta( $attachment_id, '_vocab_media_license', true );

    if ( '' === $slug || ! isset( $licenses[ $slug ] ) ) {
        return '';
    }

    $title  = get_the_title( $attachment_id );
    $source = (string) get_post_meta( $attachment_id, '_vocab_media_source', true );
    $credit = (string) get_post_meta( $attachment_id, '_vocab_media_credit', true );

    $title_html = $source
        ? sprintf( '<a href="%s">%s</a>', esc_url( $source ), esc_html( $title ) )
        : esc_html( $title );

    $license_html = $licenses[ $slug ][1]
        ? sprintf( '<a href="%s">%s</a>', esc_url( $licenses[ $slug ][1] ), esc_html( $licenses[ $slug ][0] ) )
        : esc_html( $licenses[ $slug ][0] );

    if ( $credit ) {
        return sprintf(
            /* translators: 1: image title, 2: photographer or designer, 3: license. */
            esc_html__( '%1$s by %2$s is licensed under %3$s.', 'vocabulary' ),
            $title_html,
            esc_html( $credit ),
            $license_html
        );
    }

    return sprintf(
        /* translators: 1: image title, 2: license. */
        esc_html__( '%1$s is licensed under %2$s.', 'vocabulary' ),
        $title_html,
        $license_html
    );
}

/**
 * Count images that have no alternative text.
 *
 * Cached briefly: this runs on the media screens, and the answer only changes
 * when someone edits an attachment.
 *
 * @return int
 */
function vocab_media_missing_alt_count() {
    $cached = get_transient( 'vocab_media_missing_alt' );

    if ( false !== $cached ) {
        return (int) $cached;
    }

    global $wpdb;

    $count = (int) $wpdb->get_var(
        "SELECT COUNT(*)
         FROM {$wpdb->posts} p
         LEFT JOIN {$wpdb->postmeta} m
             ON m.post_id = p.ID AND m.meta_key = '_wp_attachment_image_alt'
         WHERE p.post_type = 'attachment'
           AND p.post_mime_type LIKE 'image/%'
           AND ( m.meta_value IS NULL OR m.meta_value = '' )"
    );

    set_transient( 'vocab_media_missing_alt', $count, 5 * MINUTE_IN_SECONDS );

    return $count;
}

// The count is cached, so drop it whenever an attachment changes.
add_action( 'edit_attachment', function () {
    delete_transient( 'vocab_media_missing_alt' );
} );
add_action( 'add_attachment', function () {
    delete_transient( 'vocab_media_missing_alt' );
} );

/**
 * Nudge editors about images with no alternative text.
 */
function vocab_media_alt_notice() {
    $screen = get_current_screen();

    if ( ! $screen || ! in_array( $screen->id, array( 'upload', 'attachment' ), true ) ) {
        return;
    }

    if ( ! current_user_can( 'upload_files' ) ) {
        return;
    }

    $count = vocab_media_missing_alt_count();

    if ( ! $count ) {
        return;
    }

    printf(
        '<div class="notice notice-warning"><p>%s</p></div>',
        esc_html(
            sprintf(
                /* translators: %s: number of images. */
                _n(
                    '%s image has no alternative text. Alternative text is required for accessibility, and the Creative Commons Style Guide asks for it on every upload.',
                    '%s images have no alternative text. Alternative text is required for accessibility, and the Creative Commons Style Guide asks for it on every upload.',
                    $count,
                    'vocabulary'
                ),
                number_format_i18n( $count )
            )
        )
    );
}
add_action( 'admin_notices', 'vocab_media_alt_notice' );
