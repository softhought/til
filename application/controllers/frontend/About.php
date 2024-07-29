<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class About extends CI_Controller
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
        $page="web_view/about/about_us.php";
        $result["active"] = "about";
        webbody_helper($result, $page);
    }


    public function corporate_profile()
    {       
        $page="web_view/about/corporate_profile.php";
        $result["product"] = $this->productsmenu->getNonParentRecords("product_master", "product_master_id", "ASC");

        // pre($result["product"]);exit;
        $result["active"] = "about";
        webbody_helper($result, $page);
    }

    public function board_of_directors()
    {     
        $page="web_view/about/board_of_directors";
        $result["active"] = "about";
        $result["teamList"] = $this->commondatamodel->getAllRecordWhereOrderBy('team_member_master', ["is_disabled" => 0], 'precedence');
        webbody_helper($result, $page);
    }

    public function milestones()
    {      
        $page="web_view/about/milestones";
        $result["active"] = "about";
        webbody_helper($result, $page);
    }

    public function vision_and_values()
    {      
        $page="web_view/about/vision_and_values";
        $result["active"] = "about";
        webbody_helper($result, $page);
    }

    public function vision_and_values_new()
    {      
        $page="web_view/about/vision_and_values_new";
        $result["active"] = "about";
        webbody_helper($result, $page);
    }


    public function corporate_social_responsibility()
    {      
        $page="web_view/about/corporate_social_responsibility";
        $result["active"] = "about";
        webbody_helper($result, $page);
    }

    public function code_of_conduct()
    {      
        $page="web_view/about/code_of_conduct";
        $result["active"] = "about";
        webbody_helper($result, $page);
    }

    public function facilities()
    {      
        $page="web_view/about/facilities";
        $result["active"] = "about";
        webbody_helper($result, $page);
    }








}/* end of class  */