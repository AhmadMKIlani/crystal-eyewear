<?php
if (isset($_POST['search_for_product'])) {
  $search_key = $_POST["search_for_product"];
  header("Location:shop.php?search_key=$search_key");
}
?>

<?php $RELOAD_TIMEOUT_MINUTES = 15 * 60; //minutes 
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Shome - Shoes eCommerce Website Template" />
  <meta name="keywords" content="footwear, shoes, modern, shop, store, ecommerce, responsive, e-commerce" />
  <meta name="author" content="codecarnival" />
  <!--        RELOAD              -->
  <meta http-equiv="refresh" content="<?php echo $RELOAD_TIMEOUT_MINUTES ?>">

  <title>Shome - Shoes eCommerce Website Template</title>

  <!--== Favicon ==-->
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />

  <!--== Google Fonts ==-->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400;1,500&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  <!--== Bootstrap CSS ==-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <!--== Font Awesome Min Icon CSS ==-->
  <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
  <!--== Pe7 Stroke Icon CSS ==-->
  <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
  <!--== Swiper CSS ==-->
  <link href="assets/css/swiper.min.css" rel="stylesheet" />
  <!--== Fancybox Min CSS ==-->
  <link href="assets/css/fancybox.min.css" rel="stylesheet" />
  <!--== Aos Min CSS ==-->
  <link href="assets/css/aos.min.css" rel="stylesheet" />

  <!--== Main Style CSS ==-->
  <link href="assets/css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/update.css">

</head>

<body>

  <!--wrapper start-->
  <div class="wrapper">

    <!--== Start Header Wrapper ==-->
    <header class="main-header-wrapper position-relative">
      <div class="header-top">
        <div class="container pt--0 pb--0">
          <div class="row">
            <div class="col-12">
              <div class="header-top-align">
                <div class="header-top-align-start">
                  <div class="desc">
                    <p>World Wide Completely Free Returns and Free Shipping</p>
                  </div>
                </div>
                <div class="header-top-align-end">
                  <div class="header-info-items">
                    <div class="info-items">
                      <ul>
                        <li class="number"><i class="fa fa-phone"></i><a href="tel://0123456789">+00 123 456 789</a></li>
                        <li class="email"><i class="fa fa-envelope"></i><a href="mailto://demo@example.com">demo@example.com</a></li>
                         <?php if(isset( $_SESSION['admin_loggedin'])){
                             if( $_SESSION['admin_loggedin']===true){?>
                                 <li class="account">

                                     <i class="fa fa-unlock"></i><a href="admin/index.php">Go to admin</a>
                                     <i class="fa fa-user"></i><a class="account mx-3" href="account.php"> Admin <?php echo $_SESSION['admin-name'] ?? ""  ?></a>
                                 </li>
                                 <?php }
                             


                         } ?>
                        <li class="account"> 
                          <?php
                          $session_check= $_SESSION['user_loggedin']?? null;
                          if ( $session_check) {?>
                          <i class="fa fa-user"></i><a class="account" href="account.php"><?php echo $_SESSION['user_name'] ?? ""  ?></a>

                          <?php }else{?>  

                             <i class="fa fa-user"></i><a href="account-login.php">Log in</a>
                       <?php } ?>
                         
                        </li>

                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="header-middle">
        <div class="container pt--0 pb--0">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="header-middle-align">
                <div class="header-middle-align-start">
                  <div class="header-logo-area">
                    <a href="index.php">
                      <img class="logo-main" src="assets/img/logo.webp" width="131" height="34" alt="Logo" />
                      <img class="logo-light" src="assets/img/logo-light.webp" width="131" height="34" alt="Logo" />
                    </a>
                  </div>
                </div>
                <div class="header-middle-align-center">
                  <div class="header-search-area">
                    <form class="header-searchbox" method="POST">
                      <input type="search" class="form-control" placeholder="Search" name="search_for_product" oninput="search(this.value)">
                      <button class="btn-submit" type="submit"><i class="pe-7s-search"></i></button>
                    </form>
                  </div>
                </div>
                <div class="header-middle-align-end">
                  <div class="header-action-area">
                    <div class="shopping-search">
                      <button class="shopping-search-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasSearch" aria-controls="AsideOffcanvasSearch"><i class="pe-7s-search icon"></i></button>
                    </div>
                    
                    <div class="shopping-cart">
                      <button class="shopping-cart-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasCart" aria-controls="offcanvasRightLabel">
                        <i class="pe-7s-shopbag icon"></i>
                        <sup class="shop-count"><?php
                                                if (isset($_SESSION['shopping_cart'])) {
                                                  echo count(($_SESSION['shopping_cart']));
                                                } else {
                                                  echo 0;
                                                }

                                                ?></sup>
                                                
                      </button>
                    </div>
                    <button class="btn-menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasMenu" aria-controls="AsideOffcanvasMenu">
                      <i class="pe-7s-menu"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="header-area header-default">
        <div class="container">
          <div class="row no-gutter align-items-center position-relative">
            <div class="col-12">
              <div class="header-align">
                <div class="header-navigation-area position-relative">
                  <ul class="main-menu nav">
                    <li><a href="index.php"><span>Home</span></a></li>
                    <li><a href="Shop.php"><span>Shop</span></a></li>
                    <li><a href="about-us.php"><span>About</span></a></li>
                    <li><a href="shop-cart.php"><span>Shopping Cart</span></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!--== End Header Wrapper ==-->