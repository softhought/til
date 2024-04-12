<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter PHPMailer Class
 *
 * This class enables SMTP email with PHPMailer
 *
 * @category    Libraries
 * @author      CodexWorld
 * @link        https://www.codexworld.com
 */

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
class PHPMailer_Lib2
{
    public function __construct(){
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load(){
        // // Include PHPMailer library files
        // require_once APPPATH.'third_party/PHPMailer/Exception.php';
        // require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
        // require_once APPPATH.'third_party/PHPMailer/SMTP.php';

         require_once APPPATH.'third_party/PHPMailer/class.phpmailer.php';
         require_once APPPATH.'third_party/PHPMailer/language/phpmailer.lang-en.php';
        
        $mail = new PHPMailer;
        return $mail;
    }
}