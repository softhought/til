<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Menudocmodel extends CI_Model{


  public function getParentMenuList()
   {
    $data = [];
       $where_Ary = array(
           "menumaster.is_parent" => "P",
           "menumaster.is_active" => "Y",
       );
        $this->db->select("menumaster.*")
               ->from('menumaster')
               ->where($where_Ary)
               ->order_by('menumaster.menu_srl','ASC');
      $query = $this->db->get();
      #q();
       if ($query->num_rows()> 0)
        {
            foreach($query->result() as $rows)
            {
                $data[] = $rows;
            }

          }

          return $data;

   }


    public function getMenuListParentId($menu_id)
   {
    $data = [];
       $where_Ary = array(
           "menumaster.is_parent" => "C",
           "menumaster.is_active" => "Y",
           "menumaster.parent_id" => $menu_id,
       );
        $this->db->select("menumaster.*")
               ->from('menumaster')
               ->where($where_Ary)
               ->order_by('menumaster.menu_srl','ASC');
      $query = $this->db->get();
     # q();echo "<br>";
       if ($query->num_rows()> 0)
        {
            foreach($query->result() as $rows)
            {
                $data[] = $rows;
            }

          }

          return $data;

   }



  public function getAllTablename()
   {
    $data = [];
       $where_Ary = array(
           "table_schema" => "mumbai_anegls",
          
       );
        $this->db->select("table_name")
               ->from('information_schema.tables')
               ->where($where_Ary)
               ->order_by('table_name','ASC');
      $query = $this->db->get();
      #q();
       if ($query->num_rows()> 0)
        {
            foreach($query->result() as $rows)
            {
                $data[] = $rows;
            }

          }

          return $data;

   }



public function getMenuDocList()
   {
    $data = [];

        $this->db->select("menu_document_master.*")
               ->from('menu_document_master');
      $query = $this->db->get();
      #q();
       if ($query->num_rows()> 0)
        {
            foreach($query->result() as $rows)
            {
                $data[] = $rows;
            }

          }

          return $data;

   }

public function getTableStructure($table_name)
   {
    $data = [];

        $sql ="describe ".$table_name;

        $query = $this->db->query($sql);
     # q();echo "<br>";
       if ($query->num_rows()> 0)
        {
            foreach($query->result() as $rows)
            {
                $data[] = $rows;
            }

          }

          return $data;

   }




} // end of class