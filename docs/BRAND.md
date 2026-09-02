# Brand decisions

Why this theme looks the way it does, and which rules are settled. Read this
before "fixing" the colours or fonts back to the printed style guide.

Sources: [`Creative-Commons-Style-Guide-2019.pdf`](../Creative-Commons-Style-Guide-2019.pdf)
(Victoria Heath, CC BY 4.0) and [`ROADMAP.md`](../ROADMAP.md) §3–§4.


## The 2019 style guide is superseded on visuals

The guide is still the authority on **language, tone and media metadata**. It is
**not** the current authority on palette or type: Vocabulary, the design system
this theme implements, moved on after 2019.

| | Style Guide 2019 | Vocabulary — what the theme uses |
|---|---|---|
| Tomato | `#ed592f` | `#C74200` |
| Gold | `#efbe00` | `#FBD43C` |
| Green | `#04a635` | `#008000` |
| Turquoise | `#05b5da` | `#05b5da` (unchanged) |
| Primary type | Source Sans Pro | **DM Sans** (103 declarations) |
| Mono | — | DM Mono |
| Identity type | CC Accidenz Commons | CC Accidenz Commons (unchanged) |

**Do not revert to the 2019 hex values.** Two reasons: Vocabulary's tokens are
current, and the theme's colours are mostly hardcoded anyway — 146 hex
occurrences in `vocabulary/css/vocabulary.css` against only 61 `var()` uses — so
a palette change would be a large, merge-hostile diff for no gain.

Roboto Condensed and Source Sans Pro are still *used* in a handful of rules, and
`style.css` now declares the `@font-face` blocks they were missing. Both are
style-guide fonts; the files always shipped with the theme, they were just never
wired up, so those rules silently fell back to a generic sans.


## Where chapter styling goes

`src/style.css` imports Vocabulary into `layer(vocabulary)` and then declares
everything else unlayered. Unlayered styles form the final implicit cascade
layer, **above every named layer**, and layer precedence is resolved before
specificity — so a one-selector rule in `style.css` beats
`body > header .masthead .identity-logo:before` with no `!important`.

Put chapter changes in the `CC Sverige — chapter overrides` section of
`style.css`, not in `vocabulary.css`, so merges from upstream stay mechanical.


## Identity

There is **no approved Creative Commons Sweden chapter logo** (ROADMAP §4
documents the search). Until there is one, the theme uses Vocabulary's *product
lockup*: the compact CC lettermark plus the name typeset in CC Accidenz Commons,
lowercase — the same construction as `cc chooser` and `cc search`.

This is the form the [Chapter Logo Policy](https://creativecommons.org/policies/#Chapter%20Logo)
permits without approval, because the CC circle stays in its original font and
style. Configured in `src/inc/site-config.php`:

```php
'identity_style' => 'product',      // or 'logomark' for the full CC wordmark
'identity_text'  => 'cc sverige',
```

Rendered by `vocab_identity_link()`. The masthead variant comes from
`vocabulary.css`; the footer variant is in `style.css`, because upstream has no
footer product lockup.

**Do not** invent a decorative Sweden mark — no flags, no added graphics on the
CC circle, no recolouring outside the brand palette, no drop shadows, no
re-proportioning. A real chapter logo is ROADMAP Phase 7: commission it, submit
it to `legal@creativecommons.org`, then point `identity_style` at it.


## Trademark boundary

Three different regimes live in this repository, and they are easy to conflate:

| What | Terms |
|---|---|
| Theme code | GPL-2.0-or-later |
| Vocabulary CSS/JS | CC0 1.0 |
| **CC name, the CC circle, logos, license buttons and badges** | **Trademarks — not under any CC license** |

Logos and badges may be used only per the
[Trademark Policy](https://creativecommons.org/policies/#trademark): official
artwork from the [downloads page](https://creativecommons.org/mission/downloads/),
unmodified geometry, and contrast of at least 3:1 if the circle is recoloured.
A CC license cannot be applied to the CC logo or to a future chapter logo.


## Language rules that the code enforces

**License abbreviations** (guide p. 11) — all caps, clauses joined with hyphens,
and `CC` never followed by a hyphen:

- `CC BY`, `CC BY-SA`, `CC BY-NC-ND` ✅
- `CC-BY`, `CC-BY-SA`, `cc by` ❌

Ten violations were fixed across the templates. Check with:

```shell
grep -rnE '\bCC-(BY|[A-Z]{2})' src --include='*.php'
```

**Swedish license names** (ROADMAP §5) — keep the international abbreviation
alongside the Swedish name, e.g. *Erkännande-DelaLika 4.0 Internationell*
(`CC BY-SA 4.0`):

| | |
|---|---|
| BY | Erkännande |
| NC | IckeKommersiell |
| ND | IngaBearbetningar |
| SA | DelaLika |

These are not hardcoded. `src/inc/licenses.php` is the single source of truth
for all eight tools — abbreviation, name, elements, deed and legal-code URLs,
badge artwork and summary — and `vocab_media_licenses()` derives the media
fields' list from it, so the two cannot drift.

The msgids there are the **official English names** (`Attribution-ShareAlike
4.0 International`), with the Swedish supplied by the catalogue. Do not put
Swedish in the msgid: gettext would then translate Swedish to Swedish, and any
other locale would still render Swedish.

**NonCommercial artwork.** For a Swedish/EU audience the euro badge is
preferred (ROADMAP §7.2), so `vocab_license_badge_url()` picks
`by_nc.eu.svg` / `by_nc_sa.eu.svg` / `by_nc_nd.eu.svg` when the file exists and
falls back otherwise — only the `big/` badge set ships euro variants today.

The inline element icons still use the `cc-nc` icon class, not `cc-nc-eu`:
the sprite carries a `cc-nc-eu` symbol but `library-vars.css` defines no
`--cc-nc-eu` custom property, so that class would not resolve.

**Legal tools are linked, never re-hosted** (ROADMAP §7.1). Deeds and legal
code stay on creativecommons.org, in Swedish (`deed.sv`, `legalcode.sv`), and
the license chooser is a deep link to
`creativecommons.org/choose/?lang=sv` rather than the dormant local copy.
`vocab_license_attribution()` renders the CC BY 4.0 attribution that adapted HQ
wording requires.

**Dates.** The guide's `2019-10-22` form is right for metadata. Visible Swedish
dates are `22 oktober 2019` — set `j F Y` in Settings → General. Templates use
`vocab_the_date()` / `vocab_format_date()` (`src/inc/i18n.php`), which honour the
site locale and format.

**Spelling.** "CC officially uses American English" governs *English* HQ copy.
Swedish pages follow Swedish conventions (Språkrådet, *Svenska skrivregler*) —
do not force US spelling onto `sv` content.

**Acronyms.** Spell out Creative Commons (CC) on first use.


## Media metadata

The guide's one concrete WordPress instruction (p. 9): every uploaded image
needs a unique title, alternative text, and a caption naming the license (with a
link) and the photographer or designer. Prefer real CC-licensed community
photography over stock.

`src/inc/media-credits.php` implements the data side — **License**,
**Photographer / designer** and **Source URL** fields on the attachment editor,
`vocab_media_credit()` to assemble the credit line, and an admin notice counting
images with no alternative text.


## Deliberately not done

- **No `theme.json`.** It would pin the block-editor palette to the brand
  colours, but the theme dequeues `wp-block-library` and Classic Editor is the
  recommended plugin, so there is no block palette to constrain — and adding
  `theme.json` to a classic theme changes core layout and spacing behaviour.
  Revisit if the chapter moves to the block editor.
- **No palette or font substitution**, per the table above.
- **No chapter logo artwork**, per Identity above.
