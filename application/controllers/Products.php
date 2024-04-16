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
        $page="web_view/products/products.php";
        $result=[];
        webbody_helper($result, $page);
    }


}