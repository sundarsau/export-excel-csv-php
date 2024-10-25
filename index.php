<?php
include 'cfg/dbconnect.php';
$sql = "SELECT *  FROM users order by name";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Create CSV & Excel files in PHP</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="container">
		<h1>List of Users</h1>
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead class="table-dark">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Age</th>
						<th>Gender</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($result->num_rows > 0) {
						foreach ($result as $row) {  ?>
							<tr>
								<td><?php echo $row['id']; ?></td>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['age']; ?></td>
								<td><?php echo $row['gender']; ?></td>
							</tr>
						<?php

						}
					} else { ?>
						<tr>
							<td colspan="5"> No Users Found</td>
						</tr>
					<?php }	?>
				</tbody>
			</table>
		</div>
		<?php if ($result->num_rows > 0) { ?>
			<div class="d-flex float-end mb-5">
				<form action="export_data.php" method="post">
					<!-- export to csv -->
					<button
						type="submit"
						class="btn btn-primary"
						name="export_csv">
						Download CSV
					</button>
				</form>&nbsp;
				<form action="export_data.php" method="post">
					<!-- export to excel -->
					<button
						type="submit"
						class="btn btn-success"
						name="export_xls">
						Download Excel
					</button>
				</form>
			</div>
		<?php } ?>
	</div>
</body>

</html>