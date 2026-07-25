# Blueprint for Flarum (`gradba/flarum-blueprint`)

**A clean, recolourable theme built around a faint blueprint grid.** Soft cards on a
warm off-white page, a primary button that presses like a physical key, and one accent
colour used sparingly enough that it still means something.

## Why another theme?

Most Flarum themes recolour the chrome and stop, which leaves you with stock Flarum in
a different hue. Blueprint changes the three things that actually decide how a forum
feels — the page surface, the card treatment, and where the accent is allowed to appear
— and it does so by replacing Flarum's LESS variables rather than piling overrides on
top, so the values core derives from them (hover states, muted text, control surfaces)
stay consistent instead of drifting.

It is opinionated about one thing in particular: **one accent per view.** The primary
colour is for the primary action. It is deliberately kept off the header, off the side
navigation and off links, because an accent that appears in six places is no longer an
accent. Links and "you are here" states use the secondary colour instead.

Everything is driven by five settings, so the look is yours, not the author's.

## Settings

**Admin → Extensions → Blueprint:**

- **Primary colour** — the accent, used for the primary button and little else.
- **Secondary colour** — links, focus rings, active navigation. Also the hue Flarum
  derives its muted text and control surfaces from, so keep it desaturated.
- **Page background** — a slightly warm off-white reads softer than pure white and lets
  the cards separate from the page.
- **Show the blueprint grid** — the faint two-line grid the theme is named for, drawn in
  the same colour as the borders.
- **Grid pitch** — spacing of those lines in pixels. 56 by default.

Blueprint expects Flarum's **coloured header setting to be off** (Admin → Appearance).
It renders correctly either way, but a full-bleed accent bar competes with the primary
button on every page.

No logo ships with the theme — set `logo_path` through Admin → Appearance and the header
styling picks it up. Flarum falls back to the forum title as text if you don't.

## A note on upgrades

`resources/less/variables.less` is a **copy of Flarum's own
`less/common/variables.less`**, substituted via `Extend\Theme->overrideFileSource()`.
That is the only way to reach `@body-bg` and the other values core assigns inside its
`.define-colors()` mixin, which cannot be changed by appending LESS afterwards.

Every deviation from core is marked with a `// BLUEPRINT:` comment. On a Flarum upgrade,
diff the file against `vendor/flarum/core/less/common/variables.less` and re-apply.
Currently tracking **Flarum 1.8.10**.

## Development

```bash
composer install
cd js && npm ci && npm run build     # only needed if you change the admin settings UI
```

Target: Flarum `^1.8`.

## License

MIT. See [LICENSE](LICENSE).
