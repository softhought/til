<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once BASEPATH . 'database/DB.php';

if (!function_exists('getAllMenuUrl')) {
    function getAllMenuUrl($table)
    {
        $db =& DB();
        $result = $db->select('product_master_id, name, slug, parent_id')->where('is_disabled', '0')->get($table)->result_array();
        $menu = buildNestedMenu($result, 0);
        return menuUrls($menu[0]["children"]);
    }
}


if (!function_exists('isNew')) {
    function isNew()
    {
        $isNew = IS_NEW_DEVELOPMENT != false ? false : true;
        return $isNew ? "new/" : "";
    }
}
 
if (!function_exists('isNewDevelopmentLive')) {
    function isNewDevelopmentLive()
    {
        return IS_NEW_DEVELOPMENT;
    }
}

if (!function_exists('buildProductNestedMenu')) {
    function buildProductNestedMenu()
    {
        $db =& DB();
        $result = $db->select('product_master_id, name, slug, parent_id')->where('is_disabled', '0')->get('product_master')->result_array();
        return buildNestedMenu($result, 0);
    }
}

if (!function_exists('getAllModelUrl')) {
    function getAllModelUrl($table)
    {
        $db =& DB();
        $result = $db->select('product_master_id, name, slug, parent_id')->where('is_disabled', '0')->get($table)->result_array();
        $menu = buildNestedMenu($result, 0);
        return menuUrls($menu[0]["children"]);
    }
}

if (!function_exists('getAllInvestorMenu')) {
    function getAllInvestorMenu($table)
    {
        $db =& DB();
        $result = $db->select('*')->where('is_disabled', '0')->get($table)->result_array();
        return $result;
    }
}

function buildNestedMenu($menuItems, $parentId, $depth = 0)
{
    $result = array();

    foreach ($menuItems as $menuItem) {
        if ($menuItem['parent_id'] == $parentId) {

            $menuItem['level'] = $depth;
            $children = buildNestedMenu($menuItems, $menuItem['product_master_id'], $depth + 1);

            if ($children) {
                $menuItem['children'] = $children;
            } else {
                $specSheetDetails = fetchSpecSheetDetails($menuItem['product_master_id']);
                if ($specSheetDetails) {
                    $menuItem['children'] = array_map(function($detail) use ($depth) {
                        $detail['level'] = $depth + 1;
                        return $detail;
                    }, $specSheetDetails);
                }
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
        $url = 'category/';
        foreach ($parentSlugs as $slug) {
            $url .= $slug . '/';
        }
        $url .= $menuItem['slug'];
        $urls[] = [
            'slug' => $menuItem['slug'],
            'url' => $url,
            'level' => $menuItem['level'],
            'product_master_id' => $menuItem['product_master_id'],
            'spec_sheet_dt_id' => isset($menuItem['spec_sheet_dt_id']) ? $menuItem['spec_sheet_dt_id'] : null,
        ];
        if (isset($menuItem['children']) && !empty($menuItem['children'])) {
            $childSlugs = array_merge($parentSlugs, [$menuItem['slug']]);
            $urls = array_merge($urls, menuUrls($menuItem['children'], $childSlugs));
        }
    }
    return $urls;
}

function fetchSpecSheetDetails($productMasterId)
{
    $db =& DB();
    $specSheetDetails = $db->select('spec_sheet_dt_id, model, slug, product_master_id')->where('product_master_id', $productMasterId)->get('spec_sheet_details')->result_array();
    
    return $specSheetDetails;
}