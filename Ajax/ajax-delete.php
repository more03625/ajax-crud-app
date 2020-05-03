<?php
	$conn = mysqli_connect("localhost", "root", "", "test") or die("connection to database is failed");

	$student_id = $_POST['delete_id'];

	$sql = "DELETE FROM `students` WHERE `students`.`id` = {$student_id}";

	if (mysqli_query($conn, $sql)) {
		echo 1;
	}else{
		echo 0;
	}
 ?>