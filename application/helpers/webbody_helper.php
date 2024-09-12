<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('webbody_helper')) {
    function webbody_helper($body_content_data, $body_content_page)
    {
        $CI =& get_instance();
        $heared_menu_content = [];
        $body_content_header = [];
        $CI->load->model('ProductsMenu', 'productsmenu', TRUE);
        $CI->load->model('commondatamodel', 'commondatamodel', TRUE);

        $data['bodyview'] = $body_content_page;
        $data['leftmenusidebar'] = '';
        $data['headermenu'] = $body_content_header;
        // $data['user']=$session['name'];

        $result["product_menu"] = $CI->productsmenu->getProductsMenu();
        $result["country"] = $CI->commondatamodel->getAllDropdownData("tbl_countries");
        $result["nature_of_query"] = $CI->commondatamodel->getAllRecordOrderByWhere("fuel_nature_of_query", "precedence", "ASC", ['is_disabled' => 0]);

        $mainurl = substr(current_url(), strlen(base_url()));
        $mainurl = $mainurl == "" ? "home" : $mainurl;
        $result["seo_details"] = $CI->commondatamodel->getSingleRowByWhereCls("seo_details", ["page_url" => $mainurl]);

        if (empty($result["seo_details"])) {
            $result["seo_details"] = $CI->commondatamodel->getSingleRowByWhereCls("seo_details", ["page_url" => "home"]);
        }

        $faqMenu = $CI->commondatamodel->getSingleRowByWhereCls("faq_details", ["is_disabled" => 0]);
        if (!empty($faqMenu)) {
            $result["faqMenu"] = true;
        }

        $CI->template->setHeader($heared_menu_content);
        $CI->template->setBody($body_content_data);
        $CI->template->setMenu($result);

        $CI->template->view('layout/default_web', array('body' => $body_content_page), $data);
    }
}
