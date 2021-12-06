<!DOCTYPE html>
<html lang=en>
<?php include_once 'layouts/head.php';
include_once '../includes/db.php';
$stmt = $connection->prepare(
	"SELECT * FROM order_summary INNER JOIN user ON user.id = order_summary.user_id "
);
$stmt->execute();
$order_summary = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($order_summary);
// die;
if($_GET){
	$id=$_GET['order_id'];
$delete = $connection->prepare("DELETE FROM order_summary WHERE order_id ='{$id}'");
		$delete->execute();
		header('location:orders.php');
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
										<h2>Last Orders</h2>
									</div>
								</div>
								<div class="card-body pt-0 pb-5">
									<table class="table align-middle table-row-dashed gy-5" id="kt_table_orders">

										<thead class="border-bottom border-gray-200 fs-7 fw-bolder">

											<tr class="text-start text-muted text-uppercase gs-0">
												<th class="min-w-100px">Customer Name</th>
												<th>Status</th>
												<th>Amount</th>
												<th class="min-w-100px=">Date</th>
											</tr>
										</thead>
										<tbody class="fs-6 fw-bold text-gray-600">
											<?php
											foreach ($order_summary as $order_data ) {
												
											
											?>
											<tr>
												<td><?php echo $order_data['username'] ;?></td>
												<td>
													<?php
													//  echo $order_data['order_status'];
													 if($order_data['order_status']==="pending"){
													echo '<span class="badge badge-light-warning">Pending</span>';
												 }                            
												 else if($order_data['order_status']==="Rejected"){
													echo '<span class="badge badge-light-danger">Rejected</span>';
												 }
												 else if($order_data['order_status']==="Successful"){
													echo '<span class="badge badge-light-success">Successful</span>';
												 }
												 
												 ?>
												</td>
												<td><?php echo $order_data['order_total_price'] ?></td>
												<td><?php echo $order_data['date_of_creation'] ?></td>
											</tr>
										
											
											<?php }?>
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
	<script src="assets/js/order-table.js"></script>
</body>

</html>