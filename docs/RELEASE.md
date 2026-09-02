# Cutting a release

Releases of this fork are versioned `vX.Y-se.N`, where `X.Y` tracks the upstream
`creativecommons/vocabulary-theme` version the branch is merged up to, and `N`
counts Creative Commons Sverige releases on top of it. Example: `v2.8-se.1` is
the first Swedish release based on upstream v2.8.


## 1. Prepare `main`

```bash
git checkout main
git pull
git fetch upstream && git merge upstream/main   # if picking up upstream changes
```

Recompile the translation catalogue if any translatable string changed:

```bash
docker compose run --rm wordpress-cli \
  wp i18n make-pot wp-content/themes/vocabulary-theme \
     wp-content/themes/vocabulary-theme/languages/vocabulary.pot \
     --domain=vocabulary \
     --exclude=static-templates,inc/acf-json,inc/acf-backups,vocabulary,chooser
# merge new strings into src/languages/sv_SE.po, translate them, then:
docker compose run --rm wordpress-cli \
  wp i18n make-mo wp-content/themes/vocabulary-theme/languages \
     wp-content/themes/vocabulary-theme/languages
```

Commit `src/languages/vocabulary.pot`, `sv_SE.po` **and** `sv_SE.mo` — nothing
compiles the `.mo` at install time, so it has to be in the archive.

Bump `Version:` in `src/style.css` and commit.


## 2. Stage the release

```bash
./scripts/prepare-release.sh v2.8-se.1
```

This creates a `prep-v2.8-se.1` branch, moves `src/*` to the repository root
(WordPress needs `style.css` at the top level of the archive), deletes the
development scaffolding, and then runs `build-se-zip.sh` to write
**`vocabulary-theme-se.zip`**.

Review the result and commit the prepared branch:

```bash
git add -A
git commit -m 'prepare release v2.8-se.1'
```

The archive is added to `.git/info/exclude`, so `git add -A` will not commit
it. Check that with `git status` before committing — an 11MB blob in the
history is not easy to remove later.


## 3. About the archive

`vocabulary-theme-se.zip` has a **stable** top-level directory,
`vocabulary-theme-se/`.

That stability matters: WordPress takes the theme slug from the archive's top
directory, and GitHub's auto-generated archives are named after the tag. Using
those would install every update as a new theme, and nav menu **location**
assignments are stored per theme — the Primary, Footer and Social menus would
come unassigned on each update.


## 4. Publish

```bash
git push origin prep-v2.8-se.1
```

On GitHub → **Releases → Draft a new release**:

1. Target the `prep-v2.8-se.1` branch, create the tag `v2.8-se.1`.
2. Use **Generate release notes**.
3. Upload `vocabulary-theme-se.zip` as a release asset.
4. Note in the release body that the asset — not "Source code (zip)" — is the
   installable archive.
5. Publish.


## 5. Clean up

```bash
git checkout main
git branch -D prep-v2.8-se.1
git push origin --delete prep-v2.8-se.1
```


## 6. Install

Follow [`docs/INSTALL.md`](INSTALL.md). Test on `www-staging.okfn.se` before
`creativecommons.se`, and confirm on the first update that the theme slug stays
`vocabulary-theme-se` and the menu location assignments survive.
