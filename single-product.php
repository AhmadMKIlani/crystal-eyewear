<?php
   session_start();

       require_once "includes/db.php";

       if(isset($_GET['id'])){
        $id=$_GET['id'];
        $statement = $connection->prepare("SELECT * FROM products INNER JOIN category ON products.category_id=category.category_id
        INNER JOIN sub_category ON products.sub_category_id = sub_category.sub_category_id WHERE product_id=:id");
        $statement->bindParam(':id',$id);
        $statement->execute();
        $product=$statement->fetch(PDO::FETCH_ASSOC);

        $sub_id=(int)$product['sub_category_id'];
        $second_statement=$connection->prepare("SELECT * FROM products WHERE sub_category_id= {$sub_id}");
        $second_statement->execute();
        $related_products=$second_statement->fetchAll(PDO::FETCH_ASSOC);


        $product_review=$connection->prepare("SELECT * FROM product_review inner JOIN user ON product_review.user_id=user.id WHERE product_id={$id}");
        $product_review->execute();
        $review=$product_review->fetchAll(PDO::FETCH_ASSOC);   
}

if (isset($_POST["post"])) {
  $id=$_GET['id'];
  $user_id=$_POST['user_id'];
  $review_title = $_POST["review_title"];
  $review_comments = $_POST["review_comments"];
  $strt = $connection->prepare("INSERT INTO product_review (review_title,review_comments ,product_id,user_id )
  VALUES ('{$review_title}','{$review_comments}',{$id},{$user_id})");
  $strt->execute();
  header("location:single-product.php?id={$id}");

} 


    include("./includes/public-header.php");
   ?>
<main class="main-content">
   <!--== Start Page Header Area Wrapper ==-->
   <!--== End Page Header Area Wrapper ==-->
   <!--== Start Product Single Area Wrapper ==-->
   <section class="product-area product-single-area mt-5">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="product-single-item">
                  <div class="row">
                     <div class="col-xl-6">
                        <!--== Start Product Thumbnail Area ==-->
                        <div class="product-single-thumb product-single-thumb-normal">
                           <div class="swiper-container single-product-thumb single-product-thumb-slider">
                              <div class="swiper-wrapper">
                                 <div class="swiper-slide">
                                    <a class="lightbox-image" data-fancybox="gallery" href="admin/assets/media/products_images/<?php echo $product['product_image']; ?>">
                                    <img src="admin/assets/media/products_images/<?php echo $product['product_image']; ?>" width="570" height="541" alt="<?php echo $product['product_description'] ?>">
                                    </a>
                                 </div>
                              </div>
                           </div>
                           <div class="swiper-container single-product-nav single-product-nav-slider">
                              <div class="swiper-wrapper">
                                 <div class="swiper-slide">
                                    <img src="assets/img/shop/product-single/nav-1.webp" width="127" height="127" alt="Image-HasTech">
                                 </div>
                                 <div class="swiper-slide">
                                    <img src="assets/img/shop/product-single/nav-2.webp" width="127" height="127" alt="Image-HasTech">
                                 </div>
                                 <div class="swiper-slide">
                                    <img src="assets/img/shop/product-single/nav-3.webp" width="127" height="127" alt="Image-HasTech">
                                 </div>
                                 <div class="swiper-slide">
                                    <img src="assets/img/shop/product-single/nav-4.webp" width="127" height="127" alt="Image-HasTech">
                                 </div>
                                 <div class="swiper-slide">
                                    <img src="assets/img/shop/product-single/nav-5.webp" width="127" height="127" alt="Image-HasTech">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--== End Product Thumbnail Area ==-->
                     </div>
                     <div class="col-xl-6">
                        <!--== Start Product Info Area ==-->
                        <div class="product-single-info">
                            <div class="text-center breadcrumb"><?php echo "shop > {$product['category_name']} > {$product['sub_category_name']} " ?></div>
                           <h3 class="main-title"><?php echo $product['product_name'] ?></h3>
                            <div class="prices">
                                <?php if ($product['product_percentage_price'] > 0) { ?>
                                <span class="price-old">$<?php echo $product['product_price'] ?></span>
                                <span class="sep">-</span>
                                <span class="price">$
                                                   <?php echo ($product['product_price']) * (100 - $product['product_percentage_price']) / 100;
                                                   } else { ?><span class="price">$ <?php echo $product['product_price'];
                                        } ?></span>
                            </div>
                           <form action="shop-cart.php" method="get">
                           <input type="hidden" name="id" value="<?php echo $product['product_id'] ?>">
                           <div class="product-quick-action">
                              <div class="qty-wrap">
                                 <div class="pro-qty">
                                       <input type="text" name="quantity" title="Quantity" value="1">
                                 </div>
                              </div>
                              <button type="submit" class="btn-theme" >Add to Cart</button>
                           </div>
                           </form>
                        </div>
                        <!--== End Product Info Area ==-->
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="product-review-tabs-content">
                  <ul class="nav product-tab-nav" id="ReviewTab" role="tablist">
                     <li role="presentation">
                        <a class="active" id="description-tab" data-bs-toggle="pill" href="#description" role="tab" aria-controls="description" aria-selected="false">Description</a>
                     </li>
                     <li role="presentation">
                        <a id="reviews-tab" data-bs-toggle="pill" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews <span>(05)</span></a>
                     </li>
                  </ul>
                  <div class="tab-content product-tab-content" id="ReviewTabContent">
                     <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <div class="product-description">
                           <p><?php echo $product['product_description'] ?></p>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <div class="product-review-content">
                           <div class="review-content-header">
                              <h3>Customer Reviews</h3>
                              <div class="review-info">
                                 <span class="review-write-btn">Write a review</span>
                              </div>
                           </div>
                           <!--== Start Reviews Form Item ==-->

                               <div class="reviews-form-area">
                                    <?php
                                    $loggedin=$_SESSION['user_loggedin']?? null;
                                    if(!$loggedin) {?>
                                   <div class=" h3 my-4">You need to sign in as a user in order to write a review</div> <?php }?>
                                   <?php if(isset($_SESSION['user_id'])) {

                                   if($loggedin){?>
                                   <h4 class="title">Write a review</h4>
                                   <div class="reviews-form-content">
                                       <form action="#" method="post">
                                           <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                                           <div class="row">
                                               <div class="col-md-12">
                                                   <div class="form-group">
                                                       <label for="for_review-title">Review Title</label>
                                                       <input id="for_review-title" name="review_title" class="form-control" type="text" placeholder="Give your review a title">
                                                   </div>
                                               </div>
                                               <div class="col-md-12">
                                                   <div class="form-group">
                                                       <label for="for_comment">Body of Review</label>
                                                       <textarea id="for_comment" name="review_comments" class="form-control" placeholder="Write your comments here"></textarea>
                                                   </div>
                                               </div>
                                               <div class="col-md-12">
                                                   <div class="form-submit-btn">
                                                       <button type="submit" name="post" class="btn-submit">Post comment</button>
                                                   </div>
                                               </div>
                                           </div>
                                       </form>
                                   </div>
                               </div>
                            <?php }}?>
                           <!--== End Reviews Form Item ==-->
                           <div class="reviews-content-body">
                             <?php  
                            if(isset($review)){
                             foreach ($review as $key) {?>
                              <div class="review-item">
                                  <h3><i class="fa fa-user m-3"></i><?php echo $key['username']?></h3>
                                  <small class="text-muted"><?php echo $key["date_created"] ?></small>
                                 <h3 class="title"><span class="font-weight-900">title:</span>  <?php echo $key["review_title"]  ?></h3>
                                 <p><?php echo $key["review_comments"]  ?> </p>
                              </div>
                              <?php }} ?>
                               <div class="alert-light">There is no review for this product</div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

   <!--== End Product Single Area Wrapper ==-->
   <!--== Start Product Area Wrapper ==-->
   <section class="product-area product-best-seller-area">
      <div class="container pt--0">
         <div class="row">
            <div class="col-12">
               <div class="section-title text-center">
                  <h3 class="title">Related Products</h3>
                  <div class="desc">
                     <p>Millions of happy customers have found their perfect pair.</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="product-slider-wrap">
                  <div class="swiper-container product-slider-col4-container">
                     <div class="swiper-wrapper">

                     <?php
                       foreach ($related_products as $related) {?>

                        <div class="swiper-slide">
                           <!--== Start Product Item ==-->
                           <div class="product-item">
                                       <div class="inner-content">
                                          <div class="product-thumb">

                                             <a href="single-product.php?id=<?php echo $related['product_id']; ?>">
                                                <img src="admin/assets/media/products_images/<?php echo $related['product_image']; ?>" width="270" height="274" alt="Image-HasTech">
                                             </a>
                                             <?php if ($related['product_percentage_price'] > 0) : ?>
                                                <div class="product-flag">
                                                   <ul>
                                                      <li class="discount">-<?php echo $related['product_percentage_price'] ?>%</li>
                                                   </ul>
                                                </div>
                                             <?php endif; ?>
                                             <div class="product-action">
                                                <a class="btn-product-cart" href="shop-cart.php?id=<?php echo $related['product_id'] ?>&quantity=1&shop=true"><i class="fa fa-shopping-cart"></i></a>
                                             </div>
                                             <a class="banner-link-overlay" href="shop.php"></a>
                                          </div>
                                          <div class="product-info">

                                             <h4 class="title"><a href="single-product.php?id=<?php echo $related['product_id'] ?>"><?php echo $related['product_name']; ?></a></h4>
                                             <div class="prices">
                                                <?php if ($related['product_percentage_price'] > 0){?>
                                                   <span class="price-old">$<?php echo $related['product_price'] ?></span>
                                                   <span class="sep">-</span>
                                                   <span class="price">$
                                                   <?php echo  ($related['product_price'])*(100- $related['product_percentage_price']) / 100;
                                                } else { ?><span class="price">$ <?php echo $related['product_price'];
                                                                                 } ?></span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                           <!--== End prPduct Item ==-->
                        </div>
                        <?php } ?>

                     </div>
                  </div>
                  <!--== Add Swiper Arrows ==-->
                  <div class="product-swiper-btn-wrap">
                     <div class="product-swiper-btn-prev">
                        <i class="fa fa-arrow-left"></i>
                     </div>
                     <div class="product-swiper-btn-next">
                        <i class="fa fa-arrow-right"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--== End Product Area Wrapper ==-->
</main>
<?php
   include("./includes/public-footer.php");
   ?>