<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mantsmodel extends CI_Model{




public function getAllInvestorList()
	{
		$data = array();
		$this->db->select("
							investor_master.investor_id,
							investor_master.member_mobile,
							investor_master.country_code,
			                investor_master.investor_code,
			                investor_master.member_name
			                ")
				->from('investor_master');
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


public function getAllcreditsIssuanceData()
	{
		$data = array();
		$this->db->select("app_credits_issuance.*,investor_master.investor_code,investor_master.member_name")
				->from('app_credits_issuance')	
		->join('investor_master','investor_master.investor_id = app_credits_issuance.investor_master_id','Left');
		$query = $this->db->get();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				//$data[] = $rows;
				$data[] = array('masterData' => $rows);
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}


	public function getAllMantasDealRecordGroupBy()
	{
		$data = array();
		$this->db->select("*")
				 ->from('app_rating_comments')
				 ->where('deal_master_id IS NULL')
				 ->group_by('app_rating_comments.deal_name');
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

	public function getAllDealMasterRecord()
	{
		$data = array();
		$this->db->select("*")
				 ->from('deal_details');
				 				
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


    



}//end of class