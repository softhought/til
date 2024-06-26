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

                $next_precedence = $this->mastermodel->get_next_precedence('fuel_nature_of_query', 'precedence', []);
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
                $updateData = $this->commondatamodel->updateSingleTableData('fuel_nature_of_query', $data, $where, $queryid);
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

    public function activeInactiveNatureofquery($id, $status)
    {
        $this->commondatamodel->updateSingleTableData("fuel_nature_of_query", ["is_disabled" => $status], ["id" => $id], $id);
        redirect('master/nature_of_query', 'refresh');
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
            $result["function"] = $this->commondatamodel->getAllRecordWhereOrderByCol("functions_career", ["is_disabled" => 0], "precedence", "ASC");
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }

    public function resume_partial_view()
    {
        $function_id = $_POST["function_id"] != "" ? $_POST["function_id"] : "";
        $from_date = $_POST["from_date"] != "" ? (DateTime::createFromFormat('d/m/Y', $_POST["from_date"]))->format('Y-m-d') : "";
        $to_date = $_POST["to_date"] != "" ? (DateTime::createFromFormat('d/m/Y', $_POST["to_date"])->format('Y-m-d')) : "";

        $page = "dashboard/master/resume_partial_view.php";
        $result['resumeList'] = $this->mastermodel->resumeList($function_id, $from_date, $to_date);
        $this->load->view($page, $result);
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
                $updateData = $this->commondatamodel->updateSingleTableData('current_openings', $data, $where, $current_opening_id);
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


    public function faq_view()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "dashboard/master/faq_view.php";
            $header = "";
            $orderby = 'precedence';
            $result['faqList'] = $this->commondatamodel->getAllRecordWhereOrderBy('faq_details', [], $orderby);

            //  pre($result['participantList']);exit;
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }

    public function faq_add_edit()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            if ($this->uri->segment(3) == NULL) {
                $result['mode'] = "ADD";
                $result['btnText'] = "Create";
                $result['btnTextLoader'] = "Saving...";
                $result['faqid'] = 0;
                $result['faqEditdata'] = [];
            } else {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $result['faqid'] = $this->uri->segment(3);
                $where = array('faq_del_id' => $result['faqid']);
                $result['faqEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('faq_details', $where);

            }
            $page = "dashboard/master/faq_add_edit.php";
            $header = "";


            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }

    public function faq_action()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $faq_del_id = $this->input->post('faq_del_id');
            $mode = $this->input->post('mode');
            $faq_question = trim($this->input->post('faq_question'));
            $faq_answer = strtolower($this->input->post('faq_answer'));

            if ($mode == "ADD") {

                $next_precedence = $this->mastermodel->get_next_precedence('faq_details', 'precedence', []);
                $insert_Arr = array(
                    'faq_question' => $faq_question,
                    'faq_answer' => $faq_answer,
                    'precedence' => $next_precedence,
                );
                $insertId = $this->commondatamodel->insertSingleTableData('faq_details', $insert_Arr);
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
                    "faq_details.faq_del_id" => $faq_del_id
                );
                $data = array(
                    'faq_question' => $faq_question,
                    'faq_answer' => $faq_answer,
                );
                $updateData = $this->commondatamodel->updateSingleTableData('faq_details', $data, $where, $faq_del_id);
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

    public function activeInactiveFaq($id, $status)
    {
        $this->commondatamodel->updateSingleTableData("faq_details", ["is_disabled" => $status], ["faq_del_id" => $id], $id);
        redirect('master/faq_view', 'refresh');
    }


    public function functions_career()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "dashboard/master/functions_career_view.php";
            $header = "";
            $orderby = 'id';
            $result['functions_careerList'] = $this->commondatamodel->getAllRecordWhereOrderBy('functions_career', [], $orderby);

            //  pre($result['participantList']);exit;
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }

    public function activeInactiveFunctionscareer($id, $status)
    {
        $this->commondatamodel->updateSingleTableData("functions_career", ["is_disabled" => $status], ["id" => $id], $id);
        redirect('master/functions_career', 'refresh');
    }




    public function functions_career_add_edit()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            if ($this->uri->segment(3) == NULL) {
                $result['mode'] = "ADD";
                $result['btnText'] = "Create";
                $result['btnTextLoader'] = "Saving...";
                $result['functionsid'] = 0;
                $result['functionEditdata'] = [];
            } else {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $result['functionsid'] = $this->uri->segment(3);
                $where = array('id' => $result['functionsid']);
                $result['functionEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('functions_career', $where);

            }
            $page = "dashboard/master/functions_career_add_edit.php";
            $header = "";


            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }

    }

    public function functions_career_action()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $functions_id = $this->input->post('functions_id');
            $mode = $this->input->post('mode');
            $functions_name = trim($this->input->post('functions_name'));

            if ($mode == "ADD") {

                $next_precedence = $this->mastermodel->get_next_precedence('functions_career', 'precedence', []);
                $insert_Arr = array(
                    'name' => $functions_name,
                    'precedence' => $next_precedence,
                );
                $insertId = $this->commondatamodel->insertSingleTableData('functions_career', $insert_Arr);
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
                    "functions_career.id" => $functions_id
                );
                $data = array(
                    'name' => $functions_name
                );

                $updateData = $this->commondatamodel->updateSingleTableData('functions_career', $data, $where, $functions_id);
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

    public function getLastDayOfMonth($month_year)
    {
        list($month, $year) = explode('/', $month_year);
        $month = (int) $month;
        $year = (int) $year;

        $days_in_month = [
            1 => 31, // January
            2 => ($year % 4 == 0 && ($year % 100 != 0 || $year % 400 == 0)) ? 29 : 28, // February
            3 => 31, // March
            4 => 30, // April
            5 => 31, // May
            6 => 30, // June
            7 => 31, // July
            8 => 31, // August
            9 => 30, // September
            10 => 31, // October
            11 => 30, // November
            12 => 31  // December
        ];
        return $days_in_month[$month] . '/' . $month . '/' . $year;
    }

}/* end of class  */
