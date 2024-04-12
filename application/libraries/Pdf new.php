<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class pdf { 


public function __construct($param = "'c', 'A4-L'")
{
       $CI = & get_instance(); 
		log_message('Debug', 'mPDF class is loaded.');
}
	// function pdf() { 
	// 	$CI = & get_instance(); 
	// 	log_message('Debug', 'mPDF class is loaded.');
	//  } 
	public function load($param=[]) { 
		include_once APPPATH.'/third_party/mpdf/vendor/autoload.php'; 
		// $param = "'','A4', 0, '', 0, 0, 0, 0, 0, 0"; 
		//$param = array('utf-8','A4-L', 0, '', 15, 15, 16, 16, 9, 9, 'L');
		return new \Mpdf\Mpdf($param);
		// $mpdf->WriteHTML('<h1>Hello world!</h1>');
		// $output = 'attendence' . date('Y_m_d_H_i_s') . '_.pdf'; 
		
		// $mpdf->Output("$output", 'I');exit;
		
	 } 
 } 
 

    