<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Urlpermissionmodel extends CI_Model
{
    public function getAllAdministrativeMenu($user_id)

   {

       $data = array();

       $where_Ary = array(

           "menumaster.is_parent" => "P",

           "menumaster.is_active" => "Y",

           "menupermissions.user_id" => $user_id,

       );

       

        $this->db->select("menumaster.*")->from('menumaster')

               ->join('menupermissions','menumaster.id=menupermissions.menu_id')

               ->where($where_Ary)

               ->order_by('menumaster.menu_srl','ASC');

        $query = $this->db->get();
		// pre($this->db->last_query());exit;

        

       if ($query->num_rows()> 0)

        {

            foreach($query->result() as $rows)

            {

				$data[] = array(

						"first_menu_id" => $rows->id,

						"menu_name" => $rows->name,

						"menu_link" => $rows->link,

						"is_parent" => $rows->is_parent,

						"parent_id" => $rows->parent_id,

						"menu_icon"=>$rows->icon,

						"secondLevelMenu" => $this->getSecondLevelMenu($rows->id,$user_id) 

			);

				

                //    $data[] = array(

				// 		   "FirstLevelMenuData" => $rows,

						   

                //            "secondLevelMenu" => $this->getSecondLevelMenu($rows->id,$user_id) 

                //         );

            }

          }

          return $data;

   }



    public function getSecondLevelMenu($parentID,$user_id)

	{

		$data = array();

		$where_Ary = array(

			"menumaster.parent_id" => $parentID,

			"menumaster.is_active" => "Y",

			"menupermissions.user_id" => $user_id,

		);

		

		$this->db->select("menumaster.*")->from('menumaster')

				->join('menupermissions','menumaster.id=menupermissions.menu_id')

				->where($where_Ary)

				->order_by('menumaster.menu_srl','ASC');				     

				$query =  $this->db->get();

				// pre($this->db->last_query());exit;

		

		if($query->num_rows() > 0) 

		   {

				foreach($query->result() as $rows)

				{

					

					$data[] = array(

												"second_menu_id" => $rows->id,

												"second_menu_name" => $rows->name,

												"second_menu_link" => $rows->link,

												"second_is_parent" => $rows->is_parent,

												"second_parent_id" => $rows->parent_id,

												"menu_icon"=>$rows->icon,

                                                "menu_url"=>$this->geturl($rows->id),

												"thirdLevelMenu" => $this->getThirdLevelMenu($rows->id,$user_id) 

											 );

					// $data[] = array(

					// 		"secondLevelMenuData" => $rows,

					// 		"thirdLevelMenu" => $this->getThirdLevelMenu($rows->id,$user_id) 

					// 	 );

				}

		   }

		   return $data;

	}

	

	public function getThirdLevelMenu($parentID,$user_id)

	{

		$data = array();

		$where_Ary = array(

			"menumaster.parent_id" => $parentID,

			"menumaster.is_active" => "Y",

			"menupermissions.user_id" => $user_id,

		);

		

		$this->db->select("menumaster.*")->from('menumaster')

				->join('menupermissions','menumaster.id=menupermissions.menu_id')

				->where($where_Ary)

                ->order_by('menumaster.menu_srl','ASC');

				$query =  $this->db->get();

		if($query->num_rows()> 0) 

		{

			foreach($query->result() as $rows)

			{

				$data[] = array(

											"third_menu_id" => $rows->id,

											"third_menu_name" => $rows->name,

											"third_menu_link" => $rows->link,

											"menu_icon"=>$rows->icon,

                                            "menu_url"=>$this->geturl($rows->id),

											"third_is_parent" => $rows->is_parent,

											"third_parent_id" => $rows->parent_id,

											

										);

			}

		}

		   return $data;

	}


    public function geturl($menu_id)
    {
        $data = [];

        $where = array(
            "url_master.menu_id"=> $menu_id
        );
        $this->db->select("*")
                ->from('url_master')
                ->where($where);

                $query = $this->db->get();
                // pre($this->db->last_query());exit;
                if($query->num_rows()> 0) 

		{

			foreach($query->result() as $rows)

			{
                $data[] = array(
                                    "url_link" =>$rows->url,
                                    "url_id"=>$rows->url_id,
                                    "menu_id"=>$rows->menu_id,
									"lebel"=>$rows->label,
                                );
	

		    }

		   return $data;


    }



    }


	public function urlList()
	{
		$data= [];
		$this->db->select("*")
				->from('url_master')
				->join('menumaster','menumaster.id = url_master.menu_id',"INNER");

				$query = $this->db->get();

				if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
            }
            return $data;    
        }
		else
		{
             return $data;
         }				

	}

	public function delurlpermission($userId)
	{
		$this->db->delete('url_permission_detail', array('user_id'=>$userId));	
	}


	public function getMenuCount($userId)

    {

        $this->db->select('*')

				->from('url_permission_detail')->where('user_id',$userId);

		$query = $this->db->get();

		$rowcount = $query->num_rows();
		if($query->num_rows()>0){

			return $rowcount;

		}
		else

		{
			return 0;

		}

    }

    public function checkUrlPermission($user_id,$page_url)
	{
		$data = array();
		$where = array(
            "url_permission_detail.user_id"=> $user_id,
            "url_master.url"=> $page_url
        );
		$this->db->select("*")
				->from('url_permission_detail')
				->join('url_master','url_master.url_id = url_permission_detail.url_id',"INNER")
				->where($where);
		$query = $this->db->get();
		//  echo $this->db->last_query();

		if($query->num_rows()> 0)
		{
           $row = $query->row();
           return $data = $row;
             
        }
		else
		{
            return $data;
        }
	}



}/**End of the Class */