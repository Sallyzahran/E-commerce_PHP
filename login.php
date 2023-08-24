<?php

use  App\Http\Requests\Validation;
 include "./App/Http/Requests/Validation.php";


$title = "Login";

include "layouts/header.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";




if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST){

$validation = new Validation; 
$validation->setValueName('first name')->setValue($_POST['first_name'])->required()->max(32)->min(3);
$validation->setValueName('last name')->setValue($_POST['last_name'])->required()->max(32)->min(3);
$validation->setValueName('phone number')->setValue($_POST['phone_number'])->required()->max(11);
$validation->setValueName('email')->setValue($_POST['email'])->required()->regex('/[a-z0-9]+@[a-z]+\.[a-z]{2,3}/');
$validation->setValueName('password')->setValue($_POST['password'])->required()->regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/');
$validation->setValueName('confirm password')->setValue($_POST['confirm_password'])->required()->match($_POST['password'])->regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/');
$validation->setValueName('gender')->setValue($_POST['gender'])->required();




if(empty($validation->getErrors())){

    echo "ok";
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
                                    <h4> login </h4>
                                </a>
                              
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form method="post">
                                                <input type="text" name="first_name" placeholder="First Name">
                                                <?=  $validation->getMessage('first name')  ??  " "  ?>

                                                <input type="text" name="last_name" placeholder="Last Name">
                                                <?=  $validation->getMessage('last name')  ??  " "  ?>


                                                <input type="number" name="phone_number" placeholder="Phone Number">
                                                <?=  $validation->getMessage('phone number')  ??  " "  ?>

                                                <input type="email" name="email" placeholder="Email">
                                                <?=  $validation->getMessage('email')  ??  " "  ?>

                                                <input type="password" name="password" placeholder="Password">
                                                <?=  $validation->getMessage('password')  ??  " "  ?>

                                                <input type="password" name="confirm_password" placeholder="Confirm Password">
                                                <?=  $validation->getMessage('confirm password')  ??  " "  ?>

                                                <select name="gender" class="form-control" id="">

                                                <option value="m">Male</option>
                                                <option value="f">Female</option>
                                            

                                                </select>
                                                <?=  $validation->getMessage('gender')  ??  " "  ?>

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
        
     