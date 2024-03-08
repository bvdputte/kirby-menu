# Menu utility for Kirby 3

By default Kirby makes it easy to work with content that has 1 primary navigation. If you need multiple, or need to add items to your navigation which are no Kirby pages, you need to come up with a solution. This plugin is an opinionated utility to make it easier to work with menus in a (multilingual) kirby 3 setup, based on the [menu-builder cookbook recipe](https://getkirby.com/docs/cookbook/templating/menu-builder).

## Installation

- ⚠️ This plugin is dependent on the [kirby-linkobject plugin](https://github.com/bvdputte/kirby-linkobject)
- unzip [master.zip](https://github.com/bvdputte/kirby-menu/archive/master.zip) as folder `site/plugins/kirby-menu` or
- `git submodule add https://github.com/bvdputte/kirby-menu.git site/plugins/kirby-menu`

## Use

1. Add a menu to your `site.yml` blueprint, based on the [available menu types](#types)
2. Add some items to your new menu
2. Use the `$site->menu("id");` helper in your snippets or templates to render the menu

### Optional

#### Customize html output: use your own snippets

You can render custom your menus by

1. @auto: create a specific snippet for your menu
  - Add a custom snippet to `site/snippets/menu/{menu-fieldname}.php`
  - E.g. for `primarynav` there should be a snippet in `site/snippets/menu/primarynav.php`
2. Use a parameter
  - E.g. use `site/snippets/my-custom-snippet.php`: `<?= $site->menu("primarynav", "my-custom-snippet") ?>`

⚠️ It's a good idea to use one of the provided snippets in this plugin's `snippets` folder as boilerplate and customize it further.

You can override the default options in the blueprint as you would with any extended field or field group. Theoretically, you can even create your own if you'ld like by using the `structure>link` field logic.

#### Use your navigations as "pseudo"-pages sections in your `site.yml`

```
primarycontent:
  headline: Primary content
  type: pagesdisplay
  query: site.menuPages('primarynav') # the parameter should match with the fieldname of the menu you want to display its pages here
  help: Manage the primary nav via the "navigations" tab
```

- ⚠️ You need to install [k3-pagesdisplay-section](https://github.com/rasteiner/k3-pagesdisplay-section) to visualize navigations as pages sections in the panel.
- ⚠️ This will only work with internal page links

## Types

### Simple menu

A simple menu that contains items (internal page, external link, email, phone or file) - 1 level deep

Common use case: primary navigation, legal disclaimers, ...

Example for adding a `primarynav` menu to your `site.yml` blueprint:

```
primarynav:
  extends: fields/singlemenu
  label: Primary navigation
  max: 4
```

Render in template/snippet: `<?= $site->menu("primarynav") ?>`

### Multiple simple menu's

Collection of simple menu's

Common use case: doormat navigation (e.g. in a footer)

Example for adding a `footerdormatnav` to your `site.yml` blueprint:

```
footerdoormatnav:
  extends: fields/multiplemenu
  label: Footer doormat navigation
  max: 4
```

Render in template/snippet: `<?= $site->menu("footerdoormatnav") ?>`

## Extra's

### Social menu

Another common use case is social media menu that contains links to different social media platforms.

Example for adding these `social` profiles to your `site.yml` blueprint:

```
social: fields/social
```

Render in template/snippet: `<?= $site->socialmenu() ?>`
⚠️ In the default setup, these fields are not translatable. But you can override with `extends` if needed.
