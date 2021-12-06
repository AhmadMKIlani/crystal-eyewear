
<?php
   include_once '../../includes/db.php';
   
   if(isset($_GET["id"])){
   	$id = $_GET["id"];
   	$stmt = $connection->prepare("SELECT * FROM user WHERE id={$_GET['id']}");
   	$stmt->execute();
   	$edit_user = $stmt->fetch(PDO::FETCH_ASSOC);

      $emailError ="";
      $nameError ="";

   	if(isset($_POST["submit"])){
         $check = true;
         if(empty($_POST["username"])){
            $check = false;
            $nameError = "<span style='color:red'> Name cannot be empty </span>";
         }
         if(empty($_POST["email"])){
            $check = false;
            $emailError = "<span style='color:red'> Email cannot be empty </span>";
         }
      if($check == true){
   		$rand = rand(1,99999);
   		$userName  = $_POST["username"];
   		$userEmail = $_POST["email"];
   		$userRole = $_POST["role"];
   		$userImage=$rand.$_FILES["image"]["name"];
   		$destination = "../assets/media/avatars/".$rand.$_FILES["image"]["name"];

         $img = ",image = '{$userImage}'";

         if ($_FILES['image']['size'] == 0) {
               $img = '';
         }
         if(move_uploaded_file($_FILES["image"]["tmp_name"],$destination)){
               echo  "<h1>image uploaded</h1>";
         } else{
               echo "<h1>image not uploaded</h1>";
               }
      
   
   		$update = $connection->prepare("UPDATE user SET username = '{$userName}' ,
   		email = '{$userEmail}',
   		role = '{$userRole}' {$img}
   		WHERE id={$_GET['id']}");
   		$update->execute();
   		header("location:../users.php");
      }
   }
}
   
   ?>
<!DOCTYPE html>
<html lang=en>
   <?php include_once 'layouts/head.php'; ?>
   <body id=kt_body class="header-fixed header-tablet-and-mobile-fixed aside-enabled aside-fixed" style=--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px>
      <div class="d-flex flex-column flex-root">
         <div class="page d-flex flex-row flex-column-fluid">
            <?php include_once 'layouts/aside.php'; ?>
            <div class="wrapper d-flex flex-column flex-row-fluid" id=kt_wrapper>
               <?php include_once 'layouts/header.php'; ?>
               <div class="content d-flex flex-column flex-column-fluid" id=kt_content>
                  <div class="post d-flex flex-column-fluid" id=kt_post>
                     <div id=kt_content_container class=container-xxl>
                        <div class="card mb-5 mb-xl-10">
                           <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                              <div class="card-title m-0">
                                 <h3 class="fw-bolder m-0">Edit User</h3>
                              </div>
                           </div>
                           <div id="kt_account_settings_profile_details" class="collapse show">
                              <form id="kt_account_profile_details_form" method="post" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" enctype="multipart/form-data">
                                    <!-- user full name edit from admin -->
                                    <div class="row mb-6">
                                       <label class="col-lg-4 col-form-label required fw-bold fs-6">Full Name</label>
                                       <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                          <input type="text" name="username" class="form-control form-control-lg form-control-solid" placeholder="full name" value="<?php echo $edit_user['username']; ?>">
                                          <div><?php echo $nameError?></div>
                                          <div class="fv-plugins-message-container invalid-feedback"></div>
                                       </div>
                                    </div>
                                    <!-- user email edit from admin -->
                                    <div class="row mb-6">
                                       <label class="col-lg-4 col-form-label required fw-bold fs-6">Email</label>
                                       <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                          <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="email" value="<?php echo $edit_user['email']; ?>">
                                          <div class="fv-plugins-message-container invalid-feedback"></div>
                                          <div><?php echo $emailError?></div>
                                       </div>
                                    </div>
                                    <div class="row mb-6">
                                       <label class="col-lg-4 required fw-bold fs-6 mb-5">Role</label>
                                       <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                          <div class="d-flex fv-row">
                                             <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input me-3" name=role type=radio value=1 id=kt_modal_update_role_option_0 checked>
                                                <label class=form-check-label for=kt_modal_update_role_option_0>
                                                   <div class="fw-bolder text-gray-800">Administrator</div>
                                                   <div class=text-gray-600>Best for business owners and company administrators</div>
                                                </label>
                                             </div>
                                          </div>
                                          <div class="separator separator-dashed my-5"></div>
                                          <div class="d-flex fv-row">
                                             <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input me-3" name=role type=radio value=0 id="kt_modal_update_role_option_1">
                                                <label class=form-check-label for=kt_modal_update_role_option_1>
                                                   <div class="fw-bolder text-gray-800">Member</div>
                                                   <div class=text-gray-600>Best for normal user</div>
                                                </label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- submit button for edit form -->
                                 <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <button name="submit" type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
                                 </div>
                                 <input type="hidden">
                                 <div></div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
         <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
               <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
               <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
            </svg>
         </span>
      </div>
      <script src="../assets/plugins/global/plugins.bundle.js"></script>
      <script src="../assets/js/scripts.bundle.js"></script>
</html>