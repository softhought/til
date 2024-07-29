<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Dashboardmodel extends CI_Model{



public function checkdaterange($datedata,$year_id)

	{

		$data = array();

		

		$query = $this->db->select("*")

				->from('financialyear')

				->where('start_date <= "'.$datedata.'" and end_date >= "'.$datedata.'" and year_id = "'.$year_id.'"')

				

		        ->get();

		 #echo $this->db->last_query();       

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



  
	public function getAllLogHistory($row_id,$table_name)
	{
		$data = array();
		 $where = array('row_id' => $row_id,'table_name' => $table_name );
		$this->db->select("log_table.*,users.name as executive_name,,users.user_name")
				->from('log_table')
				->join('users','users.id=log_table.user_id','INNER')
				->where($where)
				->order_by('log_id','desc');
		$query = $this->db->get();
		#echo $this->db->last_query();

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


		public function getStateList()
	{
		$data = array();
		$where = [];
		$this->db->select("state_master.*,country_master.nicename")
				->from('state_master')
				->join('country_master','country_master.country_id=state_master.country_master_id','INNER')
				->where($where)
				->order_by('state_master.state_name','asc');
		$query = $this->db->get();
		#echo $this->db->last_query();

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

	public function getCityList()
	{
		$data = array();
		$where = [];
		$this->db->select("city_details.*,state_master.state_name")
				->from('city_details')
				->join('state_master','state_master.id=city_details.state_master_id','INNER')
				->where($where)
				->order_by('city_details.city_name','asc');
		$query = $this->db->get();
		#echo $this->db->last_query();

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


	public function getMonthlyConertList($month){
		$data = [];
		$where= array("is_converted"=>"Y");

		$this->db->select("*")
				->from('potential_customer')
				->where($where)
				->where('DATE_FORMAT(`convert_date`,"%Y-%m") >= ',$month);

				$query = $this->db->get();
				// echo $this->db->last_query();
				// exit;
				$rowcount = $query->num_rows();
	
		if($query->num_rows()>0){
			return $rowcount;
		}
		else
		{
			return 0;
		}
				
	}


	public function GetPotentialCount($year)
	{
		$data = [];
		
		$this->db->select("*")
				->from('potential_customer')
				->where('DATE_FORMAT(`created_on`,"%Y-%m") = ',$year);

				$query = $this->db->get();
				// echo $this->db->last_query();exit;
				$rowcount = $query->num_rows();
	
		if($query->num_rows()>0){
			return $rowcount;
		}
		else
		{
			return 0;
		}
	}
	public function getConvertedCount($year){
		$data = [];
		$where=array("is_converted"=>"Y");
		$this->db->select("*")
				->from('potential_customer')
				->where($where)
				->where('DATE_FORMAT(`convert_date`,"%Y-%m") = ',$year);

				$query = $this->db->get();
				//  echo $this->db->last_query();
				//  exit;
				$rowcount = $query->num_rows();
	
		if($query->num_rows()>0){
			return $rowcount;
		}
		else
		{
			return 0;
		}
	}

	public function getMonthPaymentDetail($year)
	{
		$data=[];
		$this->db->select_SUM("payment_amount")
				->from('party_bill_payment')
				->where('DATE_FORMAT(`payment_date`,"%Y-%m") = ',$year);
				$query = $this->db->get();	

			//  echo $this->db->last_query(); 
			// exit;

				$total_ammount = $query->result();

				if($query->result()>0)
				{
					$row = $query->row();
					return $data= $row;
				}
				else
				{
					return 0;
				}
				
	}


	public function getRenewalListCount($year)
	{

		$data= [];
		$where=array(
			'investor_master.is_active'=>'Active'
			
		);
		$this->db->select("*")
				->from('investor_membership_plan_details')
				->join('investor_master','investor_master.investor_id = investor_membership_plan_details.investor_master_id','INNER')
				->where($where)
				->where('DATE_FORMAT(`investor_membership_plan_details`.`renewal_date`,"%Y-%m") = ', $year);
				
				$query = $this->db->get();
				 //echo $this->db->last_query(); //exit;
				 $rowcount = $query->num_rows();
	
		if($query->num_rows()>0){
			return $rowcount;
		}
		else
		{
			return 0;
		}


	}

	public function getThisMonthRenewalCount($year)
	{
		$data= [];
		$where=array(
			'investor_master.is_active'=>'Active',
			'is_winback'=>'N'
			
		);
		$this->db->select("*")
				->from('investor_renewal')
				->join('investor_master','investor_master.investor_id = investor_renewal.investor_master_id','INNER')
				->where($where)
				->where('DATE_FORMAT(`investor_renewal`.`gst_invoice_date`,"%Y-%m") = ', $year);

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

	public function getWingbackCount($year)
	{
		$data= [];
		$where=array(
			'investor_master.is_active'=>'Active',
			'is_winback'=>'Y'
			
		);
		$this->db->select("*")
				->from('investor_renewal')
				->join('investor_master','investor_master.investor_id = investor_renewal.investor_master_id','INNER')
				->where($where)
				->where('DATE_FORMAT(`investor_renewal`.`gst_invoice_date`,"%Y-%m") = ', $year);
				
				$query = $this->db->get();
				// echo $this->db->last_query(); 
				// exit;
				$rowcount = $query->num_rows();
	
		if($query->num_rows()>0){
			return $rowcount;
		}
		else
		{
			return 0;
		}

	}

	public function getMonthlyConvertList($month){
		$data = [];
		$where= array("is_converted"=>"Y");

		$this->db->select("*")
				->from('potential_customer')
				->where($where)
				->where('DATE_FORMAT(`convert_date`,"%Y-%m") >= ',$month);

				$query = $this->db->get();
				// echo $this->db->last_query();
				// exit;
				$rowcount = $query->num_rows();
	
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

	public function getAllPaymentReceiptInvestor($month)
	{
		$data = array();
		// $where=array();
		
		$this->db->select("
							proforma_invoice_ir.*,
							investor_master.member_name,
							investor_master.investor_code,
							investor_master.member_mobile,
							party_bill_payment.payment_date,
							party_bill_payment.payment_amount,
							party_bill_payment.party_bill_payment_id,
							")
				->from('party_bill_payment')
				->join('proforma_invoice_ir','party_bill_payment.proforma_invoice_id = proforma_invoice_ir.proforma_invoice_id','INNER')
				->join('investor_master','investor_master.investor_id = proforma_invoice_ir.investor_master_id','LEFT')
				->where('DATE_FORMAT(party_bill_payment.payment_date,"%Y-%m") = ',$month)
				;
		$query = $this->db->get();
		// q();
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

	public function conversionListByDate($form_dt,$to_date)
	{
		$data = [];
		$this->db->select("*")
				->from('potential_customer')
				->where('convert_date >= ',$form_dt)
				->where('convert_date <= ',$to_date);

				$query = $this->db->get();
				// echo $this->db->last_query();
				// exit;
				$rowcount = $query->num_rows();
	
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

	public function paymentListByDate($form_dt,$to_date)
	{
		$data = array();
		// $where=array();
		
		$this->db->select("
							proforma_invoice_ir.*,
							investor_master.member_name,
							investor_master.investor_code,
							investor_master.member_mobile,
							party_bill_payment.payment_date,
							party_bill_payment.payment_amount,
							party_bill_payment.party_bill_payment_id,
							")
				->from('party_bill_payment')
				->join('proforma_invoice_ir','party_bill_payment.proforma_invoice_id = proforma_invoice_ir.proforma_invoice_id','INNER')
				->join('investor_master','investor_master.investor_id = proforma_invoice_ir.investor_master_id','LEFT')
				->where('party_bill_payment.payment_date >= ',$form_dt)
				->where('party_bill_payment.payment_date <= ',$to_date)
				;
		$query = $this->db->get();
		// q();
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

	public function totalPaymentByDate($form_dt,$to_date)
	{
		$data=[];
		$this->db->select_SUM("payment_amount")
				->from('party_bill_payment')
				->where('payment_date >= ',$form_dt)
				->where('payment_date <= ',$to_date);
				$query = $this->db->get();	

			//  echo $this->db->last_query(); 
			// exit;

				$total_ammount = $query->result();

				if($query->result()>0)
				{
					$row = $query->row();
					return $data= $row;
				}
				else
				{
					return 0;
				}

	}
	public function getMantsPayment($month,$where){
		$data = [];
		$this->db->select_SUM("payment_amount")
		->from('party_bill_payment')
		->where('DATE_FORMAT(`payment_date`,"%Y-%m") = ',$month)
		->where($where);
		$query = $this->db->get();	

	//  echo $this->db->last_query(); 
	// exit;

		$total_ammount = $query->result();

		if($query->result()>0)
		{
			$row = $query->row();
			return $data= $row;
		}
		else
		{
			return 0;
		}
	}

	public function getStartupDetails()
	{
		$data = [];
		$this->db->select ("investment_master.startup_mst_id,
							sum(investment_details.alloted_amount) AS ammount,
							startup_master.*")
							->from('investment_details')
							->join('investment_master','investment_master.investment_id = investment_details.investment_master_id','INNER')
							->join('startup_master','startup_master.startup_id = investment_master.startup_mst_id','INNER')
							->where("investment_details.investor_id !=",NULL)
							->group_by("investment_master`.`startup_mst_id`")
							->order_by("ammount","DESC")
							->limit(5);


							$query = $this->db->get();	

	//  echo $this->db->last_query(); 
	// exit;

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


	public function getSectorDetails()
	{
		$data = [];
		$this->db->select ("business_sector_master.sector_name,
							business_sector_master.sector_id,
							investment_details.investor_id,
							SUM(
							investment_details.alloted_amount
							) AS total_alloted_amount,
							COUNT(
							investment_details.investor_id
							) AS total_investor")
							->from('investment_details')
							->join('investment_master','investment_master.investment_id = investment_details.investment_master_id','INNER')
							->join('startup_master','startup_master.startup_id = investment_master.startup_mst_id','INNER')
							->join('business_sector_master','business_sector_master.sector_id = startup_master.sector_mst_id','INNER')
							->where("investment_details.investor_id !=",NULL)
							->group_by("business_sector_master.sector_id")
							->order_by("total_alloted_amount","DESC")
							->limit(5);


							$query = $this->db->get();	

	//  echo $this->db->last_query(); 
	// exit;

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



	public function getInvestorDetails()
	{
		$data = [];
					$this->db->select ("investor_master.investor_code,
									investor_master.member_mobile,
									investment_details.member_name,
									investor_master.email_primary,
									SUM(
									investment_details.alloted_amount
										) AS ammount ")
									->from('investment_details')
									->join('investor_master','investor_master.investor_id = investment_details.investor_id','INNER')
									->where("investment_details.investor_id !=",NULL)
									->group_by("investment_details.investor_id")
									->order_by("ammount","DESC")
									->limit(5);


							$query = $this->db->get();	

	//  echo $this->db->last_query(); 
	// exit;

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


	public function mantsAmunt($frmdate,$todate,$where)
	{
		$data = array();
		// $where=array();
		
		$this->db->select("
							proforma_invoice_ir.*,
							investor_master.member_name,
							investor_master.investor_code,
							investor_master.member_mobile,
							party_bill_payment.payment_date,
							party_bill_payment.payment_amount,
							party_bill_payment.party_bill_payment_id,
							")
				->from('party_bill_payment')
				->join('proforma_invoice_ir','party_bill_payment.proforma_invoice_id = proforma_invoice_ir.proforma_invoice_id','INNER')
				->join('investor_master','investor_master.investor_id = proforma_invoice_ir.investor_master_id','LEFT')
				->where($where)
				->where('party_bill_payment.payment_date >= ',$frmdate)
				->where('party_bill_payment.payment_date <= ',$todate)
				;
		$query = $this->db->get();
		// q();
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


	public function totalMantsPayment($form_dt,$to_date,$where)
	{
		$data=[];
		$this->db->select_SUM("payment_amount")
				->from('party_bill_payment')
				->where($where)
				->where('payment_date >= ',$form_dt)
				->where('payment_date <= ',$to_date);
				$query = $this->db->get();	

			//  echo $this->db->last_query(); 
			// exit;

				$total_ammount = $query->result();

				if($query->result()>0)
				{
					$row = $query->row();
					return $data= $row;
				}
				else
				{
					return 0;
				}

	}

}//end of class