<?php

/*
 * This file is part of gradba/flarum-blueprint.
 *
 * A theme is mostly a set of variable values, and Flarum makes exactly one of
 * them awkward to reach. `@body-bg` is assigned inside core's `.define-colors()`
 * mixin, not at root scope, so redeclaring it in appended LESS does not work —
 * and it does not retroactively change the values core derives from it either
 * (`@code-bg`, `@overlay-bg`, `--body-bg-shaded`, the `.Button--color-vars()`
 * palettes in root.less). Since this theme's whole premise is a warm off-white
 * page rather than pure white, that variable is not optional.
 *
 * So the theme replaces core's `variables.less` wholesale via Extend\Theme,
 * which substitutes it at the very front of the compile. Flarum still appends
 * its settings-derived `@config-*: …;` string afterwards, so the admin colour
 * pickers and the settings below continue to win — the same lazy-evaluation
 * order core relies on. See resources/less/variables.less for what changed.
 *
 * For detailed copyright and license information, see the LICENSE file.
 */

use Flarum\Extend;

return [
    // --- Frontend assets ---------------------------------------------------
    (new Extend\Frontend('forum'))
        ->css(__DIR__.'/resources/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    // --- Theme -------------------------------------------------------------
    //
    // No logo or imagery ships with this theme, deliberately. A theme anyone can
    // install must not carry one site's mark, and Flarum already falls back to
    // rendering the forum title as text when `logo_path` is unset. Point that
    // setting at your own file and the header styling below picks it up.
    (new Extend\Theme())
        ->overrideFileSource('variables.less', __DIR__.'/resources/less/variables.less'),

    // --- Settings ----------------------------------------------------------
    // registerLessConfigVar repoints core's OWN LESS variables at our setting keys,
    // so the theme stays recolourable from the admin panel instead of hard-coding a
    // single brand. The defaults below are Gradba.mk's palette.
    (new Extend\Settings())
        ->registerLessConfigVar('config-primary-color', 'gradba-blueprint.primaryColor')
        ->registerLessConfigVar('config-secondary-color', 'gradba-blueprint.accentColor')
        ->registerLessConfigVar('blueprint-body-bg', 'gradba-blueprint.bodyBg')
        ->registerLessConfigVar('blueprint-grid-size', 'gradba-blueprint.gridSize', function ($value) {
            // Interpolated raw into the stylesheet, so coerce to a bare integer:
            // a stray unit or semicolon here is a compile failure, not a bad style.
            return ((int) $value ?: 56).'px';
        })
        ->registerLessConfigVar('blueprint-show-grid', 'gradba-blueprint.showGrid', function ($value) {
            return $value ? 'true' : 'false';
        })
        ->default('gradba-blueprint.primaryColor', '#FBB03B')
        ->default('gradba-blueprint.accentColor', '#3A5952')
        ->default('gradba-blueprint.bodyBg', '#f2ebe2')
        ->default('gradba-blueprint.gridSize', 56)
        ->default('gradba-blueprint.showGrid', true),
];
