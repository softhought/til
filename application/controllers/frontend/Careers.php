<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Careers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);

    }

    public function index()
    {
        $page = "web_view/careers/careers.php";
        $result["active"] = "careers";
        webbody_helper($result, $page);
    }

    public function life_til()
    {
        $page = "web_view/careers/life_til.php";
        $result["active"] = "careers";
        webbody_helper($result, $page);
    }

    public function meet_our_team()
    {
        $page = "web_view/careers/meet_our_team.php";
        $result["active"] = "careers";
        webbody_helper($result, $page);
    }

    public function vacancies()
    {
        $page = "web_view/careers/vacancies.php";
        $result["active"] = "careers";
        webbody_helper($result, $page);
    }

    public function equal_opportunity_employer()
    {
        $page = "web_view/careers/equal_opportunity_employer.php";
        $result["active"] = "careers";
        webbody_helper($result, $page);
    }

    public function submit_cv()
    {
        $page = "web_view/careers/submit_cv.php";
        $result["active"] = "careers";
        webbody_helper($result, $page);
    }
}