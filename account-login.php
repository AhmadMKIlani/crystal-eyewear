<?php require_once "includes/public-header.php"?>
  <!--== End Header Wrapper ==-->
  <main class="main-content">


    <!--== Start My Account Area Wrapper ==-->
    <section class="account-area mt-5">
      <div class="container">

        <div class="row">
          <div class="col-sm-8 m-auto">
            <div class="section-title text-center">
              <h2 class="title">Login</h2>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-12">
            <div class="login-form-content">
              <form class="login_form" action="includes/logic.php" method="post">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="username">Name or email address <span class="required">*</span></label>
                      <input id="username" class="form-control" type="text" name="username">
                        <?php if(isset($_GET["username"])):?>
                            <span class="text-danger"><?php echo $_GET["username"]; ?></span>
                        <?php endif; ?>
                        <?php if(isset($_GET["email"])):?>
                            <span class="text-danger"><?php echo $_GET["email"]; ?></span>
                        <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="password">Password <span class="required">*</span></label>
                      <input id="password" name="password" class="form-control" type="password">
                        <?php if(isset($_GET["password"])):?>
                            <span class="text-danger"><?php echo $_GET["password"]; ?></span>
                        <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <button class="btn-login" type="submit" name="login_submit">Login</button>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group ">
                     <span>Don't have account </span> <a class="lost-password" href="account-register.php">&nbsp;register </a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--== End My Account Area Wrapper ==-->
  </main>

  <!--== Start Footer Area Wrapper ==-->
 <?php require_once 'includes/public-footer.php'?>