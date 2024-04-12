<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menudoc extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('menudocmodel','menudoc',TRUE);
        $this->load->model('menumodel','menumodel',TRUE);

    }



public function index()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/menu_doc/menudoc_list_view.php";
        $header="";  

        $result['menudocList'] = $this->menudoc->getMenuDocList();
        $result['menuName'] = $this->menuListName();

       // pre( $result['menuName']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }


 }



public function addMenudoc(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['menudocId'] = 0;
        $result['menuDocEditdata'] = [];
        $result['devDetailsData']=[];

       }else{


          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['menudocId'] = $this->uri->segment(3);
          $where = array('menu_doc_id'=>$result['menudocId']);
          $result['menuDocEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('menu_document_master',$where);

          $where_dtl = array('doc_mst_id' => $result['menudocId'] );
          $orderby='development_dt desc';

          $result['devDetailsData'] = $this->commondatamodel->getAllRecordWhereOrderBy('menu_document_details',$where_dtl,$orderby);

       }


           $result['menuListDropdown']=$this->menuList();
           $result['tableList']= $menuParentList = $this->menudoc->getAllTablename();
           // pre($result['devDetailsData']);exit;


        $page = "dashboard/menu_doc/addedit_menudoc";
        $header="";

        $result['groupnamelist'] =  $this->commondatamodel->getAllRecordWhereOrderBy('group_master',[],'group_description');

 

        

       // pre($result['accountgroupEditdata']);exit;



        createbody_method($result, $page, $header, $session);

    }else{

        redirect('login','refresh');

    }

}







 public function menudoc_action(){
      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $menudocId = trim(htmlspecialchars($dataArry['menudocId']));
            $menu_id = trim(htmlspecialchars($dataArry['menu_id']));
            $url_link = trim(htmlspecialchars($dataArry['url_link']));
            $link_type = trim(htmlspecialchars($dataArry['link_type']));
            $voucher_pass = trim(htmlspecialchars($dataArry['voucher_pass']));
           
            $notes = trim(htmlspecialchars($dataArry['notes']));

             if (isset($dataArry['select_tables'])) {
              $table_names = '';
              foreach ($dataArry['select_tables'] as  $value) {
                $table_names.=$value.',';
              }
              $table_names = substr($table_names, 0, -1);
              
               }else{
               $table_names = '';
               }
              

            $data = array(
                          'link'=>$url_link,
                          'link_type'=>$link_type,
                          'voucher_pass'=>$voucher_pass,
                          'menu_id'=>$menu_id,
                          'tables'=>$table_names,
                          'note'=>$notes,
                        );


            if($mode == 'ADD' && $menudocId == 0){



              $insertdata = $this->commondatamodel->insertSingleTableData('menu_document_master',$data);



              if (!empty($dataArry['rowdevelopment_type'])) {

                $rowdevelopment_dt=$dataArry['rowdevelopment_dt'];
                $rowdevelopment_type=$dataArry['rowdevelopment_type'];
                $rowdeveloper_name=$dataArry['rowdeveloper_name'];
                $rowdeveloper_note=$dataArry['rowdeveloper_note'];
                
                  for ($i=0; $i < sizeof($rowselectedDays_1); $i++) { 
                  
                   $doc_dtl_array = array(
                                                'doc_mst_id' => $insertdata, 
                                                'development_dt' => $rowdevelopment_dt[$i], 
                                                'development_type' => $rowdevelopment_type[$i], 
                                                'developer_name' => $rowdeveloper_name[$i], 
                                                'developer_note' => $rowdeveloper_note[$i], 
                                                'entry_dt' => date('Y-m-d h:i')
                                               
                                            );

                    $docDtlID = $this->commondatamodel->insertSingleTableData('menu_document_details',$doc_dtl_array);
                }
              }


              if($insertdata){

                      $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Saved successfully",                           
                        );
                  }else
                    {
                        $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "There is some problem while updating ...Please try again."
                        );
                    }     


            }else{

                $upd_where = array('menu_document_master.menu_doc_id' => $menudocId);

                $Updatedata = $this->commondatamodel->updateSingleTableData('menu_document_master',$data,$upd_where);

                             if (!empty($dataArry['rowdevelopment_type'])) {

                $rowdevelopment_dt=$dataArry['rowdevelopment_dt'];
                $rowdevelopment_type=$dataArry['rowdevelopment_type'];
                $rowdeveloper_name=$dataArry['rowdeveloper_name'];
                $rowdeveloper_note=$dataArry['rowdeveloper_note'];
                
                  for ($i=0; $i < sizeof($rowdevelopment_type); $i++) { 
                  
                   $doc_dtl_array = array(
                                                'doc_mst_id' => $menudocId, 
                                                'development_dt' => $rowdevelopment_dt[$i], 
                                                'development_type' => $rowdevelopment_type[$i], 
                                                'developer_name' => $rowdeveloper_name[$i], 
                                                'developer_note' => $rowdeveloper_note[$i], 
                                                'entry_dt' => date('Y-m-d h:i')
                                               
                                            );

                    $docDtlID = $this->commondatamodel->insertSingleTableData('menu_document_details',$doc_dtl_array);
                }
              }

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

            }



        header('Content-Type: application/json');

        echo json_encode( $json_response );

        exit; 





         }else{

            redirect('login','refresh');

        }   



  } 



function menuList(){

       $menuParentList = $this->menudoc->getParentMenuList();
       $menuList=[];
       foreach ($menuParentList as $menuparentlist) {
          $childList = $this->menudoc->getMenuListParentId($menuparentlist->id);
          if ($childList) {
              foreach ($childList as $childlist) {
                $subChildList = $this->menudoc->getMenuListParentId($childlist->id);
                if ($subChildList) {
                    foreach ($subChildList as $subchildlist) {
                        $menuList[] = array(
                                  'menuid' => $subchildlist->id, 
                                  'name' => $menuparentlist->name."&#10233;".$childlist->name."&#10233;".$subchildlist->name, 
                                  'menulink' => $subchildlist->link, 
                                );
                    }
                }else{
                    $menuList[] = array(
                                  'menuid' => $childlist->id, 
                                  'name' => $menuparentlist->name."&#10233;".$childlist->name, 
                                  'menulink' => $childlist->link, 
                                );
                }
              }
          }else{
            $menuList[] = array(
                                  'menuid' => $menuparentlist->id, 
                                  'name' => $menuparentlist->name, 
                                  'menulink' => $menuparentlist->link, 
                                );
          }
       }

       return $menuList;

}


function menuListName(){

       $menuParentList = $this->menudoc->getParentMenuList();
       $menuList[0] = "";
       foreach ($menuParentList as $menuparentlist) {
          $childList = $this->menudoc->getMenuListParentId($menuparentlist->id);
          if ($childList) {
              foreach ($childList as $childlist) {
                $subChildList = $this->menudoc->getMenuListParentId($childlist->id);
                if ($subChildList) {
                    foreach ($subChildList as $subchildlist) {
                        $menuList[$subchildlist->id] = $menuparentlist->name."&#10233;".$childlist->name."&#10233;".$subchildlist->name;
                    }
                }else{
                    $menuList[$childlist->id] = $menuparentlist->name."&#10233;".$childlist->name;
                }
              }
          }else{
            $menuList[$menuparentlist->id] = $menuparentlist->name;
          }
       }

       return $menuList;

}

  

  public function tableStructureDetails()
  {
      if($this->session->userdata('user_detail'))
      {
        
           $table_name = $this->input->post('tablename');


           $data['tableStructure'] =  $this->menudoc->getTableStructure($table_name);
        //   pre($data['tableStructure']);exit;
           $page = "dashboard/menu_doc/table_structure";
           $viewTemp = $this->load->view($page,$data,TRUE);
           echo $viewTemp;

      }
      else
      {
          redirect('login','refresh');
      }
  }


  public function tableDataDetails()
  {
      if($this->session->userdata('user_detail'))
      {
        
           $table_name = $this->input->post('tablename');


           $data['tableStructure'] =  $this->menudoc->getTableStructure($table_name);

           //echo count($data['tableStructure']);exit;
           $data['tableData'] = $this->commondatamodel->getAllDropdownData($table_name);
         //  pre($data['tableData']);exit;
            $data['searchColumn']='';
           for ($i=0; $i <count($data['tableStructure']) ; $i++) { 
             $data['searchColumn'].=$i.',';
           }
           $data['searchColumn'] = substr($data['searchColumn'], 0, -1);
           
           $page = "dashboard/menu_doc/table_data";
           $viewTemp = $this->load->view($page,$data,TRUE);
           echo $viewTemp;

      }
      else
      {
          redirect('login','refresh');
      }
  }


   public function tableDataDetailsWithSearchColunm()
  {
      if($this->session->userdata('user_detail'))
      {
        
           $table_name = $this->input->post('tablename');


           $data['tableStructure'] =  $this->menudoc->getTableStructure($table_name);


           $data['tableData'] = $this->commondatamodel->getAllDropdownData($table_name);
         //  pre($data['tableData']);exit;
           $data['searchColumn']='';
           for ($i=1; $i <count($data['tableStructure']) ; $i++) { 
             $data['searchColumn'].=$i.',';
           }
           $data['searchColumn'] = substr($data['searchColumn'], 0, -1);
          // $data['searchColumn']='1,2,3,4,5,6,7';
           $page = "dashboard/menu_doc/table_data_with_column_search";
           $viewTemp = $this->load->view($page,$data,TRUE);
           echo $viewTemp;

      }
      else
      {
          redirect('login','refresh');
      }
  }



    function addDevelopmentDetail(){

       $dataArry=[];
       $formData = $this->input->post('formDatas');
       parse_str($formData, $dataArry);

       $result['rowno'] = $dataArry['rowno']+1;
       $result['development_dt']=$dataArry['development_dt'];
       $result['development_type']=$dataArry['development_type'];
       $result['developer_name']=$dataArry['developer_name'];
       $result['developer_note']=$dataArry['developer_note'];
            
            if($result['development_dt']!=""){
                $result['development_dt'] = str_replace('/', '-', $result['development_dt']);
                $result['development_dt'] = date("d-m-Y",strtotime($result['development_dt']));
             }
             else{
                 $result['development_dt'] = NULL;
             }
       // pre($dataArry);exit;
       
        $page = "dashboard/menu_doc/development_details_partial_view";
       

    
        $this->load->view($page,$result);


  }


   public function deleteMenuDocDetails() {

      $session = $this->session->userdata('user_detail');

      if($this->session->userdata('user_detail'))
      {

            $docdtlid = $this->input->post('docdtlid');
            /* delete member receipt master data */

          $where_doc_dtl = array('dtl_id' => $docdtlid );
          $deleteData3=$this->commondatamodel->deleteTableData('menu_document_details',$where_doc_dtl); 

              $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Succesfully Deleted",
                        );


            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit; 



       }else{

               redirect('login','refresh');
       }


    }




} // ensd of class