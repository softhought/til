<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProductsMenu extends CI_Model
{

    public function getProductsMenu()
    {
        $result = $this->db->select('id, name, slug, parent_id')->where('is_disabled', '0')->get("fuel_catagory")->result_array();
        $menu = $this->buildNestedMenu($result, 0);
        return $this->generateMenuHTML($menu[0]["children"]);
    }

    private function buildNestedMenu($menuItems, $parentId)
    {
        $result = array();

        foreach ($menuItems as $menuItem) {
            if ($menuItem['parent_id'] == $parentId) {
                $children = $this->buildNestedMenu($menuItems, $menuItem['id']);

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
}
