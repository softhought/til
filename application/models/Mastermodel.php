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


    public function productQuotationList()
    {
        $where=[];
        $data = array();
        $this->db->select("quotation_received.*,spec_sheet_details.model")
            ->from('quotation_received')
            ->join('spec_sheet_details','spec_sheet_details.spec_sheet_dt_id=quotation_received.spec_sheet_dt_id','left')
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

    public function resumeList()
    {
        $where=[];
        $data = array();
        $this->db->select("candidte_name,technical_qualification,linkedIn_profile,resume,time,functions_career.name as functions_name")
            ->from('resume_submission')
            ->join('functions_career','functions_career.id=resume_submission.function_id','left')
            ->where($where)
            ->order_by('resume_submission.id','desc')
            ->limit(2000);
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

    public function customerSupportTrainingList()
    {
        $where=[];
        $data = array();
        $this->db->select("customer_support_training.*")
            ->from('customer_support_training')
           // ->join('functions_career','functions_career.id=resume_submission.function_id','left')
            ->where($where)
            ->order_by('customer_support_training.id','desc');
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