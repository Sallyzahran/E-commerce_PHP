<?php
// session_start();
use  App\Http\Requests\Validation;
use App\Database\Models\Contract\Crud;
use App\Database\Models\User;

//  include_once "./App/Http/Requests/Validation.php";

$title = "Profile";

include "layouts/header.php";
include "./App/Http/Middlewares/Auth.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";
include_once "./App/Http/Requests/Validation.php";



$validation = new Validation; 


if($_SERVER['REQUEST_METHOD'] == 'POST'){

if(isset($_POST['update-profile'])){


$validation->setValueName('first name')->setValue($_POST['first_name'])->required()->max(32)->min(3);
$validation->setValueName('last name')->setValue($_POST['last_name'])->required()->max(32)->min(3);
$validation->setValueName('gender')->setValue($_POST['gender'])->required();


if (empty($validation->getErrors())){
include_once "./App/Database/Models/User.php";


$user = new User;

$user->setFirst_name($_POST['first_name'])->setLast_name($_POST['last_name'])->setGender($_POST['gender'])->setEmail($_SESSION['user']->email) ;

if($user->update()){

  $_SESSION['user']->first_name = $_POST['first_name'];
  $_SESSION['user']->last_name = $_POST['last_name'];
  $_SESSION['user']->gender = $_POST['gender'];


    $succes =  "<div class='alert alert-success text-center'>Success Update Profile</div>";



}else{
    $error =  "<div class='alert alert-danger text-center'>Failed Update Profile</div>";


}

   
}

}



}








?>
    
      
        
        <section class="vh-100" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-12 col-xl-8">

        <div class="card" style="border-radius: 15px; height:400px">
          <div class="card-body text-center">
          <?= $error ?? ""?>
          <?= $succes ?? ""?>


            <form  method="post">

            <div class="mt-3 mb-4">
              <img src="assets/img/users/<?php
                  if($_SESSION['user']->image = 'default.jpg'){

                    if($_SESSION['user']->gender == 'm'){

                      echo "male.png";
                    }elseif($_SESSION['user']->gender == 'f'){
                      echo "female.jpg";

                    }
                  }
              ?>"
                class="rounded-circle img-fluid"  alt="<?=$_SESSION['user']->first_name?>" style="width: 100px;" />
            </div>

            </form>

          <form  method="post">
            
            
            <div class="d-flex justify-content-between text-center mt-5 mb-2">
              <div>
                <label for="">First Name</label>
                    <input type="text" name="first_name" value="<?= $_SESSION['user']->first_name?>" > 
             </div>
              <div class="px-3">
              <label for="">Last Name</label>
                    <input type="text" name="last_name" value="<?= $_SESSION['user']->last_name?>">
              </div>
              <div class="pt-4">
              <select name="gender" class="form-control" id="">

                 <option   <?=  $_SESSION['user']->gender == 'm' ? 'selected' : '' ?>    value="m">Male</option>
                 <option   <?=  $_SESSION['user']->gender == 'f' ? 'selected' : '' ?>    value="f">Female</option>

                                                

                 </select>
              </div>
            </div>
            <div class="button-box">
         <br>
             <button type="submit" name="update-profile" ><span>Update</span></button>
               </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
        
        <?php
include "layouts/footer.php";
include "layouts/scripts.php";



?>
        
     