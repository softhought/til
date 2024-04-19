<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProductsMenu extends CI_Model
{

    public function getProductsMenu()
    {
        $result = $this->db->select('product_master_id, name, slug, parent_id')->where('is_disabled', '0')->get("product_master")->result_array();
        $menu = $this->buildNestedMenu($result, 0);
        return $this->generateMenuHTML($menu[0]["children"]);
    }

    public function getNavProductsMenu()
    {
        $result = $this->db->select('product_master_id, name, slug, parent_id')->where('is_disabled', '0')->get("product_master")->result_array();
        return $this->buildNestedMenu($result, 0);
    }

    private function buildNestedMenu($menuItems, $parentId)
    {
        $result = array();

        foreach ($menuItems as $menuItem) {
            if ($menuItem['parent_id'] == $parentId) {
                $children = $this->buildNestedMenu($menuItems, $menuItem['product_master_id']);

                if ($children) {
                    $menuItem['children'] = $children;
                }

                $result[] = $menuItem;
            }
        }

        return $result;
    }

    function generateMenuHTML($menuItems, $isSubNav = false, $parentSlugs = [])
    {
        $html = '<ul class="dropdown-menu dropdownhover-bottom">';
        foreach ($menuItems as $key => $menuItem) {
            $hasChildren = isset($menuItem['children']) && !empty($menuItem['children']);
            $subNavClass = ($hasChildren) ? 'sub_nav' : '';

            $url = base_url() . 'products/';
            foreach ($parentSlugs as $slug) {
                $url .= $slug . '/';
            }
            $url .= $menuItem['slug'];

            $html .= '<li>';
            $html .= '<a href="' . $url . '" class="' . $subNavClass . '">' . $menuItem['name'];
            if ($hasChildren) {
                $html .= ' <span class="caret"></span>';
            }
            $html .= '</a>';
            if ($hasChildren) {
                $childSlugs = array_merge($parentSlugs, [$menuItem['slug']]);
                $html .= $this->generateMenuHTML($menuItem['children'], true, $childSlugs);
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    function generateMenuHTML1($menuItems, $isSubNav = false, $parentSlugs = [])
    {
        $html = '<ul id="menu-thank-you" class="pro_left">'; // Adding the pro_left class to match the provided HTML structure

        foreach ($menuItems as $key => $menuItem) {
            $hasChildren = isset($menuItem['children']) && !empty($menuItem['children']);

            $html .= '<li>'; // Start menu item
            $html .= '<a href="' . $menuItem['url'] . '" class="sub_nav">' . $menuItem['name']; // Link with sub_nav class

            if ($hasChildren) {
                $html .= '<span class="caret"></span>'; // Add caret icon for items with children
            }

            $html .= '</a>';

            if ($hasChildren) {
                $html .= '<ul>'; // Start submenu
                $html .= $this->generateMenuHTML($menuItem['children'], true, $parentSlugs);
                $html .= '</ul>'; // End submenu
            }

            $html .= '</li>'; // End menu item
        }
        $html .= '</ul>';
        return $html;
    }

}
