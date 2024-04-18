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
            $result['mode'] = "ADD";
            $result['btnText'] = "Save";
            $result['btnTextLoader'] = "Saving...";
            $result['videoId'] = 0;
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
            $status = trim($this->input->post('status'));
            $update_array  = array("is_disabled" => $status);   
            $where = array("id" => $updID);
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
                    $preVideoData=$this->commondatamodel->getSingleRowByWhereCls('fuel_videos',$where);
                    if(!empty( $preVideoData)){
                        $pre_videoid = $preVideoData->id;
                        if(isset($pre_videoid)){
                            $update_array  = array("precedence" => $pre_sl); 

                            $where = array("id" => $id);
                            $update = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_array,$where);

                            $update_array2  = array("precedence" => $slno);                            
                            $where2 = array("id" => $pre_videoid);
                            $update = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_array2,$where2);

                            if($update){
                                $json_response = array(
                                    "msg_status" => 1,
                                    "msg_data" => "Precedence updated"
                                );
                            }
                        }
                    }
                }
            }elseif($action=='P'){
                $where = array('precedence'=>$slectedvalue);
                $preVideoData=$this->commondatamodel->getSingleRowByWhereCls('fuel_videos',$where);
                if(!empty( $preVideoData)){
                    $pre_videoid = $preVideoData->id;

                    $update_array  = array("precedence" => $slectedvalue);                       
                    $where = array("id" => $id);
                    $update = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_array,$where);

                    $update_array2  = array("precedence" => $slno);                            
                    $where2 = array("id" => $pre_videoid);
                    $update = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_array2,$where2);

                    if($update){
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Precedence updated"
                        );
                    }
                }
    
            }else{
                $next_sl=$slno+1;

                $where = array('precedence'=>$next_sl);
                $preVideoData=$this->commondatamodel->getSingleRowByWhereCls('fuel_videos',$where);
               
                if(!empty($preVideoData)){
                    $next_videoid = $preVideoData->id;
                       
                    $update_array  = array("precedence" => $next_sl);                            
                    $where = array("id" => $id);
                    $update = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_array,$where);

                    $update_array2  = array("precedence" => $slno);                            
                    $where2 = array("id" => $next_videoid);
                    $update = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_array2,$where2);
                    if($update){
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Precedence updated"
                        );
                    }
                    
                }
    
            }
            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;
               
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
               $srl_no = $this->mediamodel->getVideoAllList(); 
               $precedence_value = '';
               $new_precedence_value = '';
                foreach($srl_no as $list){
                    $id=$list->id;
                    $precedence_value = $list->precedence;

                    $new_precedence_value = $precedence_value+1;
                    $update_array  = array("precedence" => $new_precedence_value);                       
                    $where = array("id" => $id);
                    $update = $this->commondatamodel->updateSingleTableData('fuel_videos',$update_array,$where);

                }
            
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
            $media_tag = $this->input->post('media_tag');
            $where_tag = array('media_master.menu_tag');
            $media_masterID = $this->commondatamodel->getSingleRowByWhereCls('media_master',$where_tag)->media_master_id;
            $where_srl = array('table_name' =>'media_master','ref_id'=>$media_masterID);
            $result['srl_no'] = $this->commondatamodel->getAllRecordWhereOrderBy('document_details',$where_srl,'precedence');
            $page="dashboard/media/news_partial_view";
            $this->load->view($page,$result);
        }else{
			redirect('login','refresh');
		}
    }/** end  */
    public function defaultViewNewsAndNewslater(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail')){
            $result['mode'] = "ADD";
            $result['btnText'] = "Save";
            $result['doc_id'] = 0;
            $media_tag = $this->input->post('media_tag');
            $where = array('media_master.menu_tag'=>$media_tag);
            $result['list'] = $this->commondatamodel->getSingleRowByWhereCls('media_master',$where);
            $page="dashboard/media/default_partial_view_news_and_newslater";
            $this->load->view($page,$result);
        }else{
            redirect('login','refresh');
        }
		
    }/**end */
    public function defaultViewNewsAndNewslater_action(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail')){
            $media_tag=$this->input->post('media_tag');
            $mediaMasterId=$this->input->post('mediaMasterId');
            $mode=$this->input->post('mode');
            $docID=$this->input->post('docID');
            $title_desc=$this->input->post('title_desc');
            $isdocument = trim($this->input->post('isdocument'));
            $dir = $_SERVER['DOCUMENT_ROOT'].'/til/assets-admin/pdf/news/';
            $date=date('Y-m-d H:i:s');
            move_uploaded_file($_FILES['file']['tmp_name'],$dir.$_FILES['file']['name']) or die("Unable to Move Pdf");
            $document_name = $_FILES['file']['name'];
            $file_extension = pathinfo($document_name, PATHINFO_EXTENSION);
            if($mode == 'EDIT' &&  $docID > 0){
                $where_update = array('doc_id'=>$docID);
                $update_arr = array(
                            'file_type' => $file_extension,                                
                            'table_name' => 'media_master',                                          
                            'ref_id' => $mediaMasterId,                                          
                            'title' => $title_desc,                                          
                            'file_name' => $document_name 
                            );
                $update_status = $this->commondatamodel->updateSingleTableData('document_details',$update_arr,$where_update);
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
            }else{
                
                $insert_arr = array(
                    'file_type' => $file_extension,                                
                    'table_name' => 'media_master',                                          
                    'ref_id' => $mediaMasterId,                                          
                    'title' => $title_desc,                                          
                    'file_name' => $document_name,                                                                                    
                    'precedence' => 1,                                          
                    'is_disabled' => 0,                                          
                );
                /** for reset serial no  */
                $where_srl = array('table_name' =>'media_master','ref_id'=>$mediaMasterId);
                $srl_no = $this->commondatamodel->getAllRecordWhereOrderBy('document_details',$where_srl,'precedence'); 
                $precedence_value = '';
                $new_precedence_value = '';
                 foreach($srl_no as $list){
                     $id=$list->doc_id;
                     $table_name=$list->table_name;
                     $ref_id=$list->ref_id;
                     $precedence_value = $list->precedence;
 
                     $new_precedence_value = $precedence_value+1;
                    
                     $update_array  = ["precedence" => $new_precedence_value];                       
                     $where = array("table_name"=>$table_name,"ref_id"=>$ref_id,"doc_id" => $id);
                    $update = $this->commondatamodel->updateSingleTableData('document_details',$update_array,$where);
                    
                     
 
                 }
                 /** end for reset serial */
                 
                $insert_status = $this->commondatamodel->insertSingleTableData('document_details',$insert_arr); 
               if($insert_status)
                {
                    $json_response = array(
                        "msg_status" => 1,
                        "msg_data" => "Saved successfully",
                        "mode" => "ADD",
                        "media_tag"=>$media_tag
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

    }/**end action */
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
    public function till_talk_partal_view(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
            $result = '';
            $page="dashboard/media/newslater_till_talk_partial_view";
            $this->load->view($page,$result);
        }else{
			redirect('login','refresh');
		}
    }/** end  */
    public function till_touch_partal_view(){
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
            $result = '';
            $page="dashboard/media/newslater_till_touch_partial_view ";
            $this->load->view($page,$result);
        }else{
			redirect('login','refresh');
		}
    }/** end  */
    
}/** end controller */