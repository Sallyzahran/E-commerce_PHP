
<?php
// session_start();
include "./App/Http/Middlewares/Guest.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$title = "Login";

use App\Http\Requests\Validation;
use App\Database\Models\User;

include "layouts/header.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";
include "./App/Http/Requests/Validation.php";



 $validation = new Validation;

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST ){


    $validation->setValueName('email')->setValue($_POST['email'])->required()->regex('/[a-z0-9]+@[a-z]+\.[a-z]{2,3}/','invalid email or password');
    $validation->setValueName('password')->setValue($_POST['password'])->required()->regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/','invalid email or password');

    if( empty($validation->getErrors())){

include_once "./App/Database/Models/User.php";

        $user = new User;

        $user->setEmail($_POST['email']);
        $result = $user->checkEmailExist();

        if($result->num_rows == 1){

            $userData = $result->fetch_object(); 
            if(password_verify($_POST['password'],$userData->password)){

                if(! is_null($userData->email_verified_at)){

                $_SESSION['user'] = $userData;
                    header("Location:index.php"); die;

                }else{
                  $_SESSION['email'] = $_POST['email'];
                    header("Location:verification_code.php");
                }
            }else{
        $error =  "<div class='alert alert-danger text-center'>Email or password is wrong</div>";

            }


        }else{
        $error =  "<div class='alert alert-danger text-center'>Email Not Exist</div>";

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
                    
                                <a  class="active" data-toggle="tab" href="#lg2">
                                    <h4> Login </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                              
                                <div id="lg2" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                        <?= $error ?? "" ?>

                                            <form method="post">
                                                <input type="email" name="email" placeholder="Email Address">
                                                <?=$validation->getMessage('email')?>
                                                <input type="password" name="password" placeholder="Password">
                                                <?=$validation->getMessage('password')?>

                                                <div class="button-box">
                                                    <button type="submit"><span>Login</span></button>
                                                </div>
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
include "layouts/footer.php";
include "layouts/scripts.php";



?>
        
     