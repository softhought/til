<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Team extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);
        $this->load->model('mastermodel', 'mastermodel', TRUE);

    }

    public function index()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "dashboard/team/team_list.php";
            $header = "";
            $result["teamList"] = $this->commondatamodel->getAllRecordOrderBy('team_member_master', 'precedence', 'ASC');
            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function activeInactive($id, $status)
    {
        $this->commondatamodel->updateSingleTableData("team_member_master", ["is_disabled" => $status], ["team_member_id" => $id], $id);
        redirect('team', 'refresh');
    }

    public function addEdit($id = null)
    {
        $session = $this->session->userdata('user_detail');
        $result = [];
        $page = "dashboard/team/team_addedit.php";
        $header = "";
        if ($this->session->userdata('user_detail')) {
            if ($id) {
                $result["editData"] = $this->commondatamodel->getSingleRowByWhereCls("team_member_master", ["team_member_id" => $id]);
            }
            
            $result["role"] = [
                ["key" => "BOD", "value" => "Board of Directors"],
                ["key" => "MT", "value" => "Management Team"],
            ];

            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function addEditAction()
    {
        $mode = $_POST["mode"];
        $member_name = $_POST["member_name"];
        $team_member_type = $_POST["team_member_type"];
        $designation = $_POST["designation"];
        $about = $_POST["about"];
        $address = $_POST["address"];
        $din_no = $_POST["din_no"];

        $dataArr = [
            'member_name' => $member_name,
            'team_member_type' => $team_member_type,
            'designation' => $designation,
            'about' => $about,
            'address' => $address,
            'din_no' => $din_no,
            'precedence' => $this->mastermodel->get_next_precedence("team_member_master", "precedence", []),
        ];

        if (isset($_FILES['member_picfile'])) {
            $file = $_FILES['member_picfile'];
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];

            $uploadDir = 'tilindia/assets/images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $currentDate = date('Y_m_d_H_i_s');
            $uniqueHash = uniqid();
            $originalFilename = $_FILES['member_picfile']['name'];
            $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);

            $newFilename = "{$currentDate}_{$uniqueHash}.{$fileExtension}";
            $fileDestination = $uploadDir . $newFilename;
            if ($fileError === 0) {
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $dataArr = array_merge($dataArr, [
                        'member_pic' => $newFilename
                    ]);
                }
            }
        }

        if ($mode == "edit") {
            $team_member_id = $_POST["team_member_id"];
            $status = $this->commondatamodel->updateSingleTableData("team_member_master", $dataArr, ["team_member_id" => $team_member_id], $team_member_id);
        } else {
            $status = $this->commondatamodel->insertSingleTableData("team_member_master", $dataArr);
        }

        if ($status) {
            echo json_encode(["status" => true]);
        } else {
            echo json_encode(["status" => false]);
        }
        header('Content-Type: application/json');
        exit;
    }
}
