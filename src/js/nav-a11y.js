/*
 * Keep the navigation toggles' ARIA state in step with the DOM.
 *
 * vocabulary.js toggles a `hide` class on each submenu and an `expand` class on
 * the primary menu panel, but updates no ARIA, so assistive technology was told
 * nothing about whether a menu was open. This reads the classes rather than
 * tracking state of its own, so it stays correct whatever vocabulary.js does --
 * and it must load after vocabulary.js, which sets the initial hidden state.
 */
(function () {
    'use strict';

    function submenuOf(button) {
        return button.parentElement ? button.parentElement.querySelector('ul') : null;
    }

    function syncSubmenu(button) {
        var submenu = submenuOf(button);

        if (!submenu) {
            return;
        }

        button.setAttribute('aria-expanded', submenu.classList.contains('hide') ? 'false' : 'true');
    }

    Array.prototype.forEach.call(document.querySelectorAll('button.expand'), function (button) {
        syncSubmenu(button);

        // Run after vocabulary.js's own click handler has toggled the class.
        button.addEventListener('click', function () {
            window.setTimeout(function () {
                syncSubmenu(button);
            }, 0);
        });
    });

    var menuButton = document.querySelector('button.expand-menu');
    var menuPanel = document.querySelector('.primary-menu');

    if (menuButton && menuPanel) {
        var syncMenu = function () {
            menuButton.setAttribute('aria-expanded', menuPanel.classList.contains('expand') ? 'true' : 'false');
        };

        syncMenu();

        menuButton.addEventListener('click', function () {
            window.setTimeout(syncMenu, 0);
        });
    }
})();
