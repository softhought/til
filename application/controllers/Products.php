<?php defined('BASEPATH') or exit('No direct script access allowed');
class Products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);
        $this->load->model('ProductsMenu', 'productsmenu', TRUE);

    }
    public function index()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "dashboard/products/add_edit_products";
            $header = "";
            $result["product_menu"] = $this->productsmenu->getNavProductsMenu();
            
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }
    }

}/** end controller */