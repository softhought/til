<?php defined('BASEPATH') OR exit('No direct script access allowed');
class password extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model("Loginmodel", "login");
    }

    public function index(){
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $where = array('is_active'=>'Y');
        $orderby="year_id desc";
        $result['financilayear'] = $this->commondatamodel->getAllRecordWhereOrderBy('financialyear',$where,$orderby); 
       
        $page="login/reset_password";
        $this->load->view($page,$result);
    }

    public function sendpasskey(){
        $formData = $this->input->post('formDatas');
        parse_str($formData, $dataArry);
        $username=$dataArry['username'];

        $where = array('user_name' => $username );
        $result=$this->commondatamodel->getSingleRowByWhereCls('users',$where);

          if($result)
                    {

                        $otp = mt_rand(100000, 999999);
                         $where = ["email" => $username];
            $isEmailAlreadyExist =  $this->commondatamodel->checkExistanceData('email_verification',$where);

            if($isEmailAlreadyExist){
                    
                $whereUpd = ["email" => $username];
            
                $updateDataToOTP = [
                    "otp" => $otp,
                    "generated_on" => date("Y-m-d H:i:s"),
                    "is_verified" => "N"
                ];
                
                $status = $this->commondatamodel->updateSingleTableData('email_verification',$updateDataToOTP,$whereUpd);
            }
            else{
                $insertDataToOTP = [
                    "email" => $username,
                    "otp" => $otp,
                    "generated_on" => date("Y-m-d H:i:s"),
                    "is_verified" => "N"   
                ];           
                $status = $this->commondatamodel->insertSingleTableData('email_verification',$insertDataToOTP);
            }


            /* send mail */

                $bodypage='login/passkey_mail_body.php'; 
                $data['mail_body']='Your passkey is <b>'.$otp.'</b> to reset password.Passkey is valid for 15 minutes.';
                $data['user']=$result->name;
                $msg= $html = $this->load->view($bodypage, $data, true);
                $cc_mail="";
                $bcc_mail="";
                $file_attachment=[];
                $sub='Passkey';
                $send=SendEmailCRM($username,$sub,$msg,$cc_mail,$bcc_mail,$file_attachment);


                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Passkey sent to your email address.If not in inbox,please check spam folder.",
                            "mode" => "ADD"
                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "The email is not registered.Please contact to admin."
                        );
                    }

            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;
    }



      public function verifypasskey(){
        $formData = $this->input->post('formDatas');
        parse_str($formData, $dataArry);
        $email=$dataArry['username'];
        $sentotp=$dataArry['otp'];

         $where = [
           "email_verification.is_verified" => 'N',
           "email_verification.email" => trim($email),
           "email_verification.otp" => trim($sentotp)
       ];
       
           $isValidOtp = $this->commondatamodel->checkExistanceData('email_verification',$where);// Check is valid otp
           if($isValidOtp){
               $minute = 15;
               $isOTPExpired = $this->login->isOTPExpired($email,$sentotp,$minute);
               
               if(!$isOTPExpired){
                   $updateDataToOTP = [
                       "email_verification.is_verified" => "Y"
                   ];
                   $whereUpd = [
                       "email_verification.email" => $email,
                       "email_verification.otp" => $sentotp
                   ];
                   $update = $this->commondatamodel->updateSingleTableData('email_verification',$updateDataToOTP,$whereUpd);
                   
                   if($update){

                       $json_response = [
                           "STATUS" => 200,
                           "STATUS_MSG" => "Verified successfully"
                       ];

                   }
                   else{
                       $json_response = [
                           "STATUS" => 100,
                           "STATUS_MSG" => "OTHER_ERR"
                       ];
                   }
                   
               }
               else{
                   $json_response = [
                       "STATUS" => 100,
                       "STATUS_MSG" => "Passkey Expired"
                   ];
               }
           }
           else{
               $json_response = [
               "STATUS" => 100,
               "STATUS_MSG" => "Passkey is not matched"
               ];
           }
           

            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;
    }



        public function resetPassword(){
        $formData = $this->input->post('formDatas');
        parse_str($formData, $dataArry);
        $new_password=md5($dataArry['new_password']);
        $user_email=$dataArry['user_email'];


         $update_data = [
                    "password" => $new_password,
                    
                ];
                $where = array('user_name' => $user_email );
                
       $update = $this->commondatamodel->updateSingleTableData('users',$update_data,$where);

                if ($update) {
                    $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Password update successfully!",
                            "mode" => "ADD"
                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "something wrong!"
                        );
                    }

      

            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;
    }


}