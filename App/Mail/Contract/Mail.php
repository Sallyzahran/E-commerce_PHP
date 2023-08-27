<?php

namespace App\Mail\Contract;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


include "/opt/lampp/htdocs/ecommerce/vendor/phpmailer/phpmailer/src/PHPMailer.php";
include "/opt/lampp/htdocs/ecommerce/vendor/phpmailer/phpmailer/src/SMTP.php";

abstract class Mail{

protected string $mailHost = 'smtp-mail.outlook.com';
protected string $mailFrom = 'sallyzahran23@outlook.com';
protected string $mailFromPassword = '1234567890Sa';
protected int $mailPort = 587;
protected PHPMailer $mail;



protected string $mailTo,$mailSubject,$mailBody,$mailFromName;

public function __construct($mailTo,$mailSubject,$mailBody,$mailFromName='Ecommerce')
{
    
$this->mailTo = $mailTo;
$this->mailSubject = $mailSubject;
$this->mailBody = $mailBody;
$this->mailFromName = $mailFromName;

$this->mail= new PHPMailer(true);

    $this->mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $this->mail->isSMTP();                                            //Send using SMTP
    $this->mail->Host       = $this->mailHost;                     //Set the SMTP server to send through
    $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $this->mail->Username   = $this->mailFrom;                     //SMTP username
    $this->mail->Password   = $this->mailFromPassword;                               //SMTP password
    $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $this->mail->Port       = $this->mailPort;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`



}



protected abstract function send();




}