<?php defined('BASEPATH') or exit('No direct script access allowed');
class Mastermodel extends CI_Model
{

    public function enquiryData()
    {
        $where=[];
        $data = array();
        $this->db->select("contact_us.*,fuel_nature_of_query.name as nature_of_query")
            ->from('contact_us')
            ->join('fuel_nature_of_query','fuel_nature_of_query.id=contact_us.nature_of_query_id','left')
            ->where($where)
            ->order_by('id','desc');
        $query = $this->db->get();
        #echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $data[] = $rows;
            }
            return $data;
        } else {
            return $data;
        }

    }



}