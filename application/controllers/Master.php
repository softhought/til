<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Master extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('quizmodel','quizmodel',TRUE);
    }



public function prize_view()
{

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/prize/prize_list.php";
        $header="";
        $result=[];
        $orderby='prize_id';
        $result['prizeList'] = $this->commondatamodel->getAllRecordWhereOrderBy('prize_master',[],$orderby);   
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
 

  }


public function participant_list()
{

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/participant/participant_list.php";
        $header="";
        $result=[];
        $result['participantList'] = $this->quizmodel->getParticipantList();

      //  pre($result['participantList']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
 

}


public function participant_approval()
{

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/participant/participant_list_approval.php";
        $header="";
        $result=[];
        $result['participantList'] = $this->quizmodel->getParticipantListApprovalImage();

      //  pre($result['participantList']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
 

}


public function get_point_details()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {
        $participant_code=$this->input->post('pcode');

        $page = "dashboard/participant/point_details.php";
        $result['pointList'] = $this->quizmodel->getPointDetailsByCode($participant_code);
      //  pre($result['pointList']);
        $this->load->view($page,$result);

    }
    else
    {
        redirect('login','refresh');
    }
}


public function image_approval_status()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {
        $mobile_no=$this->input->post('mobile');
        $selected_value=$this->input->post('selected_value');
        $columnname=$this->input->post('columnname');
        $point_status_code=$this->input->post('point_status_code');
        $participant_code=$this->input->post('participant_code');

        
           
          $approvel_col='is_'.$columnname.'_approved';
          $upd_array = array($approvel_col=>$selected_value);
          $upd_where = array('mobile_no'=>$mobile_no);
          $update = $this->commondatamodel->updateSingleTableData('participant_point_master',$upd_array,$upd_where);
        
          if($selected_value=="A") {
          $point=$this->get_point_by_status($point_status_code)->point;

          $insert_array=[
            "participant_code"=>$participant_code,
            "quiz_marks"=>$point,
            "quiz_status"=>$point_status_code,
            "entry_date"=>date('Y-m-d H:i:s')
           ];

            $this->commondatamodel->insertSingleTableData('quiz_master',$insert_array);

        }

        

         $totalScore = $this->quizmodel->getTotalScoreByMobile($mobile_no);

        if (1) {
            $json_response = array(
                "msg_status" => 1,
                "total_score" => $totalScore,
            );
        } else {
            $json_response = array(
                "msg_status" => 0,
            );
        }
        
    
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;

    }
    else
    {
        redirect('login','refresh');
    }
}

 public function get_point_by_status($status_code){
    $where = array('point_master.status_code'=>$status_code);
    return $result = $this->commondatamodel->getSingleRowByWhereCls('point_master',$where);
   }


   public function point_list()
{

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/prize/point_list.php";
        $header="";
        $result=[];
        $orderby='point_id';
        $result['pointList'] = $this->commondatamodel->getAllRecordWhereOrderBy('point_master',[],$orderby);   
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
 

  }



   


}
