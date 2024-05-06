<?php defined('BASEPATH') or exit('No direct script access allowed');
class Products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);
        $this->load->model('ProductsMenu', 'productsmenu', TRUE);

    }
    public function index()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "dashboard/products/add_edit_products";
            $header = "";
            $result["product_menu"] = $this->productsmenu->getNavProductsMenu();

            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function menu_add_edit($id, $isProductPage, $mode)
    {
        $session = $this->session->userdata('user_detail');
        $header = "";
        $result = [];
        if ($this->session->userdata('user_detail')) {


            if ($isProductPage == "product") {
                $page = "dashboard/products/product_add_edit";
                if ($mode == "edit") {
                    $result["editData"] = $this->commondatamodel->getSingleRowByWhereCls("product_master", ["product_master_id" => $id]);
                } else {
                    $result["parentId"] = $id;
                }

            } elseif ($isProductPage == "menu") {
                if ($mode == "edit") {
                    $result["editData"] = $this->commondatamodel->getSingleRowByWhereCls("product_master", ["product_master_id" => $id]);
                } else {
                    $result["parentId"] = $id;
                }
                $page = "dashboard/products/menu_add_edit";
            } else {
                echo "Invalid Request";
            }


            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function menu_add_edit_action()
    {
        $mode = $_POST["mode"];
        $slug = $_POST["slug"];
        $parent_id = $_POST["parent_id"];
        $title = $_POST["title"];
        $short_description = $_POST["short_description"];
        $description = $_POST["description"];

        $dataArr = [
            'slug' => $slug,
            'parent_id' => $parent_id,
            'name' => $title,
            'short_description' => $short_description,
            'about' => $description
        ];

        if (isset($_FILES['bannerimagefile'])) {
            $file = $_FILES['bannerimagefile'];
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];

            $uploadDir = 'assets/images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $currentDate = date('Y_m_d_H_i_s');
            $uniqueHash = uniqid();
            $originalFilename = $_FILES['bannerimagefile']['name'];
            $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);

            $newFilename = "{$currentDate}_{$uniqueHash}.{$fileExtension}";
            $fileDestination = $uploadDir . $newFilename;
            if ($fileError === 0) {
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $dataArr = array_merge($dataArr, [
                        'banner_image' => $newFilename
                    ]);
                }
            }
        }

        if (isset($_FILES['catagory_image_file'])) {
            $file = $_FILES['catagory_image_file'];
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];

            $uploadDir = 'assets/images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $currentDate = date('Y_m_d_H_i_s');
            $uniqueHash = uniqid();
            $originalFilename = $_FILES['catagory_image_file']['name'];
            $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);

            $newFilename = "{$currentDate}_{$uniqueHash}.{$fileExtension}";
            $fileDestination = $uploadDir . $newFilename;

            if ($fileError === 0) {
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $dataArr = array_merge($dataArr, [
                        'catagory_image' => $newFilename
                    ]);
                }
            }
        }

        if ($mode == "edit") {
            $product_master_id = $_POST["product_master_id"];
            $status = $this->commondatamodel->updateSingleTableData("product_master", $dataArr, ["product_master_id" => $product_master_id], $product_master_id);
        } else {
            $status = $this->commondatamodel->insertSingleTableData("product_master", $dataArr);
        }

        if ($status) {
            echo json_encode(["status" => true]);
        } else {
            echo json_encode(["status" => false]);
        }
        header('Content-Type: application/json');
        exit;
    }

    public function product_add_edit_action()
    {
        $mode = $_POST["mode"];
        $slug = $_POST["slug"];
        $parent_id = $_POST["parent_id"];
        $title = $_POST["title"];
        $short_description = $_POST["short_description"];
        $description = $_POST["description"];

        $dataArr = [
            'slug' => $slug,
            'parent_id' => $parent_id,
            'name' => $title,
            'short_description' => $short_description,
            'about' => $description
        ];

        if (isset($_FILES['bannerimagefile'])) {
            $file = $_FILES['bannerimagefile'];
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];

            $uploadDir = 'assets/images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $currentDate = date('Y_m_d_H_i_s');
            $uniqueHash = uniqid();
            $originalFilename = $_FILES['bannerimagefile']['name'];
            $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);

            $newFilename = "{$currentDate}_{$uniqueHash}.{$fileExtension}";
            $fileDestination = $uploadDir . $newFilename;
            if ($fileError === 0) {
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $dataArr = array_merge($dataArr, [
                        'banner_image' => $newFilename
                    ]);
                }
            }
        }

        if (isset($_FILES['catagory_image_file'])) {
            $file = $_FILES['catagory_image_file'];
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];

            $uploadDir = 'assets/images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $currentDate = date('Y_m_d_H_i_s');
            $uniqueHash = uniqid();
            $originalFilename = $_FILES['catagory_image_file']['name'];
            $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);

            $newFilename = "{$currentDate}_{$uniqueHash}.{$fileExtension}";
            $fileDestination = $uploadDir . $newFilename;

            if ($fileError === 0) {
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $dataArr = array_merge($dataArr, [
                        'catagory_image' => $newFilename
                    ]);
                }
            }
        }

        if (isset($_FILES['side_image_file'])) {
            $file = $_FILES['side_image_file'];
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];

            $uploadDir = 'assets/images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $currentDate = date('Y_m_d_H_i_s');
            $uniqueHash = uniqid();
            $originalFilename = $_FILES['side_image_file']['name'];
            $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);

            $newFilename = "{$currentDate}_{$uniqueHash}.{$fileExtension}";
            $fileDestination = $uploadDir . $newFilename;

            if ($fileError === 0) {
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $dataArr = array_merge($dataArr, [
                        'left_image' => $newFilename
                    ]);
                }
            }
        }

        if ($mode == "edit") {
            $product_master_id = $_POST["product_master_id"];
            $status = $this->commondatamodel->updateSingleTableData("product_master", $dataArr, ["product_master_id" => $product_master_id], $product_master_id);
        } else {
            $status = $this->commondatamodel->insertSingleTableData("product_master", $dataArr);
        }

        if ($status) {
            echo json_encode(["status" => true, "product_master_id" => $status]);
        } else {
            echo json_encode(["status" => false]);
        }
        header('Content-Type: application/json');
        exit;
    }

    public function fetchtemplate()
    {
        $result = $this->commondatamodel->getAllDropdownData("template_master");
        echo json_encode(["status" => true, "data" => $result]);
        header('Content-Type: application/json');
        exit;
    }

    public function fetchtemplatecolumn()
    {
        $template_id = $_POST["template_id"];
        $result = $this->commondatamodel->getSingleRowByWhereCls("template_master", ["template_id" => $template_id]);
        $decodeResultCol = json_decode($result->column_names, true);
        echo json_encode(["status" => true, "data" => $decodeResultCol]);
        header('Content-Type: application/json');
        exit;
    }

    public function modeladdeditaction()
    {
        $mode = $_POST["model_mode"];
        $product_master_id = $_POST["model_product_master_id"];
        $template_master_id = $_POST["template_set"];
        $title = $_POST["model_title"];
        $about = $_POST["model_description"];

        $dataArr = [
            'product_master_id' => $product_master_id,
            'template_master_id' => $template_master_id,
            'title' => $title,
            'about' => $about,
        ];

        if ($mode == "edit") {
            $prodect_model_dt_id = $_POST["prodect_model_dt_id"];
            $status = $this->commondatamodel->updateSingleTableData("product_model_details", $dataArr, ["prodect_model_dt_id" => $prodect_model_dt_id], $prodect_model_dt_id);
        } else {
            $status = $this->commondatamodel->insertSingleTableData("product_model_details", $dataArr);
        }

        if ($status) {
            echo json_encode(["status" => true]);
        } else {
            echo json_encode(["status" => false]);
        }

        header('Content-Type: application/json');
        exit;
    }

    public function fetchtemplatedata()
    {
        $prodect_model_dt_id = $_POST["prodect_model_dt_id"];
        $result = $this->commondatamodel->getSingleRowByWhereCls("product_model_details", ["prodect_model_dt_id" => $prodect_model_dt_id]);

        echo json_encode(["status" => true, "data" => $result]);
        header('Content-Type: application/json');
        exit;
    }

    public function productModelPartialView()
    {
        $product_master_id = $_POST['product_master_id'];
        $result["product_model_details"] = $this->commondatamodel->getAllRecordWhere('product_model_details', ['product_master_id' => $product_master_id]);
        $product_model_details = $this->commondatamodel->getAllRecordWhere("product_model_details", ['product_master_id' => $product_master_id, 'is_disabled' => 0]);
        foreach ($product_model_details as $key => $value) {
            $value->template_master = json_decode($this->commondatamodel->getSingleRowByWhereCls("template_master", ['template_id' => $value->template_master_id])->column_names);
            $value->spec_sheet_details = $this->commondatamodel->getAllRecordWhere('spec_sheet_details', ['product_model_dt_id' => $value->prodect_model_dt_id]);
        }

        $result["product_model"] = $product_model_details;
        $page = "dashboard/products/model_template_partial_view";
        $this->load->view($page, $result);
    }

    public function addEditSpecSheet()
    {
        $spec_product_master_id = $_POST["spec_product_master_id"];
        $spec_product_model_dt_id = $_POST["spec_product_model_dt_id"];
        $template_master_id = $this->commondatamodel->getSingleRowByWhereCls("product_model_details", ['prodect_model_dt_id' => $spec_product_model_dt_id, 'is_disabled' => 0])->template_master_id;

        $template_master = json_decode($this->commondatamodel->getSingleRowByWhereCls("template_master", ['template_id' => $template_master_id])->column_names);

        $dataArr = [
            'product_model_dt_id' => $spec_product_model_dt_id,
            'product_master_id' => $spec_product_master_id,
        ];

        foreach ($template_master as $key => $value) {
            if ($key != "spec_sheet") {
                $dataArr = array_merge([
                    $key => $_POST[$key]
                ], $dataArr);
                $responseArr[] = array("type" => "text", "value" => $_POST[$key]);
            }
        }

        if (isset($_FILES['spec_sheet'])) {
            $file = $_FILES['spec_sheet'];
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            $originalFilename = $file['name'];

            $uploadDir = 'assets/pdf/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileDestination = $uploadDir . $originalFilename;

            if ($fileError === 0) {
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $dataArr = array_merge($dataArr, [
                        'spec_sheet' => $originalFilename,
                    ]);
                    $responseArr[] = array("type" => "link", "value" => $originalFilename);
                } else {
                    $responseArr[] = array("type" => "link", "value" => "");
                }
            } else {
                $responseArr[] = array("type" => "link", "value" => "");
            }
        } else {
            $responseArr[] = array("type" => "link", "value" => "");
        }

        $insertedId = $this->commondatamodel->insertSingleTableData("spec_sheet_details", $dataArr);

        $response = array(
            "status" => true,
            "id" => $insertedId,
            "data" => $responseArr,
            "is_disabled" => false
        );
        echo json_encode($response);
        header('Content-Type: application/json');
        exit;
    }

    public function activeInactiveSpecSheet()
    {
        $spec_sheet_dt_id = $_POST["spec_sheet_dt_id"];
        $status = $_POST["status"];

        $result = $this->commondatamodel->updateSingleTableData("spec_sheet_details", ["is_disabled" => $status], ["spec_sheet_dt_id" => $spec_sheet_dt_id], $spec_sheet_dt_id);
        if ($result) {
            echo json_encode(["status" => true, "data" => $result]);
        } else {
            echo json_encode(["status" => false, "error" => "Fail to Update status"]);
        }
        header('Content-Type: application/json');
        exit;
    }
}

?>