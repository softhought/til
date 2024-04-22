<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class InvestorRelations extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);
    }

    public function index()
    {
        $page = "web_view/investor_relations/investor_relations.php";
        $investorMaster = $this->commondatamodel->getAllRecordWhere("investor_relations_master", ["is_disabled" => 0]);
        foreach ($investorMaster as $key => $value) {
            $value->details = $this->commondatamodel->getAllRecordWhere("investor_relations_details", ["relations_master_id" => $value->relations_master_id]);
        }

        $result["investorMenu"] = $investorMaster;
        webbody_helper($result, $page);
    }

    public function viewlayout($relations_dtl_id)
    {
        $page = "web_view/investor_relations/investor_relation_layout.php";
        $investorMaster = $this->commondatamodel->getAllRecordWhere("investor_relations_master", ["is_disabled" => 0]);
        foreach ($investorMaster as $key => $value) {
            $value->details = $this->commondatamodel->getAllRecordWhere("investor_relations_details", ["relations_master_id" => $value->relations_master_id]);
        }

        $result["investorMenu"] = $investorMaster;
        $investorRelationsDetails = $this->commondatamodel->getSingleRowByWhereCls("investor_relations_details", ["relations_dtl_id" => $relations_dtl_id]);

        if ($investorRelationsDetails->is_file_uploaded == "Y") {
            $investorRelationsDetails->file = $this->commondatamodel->getAllRecordWhereOrderByCol("document_details", ["ref_id" => $investorRelationsDetails->relations_dtl_id, "table_name" => "investor_relations_details", "is_disabled" => 0], "precedence", "ASC");
        }
        $result["investorRelationsDetails"] = $investorRelationsDetails;

        webbody_helper($result, $page);
    }
}