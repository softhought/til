<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Faq extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);

    }

    public function index()
    {
        $page = "web_view/faq/faq.php";
        $result["active"] = "faq";
        $result["faq"] = $this->commondatamodel->getAllRecordWhereOrderByCol("faq_details", ["is_disabled" => 0], "precedence", "ASC");
        webbody_helper($result, $page);
    }
}