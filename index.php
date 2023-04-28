<?php

Kirby::plugin('bvdputte/kirby-menus', [
    'blueprints' => [
        'fields/menulink' => __DIR__ . '/blueprints/fields/link.yml',
        'fields/singlemenu' => __DIR__ . '/blueprints/fields/single.yml',
        'fields/multiplemenu' => __DIR__ . '/blueprints/fields/multiple.yml',
        'fields/social' => __DIR__ . '/blueprints/fields/social.yml'
    ],
    'snippets' => [
        'menu/render-menu' => __DIR__ . '/snippets/menu.php',
        'menu/single' => __DIR__ . '/snippets/single.php',
        'menu/multiple' => __DIR__ . '/snippets/multiple.php',
        'menu/social' => __DIR__ . '/snippets/social.php'
    ],
    'siteMethods' => [
        // Returns a `pages` object with all `page` objects in the menu
        // - all other types are discarded
        'menuPages' => function($id) {
            $pages = new Pages();

            if ($this->$id()->exists()) {
                foreach($this->$id()->toStructure() as $menuItem) {
                    $linkItem = $menuItem->item()->toLinkObject();

                    if(($linkItem->isNotEmpty()) && ($linkItem->type() === "page") && (!is_null(page($linkItem->value())))) {
                        $pages->add($linkItem->value());
                    }
                }
            }

            return $pages;
        },
        // Renders a menu, based on it's type using a snippet
        'menu' => function($id, $snippet=null) {
            // Check if `$id` exists as field in `site` blueprint
            if (!array_key_exists($id, $this->blueprint()->fields())) {
                return "";
            }

            // If there's a snippet defined; use this
            if (!is_null($snippet)) {
                return snippet($snippet, compact("id"), true);
            }

            // If there is a custom snippet `menu-id` for this menu id; use this
            $customSnippet = snippet('menu/'.$id, compact("id"), true);
            if ($customSnippet !== "") {
                return $customSnippet;
            }

            // Use snippet supplied with plugin
            if(array_key_exists('menutype', $this->blueprint()->fields()[$id])) {
                return snippet('menu/'.$this->blueprint()->fields()[$id]['menutype'], compact("id"), true);
            } else {
                throw new Exception('No `menutype` defined for menu ' . $id);
            }
        },
        // Renders a menu with social networks
        'socialmenu' => function() {
            return snippet("menu/social", [], true);
        }
    ]
]);
