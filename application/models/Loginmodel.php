<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Loginmodel extends CI_Model{



    public function checkLogin($user_name,$password)

    {      

        $userId="";

        $where_arr =["user_name"=>$this->db->escape_str($user_name),

                     "password"=>md5($this->db->escape_str($password)),

                     "is_active"=>'Y'

            ];

       $query= $this->db->select("users.*")

                ->where($where_arr)

                ->get("users");

            

       if($query->num_rows()>0)

       {

           $rows = $query->row();

           $userId = $rows->id;

       }

       return $userId;

    }



    public function get_user($user_id)

    {

        $user="";

        $query=$this->db->select("users.*,user_role.role")

                ->where("users.id",$user_id)
                ->join('user_role','user_role.id = users.user_role_id','INNER')

                ->get("users");

        if($query->num_rows()>0){

            $user = $query->row();

        }

        return $user;

    }



    public function isOTPExpired($email,$otp,$minute){
    $isExpired = true;
    
    $where = [
      "email_verification.is_verified" => 'N',
      "email_verification.email" => trim($email),
      "email_verification.otp" => trim($otp)
    ];
    
    $this->db->select('*')
         ->from('email_verification')
         ->where($where)
         ->where('TIMESTAMPDIFF(MINUTE,email_verification.`generated_on`,NOW()) < "'.$minute.'"');
    $query = $this->db->get();
    //echo $this->db->last_query();
    if($query->num_rows()> 0){
      $isExpired = false;
    }
    return $isExpired;
  } 



}//end of class