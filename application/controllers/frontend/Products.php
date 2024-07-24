<?php (defined('BASEPATH')) or exit('No direct script access allowed');

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
        $page = "web_view/products/products.php";
        $result["products"] = $this->commondatamodel->getAllRecordWhere("product_master", ['parent_id' => 1, 'is_disabled' => 0]);
        $result["main-section"] = $this->commondatamodel->getAllRecordWhere("product_master", ['product_master_id' => 1, 'is_disabled' => 0]);
        $result["active"] = "products";
        webbody_helper($result, $page);
    }

    public function product_new()
    {
        $page = "web_view/products/products_new.php";
        $result["products"] = $this->commondatamodel->getAllRecordWhere("product_master", ['parent_id' => 2, 'is_disabled' => 0]);
        $result["main-section"] = $this->commondatamodel->getAllRecordWhere("product_master", ['product_master_id' => 2, 'is_disabled' => 0]);
        $result["productList"] = $this->productsmenu->getNonParentRecords("product_master", "product_master_id", "ASC");
        $result["product_menu"] = $this->productsmenu->getNavProductsMenu()[0]["children"];
        $result["faq"] = $this->commondatamodel->getAllRecordWhereOrderByCol("faq_details", ["is_disabled" => 0], "precedence", "ASC");
        $result["reviewList"] = $this->commondatamodel->getAllRecordWhereOrderByCol("customer_review", ["is_disabled" => 0], "id", "DESC");
        
        $result['productId'] = 1;
        $result['modelId'] = null;

        $result["active"] = "products";
        webbody_helper($result, $page);
    }

    public function viewLevel_1($parentSlug, $product_master_id)
    {
        $page = "web_view/products/viewlevel_1.php";
        $result["products"] = $this->commondatamodel->getAllRecordWhere("product_master", ['parent_id' => $product_master_id, 'is_disabled' => 0]);
        $result["main-section"] = $this->commondatamodel->getAllRecordWhere("product_master", ['product_master_id' => $product_master_id, 'is_disabled' => 0]);

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
        $product_model_details = $this->commondatamodel->getAllRecordWhere("product_model_details", ['product_master_id' => $product_master_id, 'is_disabled' => 0]);
        foreach ($product_model_details as $key => $value) {
            $value->template_master = json_decode($this->commondatamodel->getSingleRowByWhereCls("template_master", ['template_id' => $value->old_template_master_id])->column_names);
            $value->spec_sheet_details = $this->commondatamodel->getAllRecordWhere('spec_sheet_details', ['product_model_dt_id' => $value->prodect_model_dt_id, "is_disabled" => 0]);
        }

        $result['sheet_model'] = $this->commondatamodel->getAllRecordWhere("spec_sheet_details", ["product_master_id" => $product_master_id, "is_disabled" => 0]);

        $result["product_model"] = $product_model_details;
        $result["active"] = "products";
        webbody_helper($result, $page);
    }

    public function viewLevel_3_new($parentSlug, $rootSlug, $product_master_id)
    {
        $page = "web_view/products/viewlevel_3_new.php";
        $result['parentSlug'] = $parentSlug;
        $result['rootSlug'] = $rootSlug;

        $result["products"] = $this->commondatamodel->getAllRecordWhere("product_master", ['parent_id' => $product_master_id, 'is_disabled' => 0]);
        $result["main-section"] = $this->commondatamodel->getAllRecordWhere("product_master", ['product_master_id' => $product_master_id, 'is_disabled' => 0]);
        $result["productList"] = $this->productsmenu->getNonParentRecords("product_master", "product_master_id", "ASC");
        $result["product_menu"] = $this->productsmenu->getNavProductsMenu()[0]["children"];
        $result["faq"] = $this->commondatamodel->getAllRecordWhereOrderByCol("faq_details", ["is_disabled" => 0, 'product_id' => $product_master_id], "precedence", "ASC");
        $result["reviewList"] = $this->commondatamodel->getAllRecordWhereOrderByCol("customer_review", ["is_disabled" => 0, 'product_id' => $product_master_id], "id", "DESC");

        $result['sheet_model'] = $this->commondatamodel->getAllRecordWhere("spec_sheet_details", ["product_master_id" => $product_master_id, "is_disabled" => 0]);

        $result['productId'] = $product_master_id;
        $result['modelId'] = null;

        $result["active"] = "products";
        webbody_helper($result, $page);
    }

    public function viewLevel_4($parentSlug, $rootSlug, $subParentSlug, $spec_sheet_dt_id)
    {
        $page = "web_view/products/viewlevel_4.php";
        $result["active"] = "products";
        $result['parentSlug'] = $parentSlug;
        $result['rootSlug'] = $rootSlug;
        $result['subParentSlug'] = $subParentSlug;

        $result["main-section"] = $this->commondatamodel->getAllRecordWhere("spec_sheet_details", ['spec_sheet_dt_id' => $spec_sheet_dt_id, 'is_disabled' => 0]);
        $result["products"] = $this->commondatamodel->getAllRecordWhere("product_master", ['product_master_id' => $result["main-section"][0]->product_master_id, 'is_disabled' => 0]);
        $result["product_menu"] = $this->productsmenu->getNavProductsMenu()[0]["children"];
        $result["faq"] = $this->commondatamodel->getAllRecordWhereOrderByCol("faq_details", ["is_disabled" => 0, 'model_id' => $spec_sheet_dt_id], "precedence", "ASC");
        $result["reviewList"] = $this->commondatamodel->getAllRecordWhereOrderByCol("customer_review", ["is_disabled" => 0, 'model_id' => $spec_sheet_dt_id], "id", "DESC");

        $result['sheet_model'] = $this->commondatamodel->getAllRecordWhere("spec_sheet_details", ["spec_sheet_dt_id" => $spec_sheet_dt_id, "is_disabled" => 0]);
        
        $result['productId'] = $result["main-section"][0]->product_master_id;
        $result['modelId'] = $spec_sheet_dt_id;

        webbody_helper($result, $page);
    }
}