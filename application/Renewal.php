<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Renewal extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('investormodel','investormodel',TRUE); 
        $this->load->model('paymentreceiptmodel', 'paymentreceiptmodel', true);

        ini_set('memory_limit', '1024M');
        $this->method_call_view =& get_instance(); 
    }

public function index()
{

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/renewal/renewal_list.php";
        $header="";
        $result=[];
        
        $result['chapterList'] = $this->commondatamodel->getAllDropdownData('chapter_master');
        $result['monthList'] = $this->commondatamodel->getAllDropdownData('month_master');

         $year=$session['yearid'];
         $where = array('year_id'=>$year);
         $result['yearData'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);

         
                      
 
        createbody_method($result, $page, $header, $session);

    }else{

        redirect('login','refresh');

    }

    

  }

  public function getRenualData()
	{
     $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{
		   $sel_year = $this->input->post('sel_year');
		   $sel_month = $this->input->post('sel_month');
		   $sel_chapter = $this->input->post('sel_chapter');
           if (strlen($sel_month)==1) {
                $sel_month="0".$sel_month;
            }

          $endYearMonths = array('01','02','03');
          $year=$session['yearid'];
          $where = array('year_id'=>$year);
          $yearData = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
          $startYear= date("Y", strtotime($yearData->start_date));
          $endYear= date("Y", strtotime($yearData->end_date));


          if (in_array($sel_month,$endYearMonths)) {
            $search_year_month=$endYear."-".$sel_month;
          }else{
            $search_year_month=$startYear."-".$sel_month;
          }


       
          //  $search_year_month=$sel_year."-".$sel_month;
            $data['search_year_month']=$search_year_month;
            $data['sel_month']=$sel_month;
            $data['year_id']=$year;




           
      //  $data['investorRenewalList'] = $this->investormodel->getRenwalData($sel_chapter,$search_year_month);
		    $data['investorRenewalList'] = $this->investormodel->getRenwalDataByRenualDate($sel_chapter,$search_year_month);

        
		   
	       $viewTemp = $this->load->view('dashboard/renewal/renewal_list_partial_view.php',$data,TRUE);
		   echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}

    

public function renewalCalDetails()
  {
      if($this->session->userdata('user_detail'))
      {

        $search_year_month = $this->input->post('search_year_month');
        $investorid = $this->input->post('investorid');
        $tenure_of_membership = $this->input->post('tenure');
        $data['tenure_of_membership']=$tenure_of_membership;
        $date_of_join = $this->input->post('doj');
        $data['date_of_join']=date("d-m-Y",strtotime($date_of_join));
        $data['dateArray']=$this->checkRenualMonth($date_of_join,$tenure_of_membership,$search_year_month);
    
        $page = "dashboard/renewal/renewal_cal_details";
          
         $viewTemp = $this->load->view($page,$data,TRUE);
         echo $viewTemp;

      }
      else
      {
          redirect('login','refresh');
      }

  }

function checkRenualMonth($date_of_join,$tenure_of_membership,$search_year_month){
$dateArray=[];

			$renual_month=date("Y-m",strtotime($date_of_join));
				while($renual_month <= $search_year_month) {
				$renual_month=date('Y-m', strtotime($renual_month . "+".$tenure_of_membership."months") );
				$dateArray[]=date('m-Y', strtotime($renual_month)); 		
				}

		
	return $dateArray;

}


     public function proformaInvDetails(){    
       $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

            $company=$session['companyid'];
            $year=$session['yearid'];
            $where = array('year_id'=>$year);
            $yearData = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
            $data['start_date']=$yearData->start_date;
            $data['end_date']=$yearData->end_date;


            //  pre($yearData);exit;

            $investor_id = $this->input->post('investor_id');
            $data['search_month'] = $this->input->post('search_month');
            $data['search_year_month'] = $this->input->post('search_year_month');

            $check=$this->checkRenewalData($investor_id,$data['search_month'],$year);
            if ($check) {
            
              $data['renewal_id']=$check->renewal_id;
            }else{
             
              $data['renewal_id']=0;
            }

            $data['mode'] = "EDIT";
          
            $data['investorData'] = $this->investormodel->getInvestorDataByID($investor_id); 
            $flag=1;
            $missing_data="";

          $where = array('investor_id'=>$investor_id);
          $investorData = (array)$data['investorData'];
           
          $country_master_id=$data['investorData']->country_master_id;

          if ($country_master_id==99) {
              $verificationColumn = array(
                                        'country_master_id'=>"Country",
                                        'membership_type_id'=>"Membership Type",
                                        'inv_state_id'=>"Investor State",
                                       // 'inv_gstin_no'=>"Investor GSTN",
                                        'date_of_joining'=>"Date Of Join",
                                      );
          }else{
            $verificationColumn = array(
                                        'country_master_id'=>"Country",
                                        'membership_type_id'=>"Membership Type",
                                        'date_of_joining'=>"Date Of Join",
                                      );

          }
           
         
           

            foreach ($verificationColumn as $key => $msg) {
             
            //$investorData[$verify->column]
                if($investorData[$key]=='' || $investorData[$key]=='0'){
                  $flag=0; 
                  $missing_data.=$msg.","; 
                }

           }

           if(!$flag){
            $data['missing_data']=$missing_data;

           }else{
          
            $data['missing_data']='';
          $investor_membership_type_id=$data['investorData']->membership_type_id;
          
          $inv_state_id=$data['investorData']->inv_state_id;
          $date_of_joining=$data['investorData']->date_of_joining;
          $has_gstno=$data['investorData']->has_gstno;
          $mumbai_angles_state_id=15;
         
          $subscription_amount=$this->getMembershipTypeData($investor_membership_type_id)->renewal_amount;
          $data['subscription_amount']= $subscription_amount;

          $invoice_date=date('Y-m-d');
          $date = new DateTime($invoice_date);
          $date->modify('last day of this month');
          $proforma_due_date=$date->format('Y-m-d');

         
          $data['cgst_amt']=NULL;
          $data['sgst_amt']=NULL; 
          $data['igst_amt']=NULL;
          $gst_total=0;


          if ($country_master_id==99) {
            # code...
          

              if ($inv_state_id==$mumbai_angles_state_id) {
                $cgstData=$this->getGstDetails('CGST',$company,'O');
                $cgst_id=$cgstData->id;
                $data['cgst_amt']= ($subscription_amount*$cgstData->rate)/100; 
                $sgstData=$this->getGstDetails('SGST',$company,'O');
                $sgst_id=$sgstData->id;
                $data['sgst_amt']=($subscription_amount*$sgstData->rate)/100;
                $gst_total=($data['cgst_amt']+$data['sgst_amt']);
              }else{
                $igstData=$this->getGstDetails('IGST',$company,'O');
                $igst_id=$igstData->id;
                $data['igst_amt']=($subscription_amount*$igstData->rate)/100;
                $gst_total=$data['igst_amt'];
              }
          }
          $data['total_amount']= $data['subscription_amount']+$gst_total;

           $data['membershipDetails']=$this->investormodel->getLastMembershipPlanDetails($investor_id);


          $renual_month=date('F Y', strtotime($date_of_joining . "+".($data['membershipDetails']->tenure_of_membership-1)."months") );

        }

      

            $page = 'dashboard/renewal/generate_proforma_invoice.php';
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;


           


        }else{
           redirect('login', 'refresh');
        }

    }

    public function getMembershipTypeData($membership_type_id){
      $where = array('membership_type_id'=>$membership_type_id);
      return $investorData = $this->commondatamodel->getSingleRowByWhereCls('membership_type',$where);
    }

  public function getGstDetails($gstType,$companyid,$usedfor){

      $where = array(
                      'gstType'=>$gstType,
                      'companyid'=>$companyid,
                      'usedfor'=>$usedfor,
                    );
        return $this->commondatamodel->getSingleRowByWhereCls('gstmaster',$where);
    } 



  public function gstInvDetails(){    
       $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

            $company=$session['companyid'];
            $year=$session['yearid'];
            $investor_id = $this->input->post('investor_id');
            $where = array('year_id'=>$year);
            $yearData = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);


            $data['start_date']=$yearData->start_date;
            $data['end_date']=$yearData->end_date;

            $data['search_month'] = $this->input->post('search_month');
            $data['search_year_month'] = $this->input->post('search_year_month');



            $check=$this->checkRenewalData($investor_id,$data['search_month'],$year);
          if($check) {
              $data['proforma_invoice_id']=$check->proforma_invoice_id;
              $data['renewal_id']=$check->renewal_id;
            }else{
              $data['proforma_invoice_id']=NUll;
              $data['renewal_id']=0;
            }
           

            $data['mode'] = "EDIT";       
            $data['investorData'] = $this->investormodel->getInvestorDataByID($investor_id); 
            $flag=1;
            $missing_data="";


            $where = array('investor_id'=>$investor_id);
            $investorData = (array)$data['investorData'];
           
            $country_master_id=$data['investorData']->country_master_id;

          if ($country_master_id==99) {
              $verificationColumn = array(
                                        'country_master_id'=>"Country",
                                        'membership_type_id'=>"Membership Type",
                                        'inv_state_id'=>"Investor State",
                                       //'inv_gstin_no'=>"Investor GSTN",
                                        'date_of_joining'=>"Date Of Join",
                                      );
          }else{
            $verificationColumn = array(
                                        'country_master_id'=>"Country",
                                        'membership_type_id'=>"Membership Type",
                                        'date_of_joining'=>"Date Of Join",
                                      );

          }
           
       

            foreach ($verificationColumn as $key => $msg) {
             
            //$investorData[$verify->column]
                if($investorData[$key]=='' || $investorData[$key]=='0'){
                  $flag=0; 
                  $missing_data.=$msg.","; 
                }

           }

           if(!$flag){
            $data['missing_data']=$missing_data;

           }else{
          
            $data['missing_data']='';
          $investor_membership_type_id=$data['investorData']->membership_type_id;
          $inv_state_id=$data['investorData']->inv_state_id;
          $date_of_joining=$data['investorData']->date_of_joining;
          $has_gstno=$data['investorData']->has_gstno;
          $mumbai_angles_state_id=15;
         
          $subscription_amount=$this->getMembershipTypeData($investor_membership_type_id)->renewal_amount;
          $data['subscription_amount']= $subscription_amount;

          $invoice_date=date('Y-m-d');
          $date = new DateTime($invoice_date);
          $date->modify('last day of this month');
          $proforma_due_date=$date->format('Y-m-d');

          $data['cgst_amt']=NULL;
          $data['sgst_amt']=NULL; 
          $data['igst_amt']=NULL;
          $gst_total=0;

           if ($country_master_id==99) {
              if ($inv_state_id==$mumbai_angles_state_id) {
                $cgstData=$this->getGstDetails('CGST',$company,'O');
                $cgst_id=$cgstData->id;
                $data['cgst_amt']= ($subscription_amount*$cgstData->rate)/100; 
                $sgstData=$this->getGstDetails('SGST',$company,'O');
                $sgst_id=$sgstData->id;
                $data['sgst_amt']=($subscription_amount*$sgstData->rate)/100;
                $gst_total=($data['cgst_amt']+$data['sgst_amt']);
              }else{
                $igstData=$this->getGstDetails('IGST',$company,'O');
                $igst_id=$igstData->id;
                $data['igst_amt']=($subscription_amount*$igstData->rate)/100;
                $gst_total=$data['igst_amt'];
              }

            }

          $data['total_amount']= $data['subscription_amount']+$gst_total;


         

        }

          $data['membershipDetails']=$this->investormodel->getLastMembershipPlanDetails($investor_id);

          $last_renewal_date = date("Y-m-d",strtotime($data['membershipDetails']->renewal_date));

          $tenure_of_membership=$data['membershipDetails']->tenure_of_membership;
          $tenure_of_membership=12;/* tenure 12 month for renewal added on 07122021*/
          
          $data['renewal_date']=date('Y-m-d', strtotime($last_renewal_date . "+".($tenure_of_membership)."months") );
          $data['valid_upto'] =  date("d/m/Y",strtotime($data['renewal_date']." -1 day"));
          $data['renewal_date']= date("d/m/Y",strtotime($data['renewal_date']));
           // pre($data);


          

           // exit;

            $page = 'dashboard/renewal/generate_gst_invoice.php';
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;


           


        }else{
           redirect('login', 'refresh');
        }

    } 

/** generate proforma invoice */


    public function processGenerateProformaInvoice()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
          

            $investor_id = $this->input->post('investor_id');
            $investor_id = $this->input->post('investor_id');
            $invoice_date = $this->input->post('invest_dt');
            $renewal_month = $this->input->post('renewal_month');
            $renewal_id = $this->input->post('renewal_id');
            $invoice_no = $this->input->post('invoice_no');
            $mants_point = $this->input->post('mants_point');


              if($invoice_date!=""){
                $invoice_date = str_replace('/', '-', $invoice_date);
                $invoice_date = date("Y-m-d",strtotime($invoice_date));                       
             }
             else{
                 $invoice_date = NULL;               
             }


            $flag=1;
            $missing_data="";

          $where = array('investor_id'=>$investor_id);
          $investorData = (array)$this->commondatamodel->getSingleRowByWhereCls('investor_master',$where);
           // pre($investorData);

           
              $country_master_id=$investorData['country_master_id'];

          if ($country_master_id==99) {
              $verificationColumn = array(
                                        'country_master_id'=>"Country",
                                        'membership_type_id'=>"Membership Type",
                                        'inv_state_id'=>"Investor State",
                                       // 'inv_gstin_no'=>"Investor GSTN",
                                        'date_of_joining'=>"Date Of Join",
                                      );
          }else{
            $verificationColumn = array(
                                        'country_master_id'=>"Country",
                                        'membership_type_id'=>"Membership Type",
                                        'date_of_joining'=>"Date Of Join",
                                      );

          }
      

            foreach ($verificationColumn as $key => $msg) {
             
            //$investorData[$verify->column]
                if($investorData[$key]=='' || $investorData[$key]=='0'){
                  $flag=0; 
                  $missing_data.=$msg.","; 
                }

           }
           


            if(!$flag){
                 $json_response = array(
                "msg_status" => 0,               
                "msg_data" => "Generate Proforma Invoice Verification failed",
                "missing_data" => "Please Add: ".$missing_data,
            );
            }else{




            

                $check=0;
                $proformaInvoiceid=0;
                if ($check) {
                  # code...
                }else{
                 $proformaInvoiceid=$this->generateProformaInvoiceIR($investor_id,$invoice_date,$renewal_month,$renewal_id,$invoice_no,$mants_point);
                }

                $json_response = array(
                    "msg_status" => 1,               
                    "msg_data" => "Generated Successfully Proforma Invoice ",
                    "missing_data" => $missing_data,
                    "proformaInvoiceid" => $proformaInvoiceid,
                );

            }

          
           
            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;


    } else {
        redirect('login', 'refresh');
    }
} 


  public function generateProformaInvoiceIR($investor_id,$invoice_date,$renewal_month,$renewal_id,$invoice_no,$mants_point){

      $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

          $company=$session['companyid'];
          $year=$session['yearid'];
          $module='PROFORMAINVOICE';

           $where = array('year_id'=>$year);
           $yearData = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
           $yeardata=explode(' - ', $yearData->year);
           $yearTag=$yeardata[0]."/".$yeardata[1];

          $where = array('investor_id'=>$investor_id);
          $investorData = $this->commondatamodel->getSingleRowByWhereCls('investor_master',$where);

          $investor_membership_type_id=$investorData->membership_type_id;
          $inv_state_id=$investorData->inv_state_id;
          $country_master_id=$investorData->country_master_id;
          $date_of_joining=$investorData->date_of_joining;
          $has_gstno=$investorData->has_gstno;
          $mumbai_angles_state_id=15;
         // $invoice_no=$this->getSerialNumber($company,$year,$module);
         
          $subscription_amount=$this->getMembershipTypeData($investor_membership_type_id)->renewal_amount;

         // $invoice_date=date('Y-m-d');
          $date = new DateTime($invoice_date);
          $date->modify('last day of this month');
          $proforma_due_date=$date->format('Y-m-d');

          $cgst_id=NULL;
          $cgst_amt=NULL;
          $sgst_id=NULL;
          $sgst_amt=NULL;
          $igst_id=NULL;
          $igst_amt=NULL;
           $gst_total=0;

          if ($country_master_id==99) {
     

              if ($inv_state_id==$mumbai_angles_state_id) {
                $cgstData=$this->getGstDetails('CGST',$company,'O');
                $cgst_id=$cgstData->id;
                $cgst_amt= ($subscription_amount*$cgstData->rate)/100;
                $sgstData=$this->getGstDetails('SGST',$company,'O');
                $sgst_id=$sgstData->id;
                $sgst_amt=($subscription_amount*$sgstData->rate)/100;
                $gst_total=($cgst_amt+$sgst_amt);
              }else{
                $igstData=$this->getGstDetails('IGST',$company,'O');
                $igst_id=$igstData->id;
                $igst_amt=($subscription_amount*$igstData->rate)/100;
                $gst_total=($igst_amt);
              }

            }

              $data['membershipDetails']=$this->investormodel->getLastMembershipPlanDetails($investor_id);
            $tenure_of_membership=$data['membershipDetails']->tenure_of_membership;
            $tenure_of_membership=12;/* for renewal 12 added on 07122021 by majash*/
          $renual_month=date('F Y', strtotime($invoice_date . "+".($tenure_of_membership-1)."months") );
          $start_month=date('F Y', strtotime($invoice_date));

          $desc_two="Membership Subscription Renewal for ".$start_month." - ".$renual_month;


          $insert_proforma_invoice = array(
                                            'proforma_invoice_no' => $invoice_no, 
                                            'proforma_invoice_date' => $invoice_date,
                                            'proforma_due_date' => $proforma_due_date, 
                                            'proforma_type' => 'R', 
                                            'investor_master_id'=> $investor_id,
                                            'taxable_amount'=> $subscription_amount,
                                            'cgst_amt'=> $cgst_amt,
                                            'sgst_amt'=> $sgst_amt,
                                            'igst_amt'=> $igst_amt,
                                            'gst_total'=> $gst_total,
                                            'cgst_id'=> $cgst_id,
                                            'sgst_id'=> $sgst_id,
                                            'igst_id'=> $igst_id,
                                            'total_amount'=> ($subscription_amount+$gst_total),
                                            'desc_one'=> "Being towards MAVM Angels Network Pvt Ltd Membership For ".$yearTag,
                                            'desc_two'=> $desc_two,
                                            'created_on'=> date('Y-m-d h:i'),
                                            'company_id'=> $session['companyid'],
                                            'year_id'=> $session['yearid'],
                                            'mants_point'=> $mants_point,
                                          );

          
          $proforma_invoice_id = $this->commondatamodel->insertSingleTableData('proforma_invoice_ir',$insert_proforma_invoice);


          /* insert or update investor_renual*/
          if ($renewal_id!=0) {
              $upd_where = array('investor_renewal.renewal_id' => $renewal_id);
              $upd_array = array('proforma_invoice_id' => $proforma_invoice_id,'proforma_invoice_date' => $invoice_date );
              $update = $this->commondatamodel->updateSingleTableData('investor_renewal',$upd_array,$upd_where);
           
          }else{

          $insert_investor_renewal = array(
                                            'investor_master_id' => $investor_id, 
                                            'month_id' => $renewal_month, 
                                            'year_id' => $session['yearid'], 
                                            'company_id' => $session['companyid'], 
                                            'bill_amount' => $subscription_amount, 
                                            'cgst_amount' => $cgst_amt, 
                                            'sgst_amount' => $sgst_amt, 
                                            'igst_amount' => $igst_amt, 
                                            'net_amount' => ($subscription_amount+$gst_total), 
                                            'proforma_invoice_id' => $proforma_invoice_id, 
                                            'proforma_invoice_date' => $invoice_date, 
                                            'created_on'=> date('Y-m-d h:i'),
                                          );


          $this->commondatamodel->insertSingleTableData('investor_renewal',$insert_investor_renewal);
        }

          return $proforma_invoice_id;

      }else{
         redirect('login', 'refresh');
      }    

    } 


    public function getSerialNumber($company,$year,$module){
        $lastnumber = (int)(0);
        $tag = "";
        $noofpaddingdigit = (int)(0);
        $autoSaleNo="";
        $yeartag ="";
        $sql="SELECT
                id,
                SERIAL,
                moduleTag,
                lastnumber,
                noofpaddingdigit,
                module,
                company_id,
                year_id,
                year_tag
            FROM serialmaster
            WHERE company_id=".$company." AND year_id=".$year." AND module='".$module."' LOCK IN SHARE MODE";
        
                  $query = $this->db->query($sql);
      if ($query->num_rows() > 0) {
        $row = $query->row(); 
        $lastnumber = $row->lastnumber;
                          $tag = $row->moduleTag;
                          $noofpaddingdigit = $row->noofpaddingdigit;
                          $yeartag = $row->year_tag;
                          
                          
      }
          $digit = (int)(log($lastnumber,10)+1) ;  
        if($digit==4){
            $autoSaleNo = $yeartag."/0".$lastnumber;
        }else if($digit==3){
            $autoSaleNo = $yeartag."/00".$lastnumber;
        }else if($digit==2){
            $autoSaleNo = $yeartag."/000".$lastnumber;
        }else if($digit==1){
            $autoSaleNo = $yeartag."/0000".$lastnumber;
        }else{
           $autoSaleNo = $yeartag."/".$lastnumber;
        }
        $lastnumber = $lastnumber + 1;
        
        //update
        $data = array(
        'serial' => $lastnumber,
        'lastnumber' => $lastnumber
        );
        $array = array('company_id' => $company, 'year_id' => $year, 'module' => $module);
        $this->db->where($array); 
        $this->db->update('serialmaster', $data);
        
        return $autoSaleNo;
        
    }


   public function checkRenewalData($investor_master_id,$month_id,$year_id){

      $where = array(
                      'investor_master_id'=> $investor_master_id,
                      'month_id'=> $month_id,
                      'year_id'=> $year_id,
                    );
      return $this->commondatamodel->getSingleRowByWhereCls('investor_renewal',$where);

    }


    public function checkProformaInvoiceIR($proforma_invoice_id){

      $where = array('proforma_invoice_id'=> $proforma_invoice_id);
      return $this->commondatamodel->getSingleRowByWhereCls('proforma_invoice_ir',$where);

    }


       
    public function processGenerateGstInvoice()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

            $investor_id = $this->input->post('investor_id');
            $proforma_invoice_id = $this->input->post('proforma_invoice_id');
            $invoice_date = $this->input->post('invest_dt');
            $renewal_month = $this->input->post('renewal_month');
            $renewal_id = $this->input->post('renewal_id');

            $tenure_of_membership = $this->input->post('tenure_of_membership');
            $mambership_type_id = $this->input->post('mambership_type_id');
            $invoice_no = $this->input->post('invoice_no');

            $valid_upto = $this->input->post('valid_upto');
             if($valid_upto!=""){
                $valid_upto = str_replace('/', '-', $valid_upto);
                $valid_upto = date("Y-m-d",strtotime($valid_upto));                       
             }
             else{
                 $valid_upto = NULL;               
             }
            $next_renewal_date = $this->input->post('renewal_date');
               if($next_renewal_date!=""){
                $next_renewal_date = str_replace('/', '-', $next_renewal_date);
                $next_renewal_date = date("Y-m-d",strtotime($next_renewal_date));                       
             }
             else{
                 $next_renewal_date = NULL;               
             }
            $calculated_renewal_date = $this->input->post('calculated_renewal_date');
            $renewal_date_note = $this->input->post('renewal_date_note');

 




              if($invoice_date!=""){
                $invoice_date = str_replace('/', '-', $invoice_date);
                $invoice_date = date("Y-m-d",strtotime($invoice_date));                       
             }
             else{
                 $invoice_date = NULL;               
             }





            $flag=1;
            $missing_data="";

          $where = array('investor_id'=>$investor_id);
          $investorData = (array)$this->commondatamodel->getSingleRowByWhereCls('investor_master',$where);
           // pre($investorData);
          $country_master_id=$investorData['country_master_id'];

           
          
          if ($country_master_id==99) {
              $verificationColumn = array(
                                        'country_master_id'=>"Country",
                                        'membership_type_id'=>"Membership Type",
                                        'inv_state_id'=>"Investor State",
                                        //'inv_gstin_no'=>"Investor GSTN",
                                        'date_of_joining'=>"Date Of Join",
                                      );
          }else{
            $verificationColumn = array(
                                        'country_master_id'=>"Country",
                                        'membership_type_id'=>"Membership Type",
                                        'date_of_joining'=>"Date Of Join",
                                      );

          }
      
           

            foreach ($verificationColumn as $key => $msg) {
             
            //$investorData[$verify->column]
                if($investorData[$key]=='' || $investorData[$key]=='0'){
                  $flag=0; 
                  $missing_data.=$msg.","; 
                }

           }
           


            if(!$flag){
                 $json_response = array(
                "msg_status" => 0,               
                "msg_data" => "Generate GST Invoice Verification failed",
                "missing_data" => "Please Add: ".$missing_data,
            );
            }else{

             

               
                $gstInvoiceid=0;
                $check=0;
                if($check) {
                  # code...
                }else{
                 $gstInvoiceid=$this->generateGstInvoiceIR($investor_id,$invoice_date,$proforma_invoice_id,$renewal_month,$renewal_id,$mambership_type_id,$tenure_of_membership,$invoice_no,$next_renewal_date,$renewal_date_note);
                }



                $json_response = array(
                    "msg_status" => 1,               
                    "msg_data" => "Generated Successfully Proforma Invoice ",
                    "missing_data" => $missing_data,
                    "gstInvoiceid" => $gstInvoiceid,
                );

            }

          
           
            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;


    } else {
        redirect('login', 'refresh');
    }
}


    public function generateGstInvoiceIR($investor_id,$invoice_date,$proforma_invoice_id,$renewal_month,$renewal_id,$mambership_type_id,$tenure_of_membership,$invoice_no,$next_renewal_date,$renewal_date_note){

      $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

          $company=$session['companyid'];
          $year=$session['yearid'];
          $module='GSTINVOICE';

           $where = array('year_id'=>$year);
           $yearData = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
           $yeardata=explode(' - ', $yearData->year);
           $yearTag=$yeardata[0]."/".$yeardata[1];

          $where = array('investor_id'=>$investor_id);
          $investorData = $this->commondatamodel->getSingleRowByWhereCls('investor_master',$where);

          $investor_membership_type_id=$investorData->membership_type_id;
          $last_renewal_date=$investorData->last_renewal_date;
          $country_master_id=$investorData->country_master_id;
          $inv_state_id=$investorData->inv_state_id;
          $date_of_joining=$investorData->date_of_joining;
          $has_gstno=$investorData->has_gstno;
          $mumbai_angles_state_id=15;
         // $invoice_no=$this->getSerialNumber($company,$year,$module);
          $subscription_amount=$this->getMembershipTypeData($investor_membership_type_id)->renewal_amount;

         // $invoice_date=date('Y-m-d');
          $date = new DateTime($invoice_date);
          $date->modify('last day of this month');
          $proforma_due_date=$date->format('Y-m-d');

          $cgst_id=NULL;
          $cgst_amt=NULL;
          $sgst_id=NULL;
          $sgst_amt=NULL;
          $igst_id=NULL;
          $igst_amt=NULL;
          $gst_total=0;

          if ($country_master_id==99) {

              if ($inv_state_id==$mumbai_angles_state_id) {
                $cgstData=$this->getGstDetails('CGST',$company,'O');
                $cgst_id=$cgstData->id;
                $cgst_amt= ($subscription_amount*$cgstData->rate)/100;
                $sgstData=$this->getGstDetails('SGST',$company,'O');
                $sgst_id=$sgstData->id;
                $sgst_amt=($subscription_amount*$sgstData->rate)/100;
                $gst_total=($cgst_amt+$sgst_amt);
              }else{
                $igstData=$this->getGstDetails('IGST',$company,'O');
                $igst_id=$igstData->id;
                $igst_amt=($subscription_amount*$igstData->rate)/100;
                $gst_total=($igst_amt);
              }

          }
            /* Last renewal data*/
          $data['membershipDetails']=$this->investormodel->getLastMembershipPlanDetails($investor_id);
          $renewalDate=$data['membershipDetails']->renewal_date;


          $renual_month=date('F Y', strtotime($renewalDate . "+".($tenure_of_membership-1)."months") );
          $start_month=date('F Y', strtotime($renewalDate));

          $desc_two="Membership Subscription Renewal for ".$start_month." - ".$renual_month;


          $insert_proforma_invoice = array(
                                            'gst_invoice_no' => $invoice_no, 
                                            'gst_invoice_date' => $invoice_date,
                                            'gst_due_date' => $proforma_due_date, 
                                            'gstincv_type' => 'R', 
                                            'investor_master_id'=> $investor_id,
                                            'taxable_amount'=> $subscription_amount,
                                            'cgst_amt'=> $cgst_amt,
                                            'sgst_amt'=> $sgst_amt,
                                            'igst_amt'=> $igst_amt,
                                            'gst_total'=> $gst_total,
                                            'cgst_id'=> $cgst_id,
                                            'sgst_id'=> $sgst_id,
                                            'igst_id'=> $igst_id,
                                            'total_amount'=> ($subscription_amount+$gst_total),
                                            'desc_one'=> "Being towards MAVM Angels Network Pvt Ltd Membership For ".$yearTag,
                                            'desc_two'=> $desc_two,
                                            'proforma_invoice_id'=> $proforma_invoice_id,
                                            'created_on'=> date('Y-m-d h:i'),
                                            'company_id'=> $session['companyid'],
                                            'year_id'=> $session['yearid'],
                                          );

          $gst_invoice_id=$this->commondatamodel->insertSingleTableData('gst_invoice_ir',$insert_proforma_invoice);

      

          /* insert into party bill master*/

          $insert_into_party_bill = array(
                                           'gst_invoice_id'=> $gst_invoice_id,
                                           'bill_tag'=> 'IR-R',
                                           'bill_amount'=> ($subscription_amount+$gst_total),
                                           'created_on'=> date('Y-m-d h:i'),
                                           'company_id'=> $session['companyid'],
                                           'year_id'=> $session['yearid'],
                                         );

          $this->commondatamodel->insertSingleTableData('party_bill_master',$insert_into_party_bill);

          /* insert or update investor_renual*/
          if ($renewal_id!=0) {
              $upd_where = array('investor_renewal.renewal_id' => $renewal_id);
              $upd_array = array('gst_invoice_id' => $gst_invoice_id,'gst_invoice_date' => $invoice_date );
              $update = $this->commondatamodel->updateSingleTableData('investor_renewal',$upd_array,$upd_where);
           
          }else{

               $insert_investor_renewal = array(
                                            'investor_master_id' => $investor_id, 
                                            'month_id' => $renewal_month, 
                                            'year_id' => $session['yearid'], 
                                            'company_id' => $session['companyid'], 
                                            'bill_amount' => $subscription_amount, 
                                            'cgst_amount' => $cgst_amt, 
                                            'sgst_amount' => $sgst_amt, 
                                            'igst_amount' => $igst_amt, 
                                            'net_amount' => ($subscription_amount+$gst_total), 
                                            'gst_invoice_id' => $gst_invoice_id, 
                                            'gst_invoice_date' => $invoice_date, 
                                            'created_on'=> date('Y-m-d h:i'),
                                          );


          $this->commondatamodel->insertSingleTableData('investor_renewal',$insert_investor_renewal);

          }

          /* add data to membership plan details*/

          $renewal_date=date('Y-m-d', strtotime($renewalDate . "+".($tenure_of_membership)."months"));
          $yesterday = date("Y-m-d",strtotime($renewal_date." -1 day"));
            
            $membership_plan = array(
                                      'investor_master_id' => $investor_id,
                                      'membership_type_id' => $mambership_type_id,
                                      'tenure_of_membership' => $tenure_of_membership,
                                      'renewal_date' =>  $next_renewal_date,
                                      'calculated_renewal_date' =>  $renewal_date,
                                      'valid_upto' =>  $yesterday,
                                      'renewal_date_note' =>  $renewal_date_note,
                                      'created_on' => date('Y-m-d h:i'),
                                    );


           

          $this->commondatamodel->insertSingleTableData('investor_membership_plan_details',$membership_plan);

          /* Update Last renewal date*/

          $investor_data = array('last_renewal_date'=>$renewalDate);
          $upd_where = array('investor_master.investor_id' => $investor_id);

          $this->commondatamodel->updateSingleTableData('investor_master',$investor_data,$upd_where);


          return $gst_invoice_id;

      }else{
         redirect('login', 'refresh');
      }    

    }

    function getPaymentByProforma($proforma_invoice_id){
      $where = array('proforma_invoice_id' => $proforma_invoice_id );

      
      return $this->commondatamodel->getSingleRowByWhereCls('party_bill_payment',$where);
    }




  public function getProformaPaymentView(){    
       $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

            $company=$session['companyid'];
            $year=$session['yearid'];
            $investor_id = $this->input->post('investor_id');
            $where = array('year_id'=>$year);
            $yearData = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);


            $data['start_date']=$yearData->start_date;
            $data['end_date']=$yearData->end_date;

            $data['search_month'] = $this->input->post('search_month');
            $data['search_year_month'] = $this->input->post('search_year_month');
            $data['investor_id'] = $this->input->post('investor_id');

            $data['mode'] = "ADD";
            $data['btnText'] = "Save";
            $data['btnTextLoader'] = "Saving...";
            $data['paymentReceiptID'] = 0;
            $data['paymentReceiptEditData'] = [];
            $data['investorList']=[];
           // $data['invoiceList']=[];

            $data['chapterList'] = $this->commondatamodel->getAllDropdownData('chapter_master');
        $data['commisionList'] = $this->commondatamodel->getAllDropdownData('commision_master');
        $where = array('deduction_type' => 'TDS' );
        $data['tdsRateList'] = $this->commondatamodel->getAllRecordWhere('tax_deduction_rate',$where);
        $where = array('deduction_type' => 'TCS' );
        $data['tcsRateList'] = $this->commondatamodel->getAllRecordWhere('tax_deduction_rate',$where);

        $where = array('investor_id' => $data['investor_id'] );
        $data['investorList'] = $this->commondatamodel->getAllRecordWhere('investor_master',$where);


        $data['invoiceList'] = $this->paymentreceiptmodel->getProformaInvoiceDataByInvestor($data['investor_id']);
      //  pre($data['invoiceList']);

          //  exit;

            $page = 'dashboard/renewal/addedit_payment_receipt.php';
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;


           


        }else{
           redirect('login', 'refresh');
        }

    } 





}/* end of class  */