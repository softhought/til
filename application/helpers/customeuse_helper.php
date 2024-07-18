<?php
error_reporting(0);

if (!function_exists('pre')) {

	function pre($printarry)
	{
		$CI =& get_instance();
		echo "<pre>";
		print_r($printarry);
		echo "</pre>";
	}
}

if (!function_exists('q')) {

	function q()
	{
		$CI =& get_instance();
		$CI->load->database();
		echo $CI->db->last_query();
	}
}

if (!function_exists('date_ymd')) {
	//added by sandipan sarkar on 25.02.2019
	function date_ymd($date)
	{
		$dateEx = explode('/', $date);
		$month = $dateEx[0];
		$day = $dateEx[1];
		$year = $dateEx[2];
		$stringDate = $day . "-" . $month . "-" . $year;
		$formated_date = date("Y-m-d", strtotime($stringDate));
		return $formated_date;
	}
}

if (!function_exists('date_dmy_to_ymd')) {
	//added by sandipan sarkar on 25.02.2019
	function date_dmy_to_ymd($date)
	{
		$dateEx = explode('/', $date);
		$month = $dateEx[1];
		$day = $dateEx[0];
		$year = $dateEx[2];
		$stringDate = $day . "-" . $month . "-" . $year;
		$formated_date = date("Y-m-d", strtotime($stringDate));
		return $formated_date;
	}
}

//added by shankha 




/*------------------------------*/

if (!function_exists('accesspermission')) {

	function accesspermission($access_for = NULL)
	{

	}
}

if (!function_exists('showlog')) {

	function showlog()
	{
		$CI =& get_instance();
		$session = $CI->session->userdata('user_detail');
		if ($CI->session->userdata('user_detail')) {
			$CI->load->database();


			if ($session['user_role'] == 1 || $session['user_role'] == 2) {
				return '';
			} else {
				return 'displaynone';
			}

		} else {
			redirect('login', 'refresh');
		}

	}
}


if (!function_exists('SendEmail')) {
	function SendEmail($to, $subject, $msg, $cc_mail = "", $bcc_mail = "", $file_attachment = "", $replyto = "")
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->library('session');

		$CI->load->library('phpmailer_library');
		$mail = $CI->phpmailer_library->load();
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;
		$mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';

		$mail->Username = "devsofthought@gmail.com";
		$mail->Password = "ufrnraffrzysepva";
		$mail->SetFrom("devsofthought@gmail.com",'Softhought');

		if ($replyto != "") {
			$mail->addReplyTo($replyto, 'Softhought');
		}

		$mail->Subject = $subject;

		if ($file_attachment != "") {
			foreach ($file_attachment as $key => $value) {

				$mail->addAttachment($value, $key);
			}

		}

		if ($cc_mail != "") {
			foreach (explode(',', $cc_mail) as $list) {
				$mail->addCC($list);
			}

		}
		if ($bcc_mail != "") {
			foreach (explode(',', $bcc_mail) as $list) {
				$mail->addBCC($list);
			}

		}

		$mail->Body = $msg;
		$mail->AddAddress($to);
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => false
			)
		);
		if (!$mail->Send()) {
			return '0';
		} else {
			return '1';
		}
	}
}


if (!function_exists('SendEmailCRM')) {
	function SendEmailCRM($to, $subject, $msg, $cc_mail = "", $bcc_mail = "", $file_attachment = "", $replyto = "")
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
		//$mail->Port = 465; 
		$mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';
		//$mail->Username = "devsofthought@gmail.com";
		//$mail->Password = "softhought@2019";
		//$mail->SetFrom("devsofthought@gmail.com");
		$mail->Username = "crm@mumbaiangels.com";
		$mail->Password = "xt%FZ89#35";
		//	$mail->SetFrom("membership@mumbaiangels.com",'Mumbai Angels Membership');
		$mail->SetFrom("crm@mumbaiangels.com", 'CRM Mumbai Angels');
		if ($replyto != "") {
			$mail->addReplyTo($replyto, 'Mumbai Angels');
		}
		$mail->Subject = $subject;

		if ($file_attachment != "") {
			foreach ($file_attachment as $key => $value) {

				$mail->addAttachment($value, $key);
			}

		}

		if ($cc_mail != "") {
			foreach (explode(',', $cc_mail) as $list) {
				$mail->addCC($list);
			}

		}
		if ($bcc_mail != "") {
			foreach (explode(',', $bcc_mail) as $list) {
				$mail->addBCC($list);
			}

		}
		$mail->Body = $msg;
		$mail->AddAddress($to);
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => false
			)
		);
		if (!$mail->Send()) {
			//echo $mail->ErrorInfo;
			return '0';
		} else {
			return '1';
		}
	}
}



if (!function_exists('accesspermissionMicro')) {
	function accesspermissionMicro($type, $page_url, $permission)
	{
		$CI =& get_instance();
		$session = $CI->session->userdata('user_detail');
		$permission = strtoupper($permission);
		$user_role = $session['role'];

		$where_isactive = array(
			"user_id" => $session['userid'],
			"is_active" => 'Y'
		);

		$norestrict_user = $CI->commondatamodel->getSingleRowByWhereCls('no_user_restriction', $where_isactive);

		if ($norestrict_user) {
			//No restriction for the user
			$flag = 0;
		} else {
			//check restriction for the user
			$flag = 1;

		}

		// if($user_role != 'Developer' && $user_role != 'Admin')
		if ($flag) {

			if ($CI->session->userdata('user_detail')) {
				$CI->load->database();
				$CI->load->model('Urlpermissionmodel');
				$where = array('user_id' => $session['userid']);
				// pre($session['userid']);
				// pre($page_url);exit;
				$result = $CI->Urlpermissionmodel->checkUrlPermission($session['userid'], $page_url);
				if (!empty($result)) {
					$pg_url = $result->url;
					$accessIDs = explode(',', trim($result->permission_access));
					if ($type == "page") {
						// pre($accessIDs);
						//   pre($permission);
						//  pre(in_array($permission,$accessIDs));exit;
						if (in_array($permission, $accessIDs) == 1) {
							return '';
						} else {
							redirect('urlpermission/restricted');
						}
					} else if ($type == "button") {
						if (in_array($permission, $accessIDs)) {
							return '';
						} else {
							return 'displaynone';
						}
					}
				} else {
					redirect('urlpermission/restricted');
				}
			} else {
				redirect('login', 'refresh');
			}
		}
	}
}