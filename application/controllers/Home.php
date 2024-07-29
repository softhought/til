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
        $result["video"] = $this->productsmenu->getAllRecordWhereOrderBy("fuel_videos", ["is_disabled" => 0], "precedence", "ASC");
        $result["active"] = "home";
        webbody_helper($result, $page);
    }

}/* end of class  */