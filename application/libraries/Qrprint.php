<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Qrprint { 

    public function __construct()
    {
        $CI = & get_instance(); 		
    }
	
	public function load($data,$gstinvoiceId) { 
        //$data = "test";
		include_once APPPATH.'/third_party/phpqrcode/qrlib.php'; 	
        $errorCorrectionLevel = 'L';
        $matrixPointSize = 4;
        $filename = 'qrcode'.$gstinvoiceId.'.png';
        $full_path = $_SERVER['DOCUMENT_ROOT'].'/mumbaiAngels/assets/img/qrCodes/'.$filename;
        // echo $full_path;exit;
        QRcode::png($data, $full_path, $errorCorrectionLevel, $matrixPointSize, 2); 		
        // return QRcode::png($data); 		
        return $filename;
		
	 } 
 } 
 

    