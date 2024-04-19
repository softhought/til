<?php defined('BASEPATH') or exit('No direct script access allowed');
class Investormodel extends CI_Model
{


       

public function fileUploadInvestor($data){
    if($this->session->userdata('user_detail'))
    {


    $dir_path = FILE_UPLOAD_BASE_PATH.'/assets/test_doc/'; //server
        $is_file_uploaded = "N";
        $totalfilesupload = 0;
        if(isset($data['docFile']['fileName']))
        {
            if(sizeof($data['docFile']['fileName']['name'])>0)
            {
                $is_file_uploaded = "Y";
                $totalfilesupload = sizeof($data['docFile']['fileName']['name']);
            }
            else
            {
                $is_file_uploaded = "N";
                $totalfilesupload = 0;
            }
        }

        

        $upd_where = array("investor_relations_details.relations_dtl_id" => $data['masterID']);
        $update_data = array(
            'is_file_uploaded' => $is_file_uploaded,  
            'fileupload_count' => $totalfilesupload, 
        );
        $this->db->where($upd_where);
        $this->db->update('investor_relations_details',$update_data);

        $insert_where = array(
            "masterID" => $data['masterID'],
            "From" => "investor_relations_details",
        );
    //	$this->deleteFilePermanently($insert_where,$dir_path);exit;
        if($is_file_uploaded=="Y")
        {

            $detail_insert = $this->insertIntoUploadFile($data,$insert_where,$dir_path);
        }else{

            /* if delete all uploaded file for testing 08.10.2018*/
            if($data['mode']=="EDIT" && $data['masterID']>0)
                {

                    $where_student = array(
                        "document_details.ref_id" => $data['masterID'],
                        "document_details.table_name" => "investor_relations_details"
                        );

                        $this->db->where($where_student);
                        $this->db->delete('document_details'); 
                        #q();
                }

        }
        //pre($data);

    }
}


public function insertIntoUploadFile($data,$where_data,$dir_path)
{ 
    if($data['mode']=="EDIT" && $where_data['masterID']>0)
    {

        $where_student = array(
            "document_details.ref_id" => $where_data['masterID'],
            "document_details.table_name" => $where_data['From']
            );

            $this->db->where($where_student);
            $this->db->delete('document_details'); 

    }



    

    $config = array(
        'upload_path' => $dir_path,
        'allowed_types' => 'docx|doc|pdf|jpg|jpeg|png|txt|xls|xlsx',
        'max_size' => '5120', // Can be set to particular file size , here it is 2 MB(2048 Kb)
        'max_filename' => '255',
        'encrypt_name' => TRUE,
        );

    $this->load->library('upload', $config);
    $images = array();
    $detail_array = array();	
    $count_docs = sizeof($data['docFile']['fileName']['name']);
   $srl_no=1;
       for($i=0;$i<sizeof($data['docFile']['fileName']['name']);$i++)
    {
          $_FILES['images[]']['name']= $_FILES['fileName']['name'][$i];
        $_FILES['images[]']['type']= $_FILES['fileName']['type'][$i];
        $_FILES['images[]']['tmp_name']= $_FILES['fileName']['tmp_name'][$i];
        $_FILES['images[]']['error']= $_FILES['fileName']['error'][$i];
        $_FILES['images[]']['size']= $_FILES['fileName']['size'][$i];
        $this->upload->initialize($config);
        if ($this->upload->do_upload('images[]'))
        { 
           $file_detail = $this->upload->data();
           $file_name = $file_detail['file_name']; 
           $detail_array =array(
                "random_file_name" => $file_name,
                "uploaded_file_desc" => $data['docType'][$i],
                "user_file_name" => $data['userFilename'][$i],           
                "table_name" => $where_data['From'],
                "ref_id" => $where_data['masterID'],
                "precedence" => $srl_no++,                
                "uploaded_by_user" => $data['user_id'],
                "is_disabled" => '0'
            ); 

             $this->db->insert('document_details',$detail_array);	
           //  echo $this->db->last_query();
        }else{
          //  $errors = $this->upload->display_errors();
          //  pre($errors);
        }
    }

    // If File Not Changed Then insert Info
    $countChanged = sizeof($data['isChangedFile']);

   // echo "Count Changed ".$countChanged;
  //  exit;

    for($k=0;$k<$countChanged;$k++)
    {
        $detail_array_edit = array();

        if($data['isChangedFile'][$k]=="N")
        {   
            $detail_array_edit =array(
                "random_file_name" => $data['randomFileName'][$k],
                "uploaded_file_desc" => $data['docType'][$k],
                "user_file_name" => $data['prvFilename'][$k],
                "table_name" => $where_data['From'],
                "ref_id" => $where_data['masterID'],
                "precedence" => $srl_no++,               
                "uploaded_by_user" => $data['user_id'],
                "is_disabled" => '0'
            ); 

            $this->db->insert('document_details',$detail_array_edit);
            #echo $this->db->last_query();	
        }
    }

}
public function deleteFilePermanently($data,$dir_path){

$fileList=$this->getAllDocument($data);
foreach ($fileList as $key => $value) {
    $random_file_name=$value->random_file_name;

    $file_loc=$dir_path."/".$random_file_name;
    if(file_exists($file_loc)){
        unlink($file_loc);	
    }

}



}


}/* end of class  */