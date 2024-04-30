<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Privacypolicy extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);

    }

    public function index()
    {
        
        $page = "web_view/privecy_policy.php";
        $result["active"] = "Privacy Policy";
        webbody_helper($result, $page);
    }

   
}