<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Seodata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('mastermodel', 'mastermodel', TRUE);
        $this->load->model('Usermodel', 'user', TRUE);

    }


    public function index()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "dashboard/seo/seo_list.php";
            $header = "";
            $result['seodataList'] = $this->mastermodel->seoDataList();
            //  pre($result['participantList']);exit;
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }

    public function seo_data_create()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            if ($this->uri->segment(3) == NULL) {
                $result['mode'] = "ADD";
                $result['btnText'] = "Create";
                $result['btnTextLoader'] = "Saving...";
                $result['seodtlId'] = 0;
                $result['seoEditdata'] = [];
            } else {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $result['seodtlId'] = $this->uri->segment(3);
                $where = array('seo_dtl_id' => $result['seodtlId']);
                $result['seoEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('seo_details', $where);

            }
            $page = "dashboard/seo/seo_add_edit.php";
            $header = "";
          

            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }

    public function seo_data_action()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $seo_dtl_id = $this->input->post('seo_dtl_id');
            $mode = $this->input->post('mode');
            $page_url = trim($this->input->post('page_url'));
            $page_title = trim($this->input->post('page_title'));
            $seo_keyword = $this->input->post('seo_keyword');
            $meta_description = $this->input->post('meta_description');
            $canonical_url = $this->input->post('canonical_url');

            if ($mode == "ADD") {
                $insert_Arr = array(
                    'page_url' => $page_url,
                    'page_title' => $page_title,
                    'seo_keyword' => $seo_keyword,
                    'meta_description' => $meta_description,
                    'canonical_url' => $canonical_url
                );
                $insertId = $this->commondatamodel->insertSingleTableData('seo_details', $insert_Arr);
                if ($insertId) {
                    $json_response = array(
                        "msg_status" => 1,
                        "msg_data" => "Saved successfully"
                    );
                } else {
                    $json_response = array(
                        "msg_status" => 0,
                        "msg_data" => "something wrong!"
                    );
                }

            } else {
                $where = array(
                    "seo_details.seo_dtl_id" => $seo_dtl_id
                );
                $data = array(
                    'page_url' => $page_url,
                    'page_title' => $page_title,
                    'seo_keyword' => $seo_keyword,
                    'meta_description' => $meta_description,
                    'canonical_url' => $canonical_url,
                );
                $updateData = $this->commondatamodel->updateSingleTableData('seo_details', $data, $where);
                if ($updateData) {
                    $json_response = array(
                        "msg_status" => 1,
                        "msg_data" => "Updates successfully"
                    );
                } else {
                    $json_response = array(
                        "msg_status" => 0,
                        "msg_data" => "something wrong!"
                    );
                }
            }




            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit;
        } else {
            redirect('login', 'refresh');
        }
    }



} /* end of class */