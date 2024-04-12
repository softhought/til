<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Verification extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
       

    }

public function index()
{

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/verification/verification_list.php";
        $header="";
        $result=[];
        $orderby='ver_id';
        $result['verificationList'] = $this->commondatamodel->getAllRecordWhereOrderBy('data_verification',[],$orderby);
       
        //pre($result['doctorLeaveList']); exit;                  
 
        createbody_method($result, $page, $header, $session);

    }else{

        redirect('login','refresh');

    }

    

  }


  public function addVerification()
{

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

          if($this->uri->segment(3) == NULL){
            $result['mode'] = "ADD";
            $result['btnText'] = "Save";
            $result['btnTextLoader'] = "Saving...";
            $result['verificationId'] = 0;
            $result['verificationEditdata'] = [];
            $result['tableColumn'] = [];
           }else{
            $result['mode'] = "EDIT";
            $result['btnText'] = "Update";
            $result['btnTextLoader'] = "Updating...";
            $result['verificationId'] = $this->uri->segment(3);
            $where = array('ver_id'=>$result['verificationId']);
            $result['verificationEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('data_verification',$where);
            $table_name=$result['verificationEditdata']->table_name;
             $result['tableColumn']=$this->commondatamodel->getTableColumn($table_name);
       }
      
       $result['tableList'] = array('investor_master','startup_master');
      //pre($result['investorTableData']);exit;
        $page = "dashboard/verification/addedit_verification.php";
        $header="";            
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');

    }

  }



      public function verification_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

          $verificationId = trim(htmlspecialchars($this->input->post('verificationId')));
          $mode = trim(htmlspecialchars($this->input->post('mode')));        
          $table_name = trim(htmlspecialchars($this->input->post('table_name')));
          $column_name = trim(htmlspecialchars($this->input->post('column_name')));
          $error_msg = trim(htmlspecialchars($this->input->post('error_msg')));
     


          if($verificationId>0 && $mode=="EDIT")
            {

                     $upd_array = array(                                 
                                        "table_name" => $table_name,                                      
                                        "column" => $column_name,                                      
                                        "error_msg" => $error_msg,                                      
                                     );
                    
                    $upd_where = array('data_verification.ver_id' => $verificationId);

                     $update = $this->commondatamodel->updateSingleTableData('data_verification',$upd_array,$upd_where);
                    if($update)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Updated successfully",
                            "mode" => "EDIT"
                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "There is some problem while updating ...Please try again."
                        );
                    }



            }else{
               

 
                     $array_insert_dtlenq = array(
                                                "table_name" => $table_name,
                                                "column" => $column_name,                                      
                                                "error_msg" => $error_msg,
                                     );

                     

                     $insert_id = $this->commondatamodel->insertSingleTableData('data_verification',$array_insert_dtlenq);




                    if($insert_id)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Saved successfully",
                            "mode" => "ADD"
                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "There is some problem.Try again"
                        );
                    }


                 

               }




        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit; 

         }else{

            redirect('login','refresh');

        }   



  }

public function getTableColumns()
  {
    if($this->session->userdata('user_detail'))
    {
       $table_name = $this->input->post('table_name');
       
       if ($table_name!='') {
        
          $data['tableColumn']=$this->commondatamodel->getTableColumn($table_name);
       }else{
           $data['tableColumn']=[];
       }
     
       echo $this->load->view('dashboard/verification/column_view', $data, TRUE);
       //  $viewTemp = $this->load->view('dashboard/verification/column_view',$data,'TRUE');
     //  echo $viewTemp;
    }
    else
    {
      redirect('admin','refresh');
    }
  }

}/* end of class*/