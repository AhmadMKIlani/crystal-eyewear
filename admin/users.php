<?php
include_once '../includes/db.php';
require_once '../includes/functions.php';
$emailError = "";
$nameError = "";
$passError = "";

if (isset($_POST["user_name"])) {
    $check = true;
    if (empty($_POST["user_name"])) {
        $check = false;
        $nameError = "<span style='color:red'> Name cannot be empty </span>";
    }
    if (empty($_POST["user_email"])) {
        $check = false;
        $emailError = "<span style='color:red'> Email cannot be empty </span>";
    }
    if (empty($_POST["password"])) {
        $check = false;
        $passError = "<span style='color:red'> password cannot be empty </span>";
    }
    if ($check == true) {
        $userName = $_POST["user_name"];
        $userEmail = $_POST["user_email"];
        $password = $_POST["password"];
        $password = md5($password);
        $userRole = $_POST["user_role"];
        //-------------------------------------------------------x--------------------------------------------------------------------------
        $statement=$connection->prepare("SELECT * FROM user WHERE email='{$userEmail}'");
        $statement->execute();
        $user=$statement->fetch(PDO::FETCH_ASSOC);


        //---------------------------------------------------------------------------------------------------
        //successful login
        if($user){
            //don't add the email if it's already existed
            header("Location:users.php?email=email already existed");
            exit();
        }
        else{
            crud($connection, "INSERT", "user", ["username", "email", "password", "role"],
                [$userName, $userEmail, $password, $userRole]);
        }
           header("location:users.php");
      //-----------------------------------------------------------------------------------------

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
                        <div class=card>
                            <div class="card-header border-0 pt-6">
                                <div class=card-title>
                                </div>
                                <div class=card-toolbar>
                                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar=base>
                                        <button type=button class="btn btn-primary" data-bs-toggle=modal
                                                data-bs-target=#kt_modal_add_user>
                                       <span class="svg-icon svg-icon-2">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                               viewBox="0 0 24 24" fill="none">
                                             <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                                   transform="rotate(-90 11.364 20.364)" fill="black"/>
                                             <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"/>
                                          </svg>
                                       </span>
                                            Add User
                                        </button>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center d-none"
                                         data-kt-user-table-toolbar=selected>
                                        <div class="fw-bolder me-5"><span class=me-2
                                                                          data-kt-user-table-select=selected_count></span>Selected
                                        </div>
                                        <button type=button class="btn btn-danger"
                                                data-kt-user-table-select=delete_selected>Delete Selected
                                        </button>
                                    </div>
                                    <div class="modal fade" id=kt_modal_export_users tabindex=-1 aria-hidden=true>
                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                            <div class=modal-content>
                                                <div class=modal-header>
                                                    <h2 class=fw-bolder>Export Users</h2>
                                                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                         data-kt-users-modal-action=close>
                                                <span class="svg-icon svg-icon-1">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                      <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                                            transform="rotate(-45 6 17.3137)" fill="black"/>
                                                      <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                            transform="rotate(45 7.41422 6)" fill="black"/>
                                                   </svg>
                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id=kt_modal_add_user tabindex=-1 aria-hidden=true>
                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                            <div class=modal-content>
                                                <div class=modal-header id=kt_modal_add_user_header>
                                                    <h2 class=fw-bolder>Add User</h2>
                                                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                         data-kt-users-modal-action=close>
                                                <span class="svg-icon svg-icon-1">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                      <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                                            transform="rotate(-45 6 17.3137)" fill="black"/>
                                                      <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                            transform="rotate(45 7.41422 6)" fill="black"/>
                                                   </svg>
                                                </span>
                                                    </div>
                                                </div>
                                                <!-- model starts here for user info -->
                                                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                    <form id=kt_modal_add_user_form class="add_user_form_admin" action=#
                                                          method="post" enctype="multipart/form-data">
                                                        <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                                             id=kt_modal_add_user_scroll data-kt-scroll=true
                                                             data-kt-scroll-activate="{default: false, lg: true}"
                                                             data-kt-scroll-max-height=auto
                                                             data-kt-scroll-dependencies=#kt_modal_add_user_header
                                                             data-kt-scroll-wrappers=#kt_modal_add_user_scroll
                                                             data-kt-scroll-offset=300px>
                                                            <div class="fv-row mb-7"><label
                                                                        class="required fw-bold fs-6 mb-2">Full
                                                                    Name</label><input name="user_name"
                                                                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                                                                       placeholder="Full name"></div>
                                                            <div><?php echo $nameError ?></div>
                                                            <div class="fv-row mb-7"><label
                                                                        class="required fw-bold fs-6 mb-2">Email</label><input
                                                                        type=email name=user_email
                                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                                        placeholder=example@domain.com></div>
                                                            <div><?php echo $emailError ?></div>
                                                            <div class="fv-row mb-7"><label
                                                                        class="required fw-bold fs-6 mb-2">Password</label><input
                                                                        type=password name=password
                                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                                        placeholder=password></div>
                                                            <div><?php echo $passError ?></div>
                                                            <div class=mb-7>
                                                                <label class="required fw-bold fs-6 mb-5">Role</label>
                                                                <div class="d-flex fv-row">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input class="form-check-input me-3"
                                                                               name=user_role type=radio value=1
                                                                               id=kt_modal_update_role_option_0 checked>
                                                                        <label class=form-check-label
                                                                               for=kt_modal_update_role_option_0>
                                                                            <div class="fw-bolder text-gray-800">
                                                                                Administrator
                                                                            </div>
                                                                            <div class=text-gray-600>Best for business
                                                                                owners and company administrators
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="separator separator-dashed my-5"></div>
                                                                <div class="d-flex fv-row">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input class="form-check-input me-3"
                                                                               name=user_role type=radio value=0
                                                                               id="kt_modal_update_role_option_1">
                                                                        <label class=form-check-label
                                                                               for=kt_modal_update_role_option_1>
                                                                            <div class="fw-bolder text-gray-800">
                                                                                Member
                                                                            </div>
                                                                            <div class=text-gray-600>Best for normal
                                                                                user
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-center pt-15">
                                                            <button type=reset class="btn btn-light me-3"
                                                                    data-kt-users-modal-action=cancel>Discard
                                                            </button>
                                                            <button name="submit" type="submit" class="btn btn-primary">
                                                                <span class=indicator-label>Submit</span>
                                                                <span class=indicator-progress>Please wait... <span
                                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id=kt_table_users>
                                    <thead>
                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <th class=min-w-125px>ID</th>
                                        <th class=min-w-125px>Full Name</th>
                                        <th class=min-w-125px>Email</th>
                                        <th class=min-w-125px>Role</th>
                                    </tr>
                                    </thead>
                                    <?php
                                    $sql = $connection->prepare("SELECT * FROM user");
                                    $sql->execute();
                                    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result

                                    as $user) {

                                    ?>
                                    <tbody class="text-gray-600 fw-bold">
                                    <tr>
                                        <td><?php echo $user["id"]; ?></td>
                                        <td><?php echo $user["username"]; ?></td>
                                        <td class="row-class-email"><?php echo $user["email"]; ?></td>
                                        <td><?php if ($user["role"] == 1) {
                                                echo "Admin";
                                            } else {
                                                echo "User";
                                            } ?></td>
                                        <td class="pe-0 text-end">
                                            <a href="edit/user-edit.php?id=<?php echo $user["id"]; ?>"
                                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                               name="edit">
                                             <span data-bs-toggle="tooltip" data-bs-trigger="hover" title=""
                                                   data-bs-original-title="Edit" aria-describedby="tooltip35159">
                                                <span class="svg-icon svg-icon-3">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                      <path opacity="0.3"
                                                            d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                            fill="black"></path>
                                                      <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                            fill="black"></path>
                                                   </svg>
                                                </span>
                                             </span>
                                            </a>
                                            <a href="../admin/user-delete.php?id=<?php echo $user["id"]; ?>"
                                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                               name="delete" data-bs-toggle="tooltip" title=""
                                               data-kt-delete="delete_row" data-bs-original-title="Delete">
                                             <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                   <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                         fill="black"></path>
                                                   <path opacity="0.5"
                                                         d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                         fill="black"></path>
                                                   <path opacity="0.5"
                                                         d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                         fill="black"></path>
                                                </svg>
                                             </span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
               <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black"/>
               <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                     fill="black"/>
            </svg>
         </span>
    <!--end::Svg Icon-->
</div>
<script>

</script>
<script src="../js/main_app.js"></script>
<!--begin::Javascript-->
<!--begin::Global Javascript Bundles(used by all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<!--      <script src="assets/js/users-table.js"></script>-->
<script src="assets/js/add-user.js"></script>
<script src="assets/js/custom/widgets.js"></script>
<!--end::Page Custom Javascript-->
</body>
</html>