<?php 
	$conn = mysqli_connect("localhost", "root", "", "test") or die("connection to database is failed");

	$student_id = $_POST['id']; //`id` is key

	$sql = "SELECT * FROM students WHERE id = $student_id";
	$result = mysqli_query($conn, $sql) or die("SQL query failed");
	

	if (mysqli_num_rows($result) > 0) {
		$output = '';

		while ($row = mysqli_fetch_assoc($result)) {
			$output .= '    
			<!-- Modal body -->
			<div class="modal-body">
			   <div class="modal-body">
			      <div class="form-group">
			         <label for="email">First Name</label>
			         <input type="email" class="form-control" placeholder="First name" id="edit-first-name" value="'.$row["full_name"].'">

			         <input type="hidden" class="form-control" id="edit-id" value="'.$row["id"].'">
			      </div>
			      <div class="form-group">
			         <label for="pwd">Last Name</label>
			         <input type="text" class="form-control" placeholder="Last name" id="edit-last-name" value="'.$row["last_name"].'">
			      </div>
			      <button type="submit" class="btn btn-primary" id="edit-submit">Submit</button>
			   </div>
			</div>';
		}
		echo $output;
	}
	mysqli_close($conn);

 ?>