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

# Change directory to repository root
# (parent directory of this script's location)
pushd "${0%/*}/.." >/dev/null

command -v zip >/dev/null || die 'zip is not installed.'

[[ -f ./style.css ]] \
    || die 'style.css not found in the repository root. Run ./scripts/prepare-release.sh vX.Y-se.N first.'

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
