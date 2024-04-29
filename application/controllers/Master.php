<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('mastermodel', 'mastermodel', TRUE);
        $this->load->model('Usermodel', 'user', TRUE);

    }

    public function nature_of_query()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "dashboard/master/nature_of_query.php";
            $header = "";
            $orderby = 'id';
            $result['nature_of_queryList'] = $this->commondatamodel->getAllRecordWhereOrderBy('fuel_nature_of_query', [], $orderby);

            //  pre($result['participantList']);exit;
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }

    public function nature_of_query_add_edit()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            if ($this->uri->segment(3) == NULL) {
                $result['mode'] = "ADD";
                $result['btnText'] = "Create";
                $result['btnTextLoader'] = "Saving...";
                $result['queryid'] = 0;
                $result['queryEditdata'] = [];
            } else {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $result['queryid'] = $this->uri->segment(3);
                $where = array('id' => $result['queryid']);
                $result['queryEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('fuel_nature_of_query', $where);

            }
            $page = "dashboard/master/nature_of_query_add_edit.php";
            $header = "";

            
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }
    public function nature_of_query_action()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $queryid = $this->input->post('queryid');
            $mode = $this->input->post('mode');
            $name = trim($this->input->post('name'));
            $email = strtolower($this->input->post('email'));
            $cc_to = strtolower($this->input->post('cc_to'));

            if ($mode == "ADD") {

                $next_precedence=$this->mastermodel->get_next_precedence('fuel_nature_of_query','precedence',[]);
                $insert_Arr = array(
                    'name' => $name,
                    'email' => $email,
                    'cc_to' => $cc_to,
                    'precedence' => $next_precedence,
                );
                $insertId = $this->commondatamodel->insertSingleTableData('fuel_nature_of_query', $insert_Arr);
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
                    "fuel_nature_of_query.id" => $queryid
                );
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'cc_to' => $cc_to,
                );
                $updateData = $this->commondatamodel->updateSingleTableData('fuel_nature_of_query', $data, $where);
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
   
   
   
    public function enquiry()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "dashboard/master/enquiry.php";
            $header = "";
            $result['contactusList'] = $this->mastermodel->enquiryData();

            //  pre($result['participantList']);exit;
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }

    public function product_quotation_received()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "dashboard/master/product_quotation_received.php";
            $header = "";
            $result['productquotationList'] = $this->mastermodel->productQuotationList();
            //  pre($result['participantList']);exit;
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }

    public function resume()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "dashboard/master/resume_view.php";
            $header = "";
            $result['resumeList'] = $this->mastermodel->resumeList();
            //  pre($result['participantList']);exit;
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }

    public function customer_support_training()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "dashboard/master/customer_support_training.php";
            $header = "";
            $result['tranningList'] = $this->mastermodel->customerSupportTrainingList();
            //  pre($result['participantList']);exit;
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }

    public function current_openings()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "dashboard/master/current_openings.php";
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
            $page = "dashboard/master/current_openings_add_edit.php";
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








}
