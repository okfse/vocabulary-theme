#!/bin/bash
#
# Build the installable theme archive for a release.
#
# GitHub's auto-generated release archives are named after the tag, so their
# top-level directory changes with every version. WordPress derives the theme's
# slug from that directory, which means each update would install as a brand new
# theme -- and nav menu location assignments, which are stored per theme, would
# come unassigned every time.
#
# This script produces an archive with a stable top-level directory instead.
# Run it after prepare-release.sh has staged the theme files at the repository
# root, and attach the result to the GitHub Release.
set -o errexit
set -o errtrace
set -o nounset

THEME_SLUG='vocabulary-theme-se'
ARCHIVE="${THEME_SLUG}.zip"
STAGING='.release'

HEAD_FMT='\033[1m\033[7m'
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m'

die() {
    {
        echo
        echo -e "${RED}${1}${NC}"
        echo
    } 1>&2
    exit 1
}

# Operate on the current directory, which must already hold the staged theme.
# (Unlike the other scripts here, this one is not run from the repository root
# in its development layout -- prepare-release.sh moves src/* up to the root
# first, and then deletes ./scripts, so it invokes a copy of this script.)
command -v zip >/dev/null || die 'zip is not installed.'

[[ -f ./style.css ]] \
    || die "style.css not found in $(pwd). Run ./scripts/prepare-release.sh vX.Y-se.N from the repository root first, which builds the archive for you." 

VERSION=$(sed -n 's/^Version:[[:space:]]*//p' ./style.css | head -1)

printf "${HEAD_FMT} %-80s${NC}\n" "Build ${ARCHIVE} (theme version ${VERSION})"

rm -fr -- "${STAGING}"
rm -f -- "${ARCHIVE}"
mkdir -p -- "${STAGING}/${THEME_SLUG}"

# Copy the staged theme into a directory named after the stable theme slug.
tar \
    --exclude='./.git' \
    --exclude="./${STAGING}" \
    --exclude="./${ARCHIVE}" \
    -cf - . \
    | ( cd -- "${STAGING}/${THEME_SLUG}" && tar -xf - )

( cd -- "${STAGING}" && zip -q -r -X "../${ARCHIVE}" "${THEME_SLUG}" )
rm -fr -- "${STAGING}"

# Keep the archive out of the release commit. prepare-release.sh deletes
# .gitignore as part of its clean-up, so without this the 11MB artifact is
# untracked-but-not-ignored and `git add -A` would commit it into the prep
# branch. .git/info/exclude is local to the clone and never packaged.
GIT_COMMON_DIR="$(git rev-parse --git-common-dir 2>/dev/null || true)"
if [[ -n "${GIT_COMMON_DIR}" ]] && [[ -d "${GIT_COMMON_DIR}/info" ]]
then
    grep -qxF "${ARCHIVE}" "${GIT_COMMON_DIR}/info/exclude" 2>/dev/null \
        || echo "${ARCHIVE}" >> "${GIT_COMMON_DIR}/info/exclude"
fi

echo 'done.'
echo

printf "${HEAD_FMT} %-80s${NC}\n" 'Archive top level'
unzip -l "${ARCHIVE}" 2>/dev/null \
    | sed -n "s|.*\(${THEME_SLUG}/[^/]*/\?\)$|\1|p" | sort -u \
    || echo '(install unzip to list contents)'
echo

printf "${HEAD_FMT} %-80s${NC}\n" 'Next steps'
echo 'Attach this archive to the GitHub Release:'
echo
echo -e "    ${GREEN}${ARCHIVE}${NC}"
echo
