#!/bin/bash
#
# Prepare a branch with the directory and files structured for compatibility
# with WordPress
#
set -o errexit
set -o errtrace
set -o nounset

VERSION=${1:-}
# setup fun colors for added UX
HEAD='\033[1m\033[7m'
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m'

# Change directory to repository root
# (parent directory of this script's location)
pushd "${0%/*}/.." >/dev/null

if [[ -z "${VERSION}" ]]
then
    {
        echo
        echo -en "${RED}missing VERSION argument ("
        echo -n 'format: vMAJOR.MINOR.PATCH[-se.N],'
        echo -e " example: v2.8-se.1)${NC}"
        echo
    } 1>&2
    exit 1
elif [[ ! "${VERSION}" =~ ^v[0-9]+[.][0-9]+([.][0-9]+)?(-se[.][0-9]+)?$ ]]
then
     {
        echo
        echo -e "${RED}invalid VERSION argument: ${VERSION}${NC}"
        echo
     } 1>&2
     exit 1
else
    printf "${HEAD} %-80s${NC}\n" 'Checkout prep branch'
    git checkout -b "prep-${VERSION}"
    echo

    printf "${HEAD} %-80s${NC}\n" 'Stage directories/files for release'
    # stage theme files
    mv ./src/* ./
    # keep the archive builder reachable past the clean-up below, which deletes
    # ./scripts along with the rest of the development scaffolding
    BUILD_SCRIPT="$(mktemp)"
    cp ./scripts/build-se-zip.sh "${BUILD_SCRIPT}"
    chmod +x "${BUILD_SCRIPT}"
    # remove unneeded files for release (and self destruct)
    rm -fr -- \
        ./.devcontainer \
        ./.github \
        ./docs \
        ./src \
        ./docker \
        ./scripts \
        .cc-metadata.yml \
        .env.example \
        .gitignore \
        docker-compose.yml

    echo 'done.'
    echo

    "${BUILD_SCRIPT}"
    rm -f -- "${BUILD_SCRIPT}"

    printf "${HEAD} %-80s${NC}\n" 'Repository status'
    git status --short
    echo

    printf "${HEAD} %-80s${NC}\n" 'Next steps'
    echo 'Commit and push the prepared branch:'
    echo
    echo -e "    ${GREEN}git add -A && git commit -m 'prepare release ${VERSION}'${NC}"
    echo -e "    ${GREEN}git push origin prep-${VERSION}${NC}"
    echo
    echo 'Then create the GitHub Release from that branch and upload'
    echo -e "    ${GREEN}vocabulary-theme-se.zip${NC}"
    echo 'as a release asset. See docs/RELEASE.md.'
    echo
fi
