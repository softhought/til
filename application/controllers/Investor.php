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
            $result = [];   
          
            createbody_method($result, $page, $header, $session);
        }else{
			redirect('login','refresh');
		}
    }


    public function corporate_governance_partial_view(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
            
            $orderby='relations_dtl_id';
            $where = array("relations_master_id" =>1);
            $result['relationsDetailsList'] = $this->commondatamodel->getAllRecordWhereOrderBy('investor_relations_details',$where,$orderby);   
          // pre($result['relationsDetailsList']);
            $page = "dashboard/investor_relations/corporate_governance_partial_view";
            $this->load->view($page,$result);
        }else{
			redirect('login','refresh');
		}
    }

    public function shareholders_information_partial_view(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
           
            $orderby='relations_dtl_id';
            $where = array("relations_master_id" =>2);
            $result['relationsDetailsList'] = $this->commondatamodel->getAllRecordWhereOrderBy('investor_relations_details',$where,$orderby);  
            $page = "dashboard/investor_relations/shareholders_information_partial_view";
            $this->load->view($page,$result);
        }else{
			redirect('login','refresh');
		}
    }

    public function financials_partial_view(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
            $orderby='relations_dtl_id';
            $where = array("relations_master_id" =>3);
            $result['relationsDetailsList'] = $this->commondatamodel->getAllRecordWhereOrderBy('investor_relations_details',$where,$orderby);  
            $page = "dashboard/investor_relations/financials_partial_view";
            $this->load->view($page,$result);
        }else{
			redirect('login','refresh');
		}
    }

    public function notice_partial_view(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
            $orderby='relations_dtl_id';
            $where = array("relations_master_id" =>4);
            $result['relationsDetailsList'] = $this->commondatamodel->getAllRecordWhereOrderBy('investor_relations_details',$where,$orderby);  
            $page = "dashboard/investor_relations/notice_partial_view";
            $this->load->view($page,$result);
        }else{
			redirect('login','refresh');
		}
    }


    public function add_edit_investor_relations_partial_view(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
            $orderby='relations_dtl_id';
            $where = array("relations_master_id" =>4);
            $result['relationsDetailsList'] = $this->commondatamodel->getAllRecordWhereOrderBy('investor_relations_details',$where,$orderby);  
            $page = "dashboard/investor_relations/add_edit_investor_relations_partial_view";
            $this->load->view($page,$result);
        }else{
			redirect('login','refresh');
		}
    }


} /* end of class */