<!DOCTYPE html>
<html lang=en>
<?php
include_once '../../includes/db.php';

if (isset($_GET['product_id'])) {
	$id = $_GET['product_id'];
	$stmt = $connection->prepare(
		"SELECT * FROM products WHERE product_id = {$_GET['product_id']}"
	);
	$stmt->execute();
	$product_edited = $stmt->fetch(PDO::FETCH_ASSOC);
	$product_name = $product_edited['product_name'];
	$product_price = $product_edited['product_price'];
	$product_percentage_price  = $product_edited['product_percentage_price'];

	$product_description = $product_edited['product_description'];
	$featured_product = $product_edited['featured_products'];
	$product_image = $product_edited['product_image'];
	$product_category = $product_edited['category_id'];
	$product_sub_category = $product_edited['sub_category_id'];

	if (isset($_POST['save'])) {
		$product_name  = $_POST['product_name'];
		$product_price  = $_POST['product_price'];
		$product_percentage_price  = $_POST['product_percentage_price'];
		$product_description = $_POST['product_description'];
		$featured_product = $product_edited['featured_products'];
		$product_category  = $_POST['category'];
		$product_sub_category  = $_POST['subcategory'];
		$rand = rand(1, 99999);
		$product_image = $rand . $_FILES["image"]["name"];
		$destination = "../assets/media/products_images/" . $rand . $_FILES["image"]["name"];
		$image = ",product_image = '{$product_image}'";

		if ($_FILES["image"]["size"] == 0) {
			$image = '';
		}

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
			echo  "<h1>image uploaded</h1>";
		} else {
			echo "<h1>image not uploaded</h1>";
		}
		if (!empty($_POST['featured'])) {
			$featured_product  = $_POST['featured'];
		}
		$update = $connection->prepare("UPDATE products 
		                                SET   product_name             ='{$product_name}',
										      product_price            ='{$product_price}',
											  product_percentage_price = '{$product_percentage_price}',
											  featured_products        = '{$featured_product}',
											  product_description      ='{$product_description}'{$image},
											  category_id              = '{$product_category}',
											 sub_category_id           = '{$product_sub_category}'
										WHERE product_id               =  {$id}");
		$update->execute();
		header('location:../products.php');
	}
}
?>
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
										<h3 class="fw-bolder m-0">Edit Products</h3>
									</div>
								</div>
								<div id="kt_account_settings_profile_details" class="collapse show">
									<form id=kt_modal_add_user_form class=form action=# method="post" enctype="multipart/form-data">
										<div class="d-flex flex-column scroll-y me-n7 pe-7" id=kt_modal_add_user_scroll data-kt-scroll=true data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height=auto data-kt-scroll-dependencies=#kt_modal_add_user_header data-kt-scroll-wrappers=#kt_modal_add_user_scroll data-kt-scroll-offset=300px>
											<div class="fv-row mb-7">
												<label class="d-block fw-bold fs-6 mb-5">Product Image</label>
												<div class="image-input image-input-outline" data-kt-image-input=true style="background-image: url()">
													<div class="image-input-wrapper w-125px h-125px" style="background-image: url(../assets/media/products_images/<?php echo $product_edited["product_image"]; ?>);"></div>
													<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action=change data-bs-toggle=tooltip title="Change avatar"><i class="bi bi-pencil-fill fs-7"></i> <input type="file" name="image" value="<?php echo $product_edited['product_image']; ?>" accept=".png, .jpg, .jpeg" class="form-control-file"> <input type=hidden name="avatar_remove"></label><span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action=cancel data-bs-toggle=tooltip title="Cancel avatar"><i class="bi bi-x fs-2"></i></span> <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action=remove data-bs-toggle=tooltip title="Remove avatar"><i class="bi bi-x fs-2"></i></span>
												</div>
												<div class=form-text>Allowed file types: png, jpg, jpeg.</div>
											</div>
											<div class="fv-row mb-7"><label class="required fw-bold fs-6 mb-2">Product Name</label><input name="product_name" class="form-control form-control-solid mb-3 mb-lg-0" value="<?php echo $product_edited['product_name']; ?>" required></div>
											<div class="fv-row mb-7"><label class="required fw-bold fs-6 mb-2">Product Price </label><input type=number name="product_price" class="form-control form-control-solid mb-3 mb-lg-0" value="<?php echo $product_edited['product_price']; ?>" required></div>
											<div class="fv-row mb-7"><label class="required fw-bold fs-6 mb-2">Product Percentage Price </label><input type=number name="product_percentage_price" class="form-control form-control-solid mb-3 mb-lg-0" value="<?php echo $product_edited['product_percentage_price']; ?>" required></div>
											<div class="fv-row mb-7"><label class="required fw-bold fs-6 mb-2">Product Description</label><input type=text name="product_description" class="form-control form-control-solid mb-3 mb-lg-0" value="<?php echo $product_edited['product_description']; ?>" description required></div>
											<div class="form-check my-5">
												<input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="featured">
												<label class="form-check-label" for="flexCheckChecked">
													featured product
												</label>
											</div>
											<div class=mb-7>
												<label class="required fs-6 fw-bold mb-2">Category</label>
												<select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="" name="category" required>
													<option value="<?php echo $product_edited['category_id']; ?>"><?php
																													$sql1 = $connection->prepare("SELECT * FROM category");
																													$sql1->execute();
																													$result1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
																													foreach ($result1 as $category) {
																														if ($product_edited['category_id'] === $category['category_id']) {
																															echo $category['category_name'];
																														}
																													}
																													?></option>
													<?php
													$sql1 = $connection->prepare("SELECT * FROM category");
													$sql1->execute();
													$result1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
													foreach ($result1 as $category) {
													?>
														<option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>;
													<?php } ?>
												</select>
											</div>
											<div class=mb-7>
												<label class="required fs-6 fw-bold mb-2">Subcategory</label>
												<select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="" name="subcategory" required>
													<option value="<?php echo $product_edited['sub_category_id']; ?>"><?php
																														$sql1 = $connection->prepare("SELECT * FROM sub_category");
																														$sql1->execute();
																														$result1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
																														foreach ($result1 as $category) {
																															if ($product_edited['sub_category_id'] === $category['sub_category_id']) {
																																echo $category['sub_category_name'];
																															}
																														}
																														?></option>
													<?php
													$sql2 = $connection->prepare("SELECT * FROM sub_category");
													$sql2->execute();
													$result2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
													foreach ($result2 as $sub_category) {
													?>
														<option value="<?php echo $sub_category['sub_category_id'] ?>"><?php echo $sub_category['sub_category_name'] ?></option>;
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="text-center pt-15"><a href="http://localhost/Crystal-Eyewear/admin/products.php" id="reset" type=reset class="btn btn-light me-3" data-kt-users-modal-action=cancel>Discard</a>
											<button name="save" type="submit" class="btn btn-primary"><span class=indicator-label>Save</span>
												<span class=indicator-progress>Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span></button>
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