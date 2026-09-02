# Advanced Custom Fields

This theme uses [Advanced Custom Fields][acf] (ACF, free edition, 6.1 or later)
to define its custom post types, taxonomies and meta fields. **ACF is not
optional**: without it none of the theme's content types register.

[acf]: https://www.advancedcustomfields.com/


## How the configuration is loaded

The live configuration is the JSON in [`acf-json/`](acf-json/). ACF's local JSON
feature reads it directly; the theme only redirects ACF's save and load paths to
this directory, in `functions.php`:

```php
add_filter( 'acf/settings/save_json', 'vocab_acf_json_save_point' );
add_filter( 'acf/settings/load_json', 'vocab_acf_json_load_point' );
```

Both filters use `get_stylesheet_directory()`. If you ever run this theme as a
parent theme with a child theme active, override them to use
`get_template_directory()` or the field groups will not be found.

Nothing includes [`acf-backups/`](acf-backups/) — it is a historical snapshot
kept for reference only. (Note that `acf-backups/acf.php` has no opening `<?php`
tag, so it must not be `require`d.)


## Editing fields

Edit field groups, post types and taxonomies through the ACF admin UI. ACF
writes the changes straight back into `acf-json/`, so the workflow is:

1. Start the development environment (see the main [`README.md`](../../README.md)).
2. Make the change under **ACF → Field Groups** / **Post Types** / **Taxonomies**.
3. Confirm the corresponding file in `acf-json/` changed on disk.
4. Commit the changed JSON.

On a server, a change made in the admin UI only persists if `acf-json/` is
writable. It normally is not, so treat production field groups as read-only and
deploy changes as part of a theme release.
