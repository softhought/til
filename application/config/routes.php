<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'helpers/route_helper.php';
$menuUrls = getAllMenuUrl("fuel_catagory");
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'Login';
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* -------------- About---------------------- */
$route['about-us'] = "frontend/about";
$route['about-us/corporate-profile'] = "frontend/about/corporate_profile";
$route['about-us/board_of_directors'] = "frontend/about/board_of_directors";
$route['about-us/milestones'] = "frontend/about/milestones";
$route['about-us/vision-and-values'] = "frontend/about/vision_and_values";
$route['about-us/corporate-social-responsibility'] = "frontend/about/corporate_social_responsibility";
$route['about-us/code-of-conduct'] = "frontend/about/code_of_conduct";
$route['about-us/facilities'] = "frontend/about/facilities";

/* -------------- Products---------------------- */

$route['products'] = "frontend/products";
// $route['products/material-handling-solutions'] = "frontend/products/material_handling_solutions";

// $route['products/material-handling-solutions/til-range'] = "frontend/products/solutions_til_range";
// $route['products/material-handling-solutions/til-range/rough-terrain-cranes'] = "frontend/products/til_range_rough_terrain_ranes";
// $route['products/material-handling-solutions/til-range/truck-cranes'] = "frontend/products/til_range_truck_cranes";
// $route['products/material-handling-solutions/til-range/pick-n-carry-cranes'] = "frontend/products/til_range_pick_n_carry_cranes";

// $route['products/material-handling-solutions/manitowoc-range'] = "frontend/products/solutions_manitowoc_range";
// $route['products/material-handling-solutions/manitowoc-range/crawler-cranes'] = "frontend/products/manitowoc_range_crawler_cranes";
// $route['products/material-handling-solutions/manitowoc-range/grove-range'] = "frontend/products/manitowoc_range_grove_range";

// $route['products/material-handling-solutions/hyster-til-range'] = "frontend/products/solutions_hyster_til_range";
// $route['products/material-handling-solutions/hyster-til-range/reachstackers'] = "frontend/products/hyster_til_range_reachstackers";
// $route['products/material-handling-solutions/hyster-til-range/forklift-trucks'] = "frontend/products/hyster_til_range_forklift_trucks";
foreach ($menuUrls as $url) {
    $routeKey = $url['url'];
    
    switch ($url['level']) {
        case 1:
            $routeValue = 'frontend/products/viewLevel_1/' . explode("/",$routeKey)[1] . '/' . $url['id'];
            break;
        case 2:
            $routeValue = 'frontend/products/viewLevel_2/' . explode("/",$routeKey)[1] . '/' . $url['id'];
            break;
        case 3:
            $routeValue = 'frontend/products/viewLevel_3/' . explode("/",$routeKey)[1] . '/' . $url['id'];
            break;
    }

    $route[$routeKey] = $routeValue;
}


/* -------------- Customer Support ---------------------- */
$route['customer-support'] = "frontend/customersupport";
$route['customer-support/maintenance-contract'] = "frontend/customersupport/maintenance_contract";
$route['customer-support/parts-warehouse'] = "frontend/customersupport/parts_warehouse";
$route['customer-support/training'] = "frontend/customersupport/training";
$route['contact-us/locations'] = "frontend/contactus/locations";

/* -------------- Media ---------------------- */
$route["media"] = "frontend/media";
$route["media/videos"] = "frontend/media/videos";
$route["media/news"] = "frontend/media/news";
$route["media/events-happenings"] = "frontend/media/events_happenings";
$route["media/newsletter"] = "frontend/media/newsletter";
$route["media/newsletter/til-talk"] = "frontend/media/newsletter_til_talk";
$route["media/newsletter/til-touch"] = "frontend/media/newsletter_til_touch";

/* -------------- Carrers ---------------------- */
$route['careers'] = "frontend/careers";
$route['careers/life-til'] = "frontend/careers/life_til";
$route['careers/meet-our-team'] = "frontend/careers/meet_our_team";
$route['careers/vacancies'] = "frontend/careers/vacancies";
$route['careers/equal-opportunity-employer'] = "frontend/careers/equal_opportunity_employer";
$route['careers/submit_cv'] = "frontend/careers/submit_cv";


/* -------------- Contact Us ---------------------- */
$route['contact-us/inquiry'] = "frontend/contactus/inquiry";

$route["mediaadmin"] = "media";
