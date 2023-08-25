<?php
// session_start();
use  App\Http\Requests\Validation;
use App\Database\Models\Contract\Crud;
use App\Database\Models\User;

 include_once "./App/Http/Requests/Validation.php";

$title = "Register";

include "layouts/header.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$validation = new Validation; 

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST){

$validation->setValueName('first name')->setValue($_POST['first_name'])->required()->max(32)->min(3)->stringName();
$validation->setValueName('last name')->setValue($_POST['last_name'])->required()->max(32)->min(3);
$validation->setValueName('phone number')->setValue($_POST['phone_number'])->required()->max(11);
$validation->setValueName('email')->setValue($_POST['email'])->required()->unique('users','email')
->regex('/[a-z0-9]+@[a-z]+\.[a-z]{2,3}/');
$validation->setValueName('password')->setValue($_POST['password'])->required()->regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/');
$validation->setValueName('confirm password')->setValue($_POST['confirm_password'])->required()->match($_POST['password'])->regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/');
$validation->setValueName('gender')->setValue($_POST['gender'])->required();


if (empty($validation->getErrors())){

$verification_code = rand(100000,999999);
include_once "./App/Database/Models/User.php";




$user = new User;

$user->setFirst_name($_POST['first_name'])->setLast_name($_POST['last_name'])->setPhone($_POST['phone_number'])->setEmail($_POST['email'])->setGender($_POST['gender'])->setPassword($_POST['password'])->setVerification_code($verification_code);

if ($user->create()){

    echo "ok";
}  else {

    $error =  "<div class='alert alert-danger text-center'>somthing went wrong</div>";
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
                                    <h4> Register </h4>
                                </a>
                              
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form method="post">
                                                <?= $error ?? ""?>
                                                <input type="text" name="first_name" placeholder="First Name" value="<?= $_POST['first_name'] ?? "" ?>">
                                                <?=  $validation->getMessage('first name')   ?>

                                                <input type="text" name="last_name" placeholder="Last Name" value="<?= $_POST['last_name'] ?? "" ?>">
                                                <?=  $validation->getMessage('last name')   ?>


                                                <input type="number" name="phone_number" placeholder="Phone Number" value="<?= $_POST['phone_number'] ?? "" ?>">
                                                <?=  $validation->getMessage('phone number')  ?>

                                                <input type="email" name="email" placeholder="Email" value="<?= $_POST['email'] ?? "" ?>">
                                                <?=  $validation->getMessage('email')   ?>

                                                <input type="password" name="password" placeholder="Password">
                                                <?=  $validation->getMessage('password')  ?>

                                                <input type="password" name="confirm_password" placeholder="Confirm Password">
                                                <?=  $validation->getMessage('confirm password')   ?>

                                                <select name="gender" class="form-control" id="">

                                                <option value="m">Male</option>
                                                <option value="f">Female</option>
                                            

                                                </select>
                                                <?=  $validation->getMessage('gender')  ?>

                                                <br>

                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <input type="checkbox">
                                                        <label>Remember me</label>
                                                        <a href="#">Forgot Password?</a>
                                                    </div>
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
        
     