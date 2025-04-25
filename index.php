<?php

require __DIR__ . '/classes/Menu.php';

Kirby::plugin('bvdputte/kirby-menus', [
	'blueprints' => [
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
		'menuPages' => function ($id, $context = null) {
			$context ??= $this;
			return bvdputte\Menu\Menu::pages($id, $context);
		},
		'menu' => function ($id, $snippet = null, $context = null) {
			$context ??= $this;
			return bvdputte\Menu\Menu::render($id, $snippet, $context);
		},
		// Renders a menu with social networks
		'socialmenu' => function () {
			return snippet("menu/social", [], true);
		}
	],
	'pageMethods' => [
		'menuPages' => function ($id, $context = null) {
			$context ??= $this;
			return bvdputte\Menu\Menu::pages($id, $context);
		},
		'menu' => function ($id, $snippet = null, $context = null) {
			$context ??= $this;
			return bvdputte\Menu\Menu::render($id, $snippet, $context);
		}
	]
]);
