<?php
 namespace App\Mail;

 use App\Mail\Contract\Mail;
 include "App/Mail/Contract/Mail.php";

 
use PHPMailer\PHPMailer\Exception;


include "/opt/lampp/htdocs/ecommerce/vendor/phpmailer/phpmailer/src/Exception.php";


 class VerificationCode extends Mail {


    public function send(){
        try {

        $this->mail->setFrom($this->mailFrom,$this->mailFromName);
        $this->mail->addAddress($this->mailTo);     //Add a recipient
        
    
        
        //Content
        $this->mail->isHTML(true);                                  //Set email format to HTML
        $this->mail->Subject = $this->mailSubject;
        $this->mail->Body    = $this->mailBody;
    
        $this->mail->send();
            return true;
    } catch (Exception $e) {
              return false;
    }

    }




 }