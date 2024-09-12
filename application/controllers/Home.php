<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Home extends CI_Controller
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
        header("Access-Control-Allow-Origin: *");
        $page = "web_view/home.php";
        $result["product"] = $this->productsmenu->getNonParentRecords("product_master", "product_master_id", "ASC");
        // pre($result["product"]);exit;
        $result["video"] = $this->productsmenu->getAllRecordWhereOrderBy("fuel_videos", ["is_disabled" => 0], "precedence", "ASC");
        $result["active"] = "home";
        webbody_helper($result, $page);
    }

    public function fetchproduct()
    {
        $productId = $_POST['productMasterId'];

        $sheet_model = $this->commondatamodel->getAllRecordWhere("spec_sheet_details", ["product_master_id" => $productId, "is_disabled" => 0]);

        echo $this->load->view("web_view/products/product_dropdown", ['sheet_model' => $sheet_model], TRUE);
        exit;
    }


}