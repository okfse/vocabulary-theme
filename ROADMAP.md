# ROADMAP — Creative Commons Sweden theme fork

Investigation report and sequenced work plan for a **Swedish chapter fork** of [`creativecommons/vocabulary-theme`](https://github.com/creativecommons/vocabulary-theme). The fork is intended to live under [github.com/okfse](https://github.com/okfse) (Open Knowledge Sweden) and to power a new WordPress site for **Creative Commons Sverige**.

This file is the implementation guide. Theme changes are **not** done in the upstream snapshot that produced this document; they belong in the okfse fork.

## 1. Purpose and non-goals

**Purpose.** Adapt Vocabulary Theme from Creative Commons HQ (`creativecommons.org`) into a chapter theme for Sweden: Swedish chrome, chapter identity, chapter information architecture, and a migration path off the current site.

**Non-goals (this ROADMAP does not ask the fork to):**

- Become a second copy of creativecommons.org
- Invent a decorative “Sweden” logo that alters the CC circle
- Re-host license deeds or legal code as if the chapter issued them
- Revert Vocabulary colors/type to the 2019 print style-guide hexes
- Provide juridisk rådgivning

**Public identity vs code host.** Open Knowledge Sweden may host the git repository. The site identity remains Creative Commons Sverige, a CC Global Network chapter.

## 2. Upstream relationship

This codebase is `creativecommons/vocabulary-theme` (observed as v2.7.1), the WordPress implementation of [Vocabulary](https://github.com/creativecommons/vocabulary). Vocabulary is the **current digital design system**. It is informed by the 2019 Style Guide but has moved on (DM Sans, updated brand tokens, product lockups).

The live chapter site uses the older [`wp-theme-cc-chapter`](https://github.com/creativecommons/wp-theme-cc-chapter) on WordPress **multisite** (`sites/37`), with custom post types `cc_chfeature`, `cc_chevent`, `cc_chteam`, `cc_chvideos`, `cc_chwork`, `cc_charea`, `cc_highlight`. That theme is **not** the fork base.

**Fork stance**

- Treat Vocabulary Theme as upstream. Keep a `creativecommons/vocabulary-theme` remote and pull with care.
- Prefer a thin chapter overlay (header/footer, locale, identity, Swedish templates) over rewriting Vocabulary CSS.
- Do not silently fork Vocabulary assets in a way that blocks upstream pulls.

Suggested remotes after the okfse repo exists:

```text
origin    git@github.com:okfse/<repo>.git
upstream  git@github.com:creativecommons/vocabulary-theme.git
```

## 3. Brand and style-guide findings

Source: `Creative-Commons-Style-Guide-2019.pdf` (Victoria Heath, [CC BY 4.0](https://creativecommons.org/licenses/by/4.0/deed.sv)). The guide is for anyone making CC communications, including **CC Chapters**. It points chapters at the [Policies](https://creativecommons.org/policies/) page for logo adaptation.

### Use as-is (visual and trademark)

- One primary CC logo (wordmark / CC-in-a-circle). Derivatives only from the official [press kit / downloads](https://creativecommons.org/mission/downloads/).
- Do not recolor outside the brand palette (except black/white), mix colors in one logo, add shadows/outlines, re-proportion, or tint.
- Logos and icons are **trademarks**, not CC-licensed. See this theme’s `README.md` and the [Trademark Policy](https://creativecommons.org/policies/#trademark).
- Photography: no generic stock; prefer CC-licensed, inclusive, real community photos. WordPress uploads need a unique title, alt text, and a caption with license + photographer.
- Tone: clear, informed, professional, still approachable. Spell out Creative Commons (CC) on first use. License abbreviations in all caps with hyphens: `CC BY-NC-SA`, never `CC-BY`.
- Chapter website content should be **CC BY 4.0 or CC0**, with attribution and license links ([Internet Services Policy](https://creativecommons.org/policies/)).

### Do not apply blindly to a Swedish site

- “CC officially uses American English” applies to **English** HQ copy. Swedish pages follow Swedish writing conventions (Språkrådet / *Svenska skrivregler*), not US spelling.
- Style-guide date form `2019-10-22` is fine in metadata. Visible Swedish dates should be `22 oktober 2019` / `29 mars 2026`.
- 2019 palette hex values are **not** current Vocabulary tokens:

  | Token | Style Guide 2019 | Vocabulary (keep these) |
  |-------|------------------|-------------------------|
  | Tomato | `#ed592f` | `#C74200` |
  | Gold | `#efbe00` | `#FBD43C` |
  | Green | `#04a635` | `#008000` |
  | Turquoise | `#05b5da` | `#05b5da` (unchanged) |

  **Keep Vocabulary tokens.** Do not revert the theme to 2019 print hexes.

- Primary UI type in Vocabulary is now **DM Sans**, with **CC Accidenz Commons** for identity lockups. Source Sans Pro and Roboto Condensed remain in the theme. Do not swap the whole stack back to “Source Sans Pro everywhere.”

### Chapter policies the PDF does not reprint

- [Chapter Logo Policy](https://creativecommons.org/policies/#Chapter%20Logo): one chapter logo; must include the Creative Commons name and/or the CC-in-a-circle in **original font and style**; Chapter Lead submits it to `legal@creativecommons.org`; CC owns the mark; use only for chapter CC work.
- [CCGN Internet Services Policy](https://creativecommons.org/policies/): one principal public website; content under CC BY 4.0 or CC0; **prominent disclaimer that the site does not provide legal advice**. HQ subdomains inherit HQ privacy/terms/DMCA. A self-hosted `creativecommons.se` must maintain its own policies (GDPR).
- [Chapter Standards](https://github.com/creativecommons/global-network-strategy/blob/master/docs/chapters-standards.md): maintain a country-specific website; be a contact and information point; no legal advice in a chapter capacity.

## 4. Chapter logo recommendation

**No official, currently used, approved Creative Commons Sweden Chapter Logo was found.**

Evidence:

- [se.creativecommons.net](https://se.creativecommons.net/) uses generic CC / old chapter-theme branding.
- [CC Sweden network profile](https://network.creativecommons.org/chapter/cc-sweden/) has no chapter logo asset.
- The official press kit and Wikimedia Commons have global CC marks only.
- A 2008 post, [CC Sweden logo-contest](https://se.creativecommons.net/2008/03/10/cc-sweden-logo-contest/), pointed at a contest page that no longer exists (`creativecommons.se/?page_id=38`). No surviving winner is in use.

**Default for the fork (do this first):**

1. Use Vocabulary’s **product identity lockup**, already in the theme:
   - CSS class `identity-logo product` in `src/vocabulary/css/vocabulary.css`
   - CC lettermark `src/vocabulary/svg/cc/logos/cc/lettermark.svg` + typeset name in **CC Accidenz Commons**, lowercase
   - Visible text: `Creative Commons Sverige` (or `cc sverige`) so the mark is not the unmodified HQ wordmark
   - The CC circle stays in original style, which is what the Chapter Logo Policy requires
2. Do **not** invent a decorative Sweden logo in code (flags, dalahästar, extra graphics on the CC circle). That violates the style guide and trademark policy.
3. Favicons: keep the official CC favicon set until an approved chapter mark exists.
4. **Optional later track (Phase 7):** commission a single Chapter Logo (CC circle or wordmark + “Sverige”), submit it to `legal@creativecommons.org`, then swap the lockup.

## 5. Existing-site inventory

Live site: [https://se.creativecommons.net/](https://se.creativecommons.net/)  
`https://creativecommons.se/` redirects there.

[Network listing](https://network.creativecommons.org/chapter/cc-sweden/): founded 24 July 2023; Chapter Lead Jonas Bäckelin; GNC representative Jörg Pareigis; Facebook [CCSverige](https://www.facebook.com/CCSverige/); mailing list `cc-sweden` (Google Groups).

### Information architecture (migrate or redirect)

| Path | Role |
|------|------|
| `/` | Four cards: Om CC, Blogg, Bidra, plus latest posts |
| `/om-cc/` | About CC and CC Sverige (history from 2004; team text is mixed/outdated) |
| `/om-cc/licenserna/` | Six licenses + CC0; still centered on **2.5 SE** ports with 4.0 links |
| `/om-cc/licensvillkor-symboler-och-forkortningar/` | Symbols and abbreviations |
| `/om-cc/historik/` | History |
| `/om-cc/material-om-creative-commons/` (+ `/filmer/`, `/guider/`) | Educational material |
| `/hur-funkar-det/` and children | How to license / how to use CC material |
| `/faq-2/` | FAQ (stale) |
| `/blogg/` | News archive from 2004 through 2026 (~150+ posts) |
| `/kontakt-2/` | Contact; email group; Jonas Bäckelin / LinkedIn |
| `/intresseanmalan/` | Contribute / roles (Deltagare, Redaktör, Organisatör) |
| `/guider/`, `/akademiska-uppsatser/` | Guides and theses |
| `/privacy-policy/`, `/privacy/`, `/terms/`, `/policies/`, `/contact/`, `/about/` | Mostly HQ/WP stubs — rewrite for a Swedish self-hosted chapter |

### What the new theme must support

- Swedish-first blog/news (`Nyheter`), not HQ “What We Do / Support Us / Donate”
- License explainers that distinguish **4.0 International** (recommended; Swedish deed + legalcode) from **2.5 Sverige ports** (historical, still legally in force)
- Deep links to `https://creativecommons.org/choose/?lang=sv` and `https://creativecommons.org/licenses/by/4.0/deed.sv` (and siblings)
- People/team, events, FAQ, contact
- Legal-advice disclaimer, privacy (GDPR), cookies, site license (CC BY 4.0)
- Redirect map from every indexed URL in the current Yoast sitemaps

### Do not blindly copy from the old site

- About-page roster (2005–2013 names plus a 2023 update; several roles look stale)
- License pages that present 2.5 SE as the default
- English HQ privacy/terms stubs
- HQ donate / GoFundMe / Mountain View address / `info@creativecommons.org`
- Hardcoded “Twenty Years of Creative Commons” HQ homepage narrative

### Swedish license names (use consistently)

Keep the international abbreviations next to the Swedish names:

| Abbreviation | Swedish name |
|--------------|--------------|
| BY | Erkännande |
| NC | IckeKommersiell |
| ND | IngaBearbetningar |
| SA | DelaLika |
| CC0 | CC0 / Public Domain Dedication |
| PDM | Public Domain Mark |

Example: **Erkännande-DelaLika 4.0 Internationell** (`CC BY-SA 4.0`).

## 6. Theme gaps (HQ → chapter)

Highest-impact files:

| File | Problem for Sweden |
|------|--------------------|
| `src/header.php` | `lang="en-US"`; HQ mega-menu; Donate |
| `src/footer.php` | HQ wordmark; Mountain View address; HQ social; HQ newsletter; HQ store; license blurb pointing at HQ paths |
| `src/style.css` | Theme Name / Author still HQ |
| `src/functions.php` | Registers `primary-menu` but header does not render `wp_nav_menu()`; almost no `load_theme_textdomain`; strings not translatable |
| `page_home.php`, `page_support.php`, `page_licenses.php`, `page_training.php`, `chooser/` | HQ product IA |
| ACF CPTs | Useful: `post`, `event`, `person`, `notice`, `faq_item` / `faqs-group`. HQ-heavy: `course*`, `campaign`, `program`, `project`, `case-study`, `topic-feature`, `training` |

Identity CSS: `identity-logo` uses HQ `logomark.svg`. `identity-logo.product` is the chapter-ready lockup.

**Minimum chrome changes**

- `<html lang="sv-SE">`
- Skip link, search, nav, footer in Swedish
- Identity: Creative Commons Sverige
- Footer contact: chapter email / mailing list, not Mountain View
- Social: Facebook CCSverige plus accounts the chapter actually runs — not HQ Bluesky/Mastodon presented as Sweden’s
- Newsletter: chapter list, or omit until one exists
- Donate: omit, or link to [creativecommons.org/donate](https://creativecommons.org/donate) as support for **CC HQ**, clearly labeled
- Footer license: CC BY 4.0 with `deed.sv` / `legalcode.sv`
- Prominent: “Denna webbplats ger inte juridisk rådgivning”
- WordPress menus instead of hardcoded HQ IA
- `load_theme_textdomain` + `languages/sv_SE.po` for chrome strings

## 7. What CC Sweden may copy, adopt, and remix from CreativeCommons.org

When leaving the old chapter theme, prefer **canonical HQ legal tools + translated explainers** over cloning HQ as a second Creative Commons.

| Mode | Meaning |
|------|---------|
| **Link / adopt in place** | Point at the official URL. Do not re-host. Deeds, legal code, chooser, and trademark downloads stay on creativecommons.org. |
| **Copy and adapt** | Reuse HQ prose, structure, or media under the stated license, translate into Swedish, attribute, and mark changes. Publish the chapter page as CC BY 4.0 (or CC0). |
| **Remix in the theme** | Keep Vocabulary assets already in this theme (GPL / CC0 / font licenses). Restyle chrome for the chapter; do not treat HQ page templates as Sweden’s site map. |

**Legal baseline** ([CC licensing statement](https://creativecommons.org/policies/#licensing%20statement)):

- Most **website content** on creativecommons.org is **CC BY 4.0** unless marked otherwise → copy, translate, remix with attribution.
- **Legal code, Commons deeds, and accompanying notices** are **CC0** → copy freely. CC still reserves **all trademark and branding rights** in those pages.
- **Software** is free software; this theme is **GPL-2.0-or-later**; Vocabulary CSS/JS is **CC0**.
- **Trademarks** (name, CC circle, license buttons, “Creative Commons” in any language or stylization) are **not** under a CC license. Use only per the [Trademark Policy](https://creativecommons.org/policies/#trademark): official downloads, unmodified geometry, contrast ≥ 3:1 if recoloring the circle.

### 7.1 Adopt in place (link, do not fork)

Swedish pages should explain and deep-link, not duplicate:

- License chooser: `https://creativecommons.org/choose/?lang=sv`
- 4.0 deeds and legal code in Swedish, e.g. `https://creativecommons.org/licenses/by/4.0/deed.sv` and `legalcode.sv` (all six licenses + CC0)
- License index: `https://creativecommons.org/licenses/list.sv`
- 2.5 Sverige ports (historical, still in force): `https://creativecommons.org/licenses/by/2.5/se/` and siblings
- Official buttons/icons: [Downloads](https://creativecommons.org/mission/downloads/)
- Openverse / search the commons
- CC Certificate, CC Signals, Global Network, HQ donate — as **HQ products**, labeled as such
- HQ privacy/terms/DMCA — only if the new site stays on HQ WordPress multisite. A self-hosted `creativecommons.se` must have **chapter-owned** privacy and terms (GDPR)

Do not re-publish deeds or legal code on the chapter domain as if Sweden issued them. Canonical URL stays on creativecommons.org.

### 7.2 Copy and adapt (translate, attribute, mark as adapted)

Replace the old site’s 2.5-first license pages with HQ’s 4.0 structure, in Swedish:

| HQ source | What to take | How to adapt |
|-----------|----------------|--------------|
| [The CC Licenses](https://creativecommons.org/cc-licenses/) / [Share your work](https://creativecommons.org/share-your-work/cclicenses/) | Six-license order (most → least permissive), element icons, short “enables reusers to…” blurbs | Swedish names; keep `CC BY-SA 4.0` abbreviations; link `deed.sv` |
| [FAQ](https://creativecommons.org/faq/) | What CC is, how licenses operate, marking, 4.0 vs ported, no legal advice | Translate selected entries; **keep** “Creative Commons ger inte juridisk rådgivning”; drop US-only fair-use framing; Swedish *upphovsrätt* notes only as information, not advice |
| Style Guide 2019 (CC BY 4.0) | Mission language, tone, photography rules, abbreviation rules | Swedish voice; do not force American English on `sv` pages |
| [Marking your work](https://wiki.creativecommons.org/wiki/Marking_your_work_with_a_CC_license), [attribution](https://wiki.creativecommons.org/wiki/Best_practices_for_attribution), [considerations for licensors](https://wiki.creativecommons.org/wiki/Considerations_for_licensors_and_licensees) | How to apply a license; how to credit | Swedish how-to pages; examples from Swedish GLAM / school use (the old site has these) |
| HQ blog (4.0, CC0, CC Signals, Certificate) | Current global news | Summarize in Swedish with a link to the original; do not imply the chapter authored HQ policy |
| Press-kit videos, comics, “What is CC” flyers | Education | Check **each file’s** license (often CC BY; some BY-NC-ND). Style Guide p. 9 campaign graphics are **CC BY-NC-ND 4.0** — share unadapted, do not remix |
| License badge SVGs in `src/vocabulary/svg/cc/license_badges/` | Visual marks | Use as marks linking to the deed. Prefer **NC-EU** (`by_nc.eu.svg`) when showing NonCommercial in a Swedish/EU context |

**Attribution pattern for adapted HQ copy:**

> Text adapted from [page title](URL) by Creative Commons, [CC BY 4.0](https://creativecommons.org/licenses/by/4.0/deed.sv). Changes: translated into Swedish; Sweden-specific examples added.

### 7.3 Remix in the theme (already in this repo)

Safe to keep and restyle; this is the migration path off `wp-theme-cc-chapter`:

- Vocabulary layout, color tokens, DM Sans / Accidenz Commons, blob/star graphics
- `identity-logo product` lockup (CC lettermark + “sverige”)
- License icons (`cc-by`, `cc-sa`, `cc-nc-eu`, `cc-zero`, …)
- Event / person / FAQ / notice CPTs if the chapter will use them
- Accessibility patterns (skip link, figure + figcaption)

Do **not** carry over as Sweden’s IA: HQ mega-menu (Who we are / What we do / Support Us / Donate), `page_home.php` 20-year narrative, `page_support.php`, GoFundMe, Mountain View address, HQ social accounts, course/certificate product pages, or the in-theme license chooser (default: link to HQ chooser).

### 7.4 Do not copy, or copy only with a hard boundary

- Do not present CC Sweden as Creative Commons the US nonprofit (staff, board, PO Box, `info@creativecommons.org`).
- Do not modify legal tool text and still call it a Creative Commons license ([License Modification Policy](https://creativecommons.org/policies/#License%20Modification)).
- Do not use unofficial Swedish translations of legal code; only `legalcode.sv` published by CC.
- Do not apply a CC license to the CC logo or a future Chapter Logo (trademark, not a copyright-share).
- Do not replace the old site’s Swedish 2.5 SE documentation with silence: keep it as an **archive** with HQ’s notice that 4.0 is recommended for new works.
- Do not reuse HQ privacy/cookie/terms pages on a self-hosted chapter domain; write GDPR-compliant chapter policies. Linking HQ policy URLs is appropriate only while the site remains on HQ WordPress multisite.
- Fundraising: a “Stöd Creative Commons” link to HQ donate is fine if it is clearly **global CC**, not a Swedish org asking for US tax-deductible gifts.

### 7.5 Prefer HQ 4.0 over the old Sweden license pages

Current `/om-cc/licenserna/` still leads with **2.5 SE** (jurisdiction port, launched December 2005) and tacks on 4.0 legalcode links. HQ recommends **4.0 International** for new works.

1. Lead with 4.0 + Swedish deed/legalcode.
2. Keep 2.5 SE as “äldre svenska portningar” for works already under those licenses.
3. Reuse HQ’s “this is an older version…” notice (already on `deed.sv` for 2.5 SE).
4. Keep Swedish educational material from the old site (skolan, ABM, kulturarv) — chapter value HQ does not have.

### 7.6 Suggested new-site page map

| New page | Source mix |
|----------|------------|
| Hem | Chapter intro (old site) + latest posts; not HQ homepage |
| Om Creative Commons | Style Guide mission + HQ about, translated; then “CC i Sverige” history from `/om-cc/` and `/om-cc/historik/` |
| Licenserna | HQ six-license structure, Swedish names, links to `deed.sv`; 2.5 SE archive section |
| Välj licens | Short intro + button to HQ chooser `?lang=sv` |
| Så märker du ditt verk | Wiki marking + old `/hur-funkar-det/licensiera-ditt-verk/` |
| Så använder du CC-material | Wiki attribution + old `/hur-funkar-det/for-att-anvanda-cc-material/` |
| Vanliga frågor | Selected HQ FAQ, translated, plus Sweden-specific items from `/faq-2/` |
| Blogg / Nyheter | Migrate old archive; new posts can summarize HQ blog |
| Medverka | Old `/intresseanmalan/` roles |
| Kontakt | Chapter email, list, people — not HQ contact |
| Integritet / Villkor | New if self-hosted; else link HQ |

## 8. Swedish legal and license specifics

- **4.0 International** is jurisdiction-neutral and has official Swedish translations of deed and legal code (`deed.sv`, `legalcode.sv`).
- **2.5 Sverige** is a ported suite (`/licenses/{by,by-sa,by-nd,by-nc,by-nc-sa,by-nc-nd}/2.5/se/`). Still valid for existing works. Not recommended for new licensing.
- There is **no 4.0 Sweden port**; that is by design.
- Chapter sites must include a **prominent disclaimer that the website does not provide legal advice**.
- Country participants must not give legal advice in a chapter capacity ([Chapter Standards](https://github.com/creativecommons/global-network-strategy/blob/master/docs/chapters-standards.md)).
- Self-hosted chapter domains need their own integritetspolicy, cookie notice, and terms under GDPR / *dataskyddsförordningen*. The current `/privacy-policy/` is an empty WordPress default.

## 9. Phased work

Execute these phases in the **okfse fork**, not as a patch series against HQ `main` without a fork.

### Phase 0 — Repository

- Create the okfse repo (name TBD: `cc-sweden-theme` / `vocabulary-theme-se`) from this snapshot
- Add `upstream` remote to `creativecommons/vocabulary-theme`
- Document GPL-2.0-or-later (theme code), Vocabulary CC0, trademark caveats for logos
- Keep this `ROADMAP.md`
- Note Open Knowledge Sweden hosts the code; public identity remains Creative Commons Sverige

### Phase 1 — Chapter identity (blocking)

- Product lockup `identity-logo product` → “Creative Commons Sverige”
- Theme headers: Theme Name, Author, Text Domain
- Header/footer: Swedish chrome, chapter contact, chapter social
- `lang="sv-SE"`
- Legal-advice disclaimer in footer (and preferably the `notice` CPT for a top-of-site banner)
- Favicon: official CC set

### Phase 2 — Internationalization

- `load_theme_textdomain`
- Wrap remaining English UI strings
- Ship `languages/sv_SE.po` / `.mo`
- Date/number formatting via WordPress locale, not hardcoded US formats
- Search, 404, pagination, form labels

### Phase 3 — Slim the theme to a chapter site

- Drive primary and footer nav from WP menus
- Keep templates: blog/archive, single post, pages, events, people, FAQ, notices
- Retire or do not register HQ CPTs/templates Sweden will not use (courses, campaigns, HQ home narrative, chooser clone unless wanted)
- Homepage: chapter-sized (intro, latest news, how to license, contribute, contact) — not the HQ 20-year story
- License explainer page template that links out to official deeds rather than cloning the chooser

### Phase 4 — Swedish licenses and education (HQ remix)

**Theme scaffolding done.** `src/inc/licenses.php` holds the licence table (six
4.0 licences plus CC0 and PDM: abbreviations, Swedish names, elements,
`deed.sv` / `legalcode.sv`, badges, summaries, 2.5 SE ports).
`page_licenses.php` renders from it via `content-partials/license-card.php`,
plus partials for the public-domain tools, the chooser deep link and the 2.5
Sverige archive. `vocab_license_attribution()` carries the CC BY 4.0 credit.
**Editorial drafts done.** `content/sv/` holds Swedish drafts of Symboler och
förkortningar, Så märker du ditt verk, Så använder du CC-material and Vanliga
frågor, built into a WordPress import file by
`scripts/build-content-wxr.py`. They embed the licence shortcodes from
`src/inc/license-shortcodes.php` rather than restating the licences.
Remaining: a native-speaker review of the Swedish, and the Swedish license-name
discrepancy between CC's index and its deed pages.

- Pages from the copy/adopt/remix matrix: Licenserna (HQ 4.0 structure, Swedish names), symboler, hur man licensierar, hur man använder, FAQ
- Always **link** `deed.sv` and `legalcode.sv` for 4.0; do not re-host legal tools
- Keep 2.5 SE as an archive section with HQ’s “older version / prefer 4.0” notice
- Chooser: deep-link `creativecommons.org/choose/?lang=sv`
- Attribute adapted HQ prose (CC BY 4.0) on each remixed page
- Use in-theme license badges; prefer NC-EU artwork for NonCommercial in a Swedish/EU context

### Phase 5 — Content migration from se.creativecommons.net

- Export posts, pages, media, categories (`Nyheter`, `event`)
- Redirect map for every indexed URL in the current sitemaps
- Review and refresh `/om-cc/` (history is valuable; roster needs an editorial pass)
- Import or rewrite privacy/terms for GDPR
- Preserve permalink dates for the blog archive (2004–2026)

### Phase 6 — Policy, hosting, verification

**Done except hosting.** The accessibility pass and the cookie/analytics audit
are complete and recorded in `docs/BRAND.md`: two WCAG AA contrast failures
fixed, ARIA state added to the navigation toggles, one `h1` per page, the skip
link made focusable, and confirmation that a live page loads nothing from a
third party and sets no cookies. Still open: the domain decision, the resulting
policy pages, and browser verification at desktop and mobile widths, which
needs a person.

- Confirm domain strategy: keep `se.creativecommons.net` (HQ multisite) vs self-host `creativecommons.se` (chapter owns privacy/terms)
- Cookie and analytics choice (no non-essential trackers without consent)
- Accessibility pass (alt text, contrast, skip link already present)
- Visual check against Vocabulary (not against 2019 print hexes)
- Browser verification of header/footer, blog, license pages, contact, mobile and desktop

### Phase 7 — Optional Chapter Logo

- Only if the chapter wants a mark beyond the Accidenz lockup
- Design constraints from the Style Guide + Chapter Logo Policy
- Submit to `legal@creativecommons.org`
- After approval, add SVG under `vocabulary/svg/cc/logos/` (chapter folder) and point `identity-logo` at it

## 10. Open decisions

Record answers here when the chapter decides; none of these block starting Phase 0–1.

- [x] **Repository name under `okfse`** — `okfse/vocabulary-theme`, keeping the upstream name so the fork relationship is obvious. Work happens on `main`; `upstream/main` is the mirror. Release archives use the stable theme slug `vocabulary-theme-se`.
- [x] **Display name** — site title “Creative Commons Sverige”; the masthead lockup is typeset `cc sverige`, matching how Vocabulary sets product lockups (`cc chooser`, `cc search`). Configured via `identity_text` / `identity_style` in `src/inc/site-config.php`.
- [ ] Domain and hosting (HQ subdomain vs `creativecommons.se`)
- [x] **Local license chooser** — no. `src/chooser/` and `static-templates/static-chooser.php` stay in the repo but dormant (the latter has no `Template Name:` header, so it is unreachable). Phase 4 adds a “Välj licens” page deep-linking `creativecommons.org/choose/?lang=sv`.
- [x] **Chapter Logo** — stay with the Accidenz product lockup. Phase 7 remains open if the chapter later wants an approved mark.
- [x] **HQ CPTs** — leave dormant, delete nothing. `course`, `course_unit`, `course_chapter`, `course_group`, `campaign`, `program`, `project`, `case-study`, `topic-feature`, `training` and the `group` taxonomy are `"active": false` in `src/inc/acf-json/`; re-enabling any of them is a one-word edit. Active: `post`, `page`, `person`, `notice`, `event`, `faq_item`, `faqs-group`, `topic-feature-category`. HQ page templates are likewise retired by commenting out their `Template Name:` header, not by deletion.
- [ ] Newsletter: HQ subscribe, a Swedish list, or omit — currently omitted; `newsletter_url` in `src/inc/site-config.php` is empty, which hides the footer block entirely.
- [ ] Relationship wording between Open Knowledge Sweden (code host) and CC Sweden (chapter identity)

## 11. Sources

- `Creative-Commons-Style-Guide-2019.pdf` in this repository
- [CC Policies](https://creativecommons.org/policies/) (trademark, chapter logo, internet services, licensing statement)
- [Chapter Standards](https://github.com/creativecommons/global-network-strategy/blob/master/docs/chapters-standards.md)
- [Downloads / press kit](https://creativecommons.org/mission/downloads/)
- [The CC Licenses](https://creativecommons.org/cc-licenses/), [FAQ](https://creativecommons.org/faq/), [chooser](https://creativecommons.org/choose/?lang=sv)
- Live site [se.creativecommons.net](https://se.creativecommons.net/) and its Yoast sitemaps
- [CC Sweden chapter profile](https://network.creativecommons.org/chapter/cc-sweden/)
- Theme files: `src/header.php`, `src/footer.php`, `src/style.css`, `src/functions.php`, `src/vocabulary/css/vocabulary.css`, `src/vocabulary/css/library-vars.css`
