<!DOCTYPE html>
<html lang=en>
<?php include_once 'layouts/head.php';
include_once '../includes/db.php';
$stmt = $connection->prepare(
	"SELECT * FROM product_review INNER JOIN user ON user.id = product_review.user_id "
	
);
$stmt->execute();
$user_reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo"<pre>";var_dump($user_review);
// die;



if($_GET){
	$id=$_GET['delete_review'];
$delete = $connection->prepare("DELETE FROM product_review WHERE review_id ={$id}");
		$delete->execute();
		header('location:reviews.php');
	}

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
							<div class="card pt-4 mb-6 mb-xl-9">
								<div class="card-header border-0">
									<div class="card-title">
										<h2>Reviews</h2>
									</div>
								</div>
								<div class="card-body pt-0 pb-5">
									<table class="table align-middle table-row-dashed gy-5" id="kt_table_reviews">
										<thead class="border-bottom border-gray-200 fs-7 fw-bolder">
											<tr class="text-start text-muted text-uppercase gs-0">
											    <th class=min-w-125px>ID</th>
												<th class=min-w-125px>Review</th>
												<th class=min-w-125px>Comments</th>
												<th class=min-w-125px>Created</th>
												<th class=min-w-125px>product ID</th>
												<th class="text-end min-w-100px">Actions</th>
											</tr>
										</thead>
										<tbody class="fs-6 fw-bold text-gray-600">
											<?php
											foreach ($user_reviews as $review) {
												?>
												
										
											<tr>
												<td>
													<?php echo $review['review_id'] ?>
												</td>
												<td><?php echo $review['review_title'] ?></td>
												<td>
												<?php echo $review['review_comments'] ?>
												
												</td>
												<td><?php echo $review['date_created'] ?></td>
												<td><?php echo $review['product_id'] ?></td>
												<td class="pe-0 text-end">
													
													<a href="reviews.php?delete_review=<?php echo $review['review_id']?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"  title="" >
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
																<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
																<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
															</svg>
														</span>
													</a>
												</td>
											</tr>
									<?php	}
										?>
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
	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<span class="svg-icon">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
				<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
			</svg>
		</span>
	</div>
	<script>
		var hostUrl = "assets/";
	</script>
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
	<script src="assets/js/reviews-table.js"></script>
</body>

</html>