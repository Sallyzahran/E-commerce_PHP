<?php
session_start();
use  App\Http\Requests\Validation;
use App\Database\Models\User;



 include_once "./App/Http/Requests/Validation.php";

$title = "verification";

include "layouts/header.php";
include "./App/Http/Middlewares/EmailChecker.php";


error_reporting(E_ALL);
ini_set('display_errors', 1);

$validation = new Validation; 

$validation->setValueName('page')->setValue($_GET['page'] ?? null)->required()->in(['login','register','forget']);
if ($validation->getErrors()){

    header('Location:layouts/errors/notfound.php');die;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST){


$validation->setValueName('verification code')->setValue($_POST['verification_code'])->required()->regex( $_GET['page'] == 'forget' ?  '/^[0-9]{5}$/' : '/^[0-9]{6}$/')->exist('users','Verification_code');


    

if (empty($validation->getErrors())){



    include_once "./App/Database/Models/User.php";


$user = new User;

$user->setVerification_code($_POST['verification_code'])->setEmail($_SESSION['email']);
$result =  $user->checkEmail();

   if( $result->num_rows ==1){


         $user->setEmail_verified_at(date('Y-m-d H:i:s'));

    if($user->UpdateEmailVerified()){


    if($_GET['page'] == 'register' || $_GET['page'] == 'login' ){
        $success =  "<div class='alert alert-success text-center'>Correct You Will Redirect To Home Page</div>";
        $_SESSION['user'] = $result->fetch_object();
        unset($_SESSION['email']);
        header("refresh:5;url=index.php");
    } elseif($_GET['page'] == 'forget'){
        $success =  "<div class='alert alert-success text-center'>Correct You Will Redirect To Add New Password</div>";

        header('refresh:5;url=reset_password.php');
    
            } else {
          $error =  "<div class='alert alert-danger text-center'>Somthing Went Wrong</div>";

    }
    
}else{

    $error =  "<div class='alert alert-danger text-center'>Wrong Verification code</div>";
    
}

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
                                    <h4> verification </h4>
                                </a>
                              
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form method="post">
                                            
                                            <?= $success ?? "" ?>
                                            <?= $error ?? "" ?>

                                                <input type="number" name="verification_code" placeholder="Verification Code">
                                                <?=  $validation->getMessage('verification code')  ?>



                                                <div class="button-box">
                                                   
                                                    <button type="submit"><span>Check</span></button>
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
        
     