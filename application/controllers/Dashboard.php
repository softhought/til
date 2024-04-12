<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('Dashboardmodel','dashboard',TRUE);
    
       
    }

    public function index_old()
	{ 
        $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {     
		$user_id = $session['userid'];
        
        $sl_users = array(1,2,10,26);  //selected users

        // if(in_array($user_id,$sl_users))
        // {
        //     $page = "dashboard/dashboard";
        // }else{
        //     $page = "dashboard/dashboard2";
        // }

        $page = "dashboard/dashboard2";
       /**/
		$result=[];
		$header="";
		$session="";
        $data="";
        $where = array("is_active"=>"Active");

        $totalinvestorlist = $this->commondatamodel->getAllRecordWhere('investor_master',$where);
        $result['totalinvestor']=count($totalinvestorlist);

        $totalstartuplist = $this->commondatamodel->getAllDropdownData('startup_master');
        $result['totalstartup']= count($totalstartuplist);

        $currentmonth = date('Y-m');
        $result['totalconvertedlist'] = $this->dashboard->getMonthlyConertList($currentmonth);
        // Pre($result['totalconvertedlist']);exit;
        $result['total_payment']= $this->dashboard->getMonthPaymentDetail($currentmonth);
        // Pre($result['total_payment']);exit;

        
        createbody_method($result, $page, $header, $session);


    }else{
        redirect('login','refresh');
  
 }
	}


  public function checkdateRange(){
  	 $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {

       $year_id = $session['yearid'];
    	$datedata = $this->input->post('datedata');

    	 $inputdt = str_replace('/', '-', $datedata);
          $input_date=date('Y-m-d',strtotime($inputdt));

    	$getdata = $this->dashboard->checkdaterange($input_date,$year_id);
    	
    	if(!empty($getdata))
                    {
                        $json_response = array(
                            "msg_status" => 1,
                        
                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 0,
                           
                        );
                    }
            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;


    }else{
           redirect('login','refresh');
     
    }
  }





public function viewLogHisory()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

            $row_id = $this->input->post('rowid');
            $table_name = $this->input->post('tablename');
            $company_id=$session['companyid'];
            $year_id=$session['yearid'];

          
           
             $page="dashboard/log_history.php";
             $result['tableColumnData']=$this->commondatamodel->getTableColumn($table_name);
             $result['logData']=$this->dashboard->getAllLogHistory($row_id,$table_name);
            // pre($result['tableColumnData']);exit;
        $this->load->view($page,$result);

    } else {
        redirect('login', 'refresh');
    }
}

public function chartView(){
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {
        
        $result ="";

        for($i = 11; $i>=0; --$i)
        {
            $month[] = date('Y-m',strtotime("-$i months"));
           
        }

        foreach($month as $month)
        {
            
             $totalpotential[] = array(
                                                    'month_name'=>date("M-y", strtotime($month)),
                                                    'potential_count' => $this->dashboard->GetPotentialCount($month), 
                                                    'converted_investor'=>$this->dashboard->getConvertedCount($month),
                                                );
        }

        // pre($totalpotential);exit;
        
    	if(!empty($totalpotential))
        {
            $json_response = array(
                "details"=>$totalpotential,
                "msg_status" => 1,
            
            );
        }
        else
        {
            $json_response = array(
                "msg_status" => 0,
               
            );
        }
                header('Content-Type: application/json');
                echo json_encode( $json_response );
                    exit;



        


 


    }else {
        redirect('login', 'refresh');
    }

}

public function renewalChartView(){
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {
        $result ="";

        for($i = 11; $i>=0; --$i)
        {
            $month[] = date('Y-m',strtotime("-$i months"));
           
        }
        foreach($month as $month)
        {
            
             $totalrenewal[] = array(
                                                    'month_name'=>date("M-y", strtotime($month)),
                                                    'total_renewal' => $this->dashboard->getRenewalListCount($month), 
                                                    'renewal_sucess'=>$this->dashboard->getThisMonthRenewalCount($month),
                                                    'wing_back'=>$this->dashboard->getWingbackCount($month),
                                                );
        }

        if(!empty($totalrenewal))
        {
            $json_response = array(
                "details"=>$totalrenewal,
                "msg_status" => 1,
            
            );
        }
        else
        {
            $json_response = array(
                "msg_status" => 0,
               
            );
        }
                header('Content-Type: application/json');
                echo json_encode( $json_response );
                    exit;
       

    }else {
        redirect('login', 'refresh');
    }

}

public function getConversion(){
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {
        $header = "";
        $result=[];
        $page="dashboard/dashbord-partial-list/convert_list.php";
        $currentmonth = date('Y-m');
        $result['totalconvertedlist'] = $this->dashboard->getMonthlyConvertList($currentmonth);

        createbody_method($result, $page, $header, $session);

    }else {
        redirect('login', 'refresh');
    }
}

public function getMonthPayment(){
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {
        $header = "";
        $result=[];
        $currentmonth = date('Y-m');
                    $result['totalpaymentlist'] = $this->dashboard->getAllPaymentReceiptInvestor($currentmonth);
                    
                    $result['total_payment']= $this->dashboard->getMonthPaymentDetail($currentmonth);
                    // pre($result['total_payment']);exit;
                    $page="dashboard/dashbord-partial-list/this_month_payment.php";
       

        createbody_method($result, $page, $header, $session);

    }else {
        redirect('login', 'refresh');
    }
}


public function conversionListByDate()
{
    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $frm_date = $this->input->post('frm_date');
            $to_date = $this->input->post('to_date');
            
            if($frm_date!=""){
                $frm_date = str_replace('/', '-', $frm_date);
                $frm_date = date("Y-m-d",strtotime($frm_date));                       
             }
             else{
                 $frm_date = NULL;               
             }


            if($to_date!=""){
                $to_date = str_replace('/', '-', $to_date);
                $to_date = date("Y-m-d",strtotime($to_date));                       
             }
             else{
                 $to_date = NULL;               
             }
       

            $result = [];

             $result['conversionList'] =$this->dashboard->conversionListByDate($frm_date,$to_date) ;
             $page="dashboard/dashbord-partial-list/conversion_partial_list.php";
                // pre( $result['conversionList']);exit;
             $this->load->view($page,$result);

        }else{
            redirect('login', 'refresh');
        }
} 

public function paymentListByDate()
{
    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $frm_date = $this->input->post('frm_date');
            $to_date = $this->input->post('to_date');
            
            if($frm_date!=""){
                $frm_date = str_replace('/', '-', $frm_date);
                $frm_date = date("Y-m-d",strtotime($frm_date));                       
             }
             else{
                 $frm_date = NULL;               
             }


            if($to_date!=""){
                $to_date = str_replace('/', '-', $to_date);
                $to_date = date("Y-m-d",strtotime($to_date));                       
             }
             else{
                 $to_date = NULL;               
             }
       

            $result = [];

             $result['paymentList'] =$this->dashboard->paymentListByDate($frm_date,$to_date) ;
             $result['totalAmount'] = $this->dashboard->totalPaymentByDate($frm_date,$to_date);
             $page="dashboard/dashbord-partial-list/payment_partial_list.php";
                // pre( $result['totalAmount']);exit;
             $this->load->view($page,$result);

        }else{
            redirect('login', 'refresh');
        }
} 



// public function getDashboard()
// {
//     $session = $this->session->userdata('user_detail');
//     if($this->session->userdata('user_detail'))
//     {
//        $result = [];
//         $type=$this->input->post('type');

//         if($type == "month_conversion")
//         {
//             $currentmonth = date('Y-m');
//             $result['totalconvertedlist'] = $this->dashboard->getMonthlyConvertList($currentmonth);
//             $page="dashboard/dashbord-partial-list/this_month_convert_partial_list.php";
//             // pre($result['totalconvertedlist']);exit;
//             $this->load->view($page,$result);
//         }else if($type == "payment")
//         {
//             $currentmonth = date('Y-m');
//             $result['totalpaymentlist'] = $this->dashboard->getAllPaymentReceiptInvestor($currentmonth);
            
//             $result['total_payment']= $this->dashboard->getMonthPaymentDetail($currentmonth);
//             // pre($result['total_payment']);exit;
//             $page="dashboard/dashbord-partial-list/this_month_payment.php";
            
//             $this->load->view($page,$result);
//         }
         

//     }else {
//         redirect('login', 'refresh');
//     }

// }




public function index()
{ 
        $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {     
		$user_id = $session['userid'];
        $result=[];
        $user_role = $session['role'];
        // pre( $user_role);exit;
        
        // $sl_users = array(1,2,10,26);  //selected users
        $sl_users = array('Developer','Admin');  //selected users

        // if(in_array($user_role,$sl_users))
        // {
        //     $page = "dashboard/test";
        // }else{
        //     $page = "dashboard/dashboard2";
        // }
        
        $page = "dashboard/dashboard2";
  
       //exit;
       //pre($result);exit;

       /**/
	
		$header="";
		$session="";
        $data=[];

        // pre($result['topinvestor']);exit;
       
        createbody_method($result, $page, $header, $session);

       

    }else{
        redirect('login','refresh');
  
        }
}


public function getMantsAmount()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/dashbord-partial-list/this_month_mants.php";
        $result=[];
		$header="";
		$session="";
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
  
        }

}

public function getMantsList()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    { 
        $result = [];
        $frm_date = $this->input->post('frm_date');
            $to_date = $this->input->post('to_date');
            if($frm_date!=""){
                $frm_date = str_replace('/', '-', $frm_date);
                $frm_date = date("Y-m-d",strtotime($frm_date));                       
             }
             else{
                 $frm_date = NULL;               
             }


            if($to_date!=""){
                $to_date = str_replace('/', '-', $to_date);
                $to_date = date("Y-m-d",strtotime($to_date));                       
             }
             else{
                 $to_date = NULL;               
             }

             $where2 = array("commision_id"=>"8");
              $result['mantsPayment'] =$this->dashboard->mantsAmunt($frm_date,$to_date,$where2);
             $result['totalAmout'] = $this->dashboard->totalMantsPayment($frm_date,$to_date,$where2);
            // pre( $result['mantsPayment']);exit;
            $page="dashboard/dashbord-partial-list/mants_partial_list.php";
           
         

         $this->load->view($page,$result);

            
    }else{
        redirect('login','refresh');
  
        }

}

}//end of class