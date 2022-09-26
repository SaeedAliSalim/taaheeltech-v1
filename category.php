<?php if (!isset($_SESSION)) {
	session_start();
}
if (isset($_SESSION['admin_role'])) {
	include('config.php');
	include('function.php'); 
	$breadcrumb_array = array(
		"لوحة التحكم",
		"إدارة التصنيفات"
	);
	include('header.php');
?>
	<?php
	if (isset($_GET['del_id']) && !empty($_GET['del_id'])) {
		$del_id = input_secure($_GET['del_id']);
		// Delete Row
		mysqli_query($connection, "DELETE FROM category WHERE id='". $del_id ."'");
		?>
		<script language="javascript">window.location.href="category.php";</script>
		<?php 
	} else {
	?>
		<!--begin::Card-->
		<div class="card card-custom">
			<div class="card-header">
				<div class="card-title">
					<h3 class="card-label">
						إدارة التصنيفات
					</h3>
				</div>
				<div class="card-toolbar">
					<!--begin::Button-->
					<a href="category_add.php" class="btn btn-primary font-weight-bolder">
						إضافة تصنيف
					</a>
					<!--end::Button-->
				</div>
			</div>
			<div class="card-body">
				<!--begin: Datatable-->
				<table class="table datatable-bordered datatable-head-custom">
					<thead>
						<tr>
							<th>ID</th>
							<th>اسم التصنيف</th>
							<th>نوع التصنيف</th>
							<th> الحـالة</th>
							<th class="text-primary"> تعديل</th>
							<th class="text-danger"> حذف</th>
						</tr>
					</thead>
					<tbody>
						<?php
						// Select Queries

						$result = mysqli_query($connection, "SELECT * from category ORDER BY ID ");


						while ($row = mysqli_fetch_array($result)) {
						?>
							<tr>
								<td> <?php echo $row['id']; ?></td>
								<td> <?php echo $row['cat_name']; ?></td>
								<td> <?php
										switch ($row['cat_type']) {
											case "1":
												echo "مقالات";
												break;
											case "2":
												echo "صور";
												break;
											case "3":
												echo "فيدوهات";
												break;
										}
										?></td>
								<td> <?php if ($row['pvalid'] == 1) {
											echo "فعال";
										} else {
											echo "غير فعال";
										} ?></td>
								<td><a href="category_update.php?update_id=<?php echo $row['id']; ?>"><span class="text-primary">تعديل</span></a></td>
								<td><a href="category.php?del_id=<?php echo $row['id']; ?>">
										<span class="text-danger">حذف</span></a></td>
							<?php } ?>
							</tr>

					</tbody>
				</table>
				<!--end: Datatable-->
			</div>
		</div>
		<!--end::Card-->
	<?php
	}
	include('footer.php');
} else {
	?>
	<script language="javascript">
		window.location.href = "index.php?error_msg=1";
	</script>
<?php
}
?>