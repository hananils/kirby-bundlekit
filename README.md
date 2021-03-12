# Proof of Concept: Simple Self-bundling Panel Plugin for Kirby 3

Experimental template for Kirby 3 panel plugins that creates its plugin definition from a Vue single file component on the fly.

1. Write your component's template and script in `index.vue`.
2. Write your CSS in `index.css`.

On panel load, `index.js` will be created (or updated) with the plugin definition as described in <https://getkirby.com/docs/cookbook/panel/to-bundle-or-not-to-bundle>.

### Pros

-   No need to setup any bundling tools.
-   Nonetheless, let's you write single file Vue components which gives you nice syntax highlighting in your editor of choice.

### Cons

-   No hot-reloading in the browser.
-   Only suitable for simple plugins without dependencies.
-   The hook that creates the bundled JavaScript file needs to be adapted to the type of plugin required. This example created a custom section, `type: customsection`.

# Acknowledgement

This is a variation of <https://github.com/bastianallgeier/phew>.
