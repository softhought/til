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
            'title' => $title,
            'short_description' => $short_description,
            'description' => $description
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
                    $dataArr = array_merge([
                        'catagory_image' => $newFilename
                    ], $dataArr);
                }
            }
        }
        
        if ($mode == "edit") {
            $product_master_id = $_POST["product_master_id"];
            $status = $this->commondatamodel->updateSingleTableData("product_master", $dataArr, ["product_master_id" => $product_master_id]);
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
}