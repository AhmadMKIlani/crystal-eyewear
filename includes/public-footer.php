  <!--== Start Footer Area Wrapper ==-->
  <footer class="footer-area">
    <!--== Start Footer Main ==-->
    <div class="footer-main">
      <div class="container pt--0 pb--0">
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <!--== Start widget Item ==-->
            <div class="widget-item">
              <div class="about-widget-wrap">
                <div class="widget-logo-area">
                  <a href="index.php">
                    <img class="logo-main" src="assets/img/logo.webp" width="131" height="34" alt="Logo" />
                  </a>
                </div>
                <p class="desc">Through the following links you can access our social media pages. Enjoy!!!</p>
                <div class="social-icons">
                  <a href="https://www.facebook.com/" target="_blank" rel="noopener"><i class="fa fa-facebook"></i></a>
                  <a href="https://dribbble.com/" target="_blank" rel="noopener"><i class="fa fa-dribbble"></i></a>
                  <a href="https://www.pinterest.com/" target="_blank" rel="noopener"><i class="fa fa-pinterest-p"></i></a>
                  <a href="https://twitter.com/" target="_blank" rel="noopener"><i class="fa fa-twitter"></i></a>
                </div>
              </div>
            </div>
            <!--== End widget Item ==-->
          </div>
          <div class="col-md-6 col-lg-3">
            <!--== Start widget Item ==-->
            <div class="widget-item widget-services-item">
              <h4 class="widget-title">Company partners</h4>
              <h4 class="widget-collapsed-title collapsed" data-bs-toggle="collapse" data-bs-target="#widgetId-1">Services</h4>
              <div id="widgetId-1" class="collapse widget-collapse-body">
                <div class="collapse-body">
                  <div class="widget-menu-wrap">
                    <ul class="nav-menu">
                      <li><a href="https://www.glasses.com/">glasses.com</a></li>
                      <li><a href="https://www.zennioptical.com/">zennioptical.com</a></li>
                      <li><a href="https://www.glassesdirect.co.uk/">glassesdirect.co</a></li>
                      <li><a href="https://www.sunglasshut.com/">sunglasshut</a></li>
                      <li><a href="https://www.ray-ban.com">ray-ban.com</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!--== End widget Item ==-->
          </div>
          <div class="col-md-6 col-lg-3">
            <!--== Start widget Item ==-->
            <div class="widget-item widget-account-item">
              <h4 class="widget-title">My Account</h4>
              <h4 class="widget-collapsed-title collapsed" data-bs-toggle="collapse" data-bs-target="#widgetId-2">My Account</h4>
              <div id="widgetId-2" class="collapse widget-collapse-body">
                <div class="collapse-body">
                  <div class="widget-menu-wrap">
                    <ul class="nav-menu">
                      <li><a href="account-login.php">My Account</a></li>
                      <li><a href="contact.php">Contact</a></li>
                      <li><a href="shop-cart.php">Shopping cart</a></li>
                      <li><a href="shop.php">Shop</a></li>
                      <li><a href="account-login.php">Services Login</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!--== End widget Item ==-->
          </div>
          <div class="col-md-6 col-lg-3">
            <!--== Start widget Item ==-->
            <div class="widget-item">
              <h4 class="widget-title">Contact Info</h4>
              <h4 class="widget-collapsed-title collapsed" data-bs-toggle="collapse" data-bs-target="#widgetId-3">Contact Info</h4>
              <div id="widgetId-3" class="collapse widget-collapse-body">
                <div class="collapse-body">
                  <div class="widget-contact-wrap">
                    <ul>
                      <li><span>Address:</span> Your address goes here.</li>
                      <li><span>Phone//fax:</span> <a href="tel://0123456789">0123456789</a></li>
                      <li><span>Email:</span> <a href="mailto://demo@example.com">demo@example.com</a></li>
                      <li><a target="_blank" href="https://www.hasthemes.com/">www.example.com</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!--== End widget Item ==-->
          </div>
        </div>
      </div>
    </div>
    <!--== End Footer Main ==-->

    <!--== Start Footer Bottom ==-->
    <div class="footer-bottom">
      <div class="container pt--0 pb--0">
        <div class="row">
          <div class="col-md-7 col-lg-6">
            <p class="copyright">© 2021 Crystal-Eywear. Made with <i class="fa fa-heart"></i> by <a target="_blank" href="/index.php">Crystals.</a></p>
          </div>
          <div class="col-md-5 col-lg-6">
            <div class="payment">
              <a href="account-login.php"><img src="assets/img/photos/payment-card.webp" width="192" height="21" alt="Payment Logo"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Footer Bottom ==-->
  </footer>
  <!--== End Footer Area Wrapper ==-->

  <!--== Start Aside Cart Menu ==-->
  <div class="aside-cart-wrapper offcanvas offcanvas-end" tabindex="-1" id="AsideOffcanvasCart" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h1 id="offcanvasRightLabel"></h1>
      <button class="btn-aside-cart-close" data-bs-dismiss="offcanvas" aria-label="Close">Shopping Cart <i class="fa fa-chevron-right"></i></button>
    </div>
    <div class="offcanvas-body">
      <ul class="aside-cart-product-list">
          <?php
          if(isset($_SESSION['shopping_cart'])):
            $order_total=0;
            $price=null;
           
            foreach ($_SESSION['shopping_cart'] as $product):
                if ($product['product_sale_price']) {
                    $price=$product['product_sale_price'];
                }
                else{
                $price=$product['product_price'];
                }
                $order_total+=(int)($price)*$product['product_quantity'];
              ?>

        <li class="product-list-item">
<!--          <a href="" class="remove">×</a>-->
          <a href="single-product.php?id=<?php echo $product['product_id'] ?>">
            <img src="<?php echo "admin/assets/media/products_images/{$product['product_image']}";?>" width="90" height="110" alt="Image-HasTech">
            <span class="product-title"><?php echo $product['product_name'] ?></span>
          </a>
          <span class="product-price"><?php echo $product['product_quantity'] ?> × <?php echo $price ?></span>
        </li>
        <?php endforeach; ?>
      </ul>
      <p class="cart-total"><span>Subtotal:</span><span class="amount">$<?php echo $order_total; ?> </span></p>
      <a class="btn-theme" data-margin-bottom="10" href="shop-cart.php">View cart</a>
      <a class="btn-theme" href="shop-checkout.php">Checkout</a>

    </div>
  </div>
  <!--== End Aside Cart Menu ==-->

  <!--== Start Aside Search Menu ==-->
  <aside class="aside-search-box-wrapper offcanvas offcanvas-top" tabindex="-1" id="AsideOffcanvasSearch" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
      <h5 class="d-none" id="offcanvasTopLabel">Aside Search</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="pe-7s-close"></i></button>
    </div>
    <div class="offcanvas-body">
      <div class="container pt--0 pb--0">
        <div class="search-box-form-wrap">
          <div class="search-note">
            <p>Start typing and press Enter to search</p>
          </div>
          <form action="#" method="post">
            <div class="search-form position-relative">
              <label for="search-input" class="visually-hidden">Search</label>
              <input id="search-input" type="search" class="form-control" placeholder="Search entire store…">
              <button class="search-button"><i class="fa fa-search"></i></button>
            </div>
          </form>
            <?php endif;?>
        </div>
      </div>
    </div>
  </aside>
  <!--== End Aside Search Menu ==-->

  <!--== Start Side Menu ==-->
  <div class="off-canvas-wrapper offcanvas offcanvas-start" tabindex="-1" id="AsideOffcanvasMenu" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h1 id="offcanvasExampleLabel"></h1>
      <button class="btn-menu-close" data-bs-dismiss="offcanvas" aria-label="Close">menu <i class="fa fa-chevron-left"></i></button>
    </div>
    <div class="offcanvas-body">
      <div class="info-items">
        <ul>
          <li class="number"><a href="tel://0123456789"><i class="fa fa-phone"></i>+00 123 456 789</a></li>
          <li class="email"><a href="mailto://demo@example.com"><i class="fa fa-envelope"></i>demo@example.com</a></li>
          <li class="account"><a href="account-login.php"><i class="fa fa-user"></i>Account</a></li>
        </ul>
      </div>
      <!-- Mobile Menu Start -->
      <div class="mobile-menu-items">
        <ul class="nav-menu">
          <li><a href="#">Home</a>
            <ul class="sub-menu">
              <li><a href="index.php">Home One</a></li>
              <li><a href="index-two.php">Home Two</a></li>
            </ul>
          </li>
          <li><a href="about-us.php">About</a></li>
          <li><a href="#">Pages</a>
            <ul class="sub-menu">
              <li><a href="account.php">Account</a></li>
              <li><a href="account-login.php">Login</a></li>
              <li><a href="account-register.php">Register</a></li>
              <li><a href="page-not-found.php">Page Not Found</a></li>
            </ul>
          </li>
          <li><a href="#">Shop</a>
            <ul class="sub-menu">
              <li><a href="#">Shop Layout</a>
                <ul class="sub-menu">
                  <li><a href="shop-three-columns.php">Shop 3 Column</a></li>
                  <li><a href="shop-four-columns.php">Shop 4 Column</a></li>
                  <li><a href="shop.php">Shop Left Sidebar</a></li>
                  <li><a href="shop-right-sidebar.php">Shop Right Sidebar</a></li>
                </ul>
              </li>
              <li><a href="#">Single Product</a>
                <ul class="sub-menu">
                  <li><a href="single-normal-product.php">Single Product Normal</a></li>
                  <li><a href="single-product.php">Single Product Variable</a></li>
                  <li><a href="single-group-product.php">Single Product Group</a></li>
                  <li><a href="single-affiliate-product.php">Single Product Affiliate</a></li>
                </ul>
              </li>
              <li><a href="#">Others Pages</a>
                <ul class="sub-menu">
                  <li><a href="shop-cart.php">Shopping Cart</a></li>
                  <li><a href="shop-checkout.php">Checkout</a></li>
                  <li><a href="shop-wishlist.php">Wishlist</a></li>
                  <li><a href="shop-compare.php">Compare</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#">Blog</a>
            <ul class="sub-menu">
              <li><a href="#">Blog Layout</a>
                <ul class="sub-menu">
                  <li><a href="blog.php">Blog Grid</a></li>
                  <li><a href="blog-left-sidebar.php">Blog Left Sidebar</a></li>
                  <li><a href="blog-right-sidebar.php">Blog Right Sidebar</a></li>
                </ul>
              </li>
              <li><a href="#">Single Blog</a>
                <ul class="sub-menu">
                  <li><a href="blog-details-no-sidebar.php">Blog Details</a></li>
                  <li><a href="blog-details-left-sidebar.php">Blog Details Left Sidebar</a></li>
                  <li><a href="blog-details.php">Blog Details Right Sidebar</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>
      <!-- Mobile Menu End -->
    </div>
  </div>
  <!--== End Side Menu ==-->

</div>

            <!--=======================Javascript============================-->


            <!--=== jQuery Modernizr Min Js ===-->
            <script src="assets/js/modernizr.js"></script>
            <!--=== jQuery Min Js ===-->
            <script src="assets/js/jquery-main.js"></script>
            <!--=== jQuery Migration Min Js ===-->
            <script src="assets/js/jquery-migrate.js"></script>
            <!--=== jQuery Popper Min Js ===-->
            <script src="assets/js/popper.min.js"></script>
            <!--=== jQuery Bootstrap Min Js ===-->
            <script src="assets/js/bootstrap.min.js"></script>
            <!--=== jQuery Ui Min Js ===-->
            <script src="assets/js/jquery-ui.min.js"></script>
            <!--=== jQuery Swiper Min Js ===-->
            <script src="assets/js/swiper.min.js"></script>
            <!--=== jQuery Fancybox Min Js ===-->
            <script src="assets/js/fancybox.min.js"></script>
            <!--=== jQuery Waypoint Js ===-->
            <script src="assets/js/waypoint.js"></script>
            <!--=== jQuery Parallax Min Js ===-->
            <script src="assets/js/parallax.min.js"></script>
            <!--=== jQuery Aos Min Js ===-->
            <script src="assets/js/aos.min.js"></script>

            <!--=== jQuery Custom Js ===-->
            <script src="assets/js/custom.js"></script>
            <!---       MAIN SCRIPT             -->
            <script src="js/main_apps.js"></script>
            


</body>

</html>