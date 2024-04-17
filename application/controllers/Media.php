<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Media extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('mediamodel','mediamodel',TRUE);
        
    }
    public function index(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
            $page = "dashboard/media/add_edit_media";
            $header="";    
            $result = "";   
          
            createbody_method($result, $page, $header, $session);
        }else{
			redirect('login','refresh');
		}
    }/** end  */
    public function video_partial_view(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
            if($this->uri->segment(3) == NULL){
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $result['videoId'] = 0;
                //$result['userEditdata'] = [];
               }else{
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $result['videoId'] = $this->uri->segment(3);
                //$where = array('id'=>$result['userId']);
                //$result['userEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('users',$where);
    
           }
            $result['videolist'] = $this->mediamodel->getVideoAllList();
            $page="dashboard/media/video_partial_view";
            $this->load->view($page,$result);
        }else{
			redirect('login','refresh');
		}
    }/** end  */
    public function setStatus(){
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail')){
            $updID = trim($this->input->post('uid'));
            $setstatus = trim($this->input->post('setstatus'));
        
            $update_array  = array(
                "is_disabled" => $setstatus
                );
            
            $where = array(
                "id" => $updID
                );
            $update = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_array,$where);
            if($update)
            {
                $json_response = array(
                    "msg_status" => 1,
                    "msg_data" => "Status updated"
                );
            }
            else
            {
                $json_response = array(
                    "msg_status" => 0,
                    "msg_data" => "Failed to update"
                );
            }


            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;

        }
        else {
            redirect('login','refresh');
        }
    }/** end */
    public function videoserialchange() {
        $session = $this->session->userdata('user_detail');
       if($this->session->userdata('user_detail'))
       {
            $id = trim($this->input->post('id'));
            $slno = trim($this->input->post('slno'));
            $action = trim($this->input->post('action'));
            $slectedvalue = trim($this->input->post('slectedvalue'));
            if ($action=='U') {
                $pre_sl=$slno-1;
                if ($pre_sl!='0') {
                    
                    $where = array('precedence'=>$pre_sl);
                    $preEventData=$this->commondatamodel->getSingleRowByWhereCls('fuel_videos',$where);
                    if(!empty( $preEventData)){
                        $pre_eventid = $preEventData->id;
                        if(isset($pre_eventid)){
                            $update_array  = array("precedence" => $pre_sl);                            
                            $where = array("id" => $id);
                            $update = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_array,$where);
                            $update_array2  = array("precedence" => $slno);                            
                            $where2 = array("id" => $pre_eventid);
                            $update = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_array2,$where2);
    
                        }
                    }
                }
            }elseif($action=='P'){
                $where = array('precedence'=>$slectedvalue);
                $preEventData=$this->commondatamodel->getSingleRowByWhereCls('fuel_videos',$where);
                if(!empty( $preEventData)){
                    $pre_eventid = $preEventData->id;
                    $update_array  = array("precedence" => $slectedvalue);                            
                    $where = array("id" => $id);
                    $update = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_array,$where);
                    $update_array2  = array("precedence" => $slno);                            
                    $where2 = array("id" => $pre_eventid);
                    $update = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_array2,$where2);
    
                }
    
            }else{
                $next_sl=$slno+1;
                $where = array('precedence'=>$next_sl);
                $preEventData=$this->commondatamodel->getSingleRowByWhereCls('fuel_videos',$where);
                //pre($preEventData);exit;
                if(!empty($preEventData)){
                    $next_eventid = $preEventData->id;
                    $update_array  = array("precedence" => $next_sl);                            
                    $where = array("id" => $id);
                    $update = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_array,$where);
                    $update_array2  = array("precedence" => $slno);                            
                    $where2 = array("id" => $next_eventid);
                    $update = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_array2,$where2);
                }
    
            }
    
            // $data['eventslist'] = $this->commondatamodel->getAllRecordWhereOrderBy('event',[],'sl_no');
            // $this->load->view('dashboard/get-ready/website/events/event_partial_list',$data);
            // $result['videolist'] = $this->mediamodel->getVideoAllList();
            // $page="dashboard/media/video_partial_view";
            // $this->load->view($page,$result);
    
    
           
        }else{
    
            redirect('login','refresh');
    
        }
    
    }/** end */
    public function video_add_edit_action(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail')){
            $videoId=$this->input->post('videoId');
            $mode=$this->input->post('mode');
            $title=$this->input->post('title');
            $link=$this->input->post('link');
            $date=date('Y-m-d H:i:s');

            if($mode == 'EDIT' && $videoId > 0){
              
                $where_array = array('id'=>$videoId);
                $update_Arr=array(
                    'title'=>$title,
                    'video_id'=>$link
                );
                $update_status = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_Arr,$where_array); 
                if($update_status)
                {
                    $json_response = array(
                        "msg_status" => 1,
                        "msg_data" => "Updated successfully",
                        "mode" => "EDIT",
                    );

                }
                else
                {
                    $json_response = array(
                        "msg_status" => 0,
                        "msg_data" => "There is some problem.Try again"
                    );

                }
            }else {
                
                $insert_Arr=array(
                    'title'=>$title,
                    'video_id'=>$link,
                    'precedence'=>1,
                    'time_modified'=>$date,
                    'is_disabled'=>0
                );

                
               $insert_status = $this->commondatamodel->insertSingleTableData('fuel_videos',$insert_Arr); 
               if($insert_status)
                {
                    $json_response = array(
                        "msg_status" => 1,
                        "msg_data" => "Saved successfully",
                        "mode" => "ADD",
                    );

                }
                else
                {
                    $json_response = array(
                        "msg_status" => 0,
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
    }/**end  */
    public function news_partial_view(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
            $result = '';
            $page="dashboard/media/news_partial_view";
            $this->load->view($page,$result);
        }else{
			redirect('login','refresh');
		}
    }/** end  */
    public function events_happining_partial_view(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
            $result = '';
            $page="dashboard/media/events_happining_partial_view";
            $this->load->view($page,$result);
        }else{
			redirect('login','refresh');
		}
    }/** end  */
    public function newslater_partal_view(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
            $result = '';
            $page="dashboard/media/newslater_partial_view";
            $this->load->view($page,$result);
        }else{
			redirect('login','refresh');
		}
    }/** end  */
    
}/** end controller */