<?php


if(!function_exists('pre'))
{
	
	function pre($printarry){
		$CI =& get_instance();
		echo "<pre>";
		print_r($printarry);
		echo "</pre>";
	}
}

if(!function_exists('q'))
{
	
	function q(){
		$CI =& get_instance();
        $CI->load->database();
        echo $CI->db->last_query();
	}
}

if(!function_exists('date_ymd'))
{
	//added by sandipan sarkar on 25.02.2019
	function date_ymd($date)
	{
		$dateEx = explode('/',$date);
            $month  = $dateEx[0];
            $day  = $dateEx[1];
			$year  = $dateEx[2];
			$stringDate = $day."-".$month."-".$year;
			$formated_date = date("Y-m-d",strtotime($stringDate));
			return $formated_date;
	}
}

if(!function_exists('date_dmy_to_ymd'))
{
	//added by sandipan sarkar on 25.02.2019
	function date_dmy_to_ymd($date)
	{
		$dateEx = explode('/',$date);
            $month  = $dateEx[1];
            $day  = $dateEx[0];
			$year  = $dateEx[2];
			$stringDate = $day."-".$month."-".$year;
			$formated_date = date("Y-m-d",strtotime($stringDate));
			return $formated_date;
	}
}


if(!function_exists('send_sms'))
{
	//added by shankha 
	function send_sms($mobile,$message,$module)
	{       $CI =& get_instance();
			$CI->load->database();

			//$phone='7003319369';
		   // $msg='softhought';
		    
			    $dks_user = "";
			    $dks_password = "";
			    
			    $dks_url = "http://5.189.187.82/sendsms/bulk.php?";
			    $type='TEXT';
			    $sender = "DKSSMS";
			    $mantra_udh = 0;

		      $url = 'username='.$dks_user;
		      $url.= '&password='.$dks_password;
		      $url.= '&type='.$type;
		      $url.= '&sender='.$sender;
		      $url.= '&mobile='.urlencode($mobile);
		      $url.= '&message='.urlencode($message);
		      // $url.= '&dlr-mask=19&dlr-url*';

		      $urltouse =  $dks_url.$url;

		      $file = file_get_contents($urltouse);
		      $status = explode(" | ",$file);


		      if($status[0]=='SUBMIT_SUCCESS')
		      {
		          $response="Y";

		          $sms_log_inst = array(
		          						'mobile' => $mobile,
		          						'message' => $message,
		          						'status_code' => $status[0],
		          						'response_code' => $status[1],
		          						'module' => $module,
		          						'created_on' => date('Y-m-d')
		          					   );

		          $CI->commondatamodel->insertSingleTableData('sms_log',$sms_log_inst);
		          
		      }
		      else
		      {
		          $response="N";
		      }

		      return($response);

		

	}




	/*------------------------------*/

if(!function_exists('accesspermission'))
{
	
	function accesspermission(){
		$CI =& get_instance();
		$session = $CI->session->userdata('user_detail');
		if($CI->session->userdata('user_detail'))
	    {
			$CI->load->database();
			$where = array('users.id' => $session['userid'] );
			$result=$CI->commondatamodel->getSingleRowByWhereCls('users',$where);	       
	        if ($result->access_permission=='V') {
	        	return 'displaynone';
	        }else{
	        	return 'A';
	        }

	    }else{
	    	  redirect('login','refresh');
	    }

	}
}


/* send email */

	//added byn anil on 21-09-2021
	if(!function_exists('SendEmailxx')){
		function SendEmailxx($email,$sub,$msg,$cc_mail="",$bcc_mail="",$file_attachment="")
			{   
				
				$CI =& get_instance();
				$CI->load->database();
				$CI->load->library('session');
	
				$CI->load->library('phpmailer_lib2');
				$mail = $CI->phpmailer_lib2->load();
				$lang = APPPATH.'third_party/PHPMailer/language/phpmailer.lang-en.php';
				$mail->SetLanguage("en",$lang);
	
				//Your SMTP servers details
				$mail->IsSMTP(); 
				$mail->Host = "smtp.gmail.com";  // specify main and backup server or localhost
				// $mail->Host = "smtp.office365.com";
				 $mail->Port = 587;
				// $mail->CharSet =  "utf-8";
				 
				$mail->SMTPSecure =  'tls';
				$mail->SMTPAuth = true;     // turn on SMTP authentication
				$mail->Username = "membership@mumbaiangels.com";  // SMTP username
				$mail->Password = "membership123"; // SMTP password
			
				$mail->From = "membership@mumbaiangels.com";
					//Default From email same as smtp user
				$mail->FromName = "Mumbai Angels";
				$mail->addAddress($email);
			// // $mail->AddAddress("satnam1122@gmail.com"); //Email address where you wish to receive/collect those emails.
				// $mail->WordWrap = 50;     
				$mail->SMTPDebug  = 3;                           // set word wrap to 50 characters
				$mail->IsHTML(true);                                  // set email format to HTML
				$mail->Subject = $sub;
				// $mail->AddAttachment('pdf_files/'.APPPATH.'third_party/toMarge/sbibundlebillng.pdf', 'reservation.pdf');
				
				// if($file_attachment != ""){
				// 	foreach($file_attachment as $key=>$value){
					
				// 		$mail->addAttachment($value, $key);
				// 	}
					
				//   }
				
				// if($cc_mail != ""){
				// 	foreach(explode(',',$cc_mail) as $list){
				// 		$mail->addCC($list);
				// 	}
					
				// }
				// if($bcc_mail != ""){
				// 	foreach(explode(',',$bcc_mail) as $list){
				// 		$mail->addBCC($list);
				// 	}
					
				// }
				
				// $mail->addCC('anilk6385@outlook.com');
				//$mail->addReplyTo('membership@mumbaiangels.com','mumbaiangels');
				// pre($mail);exit;
				// if($pathimage != ""){
				// 	$mail->AddEmbeddedImage($pathimage, "my-attach", $pathimage);
				// 	$mail->Body = '<img src="cid:my-attach">';
				// }else{
				// 	$mail->Body = $msg;
				// }
				$mail->Body = $msg;
				
				if(!$mail->Send())
				{
					// echo "Message could not be sent. <p>";
					// echo "Mailer Error: " . $mail->ErrorInfo;
					return "N";
					echo pre($mail->ErrorInfo);
					
				}else{                   
					 return "Y";
				}
	
	
			}
		}


if(!function_exists('SendEmail')){
		function SendEmail($to,$subject,$msg,$cc_mail="",$bcc_mail="",$file_attachment="")
			{ 

				$CI =& get_instance();
				$CI->load->database();
				$CI->load->library('session');
	
				$CI->load->library('phpmailer_library');
				$mail = $CI->phpmailer_library->load();
				$mail = new PHPMailer(); 
				//$mail->SMTPDebug  = 3;
				$mail->IsSMTP(); 
				$mail->SMTPAuth = true; 
				$mail->SMTPSecure = 'tls'; 
				$mail->Host = "smtp.gmail.com";
				$mail->Port = 587; 
				$mail->IsHTML(true);
				$mail->CharSet = 'UTF-8';
				//$mail->Username = "devsofthought@gmail.com";
				//$mail->Password = "softhought@2019";
				//$mail->SetFrom("devsofthought@gmail.com");
			$mail->Username = "membership@mumbaiangels.com";
			$mail->Password = "membership123";
		//	$mail->SetFrom("membership@mumbaiangels.com",'Mumbai Angels Membership');
			$mail->SetFrom("membership@mumbaiangels.com");
			$mail->Subject = $subject;

					if($file_attachment != ""){
					foreach($file_attachment as $key=>$value){
					
						$mail->addAttachment($value, $key);
					}
					
				  }
				
				if($cc_mail != ""){
					foreach(explode(',',$cc_mail) as $list){
						$mail->addCC($list);
					}
					
				}
				if($bcc_mail != ""){
					foreach(explode(',',$bcc_mail) as $list){
						$mail->addBCC($list);
					}
					
				}





			$mail->Body =$msg;
			$mail->AddAddress($to);
			$mail->SMTPOptions=array('ssl'=>array(
				'verify_peer'=>false,
				'verify_peer_name'=>false,
				'allow_self_signed'=>false
			));
			if(!$mail->Send()){
				//echo $mail->ErrorInfo;
				return '0';
			}else{
				return '1';
			}




			}
		}
	





}
