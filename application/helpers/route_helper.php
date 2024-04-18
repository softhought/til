<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once BASEPATH . 'database/DB.php';

if (!function_exists('getAllMenuUrl')) {
    function getAllMenuUrl($table)
    {
        $db =& DB();
        $result = $db->select('id, name, slug, parent_id')->where('is_disabled', '0')->get($table)->result_array();
        $menu = buildNestedMenu($result, 0);
        return menuUrls($menu[0]["children"]);
    }
}


function buildNestedMenu($menuItems, $parentId, $depth = 0)
{
    $result = array();

    foreach ($menuItems as $menuItem) {
        if ($menuItem['parent_id'] == $parentId) {

            $menuItem['level'] = $depth;
            $children = buildNestedMenu($menuItems, $menuItem['id'], $depth + 1);

            if ($children) {
                $menuItem['children'] = $children;
            }

            $result[] = $menuItem;
        }
    }

    return $result;
}

function menuUrls($menuItems, $parentSlugs = [])
{
    $urls = [];
    foreach ($menuItems as $menuItem) {
        $url = 'products/';
        foreach ($parentSlugs as $slug) {
            $url .= $slug . '/';
        }
        $url .= $menuItem['slug'];
        $urls[] = [
            'slug' => $menuItem['slug'],
            'url' => $url,
            'level' => $menuItem['level'],
            'id' => $menuItem['id'],
        ];
        if (isset($menuItem['children']) && !empty($menuItem['children'])) {
            $childSlugs = array_merge($parentSlugs, [$menuItem['slug']]);
            $urls = array_merge($urls, menuUrls($menuItem['children'], $childSlugs));
        }
    }
    return $urls;
}