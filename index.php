<!--== header master-page ==-->
<?php
   session_start();
   include("./includes/public-header.php");
   require_once "includes/db.php";
   $satatement=$connection->prepare("SELECT * FROM (( products INNER JOIN category ON products.category_id=category.category_id)
                                                               INNER JOIN sub_category ON products.sub_category_id=sub_category.sub_category_id)");
   $satatement->execute();
   $products=$satatement->fetchAll(PDO::FETCH_ASSOC);
   ?>
<!--== End Header Wrapper ==-->
<main class="main-content">
   <!--== Start Hero Area Wrapper ==-->
   <section class="home-slider-area">
      <div class="container ">
         <div class=" p-0 swiper-container home-slider-container default-slider-container">
            <div class=" swiper-wrapper home-slider-wrapper slider-default">
               <div class="swiper-slide">
                  <div class="slider-content-area slider-content-area-two" data-bg-img="assets/img/slider/slider-02.webp">
                  </div>
               </div>
               <div class="swiper-slide">
                  <div class="slider-content-area slider-content-area-two" data-bg-img="assets/img/slider/slider-04.webp">
                  </div>
               </div>
               <div class="swiper-slide">
                  <div class="slider-content-area slider-content-area-two" data-bg-img="assets/img/slider/slider-01.webp">
                  </div>
               </div>
            </div>
            <!--== Add Swiper Arrows ==-->
            <div class="swiper-btn-wrap">
               <div class="swiper-btn-prev">
                  <i class="pe-7s-angle-left"></i>
               </div>
               <div class="swiper-btn-next">
                  <i class="pe-7s-angle-right"></i>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--== End Hero Area Wrapper ==-->
   <div class="feature-area">
      <div class="container home_sc">
         <div class="row">
            <div class="col-12">
               <div class="feature-content-box">
                  <div class="feature-box-wrap">
                     <div class="col-item">
                        <div class="feature-icon-box">
                           <div class="inner-content">
                              <div class="icon-box">
                                 <img class="icon-img" src="assets/img/icons/1.webp" width="55" height="41" alt="Icon-HasTech">
                              </div>
                              <div class="content">
                                 <h5 class="title">Free Home Delivary</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-item">
                        <div class="feature-icon-box">
                           <div class="inner-content">
                              <div class="icon-box">
                                 <img class="icon-img" src="assets/img/icons/2.webp" width="35" height="41" alt="Icon-HasTech">
                              </div>
                              <div class="content">
                                 <h5 class="title">Secure Payment</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-item">
                        <div class="feature-icon-box">
                           <div class="inner-content">
                              <div class="icon-box">
                                 <img class="icon-img" src="assets/img/icons/3.webp" width="33" height="41" alt="Icon-HasTech">
                              </div>
                              <div class="content">
                                 <h5 class="title">Order Discount</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-item">
                        <div class="feature-icon-box">
                           <div class="inner-content">
                              <div class="icon-box">
                                 <img class="icon-img" src="assets/img/icons/4.webp" width="43" height="41" alt="Icon-HasTech">
                              </div>
                              <div class="content">
                                 <h5 class="title">24 x 7 Online Support</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="shape-group-style1">
                     <div class="shape-group-one"><img src="assets/img/shape/6.webp" width="214" height="58" alt="Image-HasTech"></div>
                     <div class="shape-group-two"><img src="assets/img/shape/7.webp" width="136" height="88" alt="Image-HasTech"></div>
                     <div class="shape-group-three"><img src="assets/img/shape/8.webp" width="108" height="74" alt="Image-HasTech"></div>
                     <div class="shape-group-four"><img src="assets/img/shape/9.webp" width="239" height="69" alt="Image-HasTech"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--== Start Product Collection Area Wrapper ==-->
   <section class="product-area product-collection-area home_sc">
      <div class="container">
         <div class="row">
            <div class="col-lg-4 col-md-6">
               <!--== Start Product Collection Item ==-->
               <div class="product-collection">
                  <div class="inner-content">
                     <div class="product-collection-content">
                        <div class="content">
                           <h3 class="title"><a href="shop.php">Women glasses</a></h3>
                           <h4 class="price">From $40.00</h4>
                        </div>
                     </div>
                     <div class="product-collection-thumb" data-bg-img="assets/img/shop/collection/1.webp"></div>
                     <a class="banner-link-overlay" href="shop.php"></a>
                  </div>
               </div>
               <!--== End Product Collection Item ==-->
            </div>
            <div class="col-lg-4 col-md-6">
               <!--== Start Product Collection Item ==-->
               <div class="product-collection">
                  <div class="inner-content">
                     <div class="product-collection-content">
                        <div class="content">
                           <h3 class="title"><a href="shop.php?sub_category_name=men">men glasses</a></h3>
                           <h4 class="price">From $30.00</h4>
                        </div>
                     </div>
                     <div class="product-collection-thumb" data-bg-img="assets/img/shop/collection/2.webp"></div>
                     <a class="banner-link-overlay" href="shop.php"></a>
                  </div>
               </div>
               <!--== End Product Collection Item ==-->
            </div>
            <div class="col-lg-4 col-md-6">
               <!--== Start Product Collection Item ==-->
               <div class="product-collection">
                  <div class="inner-content">
                     <div class="product-collection-content">
                        <div class="content">
                           <h3 class="title"><a href="shop.php?sub_category_name=kids">kids glasses</a></h3>
                           <h4 class="price">From $35.00</h4>
                        </div>
                     </div>
                     <div class="product-collection-thumb" data-bg-img="assets/img/shop/collection/3.webp"></div>
                     <a class="banner-link-overlay" href="shop.php"></a>
                  </div>
               </div>
               <!--== End Product Collection Item ==-->
            </div>
         </div>
      </div>
   </section>
   <!--== End Product Collection Area Wrapper ==-->
   <!--== Start Product Area Wrapper ==-->
   <section class="product-area product-default-area home_sc">
      <div class="container pt--0">
         <div class="row">
            <div class="col-12">
               <div class="section-title text-center">
                  <h3 class="title">Featured Products</h3>
                  <div class="desc">
                     <p>Our Most Popular Brands</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <!--== Start Product Item ==-->
            <?php foreach ($products as $product){
               if ($product['featured_products']>0):
                ?>
            <div class="col-sm-6 col-lg-4">
               <div class="product-item">
                  <div class="inner-content">
                     <div class="product-thumb">
                        <a href="single-product.php?id=<?php echo $product['product_id'] ; ?>">
                        <img src="admin/assets/media/products_images/<?php echo $product['product_image']; ?>" width="270" height="274" alt="<?php echo $product['product_description']; ?>">
                        </a>
                        <?php if ($product['product_percentage_price']>0): ?>
                        <div class="product-flag">
                           <ul>
                              <li class="discount">-<?php echo $product['product_percentage_price']?? "" ?>%</li>
                           </ul>
                        </div>
                        <?php endif; ?>
                        <div class="product-action">
                                                <a class="btn-product-cart" href="shop-cart.php?id=<?php echo $product['product_id'] ?>&quantity=1&shop=true"><i class="fa fa-shopping-cart"></i></a>
                                             </div>
                        <a class="banner-link-overlay" href="shop.php"></a>
                     </div>
                     <div class="product-info">
                        <div class="category">
                           <ul>
                              <li ><?php echo $product['category_name'] ; ?>/<a href="shop.php?sub_category_name=<?php echo $product['sub_category_name']; ?>"><?php echo $product['sub_category_name'] ; ?></a></li>
                           </ul>
                        </div>
                        <h4 class="title"><a href="single-product.php?id=<?php echo $product['product_id'] ?>"><?php echo $product['product_name']; ?></a></h4>
                        <div class="prices">
                           <?php if ($product['product_percentage_price'] > 0){ ?>
                           <span class="price-old">$<?php echo $product['product_price'] ?></span>
                           <span class="sep">-</span>
                           <span class="price">$
                           <?php echo  ($product['product_price'])*(100- $product['product_percentage_price']) / 100;}
                              else{?><span class="price">$ <?php echo $product['product_price'] ;}?></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php endif;}?>
            <!--== End prPduct Item ==-->
         </div>
      </div>
   </section>
   <!--== End Product Area Wrapper ==-->
   <!--== Start Divider Area Wrapper ==-->
   <section class="bg-color-f2 position-relative z-index-1">
      <div class="container pt--0 pb--0">
         <div class="row divider-wrap divider-style1">
            <div class="col-lg-6">
               <div class="divider-content">
                  <h4 class="title">Saving up to 70%</h4>
                  <p class="desc">Offer Available All Products</p>
                  <a class="btn-theme" href="shop.php">Shop Now</a>
               </div>
            </div>
         </div>
      </div>
      <div class="bg-layer-wrap">
         <div class="bg-layer-style z-index--1 parallax" data-speed="1.05" data-bg-img="assets/img/photos/bg1.webp"></div>
      </div>
   </section>
   <!--== End Divider Area Wrapper ==-->
   <!--== Start Product Area Wrapper ==-->
   <section class="product-area product-best-seller-area home_sc mt-5 ">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="section-title text-center">
                  <h3 class="title">Best Seller</h3>
                  <div class="desc">
                     <p>Our Best Seller Products</p>
                  </div>
               </div>
            </div>
         </div>
         <!--== Start Product Item ==-->
         <div class="row">
            <!--== Start Product Item ==-->
            <?php foreach ($products as $product){
               if ($product['product_best_seller']>0):
                ?>
            <div class="col-sm-6 col-lg-4">
               <div class="product-item">
                  <div class="inner-content">
                     <div class="product-thumb">
                        <a href="single-product.php?id=<?php echo $product['product_id'] ; ?>">
                        <img src="admin/assets/media/products_images/<?php echo $product['product_image']; ?>" width="270" height="274" alt="<?php echo $product['product_description']; ?>">
                        </a>
                        <?php if ($product['product_percentage_price']>0): ?>
                        <div class="product-flag">
                           <ul>
                              <li class="discount">-<?php echo $product['product_percentage_price']?>%</li>
                           </ul>
                        </div>
                        <?php endif; ?>
                        <div class="product-action">
                                                <a class="btn-product-cart" href="shop-cart.php?id=<?php echo $product['product_id'] ?>&quantity=1&shop=true"><i class="fa fa-shopping-cart"></i></a>
                                             </div>
                        <a class="banner-link-overlay" href="shop.php"></a>
                     </div>
                     <div class="product-info">
                        <div class="category">
                           <ul>
                              <li ><?php echo $product['category_name'] ; ?>/<a href="shop.php?sub_category_name=<?php echo $product['sub_category_name']; ?>"><?php echo $product['sub_category_name'] ; ?></a></li>
                           </ul>
                        </div>
                        <h4 class="title"><a href="single-product.php?id=<?php echo $product['product_id'] ?>"><?php echo $product['product_name']; ?></a></h4>
                        <div class="prices">
                           <?php if ($product['product_percentage_price'] > 0){ ?>
                           <span class="price-old">$<?php echo $product['product_price'] ?></span>
                           <span class="sep">-</span>
                           <span class="price">$
                           <?php echo  ($product['product_price'])*(100- $product['product_percentage_price']) / 100;}
                              else{?><span class="price">$ <?php echo $product['product_price'] ;}?></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php endif;}?>
            <!--== End prPduct Item ==-->
         </div>
         <!--== End prPduct Item ==-->
      </div>
   </section>
   <!--== End Product Area Wrapper ==-->
</main>
<!--== footer master-page ==-->
<?php
   include("./includes/public-footer.php");  
   ?>