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

    public function getLastChildProducts()
    {
        $result = $this->db->select('product_master_id, name, slug, parent_id')->where('is_disabled', '0')->get("product_master")->result_array();
        $array = $this->buildNestedMenu($result, 0);

        $arr = [];
        foreach ($array[0]['children'][0]['children'] as $value) {
            foreach ($value['children'] as $childrenValue) {
                $arr[] = $childrenValue;
            }
        }

        return $arr;
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

    function generateMenuHTML($menuItems, $isSubNav = false, $parentSlugs = [], $isRoot = true)
    {
        if ($isRoot) {
            $html = '';
            foreach ($menuItems as $key => $menuItem) {
                if (isset($menuItem['children']) && !empty($menuItem['children'])) {
                    $html .= $this->generateMenuHTML($menuItem['children'], true, [$menuItem['slug']], false);
                }
            }
            return $html;
        }

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
                $html .= $this->generateMenuHTML($menuItem['children'], true, $childSlugs, false);
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }



    public function getNonParentRecords($table, $orderby, $orderTag)
    {
        $this->db->select("*")->where('is_disabled', '0')
            ->from($table)
            ->order_by($orderby, $orderTag);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data = array();
            $menu = buildNestedMenu($query->result_array(), 0);

            foreach ($this->menuUrls($menu[0]["children"]) as $row) {
                if (!$this->isChild($query->result(), $row["product_master_id"])) {
                    $data[] = $row;
                }
            }

            return $data;
        } else {
            return array();
        }
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
                'name' => $menuItem['name'],
                'short_description' => $menuItem['short_description'],
                'banner_image' => $menuItem['banner_image'],
                'catagory_image' => $menuItem['catagory_image'],
                'parent_id' => $menuItem['parent_id'],
                'url' => $url,
                'level' => $menuItem['level'],
                'product_master_id' => $menuItem['product_master_id'],
            ];
            if (isset($menuItem['children']) && !empty($menuItem['children'])) {
                $childSlugs = array_merge($parentSlugs, [$menuItem['slug']]);
                $urls = array_merge($urls, $this->menuUrls($menuItem['children'], $childSlugs));
            }
        }
        return $urls;
    }

    private function isChild($data, $product_master_id)
    {
        foreach ($data as $record) {
            if ($record->parent_id == $product_master_id) {
                return true;
            }
        }
        return false;
    }

    public function getAllRecordWhereOrderBy($table, $where, $orderby, $orderTag)
    {

        $data = array();

        $this->db->select("*")
            ->from($table)
            ->where($where)
            ->order_by($orderby, $orderTag);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $data[] = $rows;
            }
            return $data;
        } else {
            return $data;
        }
    }
}
