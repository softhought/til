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
        $result["products"] = $this->commondatamodel->getAllRecordWhere("product_master", ['parent_id' => 1, 'is_disabled' => 0]);
        $result["main-section"] = $this->commondatamodel->getAllRecordWhere("product_master", ['product_master_id' => 1, 'is_disabled' => 0]);
        // pre($result["main-section"]);exit;
        $result["active"] = "products";
        webbody_helper($result, $page);
    }

    public function viewLevel_1($parentSlug, $product_master_id)
    {
        $page = "web_view/products/viewlevel_1.php";
        $result["products"] = $this->commondatamodel->getAllRecordWhere("product_master", ['parent_id' => $product_master_id, 'is_disabled' => 0]);
        $result["main-section"] = $this->commondatamodel->getAllRecordWhere("product_master", ['product_master_id' => $product_master_id, 'is_disabled' => 0]);
        // pre($result["main-section"]);exit;
        $result["active"] = "products";
        webbody_helper($result, $page);
    }

    public function viewLevel_2($parentSlug, $product_master_id)
    {
        $page = "web_view/products/viewlevel_2.php";
        $result["slug"] = $parentSlug;
        $result["products"] = $this->commondatamodel->getAllRecordWhere("product_master", ['parent_id' => $product_master_id, 'is_disabled' => 0]);
        $result["main-section"] = $this->commondatamodel->getAllRecordWhere("product_master", ['product_master_id' => $product_master_id, 'is_disabled' => 0]);
        $result["active"] = "products";
        webbody_helper($result, $page);
    }

    public function viewLevel_3($parentSlug, $product_master_id)
    {
        $page = "web_view/products/viewlevel_3.php";
        $result["main-section"] = $this->commondatamodel->getAllRecordWhere("product_master", ['product_master_id' => $product_master_id, 'is_disabled' => 0]);
        $product_model_details = $this->commondatamodel->getAllRecordWhere("product_model_details", ['product_master_id' => $product_master_id, 'is_disabled'=> 0]);
        foreach ($product_model_details as $key => $value) {
            $value->template_master = json_decode($this->commondatamodel->getSingleRowByWhereCls("template_master", ['template_id' => $value->template_master_id])->column_names);
            $value->spec_sheet_details = $this->commondatamodel->getAllRecordWhere('spec_sheet_details', ['product_model_dt_id'=> $value->prodect_model_dt_id,  "is_disabled" => 0]);
        }

        $result['sheet_model'] = $this->commondatamodel->getAllRecordWhere("spec_sheet_details", ["product_master_id" => $product_master_id, "is_disabled" => 0]);

        // pre($result['sheet_model']);exit;
        $result["product_model"] = $product_model_details;
        $result["active"] = "products";
        webbody_helper($result, $page);
    }
}