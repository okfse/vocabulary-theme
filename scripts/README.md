# Scripts

- `prepare-release.sh` — stages the theme for packaging: creates a
  `prep-<version>` branch, moves `src/*` to the repository root and removes the
  development scaffolding.
- `build-se-zip.sh` — builds `vocabulary-theme-se.zip` from the staged files,
  with a stable top-level directory so the theme slug does not change between
  versions.
- `unprepare-release.sh` — undoes `prepare-release.sh` while developing the
  release process. Not part of a normal release. Invoke as:
  ```shell
  git restore scripts && ./scripts/unprepare-release.sh
  ```

- `build-content-wxr.py` — turns the Swedish page drafts in `content/sv/` into a
  WordPress import file. Requires Python 3. See
  [`docs/INSTALL.md`](../docs/INSTALL.md) section 7.

The full release procedure is in [`docs/RELEASE.md`](../docs/RELEASE.md).
