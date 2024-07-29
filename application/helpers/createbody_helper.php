<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('createbody_method')) {
	function createbody_method($body_content_data, $body_content_page, $body_content_header, $data)
	{

		$heared_menu_content = "";
		$CI =& get_instance();


		$CI->load->model('menumodel', '', TRUE);
		$CI->load->model('Loginmodel', '', TRUE);
		$CI->load->library('template');
		$CI->load->library('session');
		$session = $CI->session->userdata('user_detail');
		/* leftmenu */
		$data = [];
		$menu = $CI->menumodel->getAllAdministrativeMenu($session['userid']);
		$data['activeuser'] = $session['name'];

		$year_id = $session['yearid'];

		$where_year = array(
			"year_id" => $year_id,
		);

		$data['bodyview'] = $body_content_page;
		$data['leftmenusidebar'] = '';
		$data['headermenu'] = $body_content_header;

		$data['user'] = $session['name'];

		$CI->template->setHeader($heared_menu_content);
		$CI->template->setBody($body_content_data);
		$CI->template->setMenu($menu);

		$mainurl = substr(current_url(), strlen(base_url()));

		$menuResult = $CI->commondatamodel->getSingleRowByWhereCls("menumaster", ["link" => $mainurl]);

		if ($menuResult) {
			$menuId = $menuResult->id;
			$isUserAllowed = $CI->commondatamodel->getSingleRowByWhereCls("menupermissions", ["menu_id" => $menuId, "user_id" => $session['userid']]);
			
			if (!empty($isUserAllowed)) {
				$CI->template->view('layout/default_admin', array('body' => $body_content_page), $data);
			} else {
				$_SESSION["isUserAllowed"] = $menuId;
				redirect('dashboard', 'refresh');
			}
		} else {
			$CI->template->view('layout/default_admin', array('body' => $body_content_page), $data);
		}
	}
}