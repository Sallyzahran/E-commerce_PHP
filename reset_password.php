

<?php

session_start();
use  App\Http\Requests\Validation;
use App\Database\Models\User;



 include_once "./App/Http/Requests/Validation.php";

$title = "Reset Password";

include "layouts/header.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$validation = new Validation; 

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST){


    $validation->setValueName('password')->setValue($_POST['password'])->required()->unique('users','password')
    ->regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/','Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character');
    $validation->setValueName('confirm password')->setValue($_POST['confirm_password'])->required()->match($_POST['password'])->regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/');

    

if (empty($validation->getErrors())){



    include_once "./App/Database/Models/User.php";


$user = new User;

$user->setEmail($_SESSION['email'])->setPassword($_POST['password']);

      if( $user->UpdatePassword() ){

        $success =  "<div class='alert alert-success text-center'> You Will Redirect To Login Page</div>";
        header('refresh:5;url=login.php');


     } else {
    $error =  "<div class='alert alert-danger text-center'>Somthing Went Wrong</div>";

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
                                    <h4> Add New Password </h4>
                                </a>
                              
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form method="post">
                                            
                                            <?= $success ?? "" ?>
                                            <?= $error ?? "" ?>
                                            <input type="password" name="password" placeholder="Password">
                                                <?=  $validation->getMessage('password')  ?>

                                                <input type="password" name="confirm_password" placeholder="Confirm Password">
                                                <?=  $validation->getMessage('confirm password')   ?>

                                                <div class="button-box">
                                                   
                                                    <button type="submit"><span>Done</span></button>
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
        
     