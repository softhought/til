<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{



    public function __construct()
    {

        parent::__construct();

        $this->load->library('session');

        $this->load->model('commondatamodel', 'commondatamodel', TRUE);

        $this->load->model('Dashboardmodel', 'dashboard', TRUE);
        $this->load->model('ProductsMenu', 'productsmenu', TRUE);

    }



    public function index_old()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $user_id = $session['userid'];



            $sl_users = array(1, 2, 10, 26);  //selected users



            // if(in_array($user_id,$sl_users))

            // {

            //     $page = "dashboard/dashboard";

            // }else{

            //     $page = "dashboard/dashboard2";

            // }



            $page = "dashboard/dashboard2";

            /**/

            $result = [];

            $header = "";

            $session = "";

            $data = "";

            $where = array("is_active" => "Active");



            $totalinvestorlist = $this->commondatamodel->getAllRecordWhere('investor_master', $where);

            $result['totalinvestor'] = count($totalinvestorlist);



            $totalstartuplist = $this->commondatamodel->getAllDropdownData('startup_master');

            $result['totalstartup'] = count($totalstartuplist);



            $currentmonth = date('Y-m');

            $result['totalconvertedlist'] = $this->dashboard->getMonthlyConertList($currentmonth);

            // Pre($result['totalconvertedlist']);exit;

            $result['total_payment'] = $this->dashboard->getMonthPaymentDetail($currentmonth);

            // Pre($result['total_payment']);exit;





            createbody_method($result, $page, $header, $session);





        } else {

            redirect('login', 'refresh');



        }

    }


    public function fetchStatesOnCountrie()
    {
        $c_id = $this->input->post('c_id');
        $result = $this->commondatamodel->getAllRecordWhere("tbl_states", ["country_id" => $c_id]);
        header('Content-Type: application/json');
        echo json_encode(["status" => true, "data" => $result]);
        exit;
    }

    public function submitQuotation()
    {
        $inputs = array();
        $organization = $_POST["organization"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $c_id = $_POST["c_id"];
        $country_name = $this->commondatamodel->getSingleRowByWhereCls("tbl_countries", ["id" => $c_id])->name;
        $s_id = $_POST["s_id"];
        $state_name = $this->commondatamodel->getSingleRowByWhereCls("tbl_states", ["id" => $s_id])->name;
        $query = $_POST["query"];
        $spec_sheet_dt_id = $_POST["product_id"];
        $ip_address = $_SERVER['REMOTE_ADDR'];

        $dataArr = [
            'organization' => $organization,
            'time' => date('Y-m-d H:i:s'),
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'c_id' => $c_id,
            'country_name' => $country_name,
            's_id' => $s_id,
            'state_name' => $state_name,
            'query' => $query,
            'spec_sheet_dt_id' => $spec_sheet_dt_id,
            'ip_address' => $ip_address,
        ];


        $inputs['organization'] = $organization;
        $inputs['name'] = $name;
        $inputs['phone'] = $phone;
        $inputs['email'] = $email;
        $inputs['state_name'] = $state_name;
        $inputs['country_name'] = $country_name;
        $inputs['address'] = $address;
        $inputs['query'] = $query;
        $inputs['receipant'] = $this->commondatamodel->getSingleRowByWhereCls("fuel_nature_of_query", ["id" => 1]);
        $inputs['product'] = $this->commondatamodel->getSingleRowByWhereCls("spec_sheet_details", ["spec_sheet_dt_id" => $spec_sheet_dt_id]);
        $message = $this->load->view('mailers/quote', $inputs, TRUE);
        $subject = "Get a Quote  ";

        $insertedId = $this->commondatamodel->insertSingleTableData("quotation_received", $dataArr);
        $this->sendEmailData($inputs, $subject, $message, "quotation_received", $insertedId);

        if ($insertedId) {
            echo json_encode(["status" => true]);
        } else {
            echo json_encode(["status" => false]);
        }
        header('Content-Type: application/json');
        exit;
    }

    public function submitContactForm()
    {
        $organization = $_POST["organization"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $country_id = $_POST["country_id"];
        $country_name = $this->commondatamodel->getSingleRowByWhereCls("tbl_countries", ["id" => $country_id])->name;
        $state_id = $_POST["state_id"];
        $state_name = $this->commondatamodel->getSingleRowByWhereCls("tbl_states", ["id" => $state_id])->name;
        $query = $_POST["query"];
        $nature_of_query_id = $_POST["nature_of_query_id"];
        $ip_address = $_SERVER['REMOTE_ADDR'];

        $dataArr = [
            'organization' => $organization,
            'time' => date('Y-m-d H:i:s'),
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'country_id' => $country_id,
            'country_name' => $country_name,
            'state_id' => $state_id,
            'state_name' => $state_name,
            'query' => $query,
            'nature_of_query_id' => $nature_of_query_id,
            'ip_address' => $ip_address,
        ];

        $insertedId = $this->commondatamodel->insertSingleTableData("contact_us", $dataArr);

        if ($insertedId) {
            echo json_encode(["status" => true]);
        } else {
            echo json_encode(["status" => false]);
        }
        header('Content-Type: application/json');
        exit;
    }

    public function submityourcv()
    {
        if (isset($_FILES['resume'])) {
            $file = $_FILES['resume'];
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];

            $uploadDir = 'assets/uploads/job/application/resume/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $currentDate = date('Y_m_d_H_i_s'); // Format: yyyy_mm_dd_hh_mm_ss
            $uniqueHash = uniqid();
            $originalFilename = $_FILES['resume']['name'];
            $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);

            $newFilename = "{$currentDate}_{$uniqueHash}.{$fileExtension}";
            $fileDestination = $uploadDir . $newFilename;

            if ($fileError === 0) {
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $candidte_name = $_POST["candidte_name"];
                    $current_opening_id = $_POST["current_opening_id"];
                    $function_id = $_POST["function_id"];
                    $technical_qualification = $_POST["technical_qualification"];
                    $linkedIn_profile = $_POST["linkedIn_profile"];
                    $massage = $_POST["massage"];
                    $ip_address = $_SERVER['REMOTE_ADDR'];

                    $dataArr = [
                        'candidte_name' => $candidte_name,
                        'function_id' => $function_id,
                        'technical_qualification' => $technical_qualification,
                        'linkedIn_profile' => $linkedIn_profile,
                        'massage' => $massage,
                        'resume' => $fileDestination,
                        'ip_address' => $ip_address,

                    ];

                    $insertedId = $this->commondatamodel->insertSingleTableData("resume_submission", $dataArr);

                    if ($insertedId) {
                        echo json_encode(["status" => true]);
                    }
                    exit;
                } else {
                    echo json_encode(["status" => false]);
                }
            } else {
                echo json_encode(["status" => false]);
            }
        } else {
            echo json_encode(["status" => false]);
        }
        header('Content-Type: application/json');
    }

    public function submittrainingform()
    {
        $customer_name = $_POST["customer_name"];
        $company_name = $_POST["company_name"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $training_id = $_POST["training_id"];
        $training_month = $_POST["training_month"];
        $training_year = $_POST["training_year"];
        $location_id = $_POST["location_id"];
        $ip_address = $_SERVER['REMOTE_ADDR'];

        $dataArr = [
            'customer_name' => $customer_name,
            'company_name' => $company_name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'training_id' => $training_id,
            'training_month' => $training_month,
            'training_year' => $training_year,
            'location_id' => $location_id,
            'ip_address' => $ip_address,
        ];

        $insertedId = $this->commondatamodel->insertSingleTableData("customer_support_training", $dataArr);

        if ($insertedId) {
            echo json_encode(["status" => true]);
        } else {
            echo json_encode(["status" => false]);
        }
        header('Content-Type: application/json');
        exit;
    }

    public function checkdateRange()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {



            $year_id = $session['yearid'];

            $datedata = $this->input->post('datedata');



            $inputdt = str_replace('/', '-', $datedata);

            $input_date = date('Y-m-d', strtotime($inputdt));



            $getdata = $this->dashboard->checkdaterange($input_date, $year_id);



            if (!empty($getdata)) {

                $json_response = array(

                    "msg_status" => 1,



                );

            } else {

                $json_response = array(

                    "msg_status" => 0,



                );

            }

            header('Content-Type: application/json');

            echo json_encode($json_response);

            exit;





        } else {

            redirect('login', 'refresh');



        }

    }











    public function viewLogHisory()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {



            $row_id = $this->input->post('rowid');

            $table_name = $this->input->post('tablename');

            $company_id = $session['companyid'];

            $year_id = $session['yearid'];







            $page = "dashboard/log_history.php";

            $result['tableColumnData'] = $this->commondatamodel->getTableColumn($table_name);

            $result['logData'] = $this->dashboard->getAllLogHistory($row_id, $table_name);

            // pre($result['tableColumnData']);exit;

            $this->load->view($page, $result);



        } else {

            redirect('login', 'refresh');

        }

    }



    public function chartView()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {



            $result = "";



            for ($i = 11; $i >= 0; --$i) {

                $month[] = date('Y-m', strtotime("-$i months"));



            }



            foreach ($month as $month) {



                $totalpotential[] = array(

                    'month_name' => date("M-y", strtotime($month)),

                    'potential_count' => $this->dashboard->GetPotentialCount($month),

                    'converted_investor' => $this->dashboard->getConvertedCount($month),

                );

            }



            // pre($totalpotential);exit;



            if (!empty($totalpotential)) {

                $json_response = array(

                    "details" => $totalpotential,

                    "msg_status" => 1,



                );

            } else {

                $json_response = array(

                    "msg_status" => 0,



                );

            }

            header('Content-Type: application/json');

            echo json_encode($json_response);

            exit;



















        } else {

            redirect('login', 'refresh');

        }



    }



    public function renewalChartView()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $result = "";



            for ($i = 11; $i >= 0; --$i) {

                $month[] = date('Y-m', strtotime("-$i months"));



            }

            foreach ($month as $month) {



                $totalrenewal[] = array(

                    'month_name' => date("M-y", strtotime($month)),

                    'total_renewal' => $this->dashboard->getRenewalListCount($month),

                    'renewal_sucess' => $this->dashboard->getThisMonthRenewalCount($month),

                    'wing_back' => $this->dashboard->getWingbackCount($month),

                );

            }



            if (!empty($totalrenewal)) {

                $json_response = array(

                    "details" => $totalrenewal,

                    "msg_status" => 1,



                );

            } else {

                $json_response = array(

                    "msg_status" => 0,



                );

            }

            header('Content-Type: application/json');

            echo json_encode($json_response);

            exit;





        } else {

            redirect('login', 'refresh');

        }



    }



    public function getConversion()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $header = "";

            $result = [];

            $page = "dashboard/dashbord-partial-list/convert_list.php";

            $currentmonth = date('Y-m');

            $result['totalconvertedlist'] = $this->dashboard->getMonthlyConvertList($currentmonth);



            createbody_method($result, $page, $header, $session);



        } else {

            redirect('login', 'refresh');

        }

    }



    public function getMonthPayment()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $header = "";

            $result = [];

            $currentmonth = date('Y-m');

            $result['totalpaymentlist'] = $this->dashboard->getAllPaymentReceiptInvestor($currentmonth);



            $result['total_payment'] = $this->dashboard->getMonthPaymentDetail($currentmonth);

            // pre($result['total_payment']);exit;

            $page = "dashboard/dashbord-partial-list/this_month_payment.php";





            createbody_method($result, $page, $header, $session);



        } else {

            redirect('login', 'refresh');

        }

    }





    public function conversionListByDate()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $frm_date = $this->input->post('frm_date');

            $to_date = $this->input->post('to_date');



            if ($frm_date != "") {

                $frm_date = str_replace('/', '-', $frm_date);

                $frm_date = date("Y-m-d", strtotime($frm_date));

            } else {

                $frm_date = NULL;

            }





            if ($to_date != "") {

                $to_date = str_replace('/', '-', $to_date);

                $to_date = date("Y-m-d", strtotime($to_date));

            } else {

                $to_date = NULL;

            }





            $result = [];



            $result['conversionList'] = $this->dashboard->conversionListByDate($frm_date, $to_date);

            $page = "dashboard/dashbord-partial-list/conversion_partial_list.php";

            // pre( $result['conversionList']);exit;

            $this->load->view($page, $result);



        } else {

            redirect('login', 'refresh');

        }

    }



    public function paymentListByDate()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $frm_date = $this->input->post('frm_date');

            $to_date = $this->input->post('to_date');



            if ($frm_date != "") {

                $frm_date = str_replace('/', '-', $frm_date);

                $frm_date = date("Y-m-d", strtotime($frm_date));

            } else {

                $frm_date = NULL;

            }





            if ($to_date != "") {

                $to_date = str_replace('/', '-', $to_date);

                $to_date = date("Y-m-d", strtotime($to_date));

            } else {

                $to_date = NULL;

            }





            $result = [];



            $result['paymentList'] = $this->dashboard->paymentListByDate($frm_date, $to_date);

            $result['totalAmount'] = $this->dashboard->totalPaymentByDate($frm_date, $to_date);

            $page = "dashboard/dashbord-partial-list/payment_partial_list.php";

            // pre( $result['totalAmount']);exit;

            $this->load->view($page, $result);



        } else {

            redirect('login', 'refresh');

        }

    }







    // public function getDashboard()

    // {

    //     $session = $this->session->userdata('user_detail');

    //     if($this->session->userdata('user_detail'))

    //     {

    //        $result = [];

    //         $type=$this->input->post('type');



    //         if($type == "month_conversion")

    //         {

    //             $currentmonth = date('Y-m');

    //             $result['totalconvertedlist'] = $this->dashboard->getMonthlyConvertList($currentmonth);

    //             $page="dashboard/dashbord-partial-list/this_month_convert_partial_list.php";

    //             // pre($result['totalconvertedlist']);exit;

    //             $this->load->view($page,$result);

    //         }else if($type == "payment")

    //         {

    //             $currentmonth = date('Y-m');

    //             $result['totalpaymentlist'] = $this->dashboard->getAllPaymentReceiptInvestor($currentmonth);



    //             $result['total_payment']= $this->dashboard->getMonthPaymentDetail($currentmonth);

    //             // pre($result['total_payment']);exit;

    //             $page="dashboard/dashbord-partial-list/this_month_payment.php";



    //             $this->load->view($page,$result);

    //         }





    //     }else {

    //         redirect('login', 'refresh');

    //     }



    // }









    public function index()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $user_id = $session['userid'];

            $result = [];

            $user_role = $session['role'];

            // pre( $user_role);exit;



            // $sl_users = array(1,2,10,26);  //selected users

            $sl_users = array('Developer', 'Admin');  //selected users



            // if(in_array($user_role,$sl_users))

            // {

            //     $page = "dashboard/test";

            // }else{

            //     $page = "dashboard/dashboard2";

            // }



            $page = "dashboard/dashboard2";



            //exit;

            //pre($result);exit;



            /**/



            $header = "";

            $session = "";

            $data = [];



            // pre($result['topinvestor']);exit;



            createbody_method($result, $page, $header, $session);







        } else {

            redirect('login', 'refresh');



        }

    }





    public function getMantsAmount()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $page = "dashboard/dashbord-partial-list/this_month_mants.php";

            $result = [];

            $header = "";

            $session = "";

            createbody_method($result, $page, $header, $session);

        } else {

            redirect('login', 'refresh');



        }



    }



    public function getMantsList()
    {

        $session = $this->session->userdata('user_detail');

        if ($this->session->userdata('user_detail')) {

            $result = [];

            $frm_date = $this->input->post('frm_date');

            $to_date = $this->input->post('to_date');

            if ($frm_date != "") {

                $frm_date = str_replace('/', '-', $frm_date);

                $frm_date = date("Y-m-d", strtotime($frm_date));

            } else {

                $frm_date = NULL;

            }





            if ($to_date != "") {

                $to_date = str_replace('/', '-', $to_date);

                $to_date = date("Y-m-d", strtotime($to_date));

            } else {

                $to_date = NULL;

            }



            $where2 = array("commision_id" => "8");

            $result['mantsPayment'] = $this->dashboard->mantsAmunt($frm_date, $to_date, $where2);

            $result['totalAmout'] = $this->dashboard->totalMantsPayment($frm_date, $to_date, $where2);

            // pre( $result['mantsPayment']);exit;

            $page = "dashboard/dashbord-partial-list/mants_partial_list.php";







            $this->load->view($page, $result);





        } else {

            redirect('login', 'refresh');



        }



    }

    public function thankyou()
    {
        $page = "web_view/thank_you.php";
        $result["product_menu"] = $this->productsmenu->getNavProductsMenu()[0]["children"];
        webbody_helper($result, $page);
    }

    public function searchfrom()
    {
        $query = $_POST["key_val"];
        $jsonResult = $this->executePythonScript($query);

        if (json_decode($jsonResult)) {
            $decodeJson["content"] = json_decode($jsonResult);
            $decodeJson["query"] = $query;
            $_SESSION["search_result"] = json_encode($decodeJson);

            echo json_encode(["status" => true, "data" => $jsonResult, "query" => $query]);
        } else {
            $_SESSION["search_result"] = json_encode(["query" => $query]);
            echo json_encode(["status" => true, "data" => $query]);
        }

        header('Content-Type: application/json');
        exit;
    }

    public function executePythonScript($keyWord)
    {
        $dir = FILE_UPLOAD_BASE_PATH . "/assets/script/script.py";

        $pythonScript = "python {$dir}";
        putenv("PYTHONIOENCODING=utf-8");

        $command = "{$pythonScript} {$keyWord}";
        $output = shell_exec($command);

        $decodedOutput = json_decode($output, true);

        if ($decodedOutput !== null) {

            foreach ($decodedOutput as &$item) {
                if (isset($item['content'])) {
                    $item['content'] = trim(preg_replace('/\s+/', ' ', $item['content']));
                }
            }

            $jsonOutput = json_encode($decodedOutput, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

            return $jsonOutput;
        } else {
            return "Failed to decode JSON output.";
        }
    }

    public function unset_session()
    {
        unset($_SESSION["isUserAllowed"]);
        echo json_encode(["status" => true]);
        header('Content-Type: application/json');
        exit;
    }

    public function sendEmailData($inputs, $subject, $message, $table, $insertedId, $fileLink = "")
    {
        // $status = SendEmail($inputs['receipant']->email, $subject, $message, $inputs['receipant']->cc_to, "", $fileLink);
        $status = SendEmail("sumanvar405@gmail.com", $subject, $message, "", "", $fileLink);

        $dataArr = [
            'user_refid' => $insertedId,
            'email' => $inputs['receipant']->email,
            'table_name' => $table,
            'sub' => $subject,
            'msg' => $message,
            'to_cc_mail' => $inputs['receipant']->cc_to,
            'mail_status' => $status,
            'file_link' => $fileLink
        ];

        $insertedRow = $this->commondatamodel->insertSingleTableData("email_detail", $dataArr);
        return $insertedRow;
    }

}