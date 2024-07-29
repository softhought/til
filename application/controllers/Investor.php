<?php defined('BASEPATH') or exit('No direct script access allowed');
class Investor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Investormodel','investormodel',TRUE);
    }
    public function index()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "dashboard/investor_relations/investor_relations_view";
            $header = "";
            $result = [];
           

            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }
    }


    public function corporate_governance_partial_view()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

            $orderby = 'relations_dtl_id';
            $where = array("relations_master_id" => 1);
            $result['relationsDetailsList'] = $this->commondatamodel->getAllRecordWhereOrderBy('investor_relations_details', $where, $orderby);
            // pre($result['relationsDetailsList']);
            $page = "dashboard/investor_relations/corporate_governance_partial_view";
            $this->load->view($page, $result);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function shareholders_information_partial_view()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

            $orderby = 'relations_dtl_id';
            $where = array("relations_master_id" => 2);
            $result['relationsDetailsList'] = $this->commondatamodel->getAllRecordWhereOrderBy('investor_relations_details', $where, $orderby);
            $page = "dashboard/investor_relations/shareholders_information_partial_view";
            $this->load->view($page, $result);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function financials_partial_view()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $orderby = 'relations_dtl_id';
            $where = array("relations_master_id" => 3);
            $result['relationsDetailsList'] = $this->commondatamodel->getAllRecordWhereOrderBy('investor_relations_details', $where, $orderby);
            $page = "dashboard/investor_relations/financials_partial_view";
            $this->load->view($page, $result);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function notice_partial_view()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $orderby = 'relations_dtl_id';
            $where = array("relations_master_id" => 4);
            $result['relationsDetailsList'] = $this->commondatamodel->getAllRecordWhereOrderBy('investor_relations_details', $where, $orderby);
            $page = "dashboard/investor_relations/notice_partial_view";
            $this->load->view($page, $result);
        } else {
            redirect('login', 'refresh');
        }
    }


    public function add_edit_investor_relations_partial_view()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

            $result['relations_master_id'] = trim($this->input->post('relations_master_id'));
            $result['relations_dtl_id'] = trim($this->input->post('relations_dtl_id'));


            if ($result['relations_dtl_id'] == 0) {
                $result['mode'] = "ADD";
                $result['btnText'] = "Create";
                $result['btnTextLoader'] = "Saving...";
                $result['relationEditdata'] = [];
                $result['documenDtl'] = [];
            } else {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $where = array('investor_relations_details.relations_dtl_id' => $result['relations_dtl_id'] );
                $result['relationEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('investor_relations_details',$where);
                $where_doc = array(
					'document_details.ref_id' => $result['relations_dtl_id'], 
					'document_details.table_name' => "investor_relations_details"
				);
                $orderby = 'precedence';
                $result['documenDtl'] = $this->commondatamodel->getAllRecordWhereOrderBy('document_details',$where_doc,$orderby);

            }


            $orderby = 'relations_dtl_id';
            $where = array("relations_master_id" => 4);
            $result['relationsDetailsList'] = $this->commondatamodel->getAllRecordWhereOrderBy('investor_relations_details', $where, $orderby);
            $page = "dashboard/investor_relations/add_edit_investor_relations_partial_view";
            $this->load->view($page, $result);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function adddetaildocument()
	{
		if($this->session->userdata('user_detail'))
		{
			$session = $this->session->userdata('user_detail');
		

			$row_no = $this->input->post('rowNo');
			$data['rowno'] = $row_no;
			$data['documentTypeList'] =[];
			$viewTemp = $this->load->view('dashboard/investor_relations/add_detail_document_view.php',$data,TRUE);
			
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}



    public function investor_relation_action()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

           

            $relations_master_id = $this->input->post('relations_master_id');
            $relations_dtl_id = $this->input->post('relations_dtl_id');
            $mode = $this->input->post('mode');
            $title = $this->input->post('title');
            $page_url = $this->input->post('page_url');
            $description = $this->input->post('description');
         

            $dataArry = $_POST;
            if(isset($_POST['docType'])){
                $docType = $dataArry['docType'];
                $precedence = $dataArry['precedence'];
                $userFilename = $dataArry['userFileName'];
                $fileDesc = NULL;
                $isChangedFile = $dataArry['isChangedFile'];
            }else{
                    $docType = NULL;
                    $precedence = NULL;
                    $userFilename = NULL;
                    $fileDesc = NULL;
                    $isChangedFile = NULL;

            }


            if ($mode == "ADD") {

                $insert_data = array(
                    'relations_master_id' => $relations_master_id,
                    'title' => $title,
                    'page_url' => $page_url,
                    'description' => $description,
                );
                $insertdata = $this->commondatamodel->insertSingleTableData('investor_relations_details', $insert_data);


                      /* file upload */
                      $file_array = array(
                        "masterID" => $insertdata,
                        "isChangedFile" => $isChangedFile,
                        "mode" => $mode,
                        "docType" => $docType,
                        "precedence" => $precedence,
                        "userFilename" => $userFilename,
                        "docFile" => $_FILES,
                        "fileDesc" => $fileDesc,
                        "user_id" => $session['userid']
                      );
                    
                      $fileupload = $this->investormodel->fileUploadInvestor($file_array);
       
                if($insertdata){
                    $json_response = array(
                          "msg_status" => 1,
                          "msg_data" => "Saved successfully",                           
                      );
                }else
                  {
                      $json_response = array(
                          "msg_status" => 0,
                          "msg_data" => "There is some problem while savinging ...Please try again."
                      );
                  }     


            } else {

                $update_data = array(
                    'relations_master_id' => $relations_master_id,
                    'title' => $title,
                    'page_url' => $page_url,
                    'description' => $description,
                );
                

                $upd_where = array('investor_relations_details.relations_dtl_id' => $relations_dtl_id);
                $Updatedata = $this->commondatamodel->updateSingleTableData('investor_relations_details',$update_data,$upd_where, $relations_dtl_id);

                       /* file upload */
                       if(isset($_POST['docType'])){
                        $randomFileName = $dataArry['randomFileName'];
                        $prvFilename = $dataArry['prvFilename'];
                        $docDetailIDs = $dataArry['docDetailIDs'];
                        }else{
                                        $randomFileName = NULL;
                                        $prvFilename = NULL;
                                        $docDetailIDs = NULL;
                                }

                        $file_array = array(
                            "masterID" => $relations_dtl_id,
                            "isChangedFile" => $isChangedFile,
                            'randomFileName' => $randomFileName, 
                            'prvFilename' => $prvFilename, 
                            'docDetailIDs' => $docDetailIDs, 
                            "mode" => $mode,
                            "docType" => $docType,
                            "precedence" => $precedence,
                            "userFilename" => $userFilename,
                            "docFile" => $_FILES,
                            "fileDesc" => $fileDesc,
                            "user_id" => $session['userid']
                        );

                       // pre($_FILES);

                        $fileupload = $this->investormodel->fileUploadInvestor($file_array);

                if($Updatedata){
                    $json_response = array(
                          "msg_status" => 1,
                          "msg_data" => "Updated successfully",
                      );
                  }else
                  {
                      $json_response = array(
                          "msg_status" => 0,
                          "msg_data" => "There is some problem while updating ...Please try again."
                      );
                  } 

                # code...
            }



            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit;


        } else {
            redirect('login', 'refresh');
        }
    }


    public function investor_relations_docs_partial_view()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

            $result['relations_master_id'] = trim($this->input->post('relations_master_id'));
            $result['relations_dtl_id'] = trim($this->input->post('relations_dtl_id'));


            $where = array('investor_relations_details.relations_dtl_id' => $result['relations_dtl_id'] );
                $result['relationEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('investor_relations_details',$where);
                $where_doc = array(
					'document_details.ref_id' => $result['relations_dtl_id'], 
					'document_details.table_name' => "investor_relations_details"
				);
                $orderby = 'precedence';
				 $result['documenDtl'] = $this->commondatamodel->getAllRecordWhereOrderBy('document_details',$where_doc,$orderby);


            $orderby = 'relations_dtl_id';
            $where = array("relations_master_id" => 4);
            $result['relationsDetailsList'] = $this->commondatamodel->getAllRecordWhereOrderBy('investor_relations_details', $where, $orderby);
            $page = "dashboard/investor_relations/document_view.php";
            $this->load->view($page, $result);
        } else {
            redirect('login', 'refresh');
        }
    }



    public function setRelationStatus(){
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail')){
            $updID = trim($this->input->post('uid'));
            $status = trim($this->input->post('status'));
            $update_array  = array("is_disabled" => $status);   
            $where = array("relations_dtl_id" => $updID);
            $update = $this->commondatamodel->updateSingleTableData('investor_relations_details',$update_array,$where, $updID);
            if($update)
            {
                $json_response = array(
                    "msg_status" => 1,
                    "msg_data" => "Status successfully updated"
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
    }

    public function setRelationDocStatus(){
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail')){
            $updID = trim($this->input->post('uid'));
            $status = trim($this->input->post('status'));
            $update_array  = array("is_disabled" => $status);   
            $where = array("doc_id" => $updID);
            $update = $this->commondatamodel->updateSingleTableData('document_details',$update_array,$where, $updID);
            if($update)
            {
                $json_response = array(
                    "msg_status" => 1,
                    "msg_data" => "Status successfully updated"
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
    }


    public function DocSerialchange(){
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $doc_id = trim($this->input->post('id'));
            $slno = trim($this->input->post('slno'));
            $action = trim($this->input->post('action'));
            $slectedvalue = trim($this->input->post('slectedvalue')); 
            $relations_dtl_id = $this->input->post('relations_dtl_id'); 
            $table_name="investor_relations_details";
            $json_response = array();
            if ($action == 'U') {
                $pre_sl = $slno - 1;
                
                if ($pre_sl != '0') {
               // if ($pre_sl != '0' || $pre_sl == '0') {

                    $where = array('precedence' => $pre_sl,'ref_id' => $relations_dtl_id,'table_name' => $table_name);
                    $preDocData = $this->commondatamodel->getSingleRowByWhereCls('document_details', $where);
                    if (!empty($preDocData)) {
                        $pre_Docid = $preDocData->doc_id;                        
                            $update_array = array("precedence" => $pre_sl);
                            $where = array("doc_id" => $doc_id);                       
                            $update = $this->commondatamodel->updateSingleTableData('document_details', $update_array, $where, $doc_id);

                            $update_array2 = array("precedence" => $slno);
                            $where2 = array("doc_id" => $pre_Docid);
                            $update = $this->commondatamodel->updateSingleTableData('document_details', $update_array2, $where2, $doc_id);

                            if ($update) {
                                $json_response = array(
                                    "msg_status" => 1,
                                    "msg_data" => "Precedence updated"
                                    
                                );
                            }
                        
                    }
                }
            } elseif ($action == 'P') {
                $where = array('precedence' => $slectedvalue,'ref_id' => $relations_dtl_id,'table_name' => $table_name);
                $preDocData = $this->commondatamodel->getSingleRowByWhereCls('document_details', $where);
                if (!empty($preDocData)) {
                    $pre_Docid = $preDocData->doc_id;

                    $update_array = array("precedence" => $slectedvalue);
                    $where = array("doc_id" => $doc_id);
                    $update = $this->commondatamodel->updateSingleTableData('document_details', $update_array, $where, $doc_id);

                    $update_array2 = array("precedence" => $slno);
                    $where2 = array("doc_id" => $pre_Docid);
                    $update = $this->commondatamodel->updateSingleTableData('document_details', $update_array2, $where2, $pre_Docid);

                    if ($update) {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Precedence updated"
                           
                        );
                    }
                }
               
            }elseif ($action == 'D'){
                $next_sl = $slno + 1;

                $where = array('precedence' => $next_sl,'ref_id' => $relations_dtl_id,'table_name' => $table_name);
                $preDocData = $this->commondatamodel->getSingleRowByWhereCls('document_details', $where);
                
                if (!empty($preDocData)) {
                    $next_Docid= $preDocData->doc_id;

                    $update_array = array("precedence" => $next_sl);
                    $where = array("doc_id" => $doc_id);
                    $update = $this->commondatamodel->updateSingleTableData('document_details', $update_array, $where, $doc_id);

                    $update_array2 = array("precedence" => $slno);
                    $where2 = array("doc_id" => $next_Docid);
                    $update = $this->commondatamodel->updateSingleTableData('document_details', $update_array2, $where2, $next_Docid);
                    if ($update) {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Precedence updated"
                            
                        );
                    }

                }
            }
            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit;

        } else {

            redirect('login', 'refresh');

        }

    }

} /* end of class */