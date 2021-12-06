<div id="kt_header" class="header align-items-stretch">
   <!--begin::Container-->
   <div class="container-fluid d-flex align-items-stretch justify-content-between">
      <!--begin::Aside mobile toggle-->
      <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
         <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
            <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
            <span class="svg-icon svg-icon-2x mt-1">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                  <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
               </svg>
            </span>
            <!--end::Svg Icon-->
         </div>
      </div>
      <!--end::Aside mobile toggle-->
      <!--begin::Mobile logo-->
      <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
         <a href="../../demo1/dist/index.html" class="d-lg-none">
         <img alt="Logo" src="assets/media/logos/logo-2.svg" class="h-30px" />
         </a>
      </div>
      <!--end::Mobile logo-->
      <!--begin::Wrapper-->
      <div class="d-flex align-items-stretch justify-content-end flex-lg-grow-1">
         <!--begin::Topbar-->
         <div class="d-flex align-items-stretch flex-shrink-0">
            <!--begin::Toolbar wrapper-->
            <div class="d-flex align-items-stretch flex-shrink-0">
               <!--begin::Search-->
               <!--begin::User-->
               <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                  <!--begin::Menu wrapper-->
                  <div class="cursor-pointer symbol symbol-30px symbol-md-40px fs-6 fw-bolder" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                     <?php echo $_SESSION['admin-name']??"";?>
                     <img class=" ms-2" src="assets/media/avatars/150-26.jpg" alt="user" />
                  </div>
                  <!--begin::Menu-->
                  <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                     <!--begin::Menu item-->
                     <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                           <!--begin::Avatar-->
                           <div class="symbol symbol-50px me-5">
                              <img alt="Logo" src="assets/media/avatars/150-26.jpg" />
                           </div>
                           <!--end::Avatar-->
                           <!--begin::Username-->
                           <div class="d-flex flex-column">
                              <div class="fw-bolder d-flex align-items-center fs-5">Max Smith
                              </div>
                              <a href="#" class="fw-bold text-muted text-hover-primary fs-7">max@kt.com</a>
                           </div>
                           <!--end::Username-->
                        </div>
                     </div>
                     <!--end::Menu item-->
                     <!--begin::Menu separator-->
                     <div class="separator my-2"></div>
                     <!--end::Menu separator-->
                     <!--begin::Menu item-->
                     <div class="menu-item px-5 my-1">
                        <form action="../includes/logic.php" method="post">
                           <button type="submit" name="log_out_adminDash"
                              class="nav-link btn btn-sm btn-color-muted btn-active 
                              btn-active-light-primary active fw-bolder px-4 me-1">log out</button>
                        </form>
                     </div>
                     <!--end::Menu item-->
                  </div>
                  <!--end::Menu-->
                  <!--end::Menu wrapper-->
               </div>
               <!--end::User -->
               <!--begin::Heaeder menu toggle-->
               <!--end::Heaeder menu toggle-->
            </div>
            <!--end::Toolbar wrapper-->
         </div>
         <!--end::Topbar-->
      </div>
      <!--end::Wrapper-->
   </div>
   <!--end::Container-->
</div>