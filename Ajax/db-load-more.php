<?php
//related load-more.php
	$conn = mysqli_connect("localhost", "root", "", "test") or die("connection to database is failed");

	$sql = "SELECT * FROM students ORDER BY `id` DESC";
	$result = mysqli_query($conn, $sql) or die("SQL query failed");
	$output = "";

	if (mysqli_num_rows($result) > 0) {
		$output = '<table class="table table-striped">
					    <thead>
					      <tr>
					        <th>id</th>
					        <th>first name</th>
					        <th>last name</th>
					        <th>Edit</th>
					        <th>Delete</th>
					      </tr>
					    </thead>
					    <tbody>';

		while ($row = mysqli_fetch_assoc($result)) {
			$output .= "<tr>
							<td>{$row["id"]}</td>
							<td>{$row["full_name"]}</td>
							<td>{$row["last_name"]}</td>
							<td><button class='btn btn-warning fa fa-edit edit-button' data-eid='{$row["id"]}' data-toggle='modal' data-target='#myModal'></button></td>

							<td><button class='btn btn-danger delete-button fa fa-trash' data-id='{$row["id"]}' id='deleteBtn'></button></td>

						</tr>";
		}
		$output .= "</tbody>
					</table>";

		mysqli_close($conn);
		echo $output;
	}else{
		echo "No record Found";
	}
 ?>