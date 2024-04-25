<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Master extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('mastermodel','mastermodel',TRUE);
    
    }

public function nature_of_query()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/master/nature_of_query.php";
        $header="";
        $orderby='id';
        $result['nature_of_queryList'] = $this->commondatamodel->getAllRecordWhereOrderBy('fuel_nature_of_query',[],$orderby);  

      //  pre($result['participantList']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }

}

public function enquiry()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/master/enquiry.php";
        $header="";
        $result['contactusList'] = $this->mastermodel->enquiryData();  

      //  pre($result['participantList']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }

}





   


}
