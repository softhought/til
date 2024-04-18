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
            $media_tag = trim($this->input->post('media_tag'));

            if ($action=='U') {
                $pre_sl=$slno-1;
                if ($pre_sl!='0') {

                    if($media_tag == 'NEWS' || $media_tag == 'TIL_TALK' || $media_tag == 'TIL_TOUCH'){
                        $where = array('precedence'=>$pre_sl);
                        $preNewsNewslaterData=$this->commondatamodel->getSingleRowByWhereCls('document_details',$where);
                        $table_name = $preNewsNewslaterData->table_name;
                        $ref_id = $preNewsNewslaterData->ref_id;
                        if(!empty( $preNewsNewslaterData)){
                            $pre_docid = $preNewsNewslaterData->doc_id;
                            if(isset($pre_docid)){
                                $update_array1  = array("precedence" => $pre_sl); 
    
                                $where1 = array("doc_id" => $id,'table_name'=>$table_name,'ref_id'=>$ref_id);
                                $update = $this->commondatamodel->updateSingleTableData('document_details',$update_array1,$where1);
    
                                $update_array2  = array("precedence" => $slno);                            
                                $where2 = array("doc_id" => $pre_docid,'table_name'=>$table_name,'ref_id'=>$ref_id);
                                $update = $this->commondatamodel->updateSingleTableData('document_details',$update_array2,$where2);
    
                                if($update){
                                    $json_response = array(
                                        "msg_status" => 1,
                                        "msg_data" => "News and Newslater Precedence updated",
                                        "media_tag" => $media_tag
                                    );
                                }
                            }
                        }

                    }/** end media_tag */
                    else{
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
                    
                    
                }
            }elseif($action=='P'){
                if($media_tag == 'NEWS' || $media_tag == 'TIL_TALK' || $media_tag == 'TIL_TOUCH'){
                    $where_tag= array('menu_tag'=>$media_tag);
                    $media_master_id = $this->commondatamodel->getSingleRowByWhereCls('document_details',$where);


                    $where = array('precedence'=>$slectedvalue);
                    $preNewsNewslaterData=$this->commondatamodel->getSingleRowByWhereCls('document_details',$where);
                    pre($preNewsNewslaterData);exit;
                    $table_name = $preNewsNewslaterData->table_name;
                    $ref_id = $preNewsNewslaterData->ref_id;

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

                }/**endif */
                else{

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
                }/**end else */
                
    
            }else{
                if($media_tag == 'NEWS' || $media_tag == 'TIL_TALK' || $media_tag == 'TIL_TOUCH'){
                    $next_sl=$slno+1;

                    $where = array('precedence'=>$next_sl);
                    $preNewsNewslaterData=$this->commondatamodel->getSingleRowByWhereCls('document_details',$where);    
                    $table_name = $preNewsNewslaterData->table_name;
                    $ref_id = $preNewsNewslaterData->ref_id;

                    if(!empty($preNewsNewslaterData)){
                        // $next_videoid = $preVideoData->id;
                        $next_doc_id = $preNewsNewslaterData->doc_id;
                        
                        $update_array  = array("precedence" => $next_sl);                            
                        $where = array("doc_id" => $id,'table_name'=>$table_name,'ref_id'=>$ref_id);
                        $update = $this->commondatamodel->updateSingleTableData('document_details',$update_array,$where);

                        $update_array2  = array("precedence" => $slno);                            
                        $where2 = array("doc_id" => $next_doc_id,'table_name'=>$table_name,'ref_id'=>$ref_id);
                        $update = $this->commondatamodel->updateSingleTableData('document_details',$update_array2,$where2);
                        if($update){
                            $json_response = array(
                                "msg_status" => 1,
                                "msg_data" => "News and Newslater Precedence updated",
                                "media_tag" => $media_tag
                            );
                        }
                        
                    }



                }/** end if */
                else{
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
                }/**end else */
                
    
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
            $result['media_tag_name'] = $media_tag;
            $where_tag = array('media_master.menu_tag');
            $media_masterID = $this->commondatamodel->getSingleRowByWhereCls('media_master',$where_tag)->media_master_id;
            $where_srl = array('table_name' =>'media_master','ref_id'=>$media_masterID);
            $result['newslist'] = $this->commondatamodel->getAllRecordWhereOrderBy('document_details',$where_srl,'precedence');
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
    public function news_newslater_status(){
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail')){
            $updID = trim($this->input->post('uid'));
            $status = trim($this->input->post('status'));
            $media_tag = trim($this->input->post('media_tag'));
            $update_array  = array("is_disabled" => $status);   
            $where = array("doc_id" => $updID);
            $update = $this->commondatamodel->updateSingleTableData('document_details',$update_array,$where);
            if($update)
            {
                $json_response = array(
                    "msg_status" => 1,
                    "msg_data" => "Status updated",
                    "media_tag" =>$media_tag
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

    }/**end */
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