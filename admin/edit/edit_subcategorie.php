<!DOCTYPE html>
<html lang=en>
<?php
include_once 'layouts/head.php';
include_once '../../includes/db.php';



if (isset($_GET['sub_category_id'])) {
	$id = $_GET['sub_category_id'];
	$stmt = $connection->prepare(
		"SELECT * FROM sub_category WHERE sub_category_id={$_GET['sub_category_id']}"
	);
	$stmt->execute();
	$edit_sub_category = $stmt->fetch(PDO::FETCH_ASSOC);
	$sub_cat_name = $edit_sub_category['sub_category_name'];
	$sub_cat_desc = $edit_sub_category['sub_category_description'];
	$category_err = "";
	$sub_cat_name_err="";
	// print_r($edit_sub_category['sub_category_name']);
	// die;
	if (isset($_POST['submit'])) {

		$cat_id = $_POST['sub_category_select'];
		$sub_cat_name = $_POST['sub_category_name'];
		$sub_cat_desc = $_POST['sub_category_desc'];
		$check = 1;
		if (empty($cat_id)) {
			$category_err = "you must choose a category";
			$check = 0;
		}
		if (empty($sub_cat_name) || empty($sub_cat_desc)) {
			$sub_cat_name_err = "this field is require";
			$check = 0;
		}

		$rand = rand(1, 9999);
		$id = $_GET['sub_category_id'];
		$sub_cat_image = $rand . $_FILES['sub_category_image']['name'];
		$destination ='../assets/media/avatars/' .$rand .$_FILES['sub_category_image']['name'];

		$img = ",sub_category_image ='{$sub_cat_image}'";
		if ($_FILES['sub_category_image']['size'] == 0) {
			$img = '';
		}

		if (move_uploaded_file($_FILES['sub_category_image']['tmp_name'],$destination)) {
			echo '<h1>yes upload</h1>';} 
			else {
			echo '<h1>not upload</h1>';
			}
		if ($check == 1) {


			$update = $connection->prepare("UPDATE sub_category SET sub_category_name ='{$sub_cat_name}',
				 						sub_category_description='{$sub_cat_desc}',
										 category_id='{$cat_id}'{$img}
										  WHERE sub_category_id={$id}");
			$update->execute();
			header('location:../Subcategorie.php');
		}
	}
}
$stmt_cat = $connection->prepare('SELECT * FROM category');
$stmt_cat->execute();
$cats = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);

$sql = $connection->prepare(
	' SELECT * FROM sub_category INNER JOIN category ON category.category_id = sub_category.category_id '
);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

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
										<h3 class="fw-bolder m-0">Edit Subcategorys</h3>
									</div>
								</div>
								<div id="kt_account_settings_profile_details" class="collapse show">









									<form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" method="post" enctype="multipart/form-data">
										<div class="card-body border-top p-9">
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label fw-bold fs-6">Avatar</label>
												<div class="col-lg-8">
													<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(../assets/media/avatars/blank.png)">
														<div class="image-input-wrapper w-125px h-125px" style="background-image: url(../assets/media/avatars/<?php echo $edit_sub_category['sub_category_image']; ?>)"></div>
														<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
															<i class="bi bi-pencil-fill fs-7"></i>
															<input type="file" name="sub_category_image" accept=".png, .jpg, .jpeg">
															<input type="hidden" name="avatar_remove">
														</label>
														<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="Cancel avatar">
															<i class="bi bi-x fs-2"></i>
														</span>
														<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="Remove avatar">
															<i class="bi bi-x fs-2"></i>
														</span>
													</div>
													<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
												</div>
											</div>
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">category</label>
												<div class="col-lg-8 fv-row fv-plugins-icon-container">

													<select class="form-select form-select-solid" data-control="select2" data-hide-search="true"  name="sub_category_select">

														<?php foreach ($cats as $cat) {
															 ?>
															<option selected value="<?php echo $cat['category_id']; ?>">
															<?php echo $cat['category_name'];?></option>
																  
														<?php } ?>
														
													</select>
													<span class="text-danger"><?php echo $category_err ?></span>
												</div>
												
											</div>
											
											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">Name</label>
												<div class="col-lg-8 fv-row fv-plugins-icon-container">
													<input type="text" name="sub_category_name" class="form-control form-control-lg form-control-solid"
													 placeholder="Company name" 
													 value="<?php echo $edit_sub_category['sub_category_name'];?>">
													<div class="fv-plugins-message-container invalid-feedback">
														<span class="text-danger"><?php echo $sub_cat_name_err?></span>
													</div>
												</div>
												
											</div>
											


											<div class="row mb-6">
												<label class="col-lg-4 col-form-label required fw-bold fs-6">Description</label>
												<div class="col-lg-8 fv-row fv-plugins-icon-container">
													<input type="text" name="sub_category_desc" 
													class="form-control form-control-lg form-control-solid"
													 placeholder="Company name" 
													 value="<?php echo $edit_sub_category['sub_category_description'];?>"
																																															
													<div class="fv-plugins-message-container invalid-feedback">
													<span class="text-danger"><?php echo $sub_cat_name_err ?></span>
													</div>
												</div>
											</div>
											

										</div>
										<div class="card-footer d-flex justify-content-end py-6 px-9">
											<button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit" name="submit">Save Changes</button>
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