<?php
session_start();
use  App\Http\Requests\Validation;
use App\Database\Models\Contract\Crud;
use App\Database\Models\User;

include "./App/Http/Middlewares/Auth.php";
//  include_once "./App/Http/Requests/Validation.php";

$title = "Profile";

include "layouts/header.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";




?>
    
        <div class="login-register-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="tab" href="#lg1">
                                    <h4> Profile </h4>
                                </a>
                              
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form method="post">
                                             
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
        
     