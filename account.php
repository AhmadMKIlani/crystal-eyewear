<?php
    session_start();
    if(!$_SESSION['user_loggedin'] && !$_SESSION['admin_loggedin']){
      header("Location:index.php");
      exit();
  }

    include_once 'includes/db.php';
    $id = (int)$_SESSION['user_id'];
  
      $stmt = $connection->prepare("SELECT * FROM user WHERE id={$id}");
      $stmt->execute();
      $edit_user = $stmt->fetch(PDO::FETCH_ASSOC);


      $order_stmt = $connection->prepare("SELECT * FROM order_summary WHERE user_id ={$id}");
      $order_stmt->execute();
      $order_info = $order_stmt->fetchAll(PDO::FETCH_ASSOC);
     
// echo "<pre>";
// var_dump($order_info);
// die;

   
    include("./includes/public-header.php");
    
?>

<main class="main-content">
  <div class="container">
    <!--== Start Page Header Area Wrapper ==-->
    <div class="page-header-area" data-bg-img="">
      <div class="container pt--0 pb--0">
        <div class="row">
          <div class="col-12">
            <div class="page-header-content">
              <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Account</h2>
              <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                <ul class="breadcrumb">
                  <li><a href="index.php">Home</a></li>
                  <li class="breadcrumb-sep">//</li>
                  <li>Account</li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start My Account Wrapper ==-->
    <section class="my-account-area">
      <div class="container pt--0 pb--0">
        <div class="row">
        <div class="col-lg-12">
          <div class="myaccount-page-wrapper">
            <div class="row">
              <div class="col-lg-3 col-md-4">
                <nav>
                  <div class="myaccount-tab-menu nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="dashboad-tab" data-bs-toggle="tab" data-bs-target="#dashboad" type="button" role="tab" aria-controls="dashboad" aria-selected="true">Dashboard</button>
                    <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false">Orders</button>
                    <button class="nav-link" id="account-info-tab" data-bs-toggle="tab" data-bs-target="#account-info" type="button" role="tab" aria-controls="account-info" aria-selected="false">Account Details</button>
                    <a class="nav-link" href="includes/logic.php?logout=true" >Logout</a>

                  </div>
                </nav>
              </div>
              <div class="col-lg-9 col-md-8">
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="dashboad" role="tabpanel" aria-labelledby="dashboad-tab">
                    <div class="myaccount-content">
                      <h3>Dashboard</h3>
                      <div class="welcome">
                        <p>Hello, <strong><?php echo $_SESSION["user_name"]??"Admin" ?></strong> (If Not <strong><?php echo $_SESSION["user_name"]??"Admin" ?></strong><a href="account-login.php" class="logout"> Logout</a>)</p>
                      </div>
                      <p>From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    <div class="myaccount-content">
                      <h3>Orders</h3>
                      <div class="myaccount-table table-responsive text-center">
                        <table class="table table-bordered">
                          <thead class="thead-light">
                            <tr>
                              <th>Order</th>
                              <th>Date</th>
                              <th>Status</th>
                              <th>Total</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          
                            <?php foreach ($order_info as $info) {?>
                            <tr>
                            <td><?php echo  $info['order_id'] ?></td>
                              <td><?php echo  $info['date_of_creation'] ?></td>
                              <td><?php echo  $info['order_status'] ?></td>
                              <td><?php echo  $info['order_total_price'] ?></td>
                              <td><a href="shop-cart.php" class="check-btn sqr-btn ">View</a></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="download" role="tabpanel" aria-labelledby="download-tab">
                    <div class="myaccount-content">
                      <h3>Downloads</h3>
                      <div class="myaccount-table table-responsive text-center">
                        <table class="table table-bordered">
                          <thead class="thead-light">
                            <tr>
                              <th>Product</th>
                              <th>Date</th>
                              <th>Expire</th>
                              <th>Download</th>
                            </tr>
                          </thead>

                          <tbody>
                            <tr>
                              <td>Haven - Free Real Estate PSD Template</td>
                              <td>Aug 22, 2018</td>
                              <td>Yes</td>
                              <td><a href="#/" class="check-btn sqr-btn"><i class="fa fa-cloud-download"></i> Download File</a></td>
                            </tr>
                            <tr>
                              <td>HasTech - Profolio Business Template</td>
                              <td>Sep 12, 2018</td>
                              <td>Never</td>
                              <td><a href="#/" class="check-btn sqr-btn"><i class="fa fa-cloud-download"></i> Download File</a></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="payment-method" role="tabpanel" aria-labelledby="payment-method-tab">
                    <div class="myaccount-content">
                      <h3>Payment Method</h3>
                      <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="address-edit" role="tabpanel" aria-labelledby="address-edit-tab">
                    <div class="myaccount-content">
                      <h3>Billing Address</h3>
                      <address>
                        <p><strong>Alex Tuntuni</strong></p>
                        <p>1355 Market St, Suite 900 <br>
                          San Francisco, CA 94103</p>
                        <p>Mobile: (123) 456-7890</p>
                      </address>
                      <a href="#/" class="check-btn sqr-btn"><i class="fa fa-edit"></i> Edit Address</a>
                    </div>
                  </div>
                  
                                            <!-- **************************************************************************
                                            **************************************************************************
                 ****************************start user edit page with validation********************************************** -->
                  <div class="tab-pane fade" id="account-info" role="tabpanel" aria-labelledby="account-info-tab">
                    <div class="myaccount-content">
                      <h3>Account Details</h3>
                      <div class="account-details-form">
                        <form action="includes/logic.php" method="post">
                          <div class="row">
                            <div class="col-lg-6">
                            </div>
                            <div class="col-lg-6">
                            </div>
                          </div>
                          <div class="single-input-item">
                            <label for="display-name" class="required">Display Name</label>
                            <input name= "name" type="text" id="display-name" value="<?php echo $edit_user["username"]; ?>"/>
                            <div><?php echo $nameError?? "" ;?></div>
                          </div>
                          <div class="single-input-item">
                            <label for="email" class="required">Email Addres</label>
                            <input  name= "email" type="email" id="email" value="<?php echo $edit_user["email"]; ?>"/>
                            <div><?php echo $emailError?? "" ;?></div>
                          </div>
                          <fieldset>
                            <legend>Password change</legend>
                            <div class="single-input-item">
                              <label for="current-pwd" class="required">Current Password</label>
                              <input  name= "password" type="password" id="current-pwd" />
                            </div>
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="single-input-item">
                                  <label for="new-pwd" class="required">New Password</label>
                                  <input name="newPass"  type="password" id="new-pwd" />
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="single-input-item">
                                  <label for="confirm-pwd" class="required">Confirm Password</label>
                                  <input name="confPass" type="password" id="confirm-pwd" />
                                </div>
                              </div>
                            </div>
                          </fieldset>
                          <div class="single-input-item">
                            <button name="account_kilani_submit" type="submit" class="check-btn sqr-btn">Save Changes</button>
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
      </div>
     
    </section>
    <!--== End My Account Wrapper ==-->
  </main>
<?php
    include("./includes/public-footer.php");
?>
 