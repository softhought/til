<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('createbody_method'))
{ 
    function createbody_method($body_content_data,$body_content_page,$body_content_header,$data)
    {
      
	  $heared_menu_content="";
	  $CI =& get_instance();
	
	
		$CI->load->model('menumodel','',TRUE);
		$CI->load->model('Loginmodel','',TRUE);
		$CI->load->library('template');
		$CI->load->library('session');
		$session=$CI->session->userdata('user_detail');
	 /* leftmenu */
	 $data=[];
	 $menu = $CI->menumodel->getAllAdministrativeMenu($session['userid']);
	 $data['activeuser']=$session['name'];

	 $year_id = $session['yearid'];

	$where_year = array(
		"year_id"=>$year_id,
	);

	// $data['yearList'] = $CI->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year);

	 //$data['year'] =$data['yearList']->year;

	

	
	 //print_r(json_encode($left_menu));exit;
	//  $acdsessionData= $CI->menumodel->getAcademicSessionData();
	//  $AccountingYearData= $CI->menumodel->getAccountingYearData();
	//  $acdSessionList=$CI->login_model->getAllAcademinSession();
	//  $accntYearList=$CI->login_model->getAllAccountingYear();
	 //$user_role = $CI->menumodel->getAllRoleById();

	 $data['bodyview'] = $body_content_page;
	 $data['leftmenusidebar'] = '';
	 $data['headermenu'] = $body_content_header;
	//  $data['accntYearList'] = $accntYearList;// added by sandipan sarkar for change academic session modal on 08.03.2019
	//  $data['acdsessionData'] = $acdsessionData;
	//  $data['AccountingYearData'] = $AccountingYearData;// added by sandipan sarkar for change academic session modal on 04.09.2019
	//  $data['acdSessionList'] = $acdSessionList; // added by sandipan sarkar for change academic session modal on 01.02.2019
	 $data['user']=$session['name'];
	
	 $CI->template->setHeader($heared_menu_content);
	 $CI->template->setBody($body_content_data);
	 $CI->template->setMenu($menu);
	
	 $CI->template->view('layout/default_admin', array('body'=>$body_content_page), $data);
		
	
    }   
}