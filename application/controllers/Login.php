<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model("Loginmodel", "login");
    }

    // public function index()
    // {
    //         echo "We’ll be back soon!";
    //         echo "<br>";
    //         echo "Sorry for the inconvenience but we’re performing some maintenance at the moment. we’ll be back online shortly!";
    //         echo "<br>";
    //         echo "— Mumbai Angels";
    // }

   public function index(){
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $where = array('is_active'=>'Y');
        $orderby="year_id desc";
        $result['financilayear'] = []; 
        $this->session->sess_destroy();  
        $page="login/login2";
        $this->load->view($page,$result);
    }

    // public function testlogin(){
    //     $this->load->helper('form');
    //     $this->load->library('form_validation'); 
    //     $where = array('is_active'=>'Y');
    //     $orderby="year_id desc";
    //     $result['financilayear'] = $this->commondatamodel->getAllRecordWhereOrderBy('financialyear',$where,$orderby); 
       
    //     $page="login/login2";
    //     $this->load->view($page,$result);
    // }


    public function check_login() 
    {

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
       
        $this->form_validation->set_error_delimiters('<div class="error-login">', '</div>');
        
        if ($this->form_validation->run() == FALSE)
           {
               $this->session->set_flashdata('msg','<div style="color: red;" class="error-login">Enter Username & Password</div>');
                     
                redirect('login');                     
           }
           else
           {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $yearid = 1;
               
                $user_id = $this->login->checkLogin($username,$password);
                if($user_id!=""){
                    $arr=[
                        "user_id"=>$user_id,
                        "ip_address"=>getUserIPAddress(),
                        "user_browser"=>getUserBrowserName(),
                        "user_platform"=>getUserPlatform(),
                        "login_time"=>date('Y-m-d H:i:s')
                    ];
                   $insertid= $this->commondatamodel->insertSingleTableDataRerurnInsertId('user_account_activity',$arr);
                    $where=[
                        'id'=>$user_id
                    ];
                    $this->commondatamodel->updateSingleTableData('users',array('is_online'=>'Y','updated_at'=>date('Y-m-d H:i:s')),$where);

                    $user = $this->login->get_user($user_id);
                    $user_session = [
                    "userid"=>$user->id,
                    "username"=>$user->user_name,
                    "companyid"=>1,// It will be come login page
                   
                    "yearid"=>$yearid,
                    "name"=>$user->name,
                    "user_role"=>$user->user_role_id,
                    "role"=>$user->role,
                    "user_account_activity_id"=>$insertid,
                ];
                 $this->setSessionData($user_session);
                 redirect('dashboard');
                    
                }else{
                     $this->session->set_flashdata('msg','<div style="color: red;" class="error-login">Invalid username or password</div>');
                     redirect('login');
                }
           }
    }

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