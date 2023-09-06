<?php

session_start();

use App\Http\Requests\Validation;
use App\Database\Models\User;
use App\Database\Models\Review;


$title = "Product Details";

include_once "layouts/header.php";
include_once "layouts/navbar.php";
include_once "layouts/breadcrumb.php";


use App\Database\Models\Product;

include "./App/Http/Requests/Validation.php";

include "./App/Database/Models/Product.php";


if($_GET){

    if(isset($_GET['product'])){

        if(is_numeric($_GET['product'])){

            $productObj = new Product;
            $productData=$productObj->find($_GET['product']);
            if($productData->num_rows == 1){

               $product = $productData->fetch_object();

            }else{
        header("Location:layouts/notfound.php");

            }

        }else{
    header("Location:layouts/notfound.php");

        }
    } else{
    header("Location:layouts/notfound.php");

    }




}else{

    header("Location:layouts/notfound.php");
}

$validation = new Validation ;


if( $_SERVER['REQUEST_METHOD'] == 'POST'  &&  $_POST){

$validation->setValueName('name')->setValue($_POST['name'])->required()->min(3)->max(32);
$validation->setValueName('email')->setValue($_POST['email'])->required()->regex('/[a-z0-9]+@[a-z]+\.[a-z]{2,3}/');
$validation->setValue('message')->setValue($_POST['message'])->required()->min(3);

if (empty($validation->getErrors())){
include "./App/Database/Models/User.php";

$user = new User;
$user->setEmail($_POST['email'])->checkEmailExist();
 if($user->checkEmailExist()->num_rows == 1){

include "./App/Database/Models/Review.php";
$reviewObj = new Review;
$reviewObj->setUser_id($_SESSION['user']->id)->setProduct_id($_GET['product'])->setComment($_POST['message']);

if($reviewObj->isReviwed()->num_rows == 1){

    $error =  "<div class='alert alert-danger text-center'>You Already Reviewd This Product</div>";

} else {
    if($reviewObj->create()){
    $message =  "<div class='alert alert-success text-center'>Review Added</div>";



}else{
    $error =  "<div class='alert alert-danger text-center'>somthing went wrong Please Try Again </div>";
}

 }
 } else{
    header("Location:login.php");
}



}
}





?>
  
  <style>
    .button-class {
  border: none;
  background-color: transparent;
}
  </style>


        <?=$error ?? "" ?> 
        <?=$message ?? "" ?> 


        <div class="product-details pt-100 pb-95">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="product-details-img">
                            <img class="zoompro" src="assets/img/product/<?=$product->image?>" data-zoom-image="assets/img/product/<?=$product->image?>" alt="zoom"/>
                       
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="product-details-content">
                            <h4><?=$product->name_en?></h4>
                            <div class="rating-review">
                                <div class="pro-dec-rating">


                                <?php 
                                
                                for ($i=1 ; $i <= $product->reviews_rate ; $i ++) {
                                
                                ?>
                                    <i class="ion-android-star-outline theme-star"></i>
                              

                                    <?php } 
                                    
                                    for ($i=1 ; $i <= 5 - $product->reviews_rate ; $i ++) {
                                
                                    ?>

                                
                                    <i class="ion-android-star-outline"></i>

                                    <?php }?>
                                </div>
                                <div class="pro-dec-review">
                                    <ul>
                                        <li><?=$product->reviews_count?> Reviews </li>
                                        <li> Add Your Reviews</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="in-stock">

                            <?php if($product->quantity > 0 &&  $product->quantity < 5) {
                                

                                $message = "In Stock (" . $product->quantity . ")";
                                $color = "warning";
                            }elseif($product->quantity == 0){
                                $message = "Out Of Stock" ;
                                $color = "danger";

                                }else{
                                    $message = "In Stock" ;
                                    $color = "success";
                                }
                                ?>

                                
                                <p>Available: <span class="text-<?=$color?>" ><?=$message?></span></p>

                            </div>
                            <p><?=$product->details_en?> </p>

                            <div class="pro-dec-feature">
                        <ul>

                        <?php  
                        $productObj->setId($_GET['product']);
                        $specs = $productObj->specs()->fetch_all(MYSQLI_ASSOC);

                        foreach ($specs As $spec) {
                        
                        ?>
                            <li><?= $spec['name']?>: <span> <?=$spec['value']?></span></li>
                           
                            <?php } ?>
                        </ul>
                    </div>

                            <?php if($product->quantity != 0) { ?>
                         
                            <div class="quality-add-to-cart">
                                <div class="quality">
                                    <label>Qty:</label>
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
                                </div>
                                <div class="shop-list-cart-wishlist">
                                    <a title="Add To Cart" href="#">
                                        <i class="icon-handbag"></i>
                                    </a>
                                    <a title="Wishlist" href="#">
                                        <i class="icon-heart"></i>
                                    </a>
                                </div>

                            </div>
                            <?php } ?>
                            <div class="pro-dec-categories">
                                <ul>


                                    <li class="categories-title">Categories:</li>
                                    <li><a href="shop.php?category=<?=$product->category_id?>"><?=$product->category_name_en?>,</a></li>
                                    <li><a href="shop.php?subcategory=<?=$product->subcategory_id?>"><?=$product->subcategory_name_en?>, </a></li>
                                    <li><a href="shop.php?brand=<?=$product->brand_id?>"><?=$product->brand_name_en?>,</a></li>
                              
                                </ul>
                            </div>
                          
                            <div class="pro-dec-social">
                                <ul>
                                    <li><a class="tweet" href="#"><i class="ion-social-twitter"></i> Tweet</a></li>
                                    <li><a class="share" href="#"><i class="ion-social-facebook"></i> Share</a></li>
                                    <li><a class="google" href="#"><i class="ion-social-googleplus-outline"></i> Google+</a></li>
                                    <li><a class="pinterest" href="#"><i class="ion-social-pinterest"></i> Pinterest</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- Product Deatils Area End -->
        <div class="description-review-area pb-70">
            <div class="container">
                <div class="description-review-wrapper">
                    <div class="description-review-topbar nav text-center">
                        <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                        <a data-toggle="tab" href="#des-details3">Review</a>
                    </div>
                    <div class="tab-content description-review-bottom">
                        <div id="des-details1" class="tab-pane active">
                            <div class="product-description-wrapper">
                                <p><?=$product->details_en?></p>
                           
                            </div>
                        </div>
                      
                        <div id="des-details3" class="tab-pane">

                        <?php 
                                 $reviews = $productObj->reviews()->fetch_all(MYSQLI_ASSOC);
                                        foreach ($reviews as $review) {
                                            ?>
                            <div class="rattings-wrapper">
                                <div class="sin-rattings">
                                    <div class="star-author-all">
                                        <div class="ratting-star f-left">
                              <?php  for ($i=1 ; $i <= $review['rate'] ; $i ++) { ?>

                                            <i class="ion-star theme-color"></i>
                                            <?php }
                                            
                                            for ($i=1 ; $i <= 5 - $review['rate'] ; $i ++) { 
                                            
                                            ?>
                                    <i class="ion-android-star-outline"></i>
                                                    <?php } ?>
                                            <span>(<?=$review['rate']?>)</span>
                                        </div>
                                        <div class="ratting-author f-right">
                                           

                                            <h3><?=$review['first_name'] .' ' . $review['last_name']?></h3>
                                            <span></span>
                                            <span><?=$review['created_at']?></span>
                                        </div>
                                    </div>
                                    <?php if(isset($review['comment'])) { ?>
                                    <p><?=$review['comment']?></p>
                                    <?php } else {?>
                                        <p>No Comment</p>

                                        <?php } ?>
                                </div>
                            </div>

                            <?php } ?>
                            <div class="ratting-form-wrapper">
                                <h3>Add your Comments :</h3>
                                <div class="ratting-form">
                                    <form action="" method="post">
                                        <div class="star-box">
                                            <h2>Rating:</h2>
                                            <div class="ratting-star">

                                 <button class="button-class"> <i class="ion-android-star-outline"></i></button>   
                                 <button class="button-class"> <i class="ion-android-star-outline"></i></button>   
                                 <button class="button-class"> <i class="ion-android-star-outline"></i></button>   
                                 <button class="button-class"> <i class="ion-android-star-outline"></i></button>  
                                 <button class="button-class"> <i class="ion-android-star-outline"></i></button>   

                                



                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="rating-form-style mb-20">
                                                    <?php if(isset($_SESSION['user'])) { ?>
                                                    <input value="<?=$_SESSION['user']->first_name ?>" name="name" type="text"  >
                                                    <?php  } else {?>
                                                        <input placeholder="Name" name="name" type="text"  >
                                                        <?php 
                                                        $validation->getMessage('name') 
                                                        
                                                        ?>

                                                        <?php } ?>
                                                    
                                                    
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="rating-form-style mb-20">
                                                <?php if(isset($_SESSION['user'])) { ?>
                                                    <input value="<?=$_SESSION['user']->email ?>" name="email" type="text"  >
                                                    <?php  } else {?>
                                                        <input placeholder="Email" name="email" type="text"  >

                                                        <?php } ?>                
                                                        <?php 
                                                        $validation->getMessage('email')
                                                        
                                                        ?>                 
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    <textarea name="message" placeholder="Message"></textarea>
                                                    <?php 
                                                        $validation->getMessage('message')
                                                        
                                                        ?>   
                                                    <input type="submit" value="add review">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-area pb-100">
            <div class="container">
                <div class="product-top-bar section-border mb-35">
                    <div class="section-title-wrap">
                        <h3 class="section-title section-bg-white">Related Products</h3>
                    </div>
                </div>
                <div class="featured-product-active hot-flower owl-carousel product-nav">
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="product-details.php">
                                <img alt="" src="assets/img/product/product-1.jpg">
                            </a>
                            <span>-30%</span>
                            <div class="product-action">
                                <a class="action-wishlist" href="#" title="Wishlist">
									<i class="ion-android-favorite-outline"></i>
								</a>
								<a class="action-cart" href="#" title="Add To Cart">
									<i class="ion-ios-shuffle-strong"></i>
								</a>
								<a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
									<i class="ion-ios-search-strong"></i>
								</a>
                            </div>
                        </div>
                        <div class="product-content text-left">
							<div class="product-hover-style">
								<div class="product-title">
									<h4>
										<a href="product-details.php">Le Bongai Tea</a>
									</h4>
								</div>
								<div class="cart-hover">
									<h4><a href="product-details.php">+ Add to cart</a></h4>
								</div>
							</div>
							<div class="product-price-wrapper">
								<span>$100.00 -</span>
								<span class="product-price-old">$120.00 </span>
							</div>
						</div>
                    </div>
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="product-details.php">
                                <img alt="" src="assets/img/product/product-2.jpg">
                            </a>
                            <div class="product-action">
                                <a class="action-wishlist" href="#" title="Wishlist">
									<i class="ion-android-favorite-outline"></i>
								</a>
								<a class="action-cart" href="#" title="Add To Cart">
									<i class="ion-ios-shuffle-strong"></i>
								</a>
								<a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
									<i class="ion-ios-search-strong"></i>
								</a>
                            </div>
                        </div>
                        <div class="product-content text-left">
							<div class="product-hover-style">
								<div class="product-title">
									<h4>
										<a href="product-details.php">Society Ice Tea</a>
									</h4>
								</div>
								<div class="cart-hover">
									<h4><a href="product-details.php">+ Add to cart</a></h4>
								</div>
							</div>
							<div class="product-price-wrapper">
								<span>$100.00 -</span>
								<span class="product-price-old">$120.00 </span>
							</div>
						</div>
                    </div>
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="product-details.php">
                                <img alt="" src="assets/img/product/product-3.jpg">
                            </a>
                            <span>-30%</span>
                            <div class="product-action">
                                <a class="action-wishlist" href="#" title="Wishlist">
									<i class="ion-android-favorite-outline"></i>
								</a>
								<a class="action-cart" href="#" title="Add To Cart">
									<i class="ion-ios-shuffle-strong"></i>
								</a>
								<a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
									<i class="ion-ios-search-strong"></i>
								</a>
                            </div>
                        </div>
                        <div class="product-content text-left">
							<div class="product-hover-style">
								<div class="product-title">
									<h4>
										<a href="product-details.php">Green Tea Tulsi</a>
									</h4>
								</div>
								<div class="cart-hover">
									<h4><a href="product-details.php">+ Add to cart</a></h4>
								</div>
							</div>
							<div class="product-price-wrapper">
								<span>$100.00 -</span>
								<span class="product-price-old">$120.00 </span>
							</div>
						</div>
                    </div>
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="product-details.php">
                                <img alt="" src="assets/img/product/product-4.jpg">
                            </a>
                            <div class="product-action">
                                <a class="action-wishlist" href="#" title="Wishlist">
									<i class="ion-android-favorite-outline"></i>
								</a>
								<a class="action-cart" href="#" title="Add To Cart">
									<i class="ion-ios-shuffle-strong"></i>
								</a>
								<a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
									<i class="ion-ios-search-strong"></i>
								</a>
                            </div>
                        </div>
                        <div class="product-content text-left">
							<div class="product-hover-style">
								<div class="product-title">
									<h4>
										<a href="product-details.php">Best Friends Tea</a>
									</h4>
								</div>
								<div class="cart-hover">
									<h4><a href="product-details.php">+ Add to cart</a></h4>
								</div>
							</div>
							<div class="product-price-wrapper">
								<span>$100.00 -</span>
								<span class="product-price-old">$120.00 </span>
							</div>
						</div>
                    </div>
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="product-details.php">
                                <img alt="" src="assets/img/product/product-5.jpg">
                            </a>
                            <span>-30%</span>
                            <div class="product-action">
                                <a class="action-wishlist" href="#" title="Wishlist">
									<i class="ion-android-favorite-outline"></i>
								</a>
								<a class="action-cart" href="#" title="Add To Cart">
									<i class="ion-ios-shuffle-strong"></i>
								</a>
								<a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
									<i class="ion-ios-search-strong"></i>
								</a>
                            </div>
                        </div>
                        <div class="product-content text-left">
							<div class="product-hover-style">
								<div class="product-title">
									<h4>
										<a href="product-details.php">Instant Tea Premix</a>
									</h4>
								</div>
								<div class="cart-hover">
									<h4><a href="product-details.php">+ Add to cart</a></h4>
								</div>
							</div>
							<div class="product-price-wrapper">
								<span>$100.00 -</span>
								<span class="product-price-old">$120.00 </span>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer style Start -->
      
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <!-- Thumbnail Large Image start -->
                                <div class="tab-content">
                                    <div id="pro-1" class="tab-pane fade show active">
                                        <img src="assets/img/product-details/product-detalis-l1.jpg" alt="">
                                    </div>
                                    <div id="pro-2" class="tab-pane fade">
                                        <img src="assets/img/product-details/product-detalis-l2.jpg" alt="">
                                    </div>
                                    <div id="pro-3" class="tab-pane fade">
                                        <img src="assets/img/product-details/product-detalis-l3.jpg" alt="">
                                    </div>
                                    <div id="pro-4" class="tab-pane fade">
                                        <img src="assets/img/product-details/product-detalis-l4.jpg" alt="">
                                    </div>
                                </div>
                                <!-- Thumbnail Large Image End -->
                                <!-- Thumbnail Image End -->
                                <div class="product-thumbnail">
                                    <div class="thumb-menu owl-carousel nav nav-style" role="tablist">
                                        <a class="active" data-toggle="tab" href="#pro-1"><img src="assets/img/product-details/product-detalis-s1.jpg" alt=""></a>
                                        <a data-toggle="tab" href="#pro-2"><img src="assets/img/product-details/product-detalis-s2.jpg" alt=""></a>
                                        <a data-toggle="tab" href="#pro-3"><img src="assets/img/product-details/product-detalis-s3.jpg" alt=""></a>
                                        <a data-toggle="tab" href="#pro-4"><img src="assets/img/product-details/product-detalis-s4.jpg" alt=""></a>
                                    </div>
                                </div>
                                <!-- Thumbnail image end -->
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <div class="modal-pro-content">
                                    <h3>Dutchman's Breeches </h3>
                                    <div class="product-price-wrapper">
                                        <span class="product-price-old">£162.00 </span>
                                        <span>£120.00</span>
                                    </div>
                                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet.</p>	
                                    <div class="quick-view-select">
                                        <div class="select-option-part">
                                            <label>Size*</label>
                                            <select class="select">
                                                <option value="">S</option>
                                                <option value="">M</option>
                                                <option value="">L</option>
                                            </select>
                                        </div>
                                        <div class="quickview-color-wrap">
                                            <label>Color*</label>
                                            <div class="quickview-color">
                                                <ul>
                                                    <li class="blue">b</li>
                                                    <li class="red">r</li>
                                                    <li class="pink">p</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
                                        </div>
                                        <button>Add to cart</button>
                                    </div>
                                    <span><i class="fa fa-check"></i> In stock</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->
        
        <?php
include "layouts/footer.php";
include "layouts/scripts.php";


?>	
