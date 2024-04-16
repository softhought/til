<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Investor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
    }


    public function index(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
            $page = "dashboard/investor_relations/investor_relations_view";
            $header="";    
            $result = "";   
          
            createbody_method($result, $page, $header, $session);
        }else{
			redirect('login','refresh');
		}
    }


} /* end of class */