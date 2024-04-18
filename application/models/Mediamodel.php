<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mediamodel extends CI_Model{

    public function get_precedence_value($table,$where,$orderby){
        $data = array();
		$this->db->select("*")
				->from($table)
				->where($where)
                ->order_by($orderby)
				->limit(1);
		$query = $this->db->get();
		#echo "<br>".$this->db->last_query();
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
	public function getVideoAllList(){
		$data = array();
		$this->db->select("*")
				->from('fuel_videos')
                ->order_by('precedence','ASC');
		$query = $this->db->get();
		//echo "<br>".$this->db->last_query();

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
	}/** end */
}/**end */
