<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Logout extends CI_Controller{


    public function __construct() {


        parent::__construct();


        $this->load->model('commondatamodel','commondatamodel',TRUE);


        $this->load->library('session');


    }


    public function index(){


        $session = $this->session->userdata('user_detail');


        $where=[


            "id"=>$session['user_account_activity_id']


        ];


        $this->commondatamodel->updateSingleTableData('user_account_activity',array("logout_time"=>date('Y-m-d H:i:s')),$where, $session['user_account_activity_id']);





        $where1=[


            'id'=>$session['userid']


        ];


        $this->commondatamodel->updateSingleTableData('users',array('is_online'=>'N','updated_at'=>date('Y-m-d H:i:s')),$where1,$session['userid']);

        $this->session->unset_userdata('user_data');

        unset($_SESSION["user_detail"]);
    }





    public function __destruct() {


        redirect('login');


    }


}


