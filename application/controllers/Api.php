<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel', 'commondatamodel', TRUE);
        $this->load->model('quizmodel', 'quizmodel', TRUE);

    }



    public function version()
    {
        $json_response = $this->commondatamodel->getSingleRowByWhereCls('app_version', []);
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;

    }


    public function dashboard()
    {


        //    echo $result=$this->quizmodel->getTodayShareCount('9003319369');
        /* call to score once  */
        //     exit;
        $mobile_no = $_POST['mobile_no'];
        $participant_code = $_POST['participant_code'];

        /* call once if update needed total score */
        $this->quizmodel->getTotalScoreByMobile($mobile_no);

        $todayPlay = $this->quizmodel->getTodayQuizCount($participant_code);


        $where = array('mobile_no' => $mobile_no);
        $participantData = $this->commondatamodel->getSingleRowByWhereCls('participant_point_master', $where);

        $dailyShareLimit = $this->commondatamodel->getSingleRowByWhereCls('share_limit', [])->app_share_limit_per_day;
        $daily_play_limit = $this->commondatamodel->getSingleRowByWhereCls('share_limit', [])->daily_play_limit;

        $fb_link = $this->get_point_by_status('FB')->url;
        $in_link = $this->get_point_by_status('IN')->url;
        $xh_link = $this->get_point_by_status('XH')->url;

        $point_details = $this->quizmodel->getAllPointDetails();

        $tot20Check=$this->checkTop20($mobile_no);
        if($tot20Check['is_top20']=="Y"){
            $participantData->prize_tag = "TOP20";
        }
      

        $result = array(
            "participantData" => $participantData,
            "dailyShareLimit" => $dailyShareLimit,
            "todayAppShareCount" => $result = $this->quizmodel->getTodayShareCount($mobile_no),
            "dailyPlayLimit" => (int) $daily_play_limit,
            "todayPlay" => $todayPlay,
            "app_link" => "https://play.google.com/store/apps?hl=en_IN&gl=US",
            "fb_link" => $fb_link,
            "in_link" => $in_link,
            "xh_link" => $xh_link,
            "point_details"=> $point_details,
        );
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;

    }

    public function question()
    {

        $mobile_no = $_POST['mobile_no'];
        $participant_code = $_POST['participant_code'];

        $result['question_master_id'] = 1;
        $where = array('question_master_id' => $result['question_master_id']);
        $result['questionListAll'] = $this->commondatamodel->getAllRecordWhere('question_details', $where);

        $total_question = count($result['questionListAll']);
        $numbers = range(0, ($total_question - 1));
        shuffle($numbers);

        $questionRowIndex = array_slice($numbers, 0, 10); /* For 10 Questions */

        foreach ($questionRowIndex as $key => $value) {
            $result['questionList'][] = $result['questionListAll'][$value];
        }

        $quiz_master = [
            "participant_code" => $participant_code,
            "entry_from" => 'APP',
            "start_date" => date('Y-m-d H:i:s')
        ];

        $result['quiz_master_id'] = $this->commondatamodel->insertSingleTableDataRerurnInsertId('quiz_master', $quiz_master);

        $json_response = array(
            "msg_status" => 1,
            "questionset_master_id" => $result['question_master_id'],
            "quiz_master_id" => $result['quiz_master_id'],
            "questionList" => $result['questionList'],
        );


        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;

    }


    public function check_mobile()
    {

        $mobile_no = $_POST['mobile_no'];
        // pre($_POST);

        // exit;


        $result = $this->quizmodel->checkUserMobile($mobile_no);

        if ($result) {
            $json_response = array(
                "msg_status" => 1,
                "participantData" => $result,
                "welcome_point" => 0,
                "applogin_point" => 0,
            );
        } else {
            $json_response = array(
                "msg_status" => 0,
                "participantData" => ["data" => ""],
            );
        }


        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;

    }

    /* save qiuz answer */
    public function quiz_action()
    {

        /*  $result['questionset_master_id']=$_POST['questionset_master_id'];  
          $result['quiz_master_id']=$_POST['quiz_master_id'];  
          $result['question_dtl_id']=$_POST['question_dtl_id'];  
          $result['selectedoption']=$_POST['selectedoption'];  
          $result['question_number']=$_POST['question_number'];  
          
          header('Content-Type: application/json');
          echo json_encode( $result );
          exit;*/

        $questionset_master_id = $_POST['questionset_master_id'];
        $quiz_master_id = $_POST['quiz_master_id'];
        $question_dtl_id = $_POST['question_dtl_id'];
        ;
        $selectedoption = $_POST['selectedoption'];
        $question_number = $_POST['question_number'];

        /* delete answer if already exist */
        $delete_where = array("quiz_master_id" => $quiz_master_id, "question_dtl_id" => $question_dtl_id);
        $this->commondatamodel->deleteTableData('quiz_details', $delete_where);


        $answer_status = $this->checkQuizAnswer($question_dtl_id, $selectedoption);
        $quiz_details = [
            "quiz_master_id" => $quiz_master_id,
            "question_dtl_id" => $question_dtl_id,
            "user_answer" => $selectedoption,
            "answer_status" => $answer_status,
        ];
        // pre($quiz_details);exit;


        $this->commondatamodel->insertSingleTableData('quiz_details', $quiz_details);

        $total_score = $this->calculateTotalScore($quiz_master_id, $questionset_master_id, $question_number);




        //   sleep(5);
        $json_response = array(
            "msg_status" => 1,
            "answer_status" => $answer_status,
            "total_score" => $total_score,
            "correct_answer" => $this->getCorrectAnswer($question_dtl_id),
        );


        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;
    }


    public function checkQuizAnswer($question_dtl_id, $user_answer)
    {

        $where = array('question_dtl_id' => $question_dtl_id);
        $result = $this->commondatamodel->getSingleRowByWhereCls('question_details', $where)->answer;
        if ($result == $user_answer) {
            return 1;
        } else {
            return 0;
        }

    }

    public function getCorrectAnswer($question_dtl_id)
    {

        $where = array('question_dtl_id' => $question_dtl_id);
        return $result = $this->commondatamodel->getSingleRowByWhereCls('question_details', $where)->answer;

    }

    public function calculateTotalScore($quiz_master_id, $questionset_master_id, $question_number)
    {
        $where = array('question_id' => $questionset_master_id);
        $marks_per_question = $this->commondatamodel->getSingleRowByWhereCls('question_master', $where)->marks_per_question;
        $total_answer = $this->quizmodel->getTotalAnswer($quiz_master_id);
        $total_marks = ($marks_per_question * $total_answer);

        $upd_array = array('quiz_marks' => $total_marks);

        /* Final submit */

        if ($question_number == 10) {
            $upd_array = array('quiz_marks' => $total_marks, 'quiz_status' => "C", "end_date" => date('Y-m-d H:i:s'));
        }
        $upd_where = array('quiz_master_id' => $quiz_master_id);
        $update = $this->commondatamodel->updateSingleTableData('quiz_master', $upd_array, $upd_where);
        return $total_marks;
    }

    /* single quiz score */
    public function quiz_score()
    {

        $quiz_master_id = $_POST['quiz_master_id'];
        /* Update Quiz master data */
        $questionset_master_id = 1;
        $question_number = 10;/* Last question complete */
        $this->calculateTotalScore($quiz_master_id, $questionset_master_id, $question_number);
        /*---------- End of Update--------- */

        $orderby = 'prize_id';
        $result['prizeList'] = $this->commondatamodel->getAllRecordWhereOrderBy('prize_master', [], $orderby);

        $where = array('quiz_master_id' => $quiz_master_id);
        $result['quiz_masterData'] = $this->commondatamodel->getSingleRowByWhereCls('quiz_master', $where);

        $resultQuiz = $this->quizmodel->getMobileNumberByQuizId($quiz_master_id);
        $mobile_number = $resultQuiz->mobile;
        /* call once if update needed total score */


        $result['totalScore'] = $this->quizmodel->getTotalScoreByMobile($mobile_number);
        $result['prize'] = $this->quizmodel->getPrizeDataByScore($result['totalScore']);

        $where = array('mobile_no' => $mobile_number);
        $participantData = $this->commondatamodel->getSingleRowByWhereCls('participant_point_master', $where);


        $json_response = array(
            "msg_status" => 1,
            "current_quiz_marks" => $result['quiz_masterData']->quiz_marks,
            "total_marks" => $result['totalScore'],
            "participantData" => $participantData,
            "prize" => $result['prize'],
        );


        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;






    }



    public function registration()
    {

        $mobile = $_POST['mobile_no'];
        $full_name = $_POST['full_name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $pin_code = $_POST['pin_code'] ?? "";
        $participant_code = $this->getParticipantCode();


        $insert_array = array(
            "participant_code" => $participant_code,
            "full_name" => $full_name,
            "age" => $age,
            "gender" => $gender,
            "mobile" => $mobile,
            "email" => $email,
            "address" => $address,
            "pin_code" => $pin_code,
        );

        $insert_id = $this->commondatamodel->insertSingleTableData('participant_master', $insert_array);
        $where = array('participant_id' => $insert_id);
        $result = $this->commondatamodel->getSingleRowByWhereCls('participant_master', $where);


        /* insert into participant_point_master */
        $this->insert_participant_point_master($mobile);

        /* insert welcome app login point */
        $pointData = $this->get_point_by_status('WP');
        $this->insert_bonus_point_quiz_master($participant_code, $pointData->point, $pointData->status_code);
        /* insert daily app login point */
        $applogin_point = $this->updateLastLoginPoint($mobile, $participant_code, "");


        $this->quizmodel->getTotalScoreByMobile($mobile);

        if ($result) {
            $json_response = array(
                "msg_status" => 1,
                "participantData" => $result,
                "welcome_point" => (int) $pointData->point,
                "applogin_point" => (int) $applogin_point,
            );
        } else {
            $json_response = array(
                "msg_status" => 0,
                "participantData" => ["data" => ""],
            );
        }


        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;

    }


    function getParticipantCode()
    {
        $lastnumber = (int) (0);
        $serialno = "";
        $sql = "SELECT *
           FROM serialmaster
           WHERE serialmaster.module='PARTICIPANT'
           LOCK IN SHARE MODE";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $lastnumber = $row->next_serial_no;
            $serial_id = $row->id;

        } else {
            echo $sql;
            exit;
        }
        // echo $digit = (int)(log($lastnumber,10)) ; 

        $digit = strlen($lastnumber);
        if ($digit == 4) {
            $serialno = "0" . $lastnumber;
        } else
            if ($digit == 3) {
                $serialno = "00" . $lastnumber;
            } else if ($digit == 2) {
                $serialno = "000" . $lastnumber;
            } elseif ($digit == 1) {
                $serialno = "0000" . $lastnumber;
            } else {
                $serialno = $lastnumber;
            }

        $user_code = "P" . $serialno;
        $lastnumber = $lastnumber + 1;

        //update
        $upddata = [
            'serialmaster.next_serial_no' => $lastnumber,
        ];
        $where = [
            'serialmaster.id' => $serial_id
        ];
        $this->db->where($where);
        $this->db->update('serialmaster', $upddata);
        return $user_code;
    }


    public function pin_codes()
    {

        $result = $this->quizmodel->getPincodeList();
        // $pin_codes=[];
        // foreach ($result as $key => $value) {
        //     $pin_codes[]=$value->pin_code;
        // }  
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;

    }


    public function check_quiz()
    {
        $quiz_id = $this->uri->segment(3);

        $where = array('quiz_master_id' => $quiz_id);
        $result = $this->commondatamodel->getSingleRowByWhereCls('quiz_master', $where);

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;

    }

    public function add_new_point()
    {

        $participant_code = $_POST['participant_code'];
        $mobile_no = $_POST['mobile_no'];
        $point_type = $_POST['point_type'];

        $point_added = "0";
        $point_image = "";

        /**insert log */

        $insert_post_array = [
            "method_name" => "add_new_point",
            "post_data" => json_encode($_POST),
            "entry_date" => date('Y-m-d H:i:s')
        ];

        $this->commondatamodel->insertSingleTableData('post_details', $insert_post_array);

         /* check welcome Point add addd  */
        if($point_type == "WP"){
            $chekdata = $this->quizmodel->checkWelcomePoint($participant_code,$point_type);
            if (!$chekdata) {
                $welcome_point = $pointData = $this->get_point_by_status($point_type)->point;
                $this->insert_bonus_point_quiz_master($participant_code, $welcome_point, $point_type);  
                $point_added=$welcome_point;
            }
        }

        /* check daily Login Point add addd  */

        if ($point_type == "DL") {
            $chekdata = $this->quizmodel->checkDailyPoint($participant_code, $point_type);
            if (!$chekdata) {
                //echo "not exist";
                $loginPointLimit = $this->commondatamodel->getSingleRowByWhereCls('share_limit', []);
                $daily_login_point_increase = $loginPointLimit->daily_login_point_increase;
                $max_daily_point = $loginPointLimit->max_daily_point;
                $lastloginData = $this->quizmodel->lastLoginPointByMobile($mobile_no);

                $last_login_date = $lastloginData->last_login_date;
                $last_login_point = $lastloginData->last_login_point;
                $yester_day_date = date('Y-m-d', strtotime("-1 days"));

                if ($yester_day_date != $last_login_date) {
                    $new_login_point = $pointData = $this->get_point_by_status($point_type)->point;
                } else {

                    if ($last_login_point < $max_daily_point) {
                        $new_login_point = $last_login_point + $daily_login_point_increase;
                    } else {
                        $new_login_point = $max_daily_point;
                    }


                }

                //  echo "new_login_point :".$new_login_point;
                $this->insert_bonus_point_quiz_master($participant_code, $new_login_point, $point_type);
                $this->updateLastLoginPoint($mobile_no, $participant_code, $new_login_point);
                $point_added = $new_login_point;
                $point_image = "point_" . $new_login_point . ".png";


            } else {
                //  echo "alrady exist";
            }
        }

        /* check app refer of share click  */
        if ($point_type == "RF") {
            $share_point = $pointData = $this->get_point_by_status($point_type)->point;
            $this->insert_bonus_point_quiz_master($participant_code, $share_point, $point_type);
            $this->insert_app_refer_count_daily($mobile_no);
            $point_added = $share_point;
        }

        /* share certificate point  */
        if ($point_type == "SC") {
            $certificate_share_point = $pointData = $this->get_point_by_status($point_type)->point;
            $this->insert_bonus_point_quiz_master($participant_code, $certificate_share_point, $point_type);
            /* update certificate share status */
            $this->shareCertificateStatus($mobile_no);
            $point_added = $certificate_share_point;
        }

        if ($point_type == "FB") {
            $fb_share_point = $pointData = $this->get_point_by_status($point_type)->point;
            $this->insert_bonus_point_quiz_master($participant_code, $fb_share_point, $point_type);
            $this->socialMediaStatus($mobile_no, $point_type);
            $point_added = $fb_share_point;
        }

        if ($point_type == "IN") {
            $in_share_point = $pointData = $this->get_point_by_status($point_type)->point;
            $this->insert_bonus_point_quiz_master($participant_code, $in_share_point, $point_type);
            $this->socialMediaStatus($mobile_no, $point_type);
            $point_added = $in_share_point;
        }

        if ($point_type == "XH") {
            $xh_share_point = $pointData = $this->get_point_by_status($point_type)->point;
            $this->insert_bonus_point_quiz_master($participant_code, $xh_share_point, $point_type);
            $this->socialMediaStatus($mobile_no, $point_type);
            $point_added = $xh_share_point;
        }



        $result['totalScore'] = $this->quizmodel->getTotalScoreByMobile($mobile_no);

        $where_participant = array('mobile_no' => $mobile_no);
        $participantData = [];
        $participantData = $this->commondatamodel->getSingleRowByWhereCls('participant_point_master', $where_participant);



        if ($result) {
            $json_response = array(
                "msg_status" => 1,
                "participantData" => $participantData,
                "point_added" => $point_added,
                "point_image" => $point_image,
            );
        } else {
            $json_response = array(
                "msg_status" => 0,
                "participantData" => ["data" => ""],
            );
        }


        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;

    }


    public function test()
    {
        $mobile_no = 9475230656;
        $participant_code = "P00038";

        echo $this->quizmodel->getParticipantPrizeTag($mobile_no);
        exit;

        // $image_name='bodh_chakra.jpg';
        // $image_name='gyan_chakra.jpeg';
        // $image_name='medha_chakra.jpeg';
        // $image_name='kirti_chakra.jpeg';
        $image_name = 'pragya_chakra.jpeg';
        $image_name = $this->quizmodel->generateCertificate($mobile_no, $image_name);
        pre($image_name);

        exit;

        $todayPlay = $this->quizmodel->getTodayQuizCount($mobile_no);
        // $this->insert_participant_point_master($mobile);
        $result['prize'] = $this->quizmodel->getPrizeDataByScore(500);
        pre($result);
        exit;

    }



    public function insert_participant_point_master($mobile)
    {

        $where = array('mobile_no' => $mobile);
        $checkExist = $this->commondatamodel->checkExistanceData('participant_point_master', $where);
        if (!$checkExist) {
            //  echo "not exist";
            $insert_array = [
                "mobile_no" => $mobile,
                "last_login_date" => date('Y-m-d H:i:s')
            ];
            $insertid = $this->commondatamodel->insertSingleTableData('participant_point_master', $insert_array);
            // need to add login point
            //need to add welcome point


        }


    }


    public function get_point_by_status($status_code)
    {
        $where = array('point_master.status_code' => $status_code);
        return $result = $this->commondatamodel->getSingleRowByWhereCls('point_master', $where);
    }



    public function insert_bonus_point_quiz_master($participant_code, $quiz_marks, $quiz_status)
    {

        $insert_array = [
            "participant_code" => $participant_code,
            "quiz_marks" => $quiz_marks,
            "quiz_status" => $quiz_status,
            "entry_date" => date('Y-m-d')
        ];

        $this->commondatamodel->insertSingleTableData('quiz_master', $insert_array);

    }


    public function insert_app_refer_count_daily($mobile_no)
    {

        $insert_array = [
            "mobile_no" => $mobile_no,
            "share_date" => date('Y-m-d'),
            "entry_date" => date('Y-m-d H:i:s'),
        ];

        $this->commondatamodel->insertSingleTableData('share_app_details', $insert_array);

    }





    public function upload_image()
    {
        ini_set('max_execution_time', '300');
        ini_set('memory_limit', '128M');
        // Set CORS headers
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header("Access-Control-Allow-Headers: *");

        $json_response = array(
            "msg_status" => 1,
            "msg" => "",
        );

        $image_key = $_POST['image_key'];
        $mobile_no = $_POST['mobile_no'];
        $img = $_POST[$image_key];
        $path = $_SERVER['DOCUMENT_ROOT'] . '/votepal/assets/images/participant_images/'; //local

        $filename = $mobile_no . "_" . $image_key . ".jpeg";
        $result = file_put_contents($path . $filename, base64_decode($img));


        if ($result !== false) {
            //  echo "Data was successfully written to the file. $result bytes were written.";
            $upd_where = array('mobile_no' => $mobile_no);
            $approvel_col = 'is_' . $image_key . '_approved';
            $upd_array = array($image_key => $filename, $approvel_col => "P");
            $update = $this->commondatamodel->updateSingleTableData('participant_point_master', $upd_array, $upd_where);
            $json_response = array(
                "msg_status" => 1,
                "msg" => "Pending for approval point",
            );
        } else {
            $json_response = array(
                "msg_status" => 0,
                //  "msg"=>$error,
            );
        }
        //   $data_Array['profile_img']=$filename;

        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;


        /* Not in use because of base 64 */
        //$filename='votepalimg_1';
        //$filename='votepalimg_2';
        $filename = $_POST['image_key'];
        $mobile_no = $_POST['mobile_no'];
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/votepal/assets/images/participant_images'; //local
        //	$dir1 = APPPATH.'assets/img/room'; 
        // pre($_FILES);

        $config = array(
            'upload_path' => $dir,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_size' => '5120', // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_filename' => '255',
            'encrypt_name' => TRUE,
        );

        $this->load->library('upload', $config);
        //$images = array();
        $detail_array = array();

        $_FILES['images']['name'] = $_FILES[$filename]['name'];
        $_FILES['images']['type'] = $_FILES[$filename]['type'];
        $_FILES['images']['tmp_name'] = $_FILES[$filename]['tmp_name'];
        $_FILES['images']['error'] = $_FILES[$filename]['error'];
        $_FILES['images']['size'] = $_FILES[$filename]['size'];
        $this->upload->initialize($config);

        if ($this->upload->do_upload('images')) {

            $file_detail = $this->upload->data();
            $file_name = $file_detail['file_name'];
            // echo $file_name;

            $upd_where = array('mobile_no' => $mobile_no);
            $approvel_col = 'is_' . $filename . '_approved';
            $upd_array = array($filename => $file_name, $approvel_col => "P");
            $update = $this->commondatamodel->updateSingleTableData('participant_point_master', $upd_array, $upd_where);
            $json_response = array(
                "msg_status" => 1,
                "msg" => "Pending for approval point",
            );

        } else {
            $error = array('error' => $this->upload->display_errors());
            //  pre($error);
            // echo "not uploaded";
            $json_response = array(
                "msg_status" => 0,
                "msg" => $error,
            );
        }

        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;

    }


    public function leader_board()
    {


        $mobile_no = $_POST['mobile_no'];
        $scoreResult = $this->quizmodel->getScoreWiseDataList();
        $userScore = $this->quizmodel->getTotalScoreByMobile($mobile_no);
        $top_three = array_slice($scoreResult, 0, 3);

        $rank = 1;
        foreach ($top_three as $key => $value) {
            $rankArray[] = array("rank" => $key + 1, "total_point" => $value->total_point, "participantData" => $this->quizmodel->getParticipantByScore($value->total_point));
        }


        // $index_mobile = array_search('7003319369', array_column($scoreResult, 'mobile_no'));
        $index_mobile = array_search($userScore, array_column($scoreResult, 'total_point'));


        if (!in_array($index_mobile, [0, 1, 2])) {

            /* store previous rank */
            // echo "test Index".$index_val=4;$i=0;
            // for ($index_test=$index_mobile-1; $index_test > 3 ; $index_test--) { 
            //   echo "<br>--> ".$index_test;
            //   $i++;
            //   if($i==2) break;
            // }


            $first_previous_index = $index_mobile - 1;
            $second_previous_index = $index_mobile - 2;



            if ($second_previous_index > 2) {
                $rankArray[$second_previous_index]['rank'] = $second_previous_index + 1;
                $rankArray[$second_previous_index]['total_point'] = $scoreResult[$second_previous_index]->total_point;
                $rankArray[$second_previous_index]['participantData'] = $this->quizmodel->getParticipantByScore($scoreResult[$second_previous_index]->total_point);
            }

            if ($first_previous_index > 2) {
                $rankArray[$first_previous_index]['rank'] = $first_previous_index + 1;
                $rankArray[$first_previous_index]['total_point'] = $scoreResult[$first_previous_index]->total_point;
                $rankArray[$first_previous_index]['participantData'] = $this->quizmodel->getParticipantByScore($scoreResult[$first_previous_index]->total_point);
            }

            $rankArray[$index_mobile]['rank'] = $index_mobile + 1;
            $rankArray[$index_mobile]['total_point'] = $scoreResult[$index_mobile]->total_point;
            $rankArray[$index_mobile]['participantData'] = $this->quizmodel->getParticipantByScore($scoreResult[$index_mobile]->total_point);

        }

        // pre($rankArray);exit;

        foreach ($rankArray as $key => $rankHead) {
            // pre($rankHead['rank']);
            // pre($rankHead['participantData']);

            $participant_data = $rankHead['participantData'];
            foreach ($participant_data as $key => $parti_data) {
                $rank_final[] = array(
                    "rank" => $rankHead['rank'],
                    "total_point" => $parti_data->total_point,
                    "full_name" => $parti_data->full_name,
                    "mobile_no" => $parti_data->mobile_no,
                );
            }


        }
        //   pre($rank_final);
        //   exit;

        //   pre($rankArray);exit;
        header('Content-Type: application/json');
        echo json_encode($rank_final);
        exit;

    }

    public function updateLastLoginPoint($mobile_no, $participant_code, $last_login_point)
    {

        /* for first time only */
        if ($last_login_point == "") {
            $last_login_point = $pointData = $this->get_point_by_status('DL')->point;

            $this->insert_bonus_point_quiz_master($participant_code, $last_login_point, "DL");

        }

        $upd_array = array('last_login_point' => $last_login_point, 'app_login' => "Y", "last_login_date" => date('Y-m-d H:i:s'));
        $upd_where = array('mobile_no' => $mobile_no);
        $update = $this->commondatamodel->updateSingleTableData('participant_point_master', $upd_array, $upd_where);
        return $last_login_point;
    }


    public function shareCertificateStatus($mobile_no)
    {
        $upd_array = array('is_certificate_share' => "Y", "last_certificate_share" => date('Y-m-d H:i:s'));
        $upd_where = array('mobile_no' => $mobile_no);
        $update = $this->commondatamodel->updateSingleTableData('participant_point_master', $upd_array, $upd_where);
    }


    public function socialMediaStatus($mobile_no, $type)
    {

        $column_name = $type . "_point_added";
        $upd_array = array($column_name => "Y");
        $upd_where = array('mobile_no' => $mobile_no);
        $update = $this->commondatamodel->updateSingleTableData('participant_point_master', $upd_array, $upd_where);
    }







    public function leader_board_test()
    {


        // $mobile_no = $_POST['mobile_no'];
        $mobile_no = 8101296193;
        $scoreResult = $this->quizmodel->getScoreWiseDataList();
        $top_three = array_slice($scoreResult, 0, 3);
        // pre($scoreResult);
        $userScore = $this->quizmodel->getTotalScoreByMobile($mobile_no);
        $rank = 1;
        foreach ($top_three as $key => $value) {
            $rankArray[] = array("rank" => $key + 1, "total_point" => $value->total_point, "participantData" => $this->quizmodel->getParticipantByScore($value->total_point));
        }


        //  $index_mobile = array_search('7003319369', array_column($scoreResult, 'mobile_no'));exit;
        $index_mobile = array_search($userScore, array_column($scoreResult, 'total_point'));


        if (!in_array($index_mobile, [0, 1, 2])) {

            /* store previous rank */


            $first_previous_index = $index_mobile - 1;
            $second_previous_index = $index_mobile - 2;



            if ($second_previous_index > 2) {
                $rankArray[$second_previous_index]['rank'] = $second_previous_index;
                $rankArray[$second_previous_index]['total_point'] = $scoreResult[$second_previous_index]->total_point;
                $rankArray[$second_previous_index]['participantData'] = $this->quizmodel->getParticipantByScore($scoreResult[$second_previous_index]->total_point);
            }

            if ($first_previous_index > 2) {
                $rankArray[$first_previous_index]['rank'] = $first_previous_index;
                $rankArray[$first_previous_index]['total_point'] = $scoreResult[$first_previous_index]->total_point;
                $rankArray[$first_previous_index]['participantData'] = $this->quizmodel->getParticipantByScore($scoreResult[$first_previous_index]->total_point);
            }

            $rankArray[$index_mobile]['rank'] = $index_mobile;
            $rankArray[$index_mobile]['total_point'] = $scoreResult[$index_mobile]->total_point;
            $rankArray[$index_mobile]['participantData'] = $this->quizmodel->getParticipantByScore($scoreResult[$index_mobile]->total_point);

        }

        pre($rankArray);
        exit;

        foreach ($rankArray as $key => $rankHead) {
            // pre($rankHead['rank']);
            // pre($rankHead['participantData']);

            $participant_data = $rankHead['participantData'];
            foreach ($participant_data as $key => $parti_data) {
                $rank_final[] = array(
                    "rank" => $rankHead['rank'],
                    "total_point" => $parti_data->total_point,
                    "full_name" => $parti_data->full_name,
                    "mobile_no" => $parti_data->mobile_no,
                );
            }


        }
        //   pre($rank_final);
        //   exit;

        //   pre($rankArray);exit;
        header('Content-Type: application/json');
        echo json_encode($rank_final);
        exit;

    }



    public function upload()
    {
        ini_set('memory_limit', '128M');
        ini_set('max_execution_time', '300');
        // Set CORS headers
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header("Access-Control-Allow-Headers: *");


        // header('Content-Type: application/json');
        // echo json_encode($_FILES);
        // exit;

        


        /* Not in use because of base 64 */
        //$filename='votepalimg_1';
        //$filename='votepalimg_2';
        $filename = 'image';
     //   pre($_FILES[$filename]['name']);
      //  $mobile_no = $_POST['mobile_no'];
        $imageNameArray=explode("@#",$_FILES[$filename]['name']);
        $image_key = $imageNameArray[0];/* for identify column name */
        $mobile_no = $imageNameArray[1];/* for identify column name */

        $dir = $_SERVER['DOCUMENT_ROOT'] . '/votepal/assets/images/participant_images'; //local
        //	$dir1 = APPPATH.'assets/img/room'; 
        // pre($_FILES);
        $newfilename = $mobile_no . "_" . $image_key . ".jpeg";

        $config = array(
            'upload_path' => $dir,
            'allowed_types' => 'jpg|png|jpeg|gif',
            'max_size' => '20480', // 20MB in kilobytes
            'file_name' => $newfilename, // Specify the filename
            'max_filename' => '255',
            'overwrite' => TRUE // This will replace the existing file if it exists
        );

        $this->load->library('upload', $config);
        //$images = array();
        $detail_array = array();

        $_FILES['images']['name'] = $_FILES[$filename]['name'];
        $_FILES['images']['type'] = $_FILES[$filename]['type'];
        $_FILES['images']['tmp_name'] = $_FILES[$filename]['tmp_name'];
        $_FILES['images']['error'] = $_FILES[$filename]['error'];
        $_FILES['images']['size'] = $_FILES[$filename]['size'];
        $this->upload->initialize($config);

        if ($this->upload->do_upload('images')) {

            $file_detail = $this->upload->data();
            $file_name = $file_detail['file_name'];
            // echo $file_name;

                $upd_where = array('mobile_no'=>$mobile_no);
                $approvel_col='is_'.$image_key.'_approved';
                $upd_array = array($image_key=>$file_name,$approvel_col=>"P");
                $update = $this->commondatamodel->updateSingleTableData('participant_point_master',$upd_array,$upd_where);
            $json_response = array(
                "msg_status" => 1,
                "msg" => "Pending for approval point",
                "file_name" => $file_name,
            );

        } else {
            $error = array('error' => $this->upload->display_errors());
            //  pre($error);
            // echo "not uploaded";
            $json_response = array(
                "msg_status" => 0,
                "msg" => $error,
            );
        }

        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;

    }


   public function checkTop20($mobile_no) {

   
    $is_top20="N";

    $maxPrizePoint = $this->quizmodel->getMaxPrizePoint();/* Pragya Chakra:1500 */
    $scoreResult = $this->quizmodel->getScoreWiseDataList();
   
    $userScore = $this->quizmodel->getTotalScoreByMobile($mobile_no);
    if($userScore>=$maxPrizePoint){ $is_top20="Y";}
  

    $rank = 1;
    foreach ($scoreResult as $key => $value) {
        $rankArray[] = array("rank" => $key + 1, "total_point" => $value->total_point, "participantData" => $this->quizmodel->getParticipantByScore($value->total_point));
    }

    $index_mobile = array_search($userScore, array_column($scoreResult, 'total_point'));
    $userRank=$index_mobile+1;


     return $arrayRank = array("rank"=>$userRank,"is_top20"=>$is_top20);
   


    }

    /**
     * for new achievement popup
     */
    public function disable_popup()
    {
        $mobile_no = $_POST['mobile_no'];

        $insert_post_array = [
            "method_name" => "disable_popup",
            "post_data" => json_encode($_POST),
            "entry_date" => date('Y-m-d H:i:s')
        ];

        $this->commondatamodel->insertSingleTableData('post_details', $insert_post_array);

        $upd_array = array('is_popup_enable' => "N");
        $upd_where = array('mobile_no' => $mobile_no);
        $update = $this->commondatamodel->updateSingleTableData('participant_point_master', $upd_array, $upd_where);

        if ($update) {
            $json_response = array(
                "msg_status" => 1,
                "msg" => "Update successfully",
            );
        } else {
            $json_response = array(
                "msg_status" => 0,
                "msg" => "Something wrong",
            );
        }
        

        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;

    }



}/* end of class */