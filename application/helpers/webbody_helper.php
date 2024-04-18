<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('webbody_helper')) {
    function webbody_helper($body_content_data, $body_content_page)
    {
        $CI =& get_instance();
        $heared_menu_content = [];
        $body_content_header = [];
        $CI->load->model('ProductsMenu', 'productsmenu', TRUE);

        $data['bodyview'] = $body_content_page;
        $data['leftmenusidebar'] = '';
        $data['headermenu'] = $body_content_header;
        // $data['user']=$session['name'];

        $result["product_menu"] = $CI->productsmenu->getProductsMenu();

        $CI->template->setHeader($heared_menu_content);
        $CI->template->setBody($body_content_data);
        $CI->template->setMenu($result);

        $CI->template->view('layout/default_web', array('body' => $body_content_page), $data);
    }
}
