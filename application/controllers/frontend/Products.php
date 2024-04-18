<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);

    }

    public function index()
    {
        $page = "web_view/products/products.php";
        $result["products"] = $this->commondatamodel->getAllRecordWhere("fuel_catagory", ['parent_id' => 1, 'is_disabled' => 0]);
        $result["main-section"] = $this->commondatamodel->getAllRecordWhere("fuel_catagory", ['id' => 1, 'is_disabled' => 0]);
        // pre($result["main-section"]);exit;
        webbody_helper($result, $page);
    }

    public function viewLevel_1($parentSlug, $id)
    {
        $page = "web_view/products/viewlevel_1.php";
        $result["products"] = $this->commondatamodel->getAllRecordWhere("fuel_catagory", ['parent_id' => $id, 'is_disabled' => 0]);
        $result["main-section"] = $this->commondatamodel->getAllRecordWhere("fuel_catagory", ['id' => $id, 'is_disabled' => 0]);
        // pre($result["main-section"]);exit;
        webbody_helper($result, $page);
    }

    public function viewLevel_2($parentSlug, $id)
    {
        $page = "web_view/products/viewlevel_2.php";
        $result["slug"] = $parentSlug;
        $result["products"] = $this->commondatamodel->getAllRecordWhere("fuel_catagory", ['parent_id' => $id, 'is_disabled' => 0]);
        $result["main-section"] = $this->commondatamodel->getAllRecordWhere("fuel_catagory", ['id' => $id, 'is_disabled' => 0]);
        webbody_helper($result, $page);
    }

    public function viewLevel_3($parentSlug, $id)
    {
        $page = "web_view/products/viewlevel_3.php";
        $result["main-section"] = $this->commondatamodel->getAllRecordWhere("fuel_catagory", ['id' => $id, 'is_disabled' => 0]);
        webbody_helper($result, $page);
    }
}