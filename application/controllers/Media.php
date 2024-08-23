<?php defined('BASEPATH') or exit('No direct script access allowed');
class Media extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);
        $this->load->model('mediamodel', 'mediamodel', TRUE);
        $this->load->model('Investormodel', 'investormodel', TRUE);
    }
    public function index()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $page = "dashboard/media/add_edit_media";
            $header = "";

            $result['pressCount'] = $this->mediamodel->getPressReleaseCount();

            createbody_method($result, $page, $header, $session);
        } else {
            redirect('login', 'refresh');
        }
    }
    /**--------------------------for video section start ------------------ */
    public function video_partial_view()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $result['mode'] = "ADD";
            $result['btnText'] = "Save";
            $result['btnTextLoader'] = "Saving...";
            $result['videoId'] = 0;
            $result['videolist'] = $this->mediamodel->getVideoAllList();
            $result['media_tag'] = $this->input->post('media_tag');
            $page = "dashboard/media/video_partial_view";
            $this->load->view($page, $result);
        } else {
            redirect('login', 'refresh');
        }
    }/** end  */
    public function setStatus()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $updID = trim($this->input->post('uid'));
            $status = trim($this->input->post('status'));
            $update_array = array("is_disabled" => $status);
            $where = array("id" => $updID);
            $update = $this->commondatamodel->updateSingleTableData('fuel_videos', $update_array, $where, $updID);
            if ($update) {
                $json_response = array(
                    "msg_status" => 1,
                    "msg_data" => "Status updated"
                );
            } else {
                $json_response = array(
                    "msg_status" => 0,
                    "msg_data" => "Failed to update"
                );
            }
            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit;

        } else {
            redirect('login', 'refresh');
        }
    }/** end */
    public function video_add_edit_action()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $videoId = $this->input->post('videoId');
            $mode = $this->input->post('mode');
            $title = $this->input->post('title');
            $link = $this->input->post('link');
            $date = date('Y-m-d H:i:s');

            if ($mode == 'EDIT' && $videoId > 0) {

                $where_array = array('id' => $videoId);
                $update_Arr = array(
                    'title' => $title,
                    'video_id' => $link
                );
                $update_status = $this->commondatamodel->updateSingleTableData('fuel_videos', $update_Arr, $where_array, $videoId);
                if ($update_status) {
                    $json_response = array(
                        "msg_status" => 1,
                        "msg_data" => "Updated successfully",
                        "mode" => "EDIT",
                    );

                } else {
                    $json_response = array(
                        "msg_status" => 0,
                        "msg_data" => "There is some problem.Try again"
                    );

                }
            } else {

                $insert_Arr = array(
                    'title' => $title,
                    'video_id' => $link,
                    'precedence' => 1,
                    'time_modified' => $date,
                    'is_disabled' => 0
                );
                $srl_no = $this->mediamodel->getVideoAllList();
                $precedence_value = '';
                $new_precedence_value = '';
                foreach ($srl_no as $list) {
                    $id = $list->id;
                    $precedence_value = $list->precedence;

                    $new_precedence_value = $precedence_value + 1;
                    $update_array = array("precedence" => $new_precedence_value);
                    $where = array("id" => $id);
                    $update = $this->commondatamodel->updateSingleTableData('fuel_videos', $update_array, $where, $id);

                }

                $insert_status = $this->commondatamodel->insertSingleTableData('fuel_videos', $insert_Arr);
                if ($insert_status) {
                    $json_response = array(
                        "msg_status" => 1,
                        "msg_data" => "Saved successfully",
                        "mode" => "ADD",
                    );

                } else {
                    $json_response = array(
                        "msg_status" => 0,
                        "msg_data" => "There is some problem.Try again"
                    );

                }

            }
            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit;
        } else {
            redirect('login', 'refresh');
        }
    }/**end  */
    /**--------------------------for video section end ------------------ */


    public function videoserialchange()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $id = trim($this->input->post('id'));
            $slno = trim($this->input->post('slno'));
            $action = trim($this->input->post('action'));
            $slectedvalue = trim($this->input->post('slectedvalue'));
            $media_tag = trim($this->input->post('media_tag'));
            $table_name = trim($this->input->post('table_name'));
            $ref_id = trim($this->input->post('ref_id'));
            $json_response = array();

            if ($action == 'U') {
                $pre_sl = $slno - 1;
                if ($pre_sl != '0') {

                    if ($media_tag == 'NEWS' || $media_tag == 'TIL_TALK' || $media_tag == 'TIL_TOUCH') {
                        $where = array('precedence' => $pre_sl, 'table_name' => $table_name, 'ref_id' => $ref_id);
                        $preNewsNewslaterData = $this->commondatamodel->getSingleRowByWhereCls('document_details', $where);
                        // $table_name = $preNewsNewslaterData->table_name;
                        // $ref_id = $preNewsNewslaterData->ref_id;
                        if (!empty($preNewsNewslaterData)) {
                            $pre_docid = $preNewsNewslaterData->doc_id;
                            if (isset($pre_docid)) {
                                $update_array1 = array("precedence" => $pre_sl);

                                $where1 = array("doc_id" => $id, 'table_name' => $table_name, 'ref_id' => $ref_id);
                                $update = $this->commondatamodel->updateSingleTableData('document_details', $update_array1, $where1, $ref_id);

                                $update_array2 = array("precedence" => $slno);
                                $where2 = array("doc_id" => $pre_docid, 'table_name' => $table_name, 'ref_id' => $ref_id);
                                $update = $this->commondatamodel->updateSingleTableData('document_details', $update_array2, $where2, $ref_id);

                                if ($update) {
                                    $json_response = array(
                                        "msg_status" => 1,
                                        "msg_data" => "News and Newslater Precedence updated",
                                        "media_tag" => $media_tag
                                    );
                                }
                            }
                        }

                    }/** end media_tag */ else {

                        $where = array('precedence' => $pre_sl);
                        $preVideoData = $this->commondatamodel->getSingleRowByWhereCls('fuel_videos', $where);
                        if (!empty($preVideoData)) {
                            $pre_videoid = $preVideoData->id;
                            if (isset($pre_videoid)) {
                                $update_array = array("precedence" => $pre_sl);

                                $where = array("id" => $id);
                                $update = $this->commondatamodel->updateSingleTableData('fuel_videos', $update_array, $where, $id);

                                $update_array2 = array("precedence" => $slno);
                                $where2 = array("id" => $pre_videoid);
                                $update = $this->commondatamodel->updateSingleTableData('fuel_videos', $update_array2, $where2, $pre_videoid);

                                if ($update) {
                                    $json_response = array(
                                        "msg_status" => 2,
                                        "msg_data" => "Precedence updated",
                                        "media_tag" => $media_tag
                                    );
                                }
                            }
                        }

                    }/** end else */


                }
            } elseif ($action == 'P') {
                if ($media_tag == 'NEWS' || $media_tag == 'TIL_TALK' || $media_tag == 'TIL_TOUCH') {

                    $where = array('precedence' => $slectedvalue, 'table_name' => $table_name, 'ref_id' => $ref_id);
                    $preNewsNewslaterData = $this->commondatamodel->getSingleRowByWhereCls('document_details', $where);

                    if (!empty($preNewsNewslaterData)) {
                        $pre_docid = $preNewsNewslaterData->doc_id;

                        $update_array = array("precedence" => $slectedvalue, 'table_name' => $table_name, 'ref_id' => $ref_id);
                        $where = array("doc_id" => $id);
                        $update = $this->commondatamodel->updateSingleTableData('document_details', $update_array, $where, $id);

                        $update_array2 = array("precedence" => $slno, 'table_name' => $table_name, 'ref_id' => $ref_id);
                        $where2 = array("doc_id" => $pre_docid);
                        $update = $this->commondatamodel->updateSingleTableData('document_details', $update_array2, $where2, $pre_docid);

                        if ($update) {
                            $json_response = array(
                                "msg_status" => 1,
                                "msg_data" => "News and Newslater Precedence updated",
                                "media_tag" => $media_tag
                            );
                        }
                    }

                }/**endif */ else {

                    $where = array('precedence' => $slectedvalue);
                    $preVideoData = $this->commondatamodel->getSingleRowByWhereCls('fuel_videos', $where);
                    if (!empty($preVideoData)) {
                        $pre_videoid = $preVideoData->id;

                        $update_array = array("precedence" => $slectedvalue);
                        $where = array("id" => $id);
                        $update = $this->commondatamodel->updateSingleTableData('fuel_videos', $update_array, $where, $id);

                        $update_array2 = array("precedence" => $slno);
                        $where2 = array("id" => $pre_videoid);
                        $update = $this->commondatamodel->updateSingleTableData('fuel_videos', $update_array2, $where2, $pre_videoid);

                        if ($update) {
                            $json_response = array(
                                "msg_status" => 2,
                                "msg_data" => "Precedence updated",
                                "media_tag" => $media_tag
                            );
                        }
                    }
                }/**end else */


            } else {
                if ($media_tag == 'NEWS' || $media_tag == 'TIL_TALK' || $media_tag == 'TIL_TOUCH') {
                    $next_sl = $slno + 1;

                    $where = array('precedence' => $next_sl, 'table_name' => $table_name, 'ref_id' => $ref_id);
                    $preNewsNewslaterData = $this->commondatamodel->getSingleRowByWhereCls('document_details', $where);
                    // $table_name = $preNewsNewslaterData->table_name;
                    // $ref_id = $preNewsNewslaterData->ref_id;

                    if (!empty($preNewsNewslaterData)) {
                        // $next_videoid = $preVideoData->id;
                        $next_doc_id = $preNewsNewslaterData->doc_id;

                        $update_array = array("precedence" => $next_sl);
                        $where = array("doc_id" => $id, 'table_name' => $table_name, 'ref_id' => $ref_id);
                        $update = $this->commondatamodel->updateSingleTableData('document_details', $update_array, $where, $id);

                        $update_array2 = array("precedence" => $slno);
                        $where2 = array("doc_id" => $next_doc_id, 'table_name' => $table_name, 'ref_id' => $ref_id);
                        $update = $this->commondatamodel->updateSingleTableData('document_details', $update_array2, $where2, $next_doc_id);
                        if ($update) {
                            $json_response = array(
                                "msg_status" => 1,
                                "msg_data" => "News and Newslater Precedence updated",
                                "media_tag" => $media_tag
                            );
                        }

                    }



                }/** end if */ else {
                    $next_sl = $slno + 1;

                    $where = array('precedence' => $next_sl);
                    $preVideoData = $this->commondatamodel->getSingleRowByWhereCls('fuel_videos', $where);

                    if (!empty($preVideoData)) {
                        $next_videoid = $preVideoData->id;

                        $update_array = array("precedence" => $next_sl);
                        $where = array("id" => $id);
                        $update = $this->commondatamodel->updateSingleTableData('fuel_videos', $update_array, $where, $id);

                        $update_array2 = array("precedence" => $slno);
                        $where2 = array("id" => $next_videoid);
                        $update = $this->commondatamodel->updateSingleTableData('fuel_videos', $update_array2, $where2, $next_videoid);
                        if ($update) {
                            $json_response = array(
                                "msg_status" => 2,
                                "msg_data" => "Precedence updated",
                                "media_tag" => $media_tag
                            );
                        }

                    }
                }/**end else */


            }
            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit;

        } else {

            redirect('login', 'refresh');

        }

    }/** end */
    /** ---------------for news and partial view section start ------------------*/
    public function news_partial_view()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $media_tag = $this->input->post('media_tag');
            $result['media_tag_name'] = $media_tag;
            $where_tag = array('media_master.menu_tag' => $result['media_tag_name']);
            $media_masterID = $this->commondatamodel->getSingleRowByWhereCls('media_master', $where_tag)->media_master_id;
            $where_srl = array('table_name' => 'media_master', 'ref_id' => $media_masterID);
            $result['newslist'] = $this->commondatamodel->getAllRecordWhereOrderBy('document_details', $where_srl, 'precedence');
            //pre($result['newslist']);exit;
            $page = "dashboard/media/news_partial_view";
            $this->load->view($page, $result);
        } else {
            redirect('login', 'refresh');
        }
    }/** end  */
    public function defaultViewNewsAndNewslater()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $result['mode'] = "ADD";
            $result['btnText'] = "Save";
            $result['doc_id'] = 0;
            $media_tag = $this->input->post('media_tag');
            $where = array('media_master.menu_tag' => $media_tag);
            $data = $this->commondatamodel->getSingleRowByWhereCls('media_master', $where);

            header('Content-Type: application/json');
            echo json_encode(['data' => $data]);
            exit;
        } else {
            redirect('login', 'refresh');
        }

    }/**end */
    public function defaultViewNewsAndNewslater_action()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $media_tag = $this->input->post('media_tag');
            $mediaMasterId = $this->input->post('mediaMasterId');
            $mode = $this->input->post('mode');
            $docID = $this->input->post('docID');
            $title_desc = $this->input->post('title_desc');
            $url = $this->input->post('url') ?: null;
            $publication = $this->input->post('publication') ?: null;

            $userFileName = $this->input->post('userFileName');
            $isChangedFile = $this->input->post('isChangedFile');
            $prvFilename = $this->input->post('prvFilename');
            $randomFileName = $this->input->post('randomFileName');

            $dir = FILE_UPLOAD_BASE_PATH . '/assets/docs/pdf/';
            $date = date('Y-m-d H:i:s');

            if ($isChangedFile == 'Y') {
                //move_uploaded_file($_FILES['file']['tmp_name'],$dir.$_FILES['file']['name']) or die("Unable to Move Pdf");
                $userFileName = $_FILES['fileName']['name'];

                if (isset($_FILES['fileName']) && $_FILES['fileName']["error"] == 0) {
                    // Generate a random file name
                    //$randomFileName = uniqid('', true) . '_' . $_FILES["file"]["name"];
                    $random_genrate_name = 'pdf_file_' . uniqid('', true) . '_' . $_FILES["fileName"]["name"];
                    move_uploaded_file($_FILES["fileName"]["tmp_name"], $dir . $random_genrate_name);


                    //$document_name = $randomFileName;
                } else {
                    echo "Error uploading file";
                }

                $file_extension = pathinfo($userFileName, PATHINFO_EXTENSION);
            } else {
                $random_genrate_name = $randomFileName;
                $file_extension = pathinfo($randomFileName, PATHINFO_EXTENSION);
            }


            if ($mode == 'EDIT' && $docID > 0) {
                $where_update = array('doc_id' => $docID);
                $update_arr = array(
                    'file_type' => $file_extension,
                    'table_name' => 'media_master',
                    'ref_id' => $mediaMasterId,
                    'uploaded_file_desc' => $title_desc,
                    'url' => $url,
                    'publication' => $publication,
                    'random_file_name' => $random_genrate_name,
                    'user_file_name' => $userFileName,
                    'uploaded_by_user' => $session['userid']
                );
                $update_status = $this->commondatamodel->updateSingleTableData('document_details', $update_arr, $where_update, $docID);
                if ($update_status) {
                    $json_response = array(
                        "msg_status" => 1,
                        "msg_data" => "Updated successfully",
                        "mode" => "EDIT",
                        "media_tag" => $media_tag
                    );

                } else {
                    $json_response = array(
                        "msg_status" => 0,
                        "msg_data" => "There is some problem.Try again"
                    );

                }
            } else {

                $insert_arr = array(
                    'file_type' => $file_extension,
                    'table_name' => 'media_master',
                    'ref_id' => $mediaMasterId,
                    'uploaded_file_desc' => $title_desc,
                    'url' => $url,
                    'publication' => $publication,
                    'random_file_name' => $random_genrate_name,
                    'user_file_name' => $userFileName,
                    'precedence' => 1,
                    'is_disabled' => 0,
                    'uploaded_by_user' => $session['userid']
                );
                /** for reset serial no  */
                $where_srl = array('table_name' => 'media_master', 'ref_id' => $mediaMasterId);
                $srl_no = $this->commondatamodel->getAllRecordWhereOrderBy('document_details', $where_srl, 'precedence');
                $precedence_value = '';
                $new_precedence_value = '';
                foreach ($srl_no as $list) {
                    $id = $list->doc_id;
                    $table_name = $list->table_name;
                    $ref_id = $list->ref_id;
                    $precedence_value = $list->precedence;

                    $new_precedence_value = $precedence_value + 1;

                    $update_array = ["precedence" => $new_precedence_value];
                    $where = array("table_name" => $table_name, "ref_id" => $ref_id, "doc_id" => $id);
                    $update = $this->commondatamodel->updateSingleTableData('document_details', $update_array, $where, $ref_id);



                }
                /** end for reset serial */

                $insert_status = $this->commondatamodel->insertSingleTableData('document_details', $insert_arr);
                if ($insert_status) {
                    $json_response = array(
                        "msg_status" => 1,
                        "msg_data" => "Saved successfully",
                        "mode" => "ADD",
                        "media_tag" => $media_tag
                    );

                } else {
                    $json_response = array(
                        "msg_status" => 0,
                        "msg_data" => "There is some problem.Try again"
                    );

                }
            }
            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit;


        } else {
            redirect('login', 'refresh');
        }

    }/**end action */
    public function news_newslater_status()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $updID = trim($this->input->post('uid'));
            $status = trim($this->input->post('status'));
            $media_tag = trim($this->input->post('media_tag'));
            $update_array = array("is_disabled" => $status);
            $where = array("doc_id" => $updID);
            $update = $this->commondatamodel->updateSingleTableData('document_details', $update_array, $where, $updID);
            if ($update) {
                $json_response = array(
                    "msg_status" => 1,
                    "msg_data" => "Status updated",
                    "media_tag" => $media_tag
                );
            } else {
                $json_response = array(
                    "msg_status" => 0,
                    "msg_data" => "Failed to update"
                );
            }
            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit;

        } else {
            redirect('login', 'refresh');
        }

    }/**end */
    public function till_talk_partal_view()
    {

        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $media_tag = $this->input->post('media_tag');
            $result['media_tag_name'] = $media_tag;
            $where_tag = array('media_master.menu_tag' => $result['media_tag_name']);

            $media_masterID = $this->commondatamodel->getSingleRowByWhereCls('media_master', $where_tag)->media_master_id;
            $where_srl = array('table_name' => 'media_master', 'ref_id' => $media_masterID);
            // pre($where_srl);
            // exit;
            $result['newslist'] = $this->commondatamodel->getAllRecordWhereOrderBy('document_details', $where_srl, 'precedence');
            //pre($result['newslist']);exit;
            $page = "dashboard/media/newslater_till_talk_partial_view";
            $this->load->view($page, $result);



        } else {
            redirect('login', 'refresh');
        }
    }/** end  */
    public function till_touch_partal_view()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $media_tag = $this->input->post('media_tag');
            $result['media_tag_name'] = $media_tag;
            $where_tag = array('media_master.menu_tag' => $result['media_tag_name']);

            $media_masterID = $this->commondatamodel->getSingleRowByWhereCls('media_master', $where_tag)->media_master_id;
            $where_srl = array('table_name' => 'media_master', 'ref_id' => $media_masterID);
            // pre($where_srl);
            // exit;
            $result['newslist'] = $this->commondatamodel->getAllRecordWhereOrderBy('document_details', $where_srl, 'precedence');
            $page = "dashboard/media/newslater_till_touch_partial_view ";
            $this->load->view($page, $result);
        } else {
            redirect('login', 'refresh');
        }
    }/** end  */
    /** ---------------for news and partial view section end ------------------*/
    /** -----------------start event happining section ------------------*/
    public function events_happining_partial_view()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $result['happinig_list'] = $this->mediamodel->getEventHappiningAllList();
            $page = "dashboard/media/events_happining_partial_view";
            $this->load->view($page, $result);
        } else {
            redirect('login', 'refresh');
        }
    }/** end  */
    public function add_edit_event_happining_partial_view()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

            $result['eventHappiningId'] = trim($this->input->post('eventHappiningId'));
            if ($result['eventHappiningId'] == 0) {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $result['happiningEditdata'] = [];

            } else {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $where = array('happenings.id' => $result['eventHappiningId']);
                $result['happiningEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('happenings', $where);
                $result['images_name'] = json_decode($result['happiningEditdata']->images);
                //pre($result['images_name']);exit;

            }
            $page = "dashboard/media/add_edit_event_happining_partial_view";
            $this->load->view($page, $result);

        } else {
            redirect('login', 'refresh');
        }
    }/**end */
    public function eventsHappining_add_edit_action()
    {
        $session = $this->session->userdata('user_detail');

        if ($session) {
            $mode = $this->input->post('mode');
            $eventHappiningId = $this->input->post('eventHappiningId');
            $event_title = $this->input->post('event_title');

            $dir_path = FILE_UPLOAD_BASE_PATH . '/assets/images/';
            $uploaded_files = $_FILES;
            $file_array = array("docFile" => $_FILES);
            $fileupload = $this->mediamodel->fileUpload($file_array, $dir_path);

            if ($mode == 'EDIT' && $eventHappiningId > 0) {
                /** for previous image start */
                $prev_img_name = $this->input->post('prev_img_name');
                // pre($prev_img_name);exit;

                $prev_images_data = array();
                foreach ($prev_img_name as $previmage_name) {
                    if ($previmage_name != "") {
                        $prev_images_data[] = array(
                            'banner_alt' => $event_title,
                            'banner_image' => $previmage_name
                        );
                    }

                }
                // pre($prev_images_data);
                /** for previous image end */
                /** for new image start  */
                $images_data = array();
                foreach ($fileupload as $image_name) {

                    $image_data = array(
                        'banner_alt' => $event_title,
                        'banner_image' => $image_name
                    );
                    $images_data[] = $image_data;
                }
                /** for new image end */
                $final_image_array = array_merge($prev_images_data, $images_data);

                $images_json = json_encode($final_image_array);
                $where_update = array('happenings.id' => $eventHappiningId);
                $update_data = array(
                    'name' => $event_title,
                    'images' => $images_json,
                );
                $update_status = $this->commondatamodel->updateSingleTableData('happenings', $update_data, $where_update, $eventHappiningId);
                if ($update_status) {

                    $json_response = array(
                        "msg_status" => 1,
                        "msg_data" => "Updated Succesfully",

                    );
                } else {

                    $json_response = array(
                        "msg_status" => 0,
                        "msg_data" => "Failed to update"
                    );
                }

            } else {
                $images_data = array();
                foreach ($fileupload as $image_name) {

                    $image_data = array(
                        'banner_alt' => $event_title,
                        'banner_image' => $image_name
                    );
                    $images_data[] = $image_data;
                }


                $images_json = json_encode($images_data);
                /** for reset serial no  */
                $srl_no = $this->mediamodel->getEventHappiningAllList();

                $precedence_value = '';
                $new_precedence_value = '';
                foreach ($srl_no as $list) {
                    $id = $list->id;
                    $precedence_value = $list->precedence;

                    $new_precedence_value = $precedence_value + 1;
                    $update_array = array("precedence" => $new_precedence_value);
                    $where = array("id" => $id);
                    $update = $this->commondatamodel->updateSingleTableData('happenings', $update_array, $where, $id);

                }
                /** end for reset serial */


                $insert_data = array(
                    'name' => $event_title,
                    'precedence' => 0,
                    'images' => $images_json,
                    'modification_time' => date('Y-m-d H:i:s'),
                    'published' => 1
                );


                $insert_status = $this->commondatamodel->insertSingleTableData('happenings', $insert_data);


                if ($insert_status) {

                    $json_response = array(
                        "msg_status" => 1,
                        "msg_data" => "Saved Succesfully",

                    );
                } else {

                    $json_response = array(
                        "msg_status" => 0,
                        "msg_data" => "Failed to update"
                    );
                }
            }
            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit;
        } else {

            redirect('login', 'refresh');
        }
    }/** end */
    public function eventHappiningserialchange()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $id = trim($this->input->post('id'));
            $slno = trim($this->input->post('slno'));
            $action = trim($this->input->post('action'));
            $slectedvalue = trim($this->input->post('slectedvalue'));
            $json_response = array();
            if ($action == 'U') {
                $pre_sl = $slno - 1;

                //if ($pre_sl != '0') {
                if ($pre_sl != '0' || $pre_sl == '0') {

                    $where = array('precedence' => $pre_sl);
                    $preEventData = $this->commondatamodel->getSingleRowByWhereCls('happenings', $where);
                    if (!empty($preEventData)) {
                        $pre_Eventid = $preEventData->id;
                        if (isset($pre_Eventid)) {
                            $update_array = array("precedence" => $pre_sl);

                            $where = array("id" => $id);
                            $update = $this->commondatamodel->updateSingleTableData('happenings', $update_array, $where, $id);

                            $update_array2 = array("precedence" => $slno);
                            $where2 = array("id" => $pre_Eventid);
                            $update = $this->commondatamodel->updateSingleTableData('happenings', $update_array2, $where2, $pre_Eventid);

                            if ($update) {
                                $json_response = array(
                                    "msg_status" => 1,
                                    "msg_data" => "Precedence updated"

                                );
                            }
                        }
                    }
                }
            } elseif ($action == 'P') {
                $where = array('precedence' => $slectedvalue);
                $preEventData = $this->commondatamodel->getSingleRowByWhereCls('happenings', $where);
                if (!empty($preEventData)) {
                    $pre_Eventid = $preEventData->id;

                    $update_array = array("precedence" => $slectedvalue);
                    $where = array("id" => $id);
                    $update = $this->commondatamodel->updateSingleTableData('happenings', $update_array, $where, $id);

                    $update_array2 = array("precedence" => $slno);
                    $where2 = array("id" => $pre_Eventid);
                    $update = $this->commondatamodel->updateSingleTableData('happenings', $update_array2, $where2, $pre_Eventid);

                    if ($update) {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Precedence updated"

                        );
                    }
                }

            } else {
                $next_sl = $slno + 1;

                $where = array('precedence' => $next_sl);
                $preEventData = $this->commondatamodel->getSingleRowByWhereCls('happenings', $where);
                if (!empty($preEventData)) {
                    $next_Eventid = $preEventData->id;

                    $update_array = array("precedence" => $next_sl);
                    $where = array("id" => $id);
                    $update = $this->commondatamodel->updateSingleTableData('happenings', $update_array, $where, $id);

                    $update_array2 = array("precedence" => $slno);
                    $where2 = array("id" => $next_Eventid);
                    $update = $this->commondatamodel->updateSingleTableData('happenings', $update_array2, $where2, $next_Eventid);
                    if ($update) {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Precedence updated"

                        );
                    }

                }
            }
            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit;

        } else {

            redirect('login', 'refresh');

        }

    }/**end */
    public function setEventStatus()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {
            $uid = trim($this->input->post('uid'));
            $status = trim($this->input->post('status'));
            $update_array = array("published" => $status);
            $where = array("id" => $uid);
            $update = $this->commondatamodel->updateSingleTableData('happenings', $update_array, $where, $uid);
            if ($update) {
                $json_response = array(
                    "msg_status" => 1,
                    "msg_data" => "Status updated"
                );
            } else {
                $json_response = array(
                    "msg_status" => 0,
                    "msg_data" => "Failed to update"
                );
            }
            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit;

        } else {
            redirect('login', 'refresh');
        }

    }/** end */
    /** -----------------end event happining section ------------------*/




    public function add_edit_investor_relations_partial_view()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

            $result['relations_master_id'] = trim($this->input->post('relations_master_id'));
            $result['relations_dtl_id'] = trim($this->input->post('relations_dtl_id'));


            if ($result['relations_dtl_id'] == 0) {
                $result['mode'] = "ADD";
                $result['btnText'] = "Create";
                $result['btnTextLoader'] = "Saving...";
                $result['relationEditdata'] = [];
                $result['documenDtl'] = [];
            } else {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $where = array('investor_relations_details.relations_dtl_id' => $result['relations_dtl_id']);
                $result['relationEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('investor_relations_details', $where);
                $where_doc1 = array(
                    'document_details.ref_id' => $result['relations_dtl_id'],
                    'document_details.table_name' => "investor_relations_details"
                );

                $orderby = 'precedence';
                $result['documenDtl'] = $this->commondatamodel->getAllRecordWhereOrderBy('document_details', $where_doc1, $orderby);
            }

            $page = "dashboard/media/add_edit_investor_relations_partial_view";
            $this->load->view($page, $result);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function investor_relation_action()
    {
        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {

            $relations_master_id = $this->input->post('relations_master_id');
            $relations_dtl_id = $this->input->post('relations_dtl_id');
            $mode = $this->input->post('mode');
            $title = $this->input->post('title');
            $page_url = $this->input->post('page_url');
            $description = $this->input->post('description');

            $dataArry = $_POST;
            if (isset($_POST['docType'])) {
                $docType = $dataArry['docType'];
                $precedence = $dataArry['precedence'];
                $userFilename = $dataArry['userFileName'];
                $fileDesc = NULL;
                $isChangedFile = $dataArry['isChangedFile'];
            } else {
                $docType = NULL;
                $precedence = NULL;
                $userFilename = NULL;
                $fileDesc = NULL;
                $isChangedFile = NULL;
            }

            $update_data = array(
                'relations_master_id' => $relations_master_id,
                'title' => $title,
                'page_url' => $page_url,
                'description' => $description,
            );


            $upd_where = array('investor_relations_details.relations_dtl_id' => $relations_dtl_id);
            $Updatedata = $this->commondatamodel->updateSingleTableData('investor_relations_details', $update_data, $upd_where, $relations_dtl_id);

            /* file upload */
            if (isset($_POST['docType'])) {
                $randomFileName = $dataArry['randomFileName'];
                $prvFilename = $dataArry['prvFilename'];
                $docDetailIDs = $dataArry['docDetailIDs'];
            } else {
                $randomFileName = NULL;
                $prvFilename = NULL;
                $docDetailIDs = NULL;
            }

            $file_array = array(
                "masterID" => $relations_dtl_id,
                "isChangedFile" => $isChangedFile,
                'randomFileName' => $randomFileName,
                'prvFilename' => $prvFilename,
                'docDetailIDs' => $docDetailIDs,
                "mode" => $mode,
                "docType" => $docType,
                "precedence" => $precedence,
                "userFilename" => $userFilename,
                "docFile" => $_FILES,
                "fileDesc" => $fileDesc,
                "user_id" => $session['userid']
            );

            $fileupload = $this->investormodel->fileUploadInvestor($file_array);

            if ($Updatedata) {
                $json_response = array(
                    "msg_status" => 1,
                    "msg_data" => "Updated successfully",
                );
            } else {
                $json_response = array(
                    "msg_status" => 0,
                    "msg_data" => "There is some problem while updating ...Please try again."
                );
            }


            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit;


        } else {
            redirect('login', 'refresh');
        }
    }

}/** end controller */