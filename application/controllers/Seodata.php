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
            $result['openingsList'] = $this->mastermodel->currentOpeningsList();
            //  pre($result['participantList']);exit;
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }

    public function current_opening_create()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            if ($this->uri->segment(3) == NULL) {
                $result['mode'] = "ADD";
                $result['btnText'] = "Create";
                $result['btnTextLoader'] = "Saving...";
                $result['upeningId'] = 0;
                $result['openingEditdata'] = [];
            } else {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $result['upeningId'] = $this->uri->segment(3);
                $where = array('current_opening_id' => $result['upeningId']);
                $result['openingEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('current_openings', $where);

            }
            $page = "dashboard/seo/seo_add_edit.php";
            $header = "";
          

            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }

    public function current_opening_action()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $current_opening_id = $this->input->post('current_opening_id');
            $mode = $this->input->post('mode');
            $opening_type = trim($this->input->post('opening_type'));
            $opening_title = trim($this->input->post('opening_title'));
            $opening_description = trim($this->input->post('opening_description'));

            if ($mode == "ADD") {
                $insert_Arr = array(
                    'opening_type' => $opening_type,
                    'opening_title' => $opening_title,
                    'opening_description' => $opening_description,
                );
                $insertId = $this->commondatamodel->insertSingleTableData('current_openings', $insert_Arr);
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
                    "current_openings.current_opening_id" => $current_opening_id
                );
                $data = array(
                    'opening_type' => $opening_type,
                    'opening_title' => $opening_title,
                    'opening_description' => $opening_description,
                );
                $updateData = $this->commondatamodel->updateSingleTableData('current_openings', $data, $where);
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