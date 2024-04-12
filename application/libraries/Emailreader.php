<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . "/third_party/lib/class.imap.php";

class Emailreader {
    
    public function mail() { 
        
        $email = new Imap();
        $connect = $email->connect(
            '{webmail.mudrakshiproject.com:143/notls}INBOX', //host
            'ho@mudrakshiproject.com', //username
            'Pb?dx~Lt!SnX' //password
        );
        return $connect;
      
		// if($connect){
        //     if(isset($_POST['inbox'])){
        //         // inbox array
        //         $inbox = $email->getMessages('html');
        //         echo json_encode($inbox, JSON_PRETTY_PRINT);
        //     }else if(!empty($_POST['uid']) && !empty($_POST['part']) && !empty($_POST['file']) && !empty($_POST['encoding'])){
        //         // attachments
        //         $inbox = $email->getFiles($_POST);
        //         pre($connect);exit;
        //         return $inbox;
        //         // echo json_encode($inbox, JSON_PRETTY_PRINT);
        //     }else {
        //         return 0;
        //         // echo json_encode(array("status" => "error", "message" => "Not connect."), JSON_PRETTY_PRINT);
        //     }
        // }else{
        //     return 0;
        //     // echo json_encode(array("status" => "error", "message" => "Not connect."), JSON_PRETTY_PRINT);
        // }
	 } 
}
?>