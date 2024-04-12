<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Urlpermission extends CI_Controller 
{

    public function __construct() {

        parent::__construct();

        $this->load->library('session');

        $this->load->model('commondatamodel','commondatamodel',TRUE); 
        $this->load->model('menudocmodel','menudoc',TRUE);
        $this->load->model('menumodel','menumodel',TRUE); 
        $this->load->model('Usermodel','user',TRUE);  
        $this->load->model('Urlpermissionmodel','Urlpermissionmodel',TRUE);       

    }

    public function index()
	{   

        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{  
            $page ="dashboard/url/url_list";
            $header="";       
            $result =[];
            $result['url_list'] = $this->Urlpermissionmodel->urlList();
            // pre($result['url_list']);exit;
           
            createbody_method($result, $page, $header, $session);
        }else{
			redirect('login','refresh');
		}

    }

    public function create()
    {
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
            if($this->uri->segment(3) == NULL){

                $result['mode'] = "ADD";
                $result['btnText'] = "Create";
                $result['btnTextLoader'] = "Saving...";
                $result['url_id'] = 0;
                $result['urlEditdata'] = [];
    
               }else{
    
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $result['url_id'] = $this->uri->segment(3);
                $where = array('url_id'=>$result['url_id']);
                $result['urlEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('url_master',$where);
    
           }

           $result['menuList'] = $this->menuList();
        //    pre($result['menuList']);exit;
    
                $page ="dashboard/url/urlParmission";
                $header=""; 
                
                accesspermissionMicro("page","urlpermission/create",$result['mode']);

                createbody_method($result, $page, $header, $session);
    
        }else{
            redirect('login','refresh');
        }

    }

    public function store()
    {
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{ 
            $url_id =$this->input->post('url_id');
            $mode = $this->input->post('mode');
            $url = $this->input->post('url');
            $label = $this->input->post('url_label');
            $url_type = $this->input->post('url_type');
            $menu_id = $this->input->post('menu_id');

            if($mode == 'ADD')
            {

                $where4 = array(
                                "url"=>$url,
                            );

                $url_count = $this->commondatamodel->duplicateValueCheck('url_master',$where4);

                // pre($url_count);exit;
                        if($url_count < 1 )
                        {
                                                $insert_array = [
                                                    'url'=>$url,
                                                    'label'=>$label,
                                                    'type'=>$url_type,
                                                    'menu_id'=>$menu_id,
                                                ];
                                $id= $this->commondatamodel->insertSingleTableData('url_master',$insert_array);
                                    if ($id>0) {

                                        /** audit trail */

                                        $user_activity = array(

                                            "activity_module_admin" => 'Create Url',
                                            "activity_module" => 'url_master',
                                            "action" => 'Insert',
                                            "from_method" => 'urlpermission/create',
                                            "module_master_id" => $id,
                                            "user_id" =>$session['userid'],
                                            "table_name" => 'url_master',
                                            "user_browser" => getUserBrowserName(),
                                            "user_platform" =>  getUserPlatform(),
                                            'ip_address'=>getUserIPAddress()

                                        );



                                        $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
                                        $this->session->set_flashdata('success', 'User created successfully');
                                    }else{
                                        $this->session->set_flashdata('error', 'oops! an error occur');
                                    }

                        }else
                        {

                           $result['error']= 'oops! Url Arready Added';
                        }
                        
            }else{

                $upd_array=[

                                    'url'=>$url,
                                    'label'=>$label,
                                    'type'=>$url_type,
                                    'menu_id'=>$menu_id,

                             ];

          $upd_where = array('url_id' => $url_id);

            $update = $this->commondatamodel->updateSingleTableData('url_master',$upd_array,$upd_where);        

            /* insert log data */
            $this->commondatamodel->insertLogData('url_master',$upd_array,$userId,'Update');

            }

            redirect('urlpermission');

        }else{
            redirect('login','refresh');
        }

    }



    function menuList()
    {

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

    public function userUrlPermission()
    {
        $session = $this->session->userdata('user_detail');

        if($this->session->userdata('user_detail'))
        { 
            $page ="dashboard/url/user_url_permission";
                $header="";       
                $result =[];
                $result['user_id']= $this->uri->segment(3);

                $count = $this->Urlpermissionmodel->getMenuCount($result['user_id']);

                if($count>0)
                {
                $result['mode'] = "EDIT";
                $result['user_id'] = $this->uri->segment(3);
                $where = array('user_id'=>$result['user_id']);
                $result['permissionEditdata'] = $this->commondatamodel->getAllRecordWhere('url_permission_detail',$where);

                $url = [];
                foreach($result['permissionEditdata'] as  $value)
                {
                    $permission_access_array=[];
                    if($value->permission_access!=''){
                        $permission_access_array=explode(",",$value->permission_access);
                    }
                    $result['url'][] = $value->url_id;
                    $result['permission_access'][$value->url_id] = $permission_access_array;

                }
                    

                }else
                {
                    $result['mode'] = "ADD";
                    $result['user_id'] = $this->uri->segment(3);
                    $result['permissionEditdata'] = [];

                }
                
                    $result['menulist'] =$this->Urlpermissionmodel->getAllAdministrativeMenu($result['user_id']);
                    $users_id = array( 'id'=>$result['user_id']);
                    $result['userDetail'] = $this->commondatamodel->getSingleRowByWhereCls('users',$users_id);
                
                //  pre($result['userDetail']);
                // exit;
            
                createbody_method($result, $page, $header, $session);

        }else{
                redirect('login','refresh');
            }
    }

    public function getmenupermission()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        { 
            $dataArry = [];
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);
            // pre($dataArry);exit;


            $user_id = $dataArry['user_id'];
            $menu_id = $dataArry['menu_id'];
            $url_id=$dataArry['url_id'];

    


            $count = $this->Urlpermissionmodel->getMenuCount($user_id);

            // pre($count);
            // exit;

            if($count >0)
            {
                $this->Urlpermissionmodel->delurlpermission($user_id);

            }
           

            
            for($i=0;$i<sizeof($menu_id);$i++)
            {

                if(isset($dataArry['access_permission'.$url_id[$i]]))
                {
                    $acc = implode(',',$dataArry['access_permission'.$url_id[$i]]);
               

                $dataSet[$i] = array (
                                        
                                        'url_id' => $url_id[$i],
                                        'menu_id'=>$menu_id[$i],
                                        'user_id'=>$user_id,
                                        'permission_access' => $acc,

                                        );

                $masterId=$this->commondatamodel->insertSingleTableData('url_permission_detail',$dataSet[$i]);

                
                    }
           
                
             }

             $json_response = array(

                "status"=>1,

                "msg" =>'URL permitted successfully'

            );



            header('Content-Type: application/json');

            echo json_encode( $json_response );

            exit;

            //  redirect('urlpermission/userUrlPermission/'.$user_id);


        }else{
            redirect('login','refresh');
        }

    }

    public function restricted()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $page ="dashboard/url/permission";
            $header="";       
            $result =[];
            // pre($result['url_list']);exit;
           
            createbody_method($result, $page, $header, $session);

        }else{
            redirect('login','refresh');
        }

    }





   



}