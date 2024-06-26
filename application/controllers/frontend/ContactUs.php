<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class ContactUs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);

    }

    public function index()
    {       
        $result["active"] = "contact-us";
    }

    public function locations()
    {
        $page = "web_view/contact_us/locations.php";
        $result["active"] = "contact-us";
        webbody_helper($result, $page);
    }

    public function inquiry()
    {
        $page = "web_view/contact_us/inquiry.php";
        $result["active"] = "contact-us";
        webbody_helper($result, $page);
    }

}