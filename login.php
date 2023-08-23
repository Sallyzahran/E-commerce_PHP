<?php

use  App\Http\Requests\Validation;
 include "./App/Http/Requests/Validation.php";


$title = "Login";

include "layouts/header.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";




if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST){

$validation = new Validation; 
$validation->setValueName('first name')->setValue($_POST['first_name'])->required()->max(32);



// if(empty($validation->getErrors())){

//     echo "ok";
// }



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


                                                <input type="password" name="user-password" placeholder="Password">
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
        
     