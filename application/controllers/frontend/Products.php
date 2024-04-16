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
        $result = [];
        webbody_helper($result, $page);
    }


    public function material_handling_solutions()
    {
        $page = "web_view/products/material_handling_solutions.php";
        $result = [];
        webbody_helper($result, $page);
    }

    public function solutions_til_range() {
        $page = "web_view/products/material_handling_solutions/til_range.php";
        $result = [];
        webbody_helper($result, $page);
    }

    public function til_range_rough_terrain_ranes() {
        $page = "web_view/products/material_handling_solutions/til_range/rough_terrain_cranes.php";
        $result = [];
        webbody_helper($result, $page);
    }

    public function til_range_truck_cranes() {
        $page = "web_view/products/material_handling_solutions/til_range/truck_cranes.php";
        $result = [];
        webbody_helper($result, $page);
    }

    public function til_range_pick_n_carry_cranes() {
        $page = "web_view/products/material_handling_solutions/til_range/pick_n_carry_cranes.php";
        $result = [];
        webbody_helper($result, $page);
    }

    public function solutions_manitowoc_range() {
        $page = "web_view/products/material_handling_solutions/manitowoc_range.php";
        $result = [];
        webbody_helper($result, $page);
    }

    public function manitowoc_range_crawler_cranes() {
        $page = "web_view/products/material_handling_solutions/manitowoc_range/crawler_cranes.php";
        $result = [];
        webbody_helper($result, $page);
    }

    public function manitowoc_range_grove_range() {
        $page = "web_view/products/material_handling_solutions/manitowoc_range/grove_range.php";
        $result = [];
        webbody_helper($result, $page);
    }

    public function solutions_hyster_til_range() {
        $page = "web_view/products/material_handling_solutions/hyster_til_range.php";
        $result = [];
        webbody_helper($result, $page);
    }

    public function hyster_til_range_reachstackers() {
        $page = "web_view/products/material_handling_solutions/hyster_til_range/reachstackers.php";
        $result = [];
        webbody_helper($result, $page);
    }

    public function hyster_til_range_forklift_trucks() {
        $page = "web_view/products/material_handling_solutions/hyster_til_range/forklift_trucks.php";
        $result = [];
        webbody_helper($result, $page);
    }
}