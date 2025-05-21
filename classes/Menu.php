<?php

namespace bvdputte\Menu;

use \Kirby\Cms\Page;
use \Kirby\Cms\Pages;
use \Kirby\Cms\Site;

class Menu
{
	// Renders a menu, based on it's type using a snippet
	public static function render (String $id, Site|Page $context, String|null $snippet=null): String
	{
		// Check if `$id` exists as field in `site` blueprint
		if (!array_key_exists($id, $context->blueprint()->fields())) {
			return "";
		}

		// If there's a snippet defined; use this
		if (!is_null($snippet)) {
			return snippet($snippet, compact("id", "context"), true);
		}

		// If there is a custom snippet `menu-id` for this menu id; use this
		$customSnippet = snippet('menu/'.$id, compact("id", "context"), true);
		if ($customSnippet !== "") {
			return $customSnippet;
		}

		// Use snippet supplied with plugin
		if(array_key_exists('menutype', $context->blueprint()->fields()[$id])) {
			return snippet('menu/'.$context->blueprint()->fields()[$id]['menutype'], compact("id", "context"), true);
		} else {
			throw new Exception('No `menutype` defined for menu ' . $id);
		}
	}

	// Returns a `pages` object with all `page` objects in the menu
	// - all other types are discarded
	public static function pages (String $id, Site|Page $context): Pages
	{
		$pages = new Pages();

		if ($context && $context->$id()->exists()) {
			foreach($context->$id()->toStructure() as $menuItem) {
				if (
					($menuItem->item()->value()) &&
					($page = page($menuItem->item()->toLinkObject()->link()->value()))
				) {
					// Singlemenu
					$pages->add($page);
				} else {
					// Multiplemenu
					foreach($menuItem->items()->toStructure() as $menusItem) {
						if ($page = page($menusItem->item()->toLinkObject()->link()->value())) {
							$pages->add($page);
						}
					}
				}
			}
		}

		return $pages;
	}
}
