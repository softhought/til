<?php



defined('BASEPATH') or exit('No direct script access allowed');







class User extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);
        $this->load->model('Usermodel', 'user', TRUE);
    }

    public function index()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "usermanagement/user";
            $header = "";
            $result['userslist'] = $this->user->getUserList($session['user_role']);
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }
    }/**end  */
    public function create()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            if ($this->uri->segment(3) == NULL) {
                $result['mode'] = "ADD";
                $result['btnText'] = "Create";
                $result['btnTextLoader'] = "Saving...";
                $result['userId'] = 0;
                $result['userEditdata'] = [];
            } else {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $result['userId'] = $this->uri->segment(3);
                $where = array('id' => $result['userId']);
                $result['userEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('users', $where);

            }
            $page = "usermanagement/createuser";
            $header = "";
            $result['userRoleList'] = $this->user->getUserRoleList($session['user_role']);
            $where = array('is_active' => 'Y');
            $result['chapterList'] = $this->commondatamodel->getAllRecordWhere('chapter_master', $where);
            accesspermissionMicro("page", "user/create", $result['mode']);
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }/** end */
    public function store()
    {

        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

            $userId = $this->input->post('userId');
            $mode = $this->input->post('mode');
            $name = $this->input->post('name');
            $user_name = $this->input->post('user_name');
            //  $access_permission=$this->input->post('access_permission');
            $mobile_no = $this->input->post('mobile_no');
            $user_role_id = $this->input->post('user_role_id');
            $password = $this->input->post('password');
            //  $is_ir_person = $this->input->post('is_ir_person') != NULL ?'Y':'N';
            // $access_permission=implode(',',$this->input->post('access_permission'));

            $date = date('Y-m-d H:i:s');

            if ($userId > 0 && $mode == 'EDIT') {

                $upd_array = [
                    'name' => $name,
                    'mobile_no' => $mobile_no,
                    'user_role_id' => $user_role_id,
                    //  'access_permission'=>$access_permission,
                    'updated_at' => $date,
                    // 'is_ir_person'=>$is_ir_person,

                ];
                $upd_where = array('users.id' => $userId);
                $update = $this->commondatamodel->updateSingleTableData('users', $upd_array, $upd_where, $userId);
                /* insert log data */

                $this->commondatamodel->insertLogData('users', $upd_array, $userId, 'Update');

            } else {
                $insert_Arr = [
                    'name' => $name,
                    'user_name' => $user_name,
                    'mobile_no' => $mobile_no,
                    'user_role_id' => $user_role_id,
                    //  'access_permission'=>$access_permission,
                    'password' => md5($password),
                    'created_at' => $date,
                    'updated_at' => $date,
                    // 'is_ir_person'=>$is_ir_person,

                ];
                $id = $this->commondatamodel->insertSingleTableData('users', $insert_Arr);
                if ($id > 0) {
                    $this->session->set_flashdata('success', 'User created successfully');

                } else {
                    $this->session->set_flashdata('error', 'oops! an error occur');
                }

            }

            redirect('user');

        } else {
            redirect('login', 'refresh');



        }



    }

    public function ActiveUser()
    {

        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $userId = $this->uri->segment(3);
            $this->user->ActiveInactiveUserAccount($userId, 'Y');
            /** audit trail */
            $user_activity = array(
                "activity_module_admin" => 'Active User Account',
                "activity_module" => 'user',
                "action" => 'Insert',
                "from_method" => 'user/ActiveUser',
                "module_master_id" => $userId,
                "user_id" => $session['userid'],
                "table_name" => 'users',
                "user_browser" => getUserBrowserName(),
                "user_platform" => getUserPlatform(),
                'ip_address' => getUserIPAddress()

            );
            // $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
            redirect('user', 'refresh');
        } else {
            redirect('login', 'refresh');

        }

    }

    public function InactiveUser()
    {
        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {
            $userId = $this->uri->segment(3);

            $this->user->ActiveInactiveUserAccount($userId, 'N');

            /** audit trail */

            $user_activity = array(
                "activity_module_admin" => 'Inactive User Account',
                "activity_module" => 'user',
                "action" => 'Insert',
                "from_method" => 'user/InactiveUser',
                "module_master_id" => $userId,
                "user_id" => $session['userid'],
                "table_name" => 'users',
                "user_browser" => getUserBrowserName(),
                "user_platform" => getUserPlatform(),
                'ip_address' => getUserIPAddress()
            );
            redirect('user', 'refresh');
        } else {
            redirect('login', 'refresh');

        }

    }

    public function getloginLogoutDetailByUserId()
    {



        $userid = $this->input->post('userid');







        $table = "";



        $userActivity = $this->user->getUserAccountActivity($userid);



        $table = "<table id='loginLogoutTable' class='table customTbl table-bordered table-striped dataTables' style='border-collapse: collapse !important;'>



                    <thead>



                        <tr>



                            <th>Login Date & Time</th>



                            <th>Logout Date & Time</th>



                            <th>Browser</th>



                            <th>Device OS</th>



                        </tr>



                    </thead>



                    <tbody>";



        foreach ($userActivity as $Activity) {



            $table .= "<tr>



                                        <td>" . $Activity->login_time . "</td>



                                        <td>" . $Activity->logout_time . "</td>



                                        <td>" . $Activity->user_browser . "</td>



                                        <td>" . $Activity->user_platform . "</td>                        



                                    </tr>";



        }



        $table .= "</tbody>



                </table>";



        echo $table;



    }



    public function checkUserName()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $username = trim($this->input->post('username'));







            $where = array(

                "users.user_name" => trim($username)

            );



            $exist = $this->commondatamodel->duplicateValueCheck('users', $where);



            if ($exist) {

                $json_response = array(

                    "msg_status" => 1,

                    "msg_data" => "Successfully deleted"

                );

            } else {

                $json_response = array(

                    "msg_status" => 0,

                    "msg_data" => "Failed to delete"

                );

            }





            header('Content-Type: application/json');

            echo json_encode($json_response);

            exit;



        } else {

            redirect('login', 'refresh');

        }

    }





    public function change_password()
    {



        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $page = "dashboard/change_password/change_password.php";

            $header = "";

            $result['mode'] = "EDIT";

            $result['btnText'] = "Update";

            $result['btnTextLoader'] = "Updating...";

            $result['userId'] = $session['userid'];



            createbody_method($result, $page, $header, $session);

        } else {

            redirect('login', 'refresh');

        }







    }







    public function checkPass()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $userId = trim($this->input->post('userId'));

            $old_password = md5(trim($this->input->post('old_password')));







            $where = array(

                "users.id" => $userId

            );



            $userData = $this->commondatamodel->getSingleRowByWhereCls('users', $where);



            if ($userData->password == $old_password) {

                $json_response = array(

                    "msg_status" => 1,

                    "msg_data" => "password mathced"

                );

            } else {

                $json_response = array(

                    "msg_status" => 0,

                    "msg_data" => "password not mathced"

                );

            }





            header('Content-Type: application/json');

            echo json_encode($json_response);

            exit;



        } else {

            redirect('login', 'refresh');

        }

    }







    public function passward_action()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $userId = trim($this->input->post('userId'));

            $new_password = md5(trim($this->input->post('new_password')));







            $where = array(

                "users.id" => $userId

            );



            $data = array('password' => $new_password);



            $updateData = $this->commondatamodel->updateSingleTableData('users', $data, $where. $userId);



            if ($updateData) {

                $json_response = array(

                    "msg_status" => 1,

                    "msg_data" => "password updates successfully"

                );

            } else {

                $json_response = array(

                    "msg_status" => 0,

                    "msg_data" => "something wrong!"

                );

            }





            header('Content-Type: application/json');

            echo json_encode($json_response);

            exit;



        } else {

            redirect('login', 'refresh');

        }

    }





    public function addRestrictedURL()
    {



        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            if ($this->uri->rsegment(3) == NULL) {

                $result['mode'] = "ADD";

                $result['btnText'] = "Save";

                $result['btnTextLoader'] = "Saving...";

                $restrictedID = 0;

                $result['restrictedID'] = $restrictedID;

                $result['restrictedEditdata'] = [];





            } else {

                $result['mode'] = "EDIT";

                $result['btnText'] = "Update";

                $result['btnTextLoader'] = "Updating...";

                $restrictedID = $this->uri->segment(3);

                $result['restrictedID'] = $restrictedID;



                $whereAry = [

                    'restricted_url_master.restricted_id' => $restrictedID

                ];



                $result['restrictedEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('restricted_url_master', $whereAry);





            }

            $orderby = 'role';



            $result['userTypeList'] = $this->commondatamodel->getAllRecordWhereOrderBy("user_role", [], $orderby);

            $header = "";



            $page = "usermanagement/restricted_url/restricted_url_add_edit";





            createbody_method($result, $page, $header, $session);

        } else {

            redirect('login', 'refresh');

        }





    }

    public function restricted_action()
    {



        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $json_response = array();

            $formData = $this->input->post('formDatas');

            parse_str($formData, $dataArry);



            $restrictedID = trim(htmlspecialchars($dataArry['restrictedID']));

            $mode = trim(htmlspecialchars($dataArry['mode']));



            $restricted_url = trim(htmlspecialchars($dataArry['restricted_url']));

            $sel_users = $dataArry['sel_users'];





            foreach ($sel_users as $key => $value) {



                $where = array('url' => $restricted_url, 'user_role' => $value);



                $this->commondatamodel->deleteTableData('restricted_url_master', $where);



                $insert_array = array(

                    'url' => $restricted_url,

                    'user_role' => $value,

                    'is_active' => 'Y',

                    'creted_on' => date('Y-m-d h:i'),



                );





                $insertData = $this->commondatamodel->insertSingleTableData('restricted_url_master', $insert_array);



            }



            if ($insertData) {

                $json_response = array(

                    "msg_status" => 1,

                    "msg_data" => "Saved successfully",

                    "mode" => "ADD"

                );

            } else {

                $json_response = array(

                    "msg_status" => 1,

                    "msg_data" => "There is some problem.Try again"

                );

            }





            header('Content-Type: application/json');

            echo json_encode($json_response);

            exit;







        } else {

            redirect('login', 'refresh');

        }

    }









    public function restrictedURL()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $page = 'usermanagement/restricted_url/restricted_url_list.php';



            $result['restrictedUrlList'] = $this->commondatamodel->getAllDropdownData("restricted_url_master");

            $header = "";















            createbody_method($result, $page, $header, $session);



        } else {

            redirect('login', 'refresh');

        }

    }









    public function setrestrictedURLStatus()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $updID = trim($this->input->post('uid'));

            $setstatus = trim($this->input->post('setstatus'));



            $update_array = array(

                "is_active" => $setstatus

            );



            $where = array(

                "restricted_url_master.restricted_id" => $updID

            );







            $update = $this->commondatamodel->updateSingleTableData('restricted_url_master', $update_array, $where, $updID);

            if ($update) {

                $json_response = array(

                    "msg_status" => 1,

                    "msg_data" => "Status updated"

                );

            } else {

                $json_response = array(

                    "msg_status" => 0,

                    "msg_data" => "Failed to update"

                );

            }





            header('Content-Type: application/json');

            echo json_encode($json_response);

            exit;



        } else {

            redirect('login', 'refresh');

        }

    }





}// end of class