<?php

session_start();
use  App\Http\Requests\Validation;
use App\Database\Models\User;



 include_once "./App/Http/Requests/Validation.php";

$title = "Forget Password";

include "layouts/header.php";


error_reporting(E_ALL);
ini_set('display_errors', 1);

$validation = new Validation; 

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST){


$validation->setValueName('email')->setValue($_POST['email'])->required()->regex('/[a-z0-9]+@[a-z]+\.[a-z]{2,3}/');


    

if (empty($validation->getErrors())){



    include_once "./App/Database/Models/User.php";


$user = new User;

$user->setEmail($_POST['email']);
$result =  $user->checkEmailExist();

   if( $result->num_rows ==1){

    $verification_code = rand(10000,99999);
    $user->setVerification_code($verification_code);
     if($user->UpdateVerificationCode()){

        $_SESSION['email'] = $_POST['email'];

        header("Location:verification_code.php?page=forget");
     } else {
    $error =  "<div class='alert alert-danger text-center'>Somthing Went Wrong</div>";

     }


    
    
        
} else {

    $error =  "<div class='alert alert-danger text-center'>Email Not Match Our Records</div>";

      


}
}

}


?>
    
        <div class="login-register-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="tab" href="#lg1">
                                    <h4> Find Your Account </h4>
                                </a>
                              
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form method="post">
                                            
                                            <?= $success ?? "" ?>
                                            <?= $error ?? "" ?>

                                                <input type="email" name="email" placeholder="Email Address">
                                                <?=  $validation->getMessage('email')  ?>



                                                <div class="button-box">
                                                   
                                                    <button type="submit"><span>Find</span></button>
                                                </div>                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
     

        <?php
     include "layouts/scripts.php";






?>
        
     