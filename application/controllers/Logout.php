<?php defined("BASEPATH") or exit("No direct script access allowed");
class Logout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("commondatamodel", "commondatamodel", true);

        $this->load->library("session");
    }

    public function index()
    {

        if ($this->session->userdata('user_detail')) {
        $session = $this->session->userdata("user_detail");
        $where=[
            "id"=>$session['userid']
        ];

        $this->commondatamodel->updateSingleTableData('user_account_activity',array("logout_time"=>date('Y-m-d H:i:s')),$where);

        $where1 = [
            "id" => $session["userid"],
        ];

        $this->commondatamodel->updateSingleTableData('users',array('is_online'=>'N','updated_at'=>date('Y-m-d H:i:s')),$where1);

        $this->session->unset_userdata("user_detail");
        redirect('login', 'refresh');
        exit;

       // unset($_SESSION["user_detail"]);

      } else {
        redirect('login', 'refresh');
      }
    }

    // public function __destruct()
    // {
    //     redirect("login");
    // }
}
