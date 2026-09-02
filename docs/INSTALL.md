# Installing the CC Vocabulary Theme (Sverige)

This guide covers installing the theme on a WordPress site — first on staging
(`www-staging.okfn.se`), then on `creativecommons.se`. It is written for the
`main` branch of [`okfse/vocabulary-theme`][fork], the Creative Commons
Sverige build of [`creativecommons/vocabulary-theme`][upstream].

[fork]: https://github.com/okfse/vocabulary-theme
[upstream]: https://github.com/creativecommons/vocabulary-theme


## 1. Requirements

| | |
|---|---|
| WordPress | **5.7 or later** (the theme calls `has_post_parent()` / `get_post_parent()`) |
| PHP | 7.4 or later; 8.1+ recommended |
| Plugins | Advanced Custom Fields is **required** — see below |

> **The most common installation failure.** Every front-end request reads an ACF
> field (`css_dev_hotfixes` in `header.php`), and all of the theme's post types,
> taxonomies and field groups are defined by the ACF JSON in `inc/acf-json/`.
> Activating the theme without ACF used to produce *"There has been a critical
> error on this website."* on every URL. This build ships fallbacks so the site
> degrades instead of dying, but the site is not usable without ACF — install it
> first.


## 2. Install the plugins first

| Plugin | Version | Required? | Purpose |
|---|---|---|---|
| [Advanced Custom Fields][acf] (free edition) | 6.1+ | **Yes** | Custom post types, taxonomies, every content field |
| [acf-menu-chooser][menu-chooser] | 1.1 | Recommended | The `display_menu` field used by the page sidebar |
| [Classic Editor][classic] | 1.6+ | Recommended | The theme's templates assume the classic editor |
| [Redirection][redirection] | 5.3+ | Optional | Managing URL redirects |
| [TablePress][tablepress] | 2.1+ | Optional | Tables inside page content |

ACF **PRO is not needed** — the field groups use no Repeater or Flexible Content
fields. `acf-menu-chooser` is not on wordpress.org; install it from its
[release zip][menu-chooser-zip].

[acf]: https://wordpress.org/plugins/advanced-custom-fields/
[classic]: https://wordpress.org/plugins/classic-editor/
[redirection]: https://wordpress.org/plugins/redirection/
[tablepress]: https://wordpress.org/plugins/tablepress/
[menu-chooser]: https://github.com/reyhoun/acf-menu-chooser
[menu-chooser-zip]: https://github.com/reyhoun/acf-menu-chooser/archive/refs/tags/v1.1.0.zip

An SEO plugin is optional. Upstream's `header.php` printed `<title>` with
`wp_title()`, which needs Yoast SEO to produce anything useful; this build uses
core's `title-tag` support instead, so `<title>` works with no plugin.


## 3. Install the theme

Download **`vocabulary-theme-se.zip`** from the [Releases page][releases] and
upload it under **Appearance → Themes → Add New → Upload Theme**, then activate.

[releases]: https://github.com/okfse/vocabulary-theme/releases

> Use the `vocabulary-theme-se.zip` **release asset**, not GitHub's
> auto-generated "Source code (zip)":
>
> - A source archive of a branch has `style.css` inside `src/`, so WordPress
>   rejects it with *"the theme is missing the style.css stylesheet."*
> - A source archive of a release tag installs, but its folder name contains the
>   version, so each update lands as a separate theme and nav menu assignments
>   (stored per theme) are lost. The release asset always unpacks to
>   `vocabulary-theme-se/`.


## 4. Post-activation checklist

1. **Settings → General**
   - Site Language: **Svenska** — this is what loads `languages/sv_SE.mo`.
   - Timezone: **Europe/Stockholm**.
   - Site Title: used as the logo link's accessible name and in the footer.
2. **Settings → Permalinks** → *Save Changes* once, to register the rewrite
   rules for the theme's custom post types.
3. **Settings → Reading** → set a static front page (see §5 for which template).
4. **Verify ACF loaded the theme's configuration.** Under **ACF** you should
   see 34 field groups, 15 post types and 2 taxonomies. Some are shipped
   inactive, so 30 groups, 11 post types and 1 taxonomy actually register —
   check with `wp post-type list`. If the lists are empty, the
   `acf/settings/load_json` filter is not resolving: confirm the theme folder is
   `wp-content/themes/vocabulary-theme-se/` and that `inc/acf-json/` came across
   in the upload.
5. **Appearance → Menus** — create menus and assign them to the three
   locations this build adds:

   | Location | Where it renders |
   |---|---|
   | Huvudmeny (Primary Navigation) | Header, inside `.masthead` |
   | Sidfotsmeny (Footer Menu) | Footer link list |
   | Sociala medier (Social Menu) | Footer social icons |

   Submenu toggle buttons are generated automatically — nothing to add by hand.
   Nesting up to three levels is styled.

   Use each item's **CSS Classes** field (enable it via *Screen Options*) for
   Vocabulary's presentational classes. The theme moves these onto the `<a>`,
   which is where the design system expects them:

   | Class | Effect |
   |---|---|
   | `donate` | Renders the item as the highlighted call-to-action button |
   | `attention` | Renders the item as an attention-styled link |
   | `icon-replace fa-bluesky` | Replaces the label with the Bluesky icon |
   | `icon-replace fa-mastodon` | Mastodon icon |
   | `icon-replace fa-linkedin` | LinkedIn icon |
   | `icon-attach fa-…` | Keeps the label and adds the icon beside it |

   Any `fa-*` class from Vocabulary's icon set works the same way.
6. **Edit `inc/site-config.php`** (or filter `vocab_site_config` from a small
   plugin) to set the chapter's own details. Values left empty are not rendered.

   | Key | Purpose |
   |---|---|
   | `identity_style` | `product` for the CC lettermark + typeset name lockup, `logomark` for the full CC wordmark |
   | `identity_text` | Lockup text, default `cc sverige`. Empty falls back to the site title |
   | `legal_disclaimer` | The legal-advice notice. **Required of chapter sites — do not empty it** |
   | `address`, `email` | Footer contact block |
   | `newsletter_url` | Empty hides the subscribe block entirely |
   | `license_url`, `license_anchor`, `license_deed`, `license_icons` | Footer site-licence notice |
   | `default_header_image`, `default_header_alt`, `default_header_caption` | Fallback page header graphic |

7. **Set the date format.** Settings → General → `j F Y`, so Swedish dates read
   `22 oktober 2019`. A site installed in Swedish gets this by default; one
   installed in English and switched afterwards keeps the US default.
   Metadata dates stay ISO — see [`BRAND.md`](BRAND.md).


## 5. Page templates

Select these under **Page Attributes → Template**. Each exposes its own ACF
field group.

| Template | File | ACF field group |
|---|---|---|
| *(default)* | `page.php` | Header Settings, Page Sidebar Meta, Page Opening, Page Closing, Page More Links Meta |
| Index - Home | `page_home.php` | Home Index Settings |
| Index - Home Narrative | `page_home-narrative.php` | Home Narrative Settings, Home Narrative Interim Settings |
| Index - Blog | `page_blog.php` | Blog Index Settings |
| Index - Team | `page_team.php` | Team Index Settings |
| Index - Events | `page_events.php` | *(uses the `event` post type)* |
| Index - FAQs | `page_faqs.php` | FAQs Index Settings, FAQs Index Meta |
| Index - Case Studies | `page_casestudies.php` | *(uses the `case-study` post type)* |
| Page - Licenses | `page_licenses.php` | Licenses Page Settings |
| Page - Support | `page_support.php` | Support Page Settings |
| Page - Training | `page_training.php` | Training Index Settings |
| Page - Training Videos | `page_training-videos.php` | Training Videos Page Settings |
| Overview | `page_overview.php` | Overview Page Settings |
| Static | `page_static.php` | Static Page Settings |
| Walkthrough | `page_walkthrough.php` | — |

Custom post types, all provided by ACF. Active by default: `person`, `notice`,
`program`, `event`, `faq_item`, `faqs-group`, `course`, `topic-feature`,
`project`, `case-study`, `training`, plus the `topic-feature-category`
taxonomy. Shipped **inactive** (enable them under ACF → Post Types if needed):
`campaign`, `course_unit`, `course_chapter`, `course_group`, and the `group`
taxonomy.

`notice` posts drive the site-wide banner. Set the notice's **type** to
`top-of-site` for the header banner or `newsletter-promo` for the in-page
newsletter block. The legal-advice disclaimer does **not** use this — it is part
of the footer template, so it cannot be switched off by accident.

### What is dormant, and how to bring it back

Creative Commons HQ's own information architecture is retired rather than
deleted, so every decision here is reversible (ROADMAP.md Phase 3).

**Page templates.** `page_home.php`, `page_home-narrative.php`,
`page_support.php`, `page_casestudies.php`, `page_training.php`,
`page_training-videos.php` and `page_walkthrough.php` no longer carry a
page-template header, so WordPress does not offer them. Each file opens with a
comment naming the template it used to provide; restoring that header brings it
back. WordPress caches the template list per theme *version*, so the dropdown
updates on the next release.

**Post types.** `course`, `course_unit`, `course_chapter`, `course_group`,
`campaign`, `program`, `project`, `case-study`, `topic-feature`, `training` and
the `group` taxonomy are `"active": false` in `src/inc/acf-json/post_type_*.json`
/ `taxonomy_*.json`. Flip the flag to `true` to re-register one. Field groups
scoped to a dormant post type simply never appear, so they were left untouched.

**The license chooser.** `src/chooser/` and
`static-templates/static-chooser.php` are still in the repo but unreachable —
the template has no page-template header. ROADMAP Phase 4 adds a "Välj licens"
page that deep-links `https://creativecommons.org/choose/?lang=sv` instead of
running a local copy.


## 6. Shortcodes

| Shortcode | Purpose |
|---|---|
| `[list category="" tags="" type="post" limit="5" sort="ASC" sortby="date" template=""]` | A queried list of posts; `template` names a partial in `shortcode-templates/` |
| `[highlight]…[/highlight]` | Highlighted block |
| `[stats][stat num="42" description="…"][/stats]` | Statistics row |
| `[button]…[/button]` | Renders inline text as a button |
| `[topic-summary heading="" description="…"]…[/topic-summary]` | Topic summary panel |
| `[columns][column]…[/column][/columns]` | Multi-column list |


## 7. Translations

UI strings live in `languages/`:

- `vocabulary.pot` — extracted source strings
- `sv_SE.po` — Swedish translation
- `sv_SE.mo` — compiled catalogue, shipped inside the release zip

To change a string, edit `sv_SE.po` and recompile (see
[`docs/RELEASE.md`](RELEASE.md)); do not edit the `.mo` by hand.

See [`BRAND.md`](BRAND.md) for the language rules the theme follows — license
abbreviations, Swedish license names, date forms.

**What is not translated.** Editorial copy hardcoded into
`page_home.php`, `page_licenses.php`, `front-page-old.php` and
`static-templates/static-chooser.php` is CC's own English marketing and
chooser-app text. That is content, not UI, and should be replaced with Swedish
editorial content (or the template dropped) rather than routed through gettext.


## 8. Caching

> **Warning** (carried over from upstream): the theme's page output is fully
> deterministic — the same page rendered now and in 30 minutes is byte-identical
> for a given theme version. CDN page rules assume this. Adding per-user dynamic
> content must be coordinated with those rules.


## 9. Keeping up with upstream

```bash
git fetch upstream
git merge upstream/main
```

Conflicts are concentrated in `src/header.php`, `src/footer.php`,
`src/style.css` and `src/functions.php`. After merging, cut a new release as
described in [`docs/RELEASE.md`](RELEASE.md).
