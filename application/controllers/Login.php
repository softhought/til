<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
        $result = [];
        //$this->session->sess_destroy(); 
        $this->session->unset_userdata('quote_captcha_session');
	    //$this->session->unset_userdata('redirect'); 
        $num1 = rand (1,10);
        $num2 = rand (1,10);
        
        $captcha_data = array(
            'number1' => $num1,
            'number2' => $num2,
            'result' => $num1+$num2
        );
        $this->session->set_userdata('quote_captcha_session', $captcha_data); 
        $result['captcha_data'] = $captcha_data;
        $page="login/login2";
        $this->load->view($page,$result);
    }/** end  */

    public function check_login(){ 
        $json_response = array();
        $formData = $this->input->post('formDatas');
        parse_str($formData, $dataArry);
        $user_name =  htmlspecialchars($dataArry['user_name']);
        $password =  htmlspecialchars($dataArry['password']);
       
        $captcha_data = $this->session->userdata('quote_captcha_session'); 
  
	
	    if($captcha_data['result'] == $dataArry['captchavalue']){
            if($user_name=="" OR $password==""){
                $json_response = array(
                    "msg_status" => 0,
                    "msg_data" => "All fields are required"
                );
                
            }
		    else {
			    $user_id = $this->login->checkLogin($user_name,$password);
			    if($user_id!="") {
					$arr=[
							"user_id"=>$user_id,
							"ip_address"=>getUserIPAddress(),
							"user_browser"=>getUserBrowserName(),
							"user_platform"=>getUserPlatform(),
							"login_time"=>date('Y-m-d H:i:s')
						];
					$insertid= $this->commondatamodel->insertSingleTableDataRerurnInsertId('user_account_activity',$arr);
                    
                    $where=['id'=>$user_id];
                
                    $this->commondatamodel->updateSingleTableData('users',array('is_online'=>'Y','updated_at'=>date('Y-m-d H:i:s')),$where);
					$user = $this->login->get_user($user_id);
					

                    $user_session = [
                                        "userid"=>$user->id,
                                        "username"=>$user->user_name,
                                        "companyid"=>1,// It will be come login page
                                        "yearid"=>1,
                                        "name"=>$user->name,
                                        "user_role"=>$user->user_role_id,
                                        "role"=>$user->role,
                                        "user_account_activity_id"=>$insertid,
                                    ];



                                    $this->setSessionData($user_session);
                                    //redirect('dashboard');
					// pre($user_session);
					$json_response = array(
						"msg_status" => 1,
						"msg_data" => "Logged in successfully..."
					);
				
			    } else {
                    $json_response = array(
                        "msg_status" => 0,
                        "msg_data" => "Invalid login details..."
                    );
                }
		}
        }else{
        	$json_response = array(
        		"msg_status" => 0,
        		"msg_data" => "Enter valid captcha"
        	);
        }
        
        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit;
	
    }/** end */

    private function setSessionData($result = NULL) {
        if ($result) {
            $this->session->set_userdata("user_detail", $result);
        }

    }
    
    public function restricted()

 {

    $page = 'restricted_view.php';

        

    $this->load->view($page);



 }



}// end of class