<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class CustomerSupport extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);

    }

    public function index()
    {
        $page = "web_view/customer_support/customer_support.php";
        $result["active"] = "customer-support";
        webbody_helper($result, $page);
    }

    public function maintenance_contract()
    {
        $page = "web_view/customer_support/maintenance_contract.php";
        $result["active"] = "customer-support";
        webbody_helper($result, $page);
    }

    public function parts_warehouse()
    {
        $page = "web_view/customer_support/parts_warehouse.php";
        $result["active"] = "customer-support";
        webbody_helper($result, $page);
    }

    public function training()
    {
        $page = "web_view/customer_support/training.php";
        $result["active"] = "customer-support";
        webbody_helper($result, $page);
    }
}