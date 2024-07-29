<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);

    }

    public function index()
    {
        $result = [];
        if (isset($_SESSION["search_result"])) {
            $searchQuery = json_decode($_SESSION["search_result"], true);
            $result["searchResult"] = $searchQuery;
        }
        $page = "web_view/search/search.php";
        webbody_helper($result, $page);
    }
}